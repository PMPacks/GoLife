<?php
/**
*
* 
*  _____                 _            _             
* |_   _|               | |          | |            
*   | |  _ __ ___  _ __ | | __ _  ___| |_ ___  _ __ 
*   | | | '_ ` _ \| '_ \| |/ _` |/ __| __/ _ \| '__|
*  _| |_| | | | | | |_) | | (_| | (__| || (_) | |   
* |_____|_| |_| |_| .__/|_|\__,_|\___|\__\___/|_|   
*                 | |                               
*                 |_|                               
*
* Implactor (c) 2018
* This plugin is licensed under GNU General Public License v3.0!
* It is free to use, copyleft license for software and other 
* kinds of works.
* ------===------
* > Author: Zadezter
* > Team: ImpladeDeveloped
*
*
**/
declare(strict_types=1);
namespace Implactor;

use pocketmine\{
	Player, Server
};
use pocketmine\level\{
	Level, Position
};
use pocketmine\utils\{
	Utils, Config as ImpladeConfig
};
use pocketmine\plugin\{
	Plugin, PluginBase, PluginDescription as ImplactorDescription
};
use pocketmine\nbt\tag\{
	CompoundTag, ListTag, DoubleTag, FloatTag, NamedTag, StringTag
};
use pocketmine\command\{
	Command, CommandSender
};
use pocketmine\entity\{
	Effect, EffectInstance, Entity, Creature, Human
};
use pocketmine\item\enchantment\{
	    Enchantment, EnchantmentInstance
};
use pocketmine\level\sound\{
	EndermanTeleportSound as Join, BlazeShootSound as Quit, GhastSound as DeathOne, AnvilBreakSound as DeathTwo, DoorBumpSound as Bot, FizzSound as Book
};
use pocketmine\event\entity\{
	EntityDamageEvent, EntityDamageByEntityEvent
};
use pocketmine\event\player\{
	PlayerPreLoginEvent, PlayerLoginEvent, PlayerJoinEvent, PlayerQuitEvent, PlayerDeathEvent, PlayerRespawnEvent, PlayerChatEvent, PlayerMoveEvent
};
use pocketmine\level\particle\{
        FlameParticle as Ball, HugeExplodeParticle as BallShoot
};
use pocketmine\level\particle\DestroyBlockParticle as Bloodful;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket as BallSoundPacket;
use pocketmine\inventory\PlayerInventory;
use pocketmine\event\Listener;
use pocketmine\nbt\NBT;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\utils\Color as Rainbow;
use Exception as Unknown;

use Implactor\listeners\{
	AntiAdvertising, AntiSwearing, AntiCaps, BotListener
};
use Implactor\tasks\{
	ChatCooldownTask, ClearLaggTask, GuardianJoinTask, TotemRespawnTask, RainbowArmorTask, DeathHumanDespawnTask, BotTask
};
use Implactor\tridents\{
	Trident, ThrownTrident, TridentEntityManager, TridentItemManager
};
use Implactor\particles\{
	SpawnParticles, DeathParticles, DespawnParticles
};
use Implactor\entities\{
	DeathHuman, BotHuman, SoccerSlime
};
use onebone\economyapi\EconomyAPI;
use jojoe77777\FormAPI\FormAPI;

class Implade extends PluginBase implements Listener {
	
	    public $rainbows = array();
	    public $timers = array();
	    public $config;
	    public $lang;
	    public $impladePrefix = "§7[§aI§6R§7]§r ";
        public $wild = [];
        public $ichat = [];
        private $visibility = [];
        
        public function onLoad(): void{
        	$this->getLogger()->info("Loading the code systems and resources from Implactor...");
        	$this->getLogger()->notice("Checking the update...");
        try{
        	if(($update = (new ImplactorDescription(file_get_contents("https://raw.githubusercontent.com/ImpladeDeveloped/Implactor/Implade/plugin.yml")))->getVersion()) != $this->getDescription()->getVersion()){
        	    $this->getLogger()->notice("New version $update is now available! Update it on Github or Poggit!");
             }else{
                $this->getLogger()->info("Implactor is already updated to the latest version!");   
               }
             }catch(Unknown $ex){
             $this->getLogger()->warning("Unable to checking the update!");
             }
        }
        
        public function onEnable(): void{
		$this->getLogger()->info("Implactor is currently now online! Thanks for using this plugin!");
		$this->getScheduler()->scheduleRepeatingTask(new SpawnParticles($this, $this), 15);
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->configLanguages();
		$this->getLogger()->info("Implactor is licensed under GNU General Public License v3.0");
		$this->checkDepends();
		$this->checkTridents();      
		$this->checkEntities();
		$this->checkListeners();
		$this->autoClearLagg();
	}
        
        public function checkDepends(): void{
        	$this->getLogger()->info("Checking all depends from Implactor...");
        	$this->form = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            $this->getLogger()->info("FormAPI found in plugins folder! Enabling the UI systems!");
            if(is_null($this->form)){
            	$this->getLogger()->warning("FormAPI not found in plugins folder! Disabling the UI systems!");
            }
            $this->economy = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
            $this->getLogger()->info("EconomyAPI found in plugins folder! Enabling the kill money feature!");
            if(is_null($this->economy)){
            	$this->getLogger()->warning("EconomyAPI not found in plugins folder! Disabling the money killer feature!");
            }
        }

	private function checkTridents(){
        	$this->getLogger()->info("Checking all Mysterious Legendary Trident files from Implactor...");
        	TridentEntityManager::init();
		TridentItemManager::init();
        }
        
	public function checkEntities(){
		Entity::registerEntity(DeathHuman::class, true);
		Entity::registerEntity(BotHuman::class, true);
		Entity::registerEntity(SoccerSlime::class, true);
	}
        
        public function checkListeners(){
		$this->getServer()->getPluginManager()->registerEvents(new AntiAdvertising($this), $this);
		$this->getServer()->getPluginManager()->registerEvents(new AntiSwearing($this), $this);
		$this->getServer()->getPluginManager()->registerEvents(new AntiCaps($this), $this);
		$this->getServer()->getPluginManager()->registerEvents(new BotListener($this), $this);          
        }
        
        public function autoClearLagg(){
        	if(is_numeric(480)){  	
                $this->getScheduler()->scheduleRepeatingTask(new ClearLaggTask($this, $this), 480 * 20);
             }
        }

        public function configLanguages(){ 
            if(!file_exists($this->getDataFolder())){ 
                @mkdir($this->getDataFolder()); 
            } 
            if(!is_file($this->getDataFolder()."iConfig.yml")){ 
                 $this->saveResource("iConfig.yml"); 
            } 
            $this->config = new ImpladeConfig($this->getDataFolder(). "iConfig.yml", ImpladeConfig::YAML);
            if(!file_exists($this->getDataFolder()."languages/")){ 
                @mkdir($this->getDataFolder()."languages/"); 
            } 
            if(!is_file($this->getDataFolder(). "languages/English.yml")){ 
                $this->saveResource("languages/English.yml"); 
            } 
            if(!is_file($this->getDataFolder(). "languages/Malay.yml")){
                $this->saveResource("languages/Malay.yml");
            }
            if(!is_file($this->getDataFolder(). "languages/Espanish.yml")){
                $this->saveResource("languages/Espanish.yml");
            }
            if(!is_file($this->getDataFolder(). "languages/{$this->config->get('language')}.yml")){ 
                $this->lang = new ImpladeConfig($this->getDataFolder(). "languages/English.yml", ImpladeConfig::YAML); 
                $this->getLogger()->info("[English] Selected language to English!"); 
	    }
            if(!is_file($this->getDataFolder(). "languages/{$this->config->get("language")}.yml")){
	        $this->lang = new ImpladeConfig($this->getDataFolder(). "languages/Malay.yml", ImpladeConfig::YAML); 
                $this->getLogger()->info("[Malay] Bahasa Melayu telah dipilih!"); 
	    }
            if(!is_file($this->getDataFolder(). "languages/{$this->config->get("language")}.yml")){
                $this->lang = new ImpladeConfig($this->getDataFolder(). "languages/Espanish.yml", ImpladeConfig::YAML);
                $this->getLogger()->info("[Espanish] Idioma seleccionado Espanish!");
            }
        }  	
        
        public function onDisable(): void{
        	$this->getLogger()->notice("Oh no, Implactor has self-destructed it's system and now finally closed!");
		$this->getScheduler()->cancelAllTasks();
        }
        
        public function onPreLogin(PlayerPreLoginEvent $ev): void{
        	$player = $ev->getPlayer();
            if(!$this->getServer()->isWhitelisted($player->getName())){
            	$ev->setKickMessage($this->getLang("server-whitelisted-message"));
                $ev->setCancelled(true);
             }
        }

	public function onLogin(PlayerLoginEvent $ev): void{
		$player = $ev->getPlayer();
		$spawn = $this->getServer()->getDefaultLevel()->getSafeSpawn();
		$player->teleport($spawn);
        }
        
        public function onJoin(PlayerJoinEvent $ev): void{
        	$player = $ev->getPlayer();
            $player->sendMessage($this->impladePrefix. $this->getLang("join-notice-message"));
            $player->setGamemode(Player::SURVIVAL);
	        $this->getScheduler()->scheduleDelayedTask(new GuardianJoinTask($this, $player), 25);
	      if($player->isOP()){
		      $ev->setJoinMessage($this->getLang("join-message-operators") .$player->getName());
			  $player->getLevel()->addSound(new Join($player));
		   }else{
			  $ev->setJoinMessage($this->getLang("join-message-players") .$player->getName());
			  $player->getLevel()->addSound(new Join($player));
			}
			if(!in_array($player->getName(), $this->rainbows)){
			$this->rainbows[] = $player->getName();
		    }
		    $this->rainbows[$player->getName()] = 0;
		    if(!in_array($player->getName(), $this->timers)){
			    $this->timers[] = $player->getName();
		    }
		    $this->timers[$player->getName()] = 0;
		    $player->getArmorInventory()->clearAll();
	    }
	
        public function onDeath(PlayerDeathEvent $ev): void{
            $player = $ev->getPlayer();
            $level = $player->getLevel();
            $level->addSound(new DeathOne($player));
            $level->addSound(new DeathTwo($player));
            $player->sendMessage($this->impladePrefix. $this->getLang("death-message"));
            $this->getScheduler()->scheduleDelayedTask(new DeathParticles($this, $player), 1);
            if($player->getLastDamageCause() instanceof EntityDamageByEntityEvent){
            	if($player->getLastDamageCause()->getDamager() instanceof Player){
            	     $playerKiller = $player->getLastDamageCause()->getDamager();
                     $weaponKiller = $playerKiller->getInventory()->getItemInHand()->getName();
                     if(!EconomyAPI::getInstance()->addMoney($playerKiller, 220)){
                         $this->getLogger()->error("There was a error problem with EconomyAPI! It failed to add money to the killer!");
                         return;
                        }
                         $message = str_replace("×MONEY×", 220, $this->getLang("death-money-message"));
                         $message = str_replace("×INNOCENT×", $player->getName(), $message);
                         $message = str_replace("×KILLER×", $playerKiller->getName(), $message);
                         $message = str_replace("×WEAPON×", $weaponKiller, $message);
                         $player->getServer()->broadcastMessage($this->impladePrefix. $message);
                   }
            }
            $deathNBT = new CompoundTag("",[
              new ListTag("Pos", [
                 new DoubleTag("", $player->getX()),
                 new DoubleTag("", $player->getY() - 1),
				 new DoubleTag("", $player->getZ())
			  ]),
			  new ListTag("Motion", [
				 new DoubleTag("", 0),
				 new DoubleTag("", 0),
				 new DoubleTag("", 0)
			  ]),
			  new ListTag("Rotation", [
				 new FloatTag("", 2),
				 new FloatTag("", 2)
			  ])
		    ]);
		    $deathNBT->setTag($player->namedtag->getTag("Skin"));
		    $death = new DeathHuman($level, $deathNBT);
		    $death->getDataPropertyManager()->setBlockPos(DeathHuman::DATA_PLAYER_BED_POSITION, new Vector3($player->getX(), $player->getY(), $player->getZ()));
		    $death->setPlayerFlag(DeathHuman::DATA_PLAYER_FLAG_SLEEP, true);
		    $death->setNameTag("§7[§cDeath§7]§r\n§f" .$player->getName());
		    $death->setNameTagAlwaysVisible(true);
		    $death->spawnToAll();
		    $this->getScheduler()->scheduleDelayedTask(new DeathHumanDespawnTask($this, $death, $player), 1300);
        }
        
	public function onRespawn(PlayerRespawnEvent $ev): void{
		$player = $ev->getPlayer();
		$player->setGamemode(Player::SURVIVAL);
                $title = $this->getLang("respawn-title");
                $subtitle = $this->getLang("respawn-subtitle");
		$player->addTitle($title, $subtitle);
		$this->getScheduler()->scheduleDelayedTask(new TotemRespawnTask($this, $player), 1);
	}
        
        public function onMove(PlayerMoveEvent $ev): void{
        	$player = $ev->getPlayer();
		    $speed = $ev->getFrom()->distanceSquared($ev->getTo()) * 5;
		    foreach($player->getLevel()->getNearByEntities($player->getBoundingBox()->expandedCopy(0.6, 0.6, 0.6), $player) as $entity){
			if($entity instanceof SoccerSlime){
				$entity->getLevel()->addParticle(new BallShoot($entity));
				switch($player->getDirection()){
					case 0:
					$entity->setMotion(new Vector3($speed, $speed / 4, 0));
					$entity->level->broadcastLevelSoundEvent($entity, BallSoundPacket::SOUND_POP);
					$entity->getLevel()->addParticle(new Ball($entity));
					break;
					case 1:
					$entity->setMotion(new Vector3(0, $speed / 4, $speed));
					$entity->level->broadcastLevelSoundEvent($entity, BallSoundPacket::SOUND_POP);
					$entity->getLevel()->addParticle(new Ball($entity));
					break;
					case 2:
					$entity->setMotion(new Vector3(-$speed, $speed / 4, 0));
					$entity->level->broadcastLevelSoundEvent($entity, BallSoundPacket::SOUND_POP);
					$entity->getLevel()->addParticle(new Ball($entity));
					break;
					case 3:
					$entity->setMotion(new Vector3(0, $speed / 4, -$speed));
					$entity->level->broadcastLevelSoundEvent($entity, BallSoundPacket::SOUND_POP);
					$entity->getLevel()->addParticle(new Ball($entity));
					break;
				}
			}
		}
	}
        
        public function onChat(PlayerChatEvent $ev): void{
        	$player = $ev->getPlayer();
            if(isset($this->ichat[$player->getName()])){
            	$ev->setCancelled(true);
                $player->sendMessage($this->getLang("fast-chatting-message"));
               }
               if(!$player->hasPermission("implactor.chatcooldown")){
               	$this->chat[$player->getName()] = true;
                   $this->getScheduler()->scheduleDelayedTask(new ChatCooldownTask($this, $player), 205);            
            }
        }
        
        public function onQuit(PlayerQuitEvent $ev): void{
        	$player = $ev->getPlayer();
            if($player->isOP()){
			    $ev->setQuitMessage($this->getLang("quit-message-operators") .$player->getName());
			    $player->getLevel()->addSound(new Quit($player));
             }else{
			    $ev->setQuitMessage($this->getLang("quit-message-players") .$player->getName());
			    $player->getLevel()->addSound(new Quit($player));
			}
        }
        
        public function onDamage(EntityDamageEvent $ev): void{
        	$entity = $ev->getEntity();
            $cause = $ev->getCause();
            if($entity instanceof Player){
            	if($cause === EntityDamageEvent::CAUSE_FALL){
               }
               if($cause !== $ev::CAUSE_FALL){
               	if(!$entity instanceof Player) return;
                       if($entity->isCreative()) return;
                           if($entity->getAllowFlight() == true){
                           	$entity->setFlying(false);
					           $entity->setAllowFlight(false);
					           $entity->sendMessage($this->impladePrefix. $this->getLang("fly-disabled-damage-message"));
					          }
					}
					if(isset($this->wild[$entity->getName()])){
                        unset($this->wild[$entity->getName()]);
                        $ev->setCancelled(true);
                  }
                  $entity->getLevel()->addParticle(new Bloodful($entity, Block::get(152)));   
             }
             if($entity instanceof SoccerSlime) $ev->setCancelled(true);
			 if($entity instanceof DeathHuman) $ev->setCancelled(true);
			if($entity instanceof BotHuman) $ev->setCancelled(true);
        }  
        
        public function soccerBall(Player $player): void{
        	$soccerLevel = $player->getLevel();
		$soccerNBT = Entity::createBaseNBT($player, null, 2, 2);
		$entitySoccer = new SoccerSlime($soccerLevel, $soccerNBT);
		$entitySoccer->setScale(1.6);
		$entitySoccer->spawnToAll();
        }
        
        public function summonBot(Player $player, string $botname): void{
        	$level = $player->getLevel();
        	$botnbt = Entity::createBaseNBT($player, null, 2, 2);
		    $botnbt->setTag($player->namedtag->getTag("Skin"));
		    $bot = new BotHuman($level, $botnbt);
		    $bot->setNameTag("§7[§bBot§7]§r\n§f" .$botname);
		    $bot->setNameTagAlwaysVisible(true);
		    $bot->spawnToAll();
        }
        
        public function implactorBook(Player $player): void{
        	$ibook = Item::get(Item::WRITTEN_BOOK, 0, 1);
		$enchantment = Enchantment::getEnchantment(19);
		$enchantInstance = new EnchantmentInstance($enchantment, 5);
		$ibook->addEnchantment($enchantInstance);
		$ibook->setTitle("§l§aBook §bof §cImplactor");
		$ibook->setPageText(0, "§4You are now reading on Book of Implactor!\n\n§0Created: §123 May 2018\nRemaked: §114 July 2018\n\n§0Author: §cZadezter\n§0Team: §cImpladeDeveloped\n\n\n§2This plugin and also a book are licensed under GNU General Public License v3.0!");
		$ibook->setPageText(1, "§3Implactor\n§2A elite plugin, more added features for Minecraft: Bedorck Edition servers!\n\n§4Thank you for using our plugin. If you have any bug issue, post on our issue at Github.\n\n§4Shall we get started? We added some informations!");
		$ibook->setPageText(2, "§5Bot Human\n§2A moving bot having a functional which can walk, swing, sneak/unsneak, particle and jump!\n\n§4This feature is a special for you, but there is little kind of annoying. But when the bot sees you, it will jump and walk to near you!");
		$ibook->setPageText(3, "§bTrident\n§2A deadly one shot kill weapon with enchantments!\n\n§dIn Aquatic Update, one of the mysterious legendary trident is from the sea and owned by the former holder, Posideon! Until now, it is appeared to Implactor with a impossible damages!");
		$ibook->setPageText(4, "§dWith this power on Trident, they can charge and fast when in the sea for trying to escape from opponents, auto return to their's holder after throwed far away and the impossible deadly one shot kill!\n§dThis is a extreme rarest item in-game server!");
		$ibook->setPageText(5, "§3Get a dangerous item from the sea. For staff who work on other servers, you can do some challanges and events for your players!\n\n§5- Zadezter\n§2P.S: Be a holder of Mysterious Legendary Trident and slain all opponents!");
		$ibook->setPageText(6, "§bSoccer\n§2A sports and fun feature that you can kick a ball!\n\n§7A games for fun to play the soccer games! Whenever you do is, type /soccer in chat to spawn the, baby slime?! And let's go to get score §5GOAL§7!!!");
		$ibook->setPageText(7, "§dRainbow Armor\n§2You can use /rainbow UI command to enable or disable your rainbow armor. It keep active when you re-joined the server!");
                $ibook->setPageText(8, "§5Languages\n§2A configuration for langauges has been added to Implactor. This is good for players from any country using this plugin. Suggest a language on our ImpladeDeveloped team on Github.");
		$ibook->setAuthor("§l§eZadezter");
		$player->getInventory()->addItem($ibook);
        }
        
        public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        	if(strtolower($command->getName()) === "ihelp"){
        	    if($sender instanceof Player){
		            if($sender->hasPermission("implactor.command.help")){
                        if(count($args) == 0){
			                $sender->sendMessage("§8§l(§6!§8)§r §cCommand usage§8:§r§7 /ihelp §e[1-4]");
                         }else{
			                 if(count($args) == 1){
                                 switch($args[0]){
			                     case "1":
			                     $sender->sendMessage("§b--(§a Implactor Help §7[§e1-4§7] §b)--");
			                     $sender->sendMessage("§e/ihelp §9- §fCheck all commands list available!");
			                     $sender->sendMessage("§e/iabout §9- §fCheck about Implactor!");
			                     $sender->sendMessage("§e/ping §9- §fPing your connection in-game server!");
			                     $sender->sendMessage("§e/bot §9- §fSpawn the §bbot human§f by open a UI menu!");
			                     $sender->sendMessage("§e/icast §9- §fBroadcast your message to all online players!");
			                     break;
			                     case "2":
			                     $sender->sendMessage("§b--(§a Implactor Help §7[§e2-4§7] §b)--");
			                     $sender->sendMessage("§e/wild §9- §fTeleport to a random spot of wilderness!");
			                     $sender->sendMessage("§e/pvisible §9- §fOpen the player visibility menu UI!");
			                     $sender->sendMessage("§e/vision §9- §fOpen the vision menu UI!");
			                     $sender->sendMessage("§e/ibook §9- §fGet a book of §6Implactor§f!");
			                     $sender->sendMessage("§e/gms §9- §fChange the gamemode to §c§lSURVIVAL");
			                     break;
			                     case "3":
			                     $sender->sendMessage("§b--(§a Implactor Help §7[§e3-4§7] §b)--");
			                     $sender->sendMessage("§e/gmc §9- §fChange the gamemode to §e§lCREATIVE");
			                     $sender->sendMessage("§e/gma §9- §fChange the gamemode to §b§lADVENTURE");
			                     $sender->sendMessage("§e/gmsc §9- §fChange the gamemode to §b§lSPECTATOR");
			                     $sender->sendMessage("§e/soccer §9- §fSpawn the soccer ball, play and score §bGOAL§f!");
			                     $sender->sendMessage("§e/clearinv §9- §fClear all items from inventory!");
			                     break;
			                     case "4":
			                     $sender->sendMessage("§b--(§a Implactor Help §7[§e4-4§7] §b)--");
			                     $sender->sendMessage("§e/cleararmor §9- §fClear armors from own character!");
			                     $sender->sendMessage("§e/rainbow §9- §fOpen the rainbow armor menu UI!");
			                     $sender->sendMessage("§e/clearbot §9- §fClear all spawned §bbot humans§f by open a UI menu!");
			                     break;
			                     }
                              }
		                  }
                      }else{
			             $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
			             return false;
			            }
		            }else{
			           $sender->sendMessage($this->getLang("only-command-ingame-message"));
			           return false;
			        }
			        return true;
        	}
        
        	if(strtolower($command->getName()) === "iabout"){
        	    if($sender instanceof Player){
		            if($sender->hasPermission("implactor.command.about")){
			            $sender->sendMessage("§8---=========================---");
			            $sender->sendMessage("§8- §aImpl§6actor");
			            $sender->sendMessage("§8- §cAuthor: §fZadezter");
			            $sender->sendMessage("§8- §aTeam: §fImpladeDeveloped");
			            $sender->sendMessage("§8- §bCreated: §f23 §eMay §f2018");
		                $sender->sendMessage("§8- §dRe-created: §f14 §eJuly §f2018");
			            $sender->sendMessage("§8---=========================---");
		             }else{
			            $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
			            return false;
			          }
		          }else{
			         $sender->sendMessage($this->getLang("only-command-ingame-message"));
			         return false;
			      }
			      return true;
        	}
        
        	if(strtolower($command->getName()) === "ping"){
        	    if($sender instanceof Player){
		            if($sender->hasPermission("implactor.ping")){
			            $sender->sendMessage($sender->getPlayer()->getName(). "§a's ping status: §7[§d". $sender->getPing() ."§ems§7]");
                     }else{
			            $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
			             return false;
			            }
		            }else{
			           $sender->sendMessage($this->getLang("only-command-ingame-message"));
			           return false;
                    }
                    return true;
        	}
        
        	if(strtolower($command->getName()) === "wild"){
        	    if($sender instanceof Player){
		            if($sender->hasPermission("implactor.wild")){
			            $x = rand(1,999);
                        $y = 128;
                        $z = rand(1,999);
                        $sender->teleport($sender->getLevel()->getSafeSpawn(new Vector3($x, $y, $z)));            
			            $sender->addTitle("§l§k§a!§bÂ¡§c!§r §7§l[§eTeleporting§7]§r §l§k§a!§bÂ¡§c!§r", "...");
                        $sender->sendMessage("--------\n §eTeleporting to random spot\n §eof §bwilderness! \n§r--------");
			            $this->wild[$sender->getName()] = true;
                     }else{
			            $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
			            return false;
			          }
		          }else{
			         $sender->sendMessage($this->getLang("only-command-ingame-message"));
			         return false;
			      }
                  return true;
        	}
        
        	if(strtolower($command->getName()) === "ibook"){
        	    if($sender instanceof Player){
		            if($sender->hasPermission("implactor.book")){
			            $this->implactorBook($sender);
			            $sender->sendMessage($this->impladePrefix. "§6You has given a §aBook §bof §cImplactor§6!\n§fRead inside the book, §b". $sender->getPlayer()->getName() ."§f!");
                        $sender->getLevel()->addSound(new Book($sender));
		             }else{
			            $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
			            return false;
			          }
	              }else{
		             $sender->sendMessage($this->getLang("only-command-ingame-message"));
		             return false;
		          }
		          return true;
        	}
        
        	if(strtolower($command->getName()) === "bot"){
        	    if($sender instanceof Player){
			        if($sender->hasPermission("implactor.bot")){
			            $this->botMenu($sender);
                     }else{
                        $sender->sendMessage($this->getLang("no-permission-message"));
	                    return false;
			          }
			      }else{
			         $sender->sendMessage($this->getLang("only-command-ingame-message"));
			          return false;
			       }
			       return true;
       	}   
       
           if(strtolower($command->getName()) === "clearbot"){
        	    if($sender instanceof Player){
			        if($sender->hasPermission("implactor.bot")){
			            $this->clearAllBotMenu($sender);
                     }else{
                        $sender->sendMessage($this->getLang("no-permission-message"));
	                    return false;
			          }
			      }else{
			         $sender->sendMessage($this->getLang("only-command-ingame-message"));
			          return false;
			       }
			       return true;
        	}
  
        	if(strtolower($command->getName()) === "soccer"){
        	   if($sender instanceof Player){
			       if($sender->hasPermission("implactor.soccer")){
				       $this->soccerBall($sender, "SoccerSlime");
				       $sender->level->broadcastLevelSoundEvent($sender, BallSoundPacket::SOUND_POP);
				       $sender->sendMessage($this->impladePrefix. "§fYou have spawned a soccer ball at your coordinates! Wait a minute, that's a §ababy slime§f!");
                    }else{
                       $sender->sendMessage($this->getLang("no-permission-message"));
	                   return false;
			         }
			     }else{
			        $sender->sendMessage($this->getLang("only-command-ingame-message"));
			        return false;
			    }
			    return true;
        	}
        
        	if(strtolower($command->getName()) === "vision"){
        	   if($sender instanceof Player){
		           if($sender->hasPermission("implactor.vision")){
		                $this->visionMenu($sender);
		             }else{
                        $sender->sendMessage($this->getLang("no-permission-message"));
                        return false;
                      }            
                  }else{
                     $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                  }
                  return true;
        	}
        
        	if(strtolower($command->getName()) === "pvisible"){
        	   if($sender instanceof Player){
		           if($sender->hasPermission("implactor.playervisibility")){
		                $this->visibilityMenu($sender);
		             }else{
                        $sender->sendMessage($this->getLang("no-permission-message"));
                        return false;
                      }            
                  }else{
                     $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                  }
                  return true;
        	}
        
            if(strtolower($command->getName()) === "rainbow"){
        	   if($sender instanceof Player){
		           if($sender->hasPermission("implactor.rainbow")){
		                $this->rainbowMenu($sender);
		             }else{
                        $sender->sendMessage($this->getLang("no-permission-message"));
                        return false;
                      }            
                  }else{
                     $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                  }
                  return true;
        	}
        
        	if(strtolower($command->getName()) === "gms"){
        	    if(!$sender instanceof Player){
                    $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                   }
                   if(!$sender->hasPermission("implactor.gamemode")){
                       $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
                       return false;
                     }
                     if(empty($args[0])){
                         $sender->setGamemode(Player::SURVIVAL); 
	                     $sender->sendMessage($this->impladePrefix. "§aYou have changed the gamemode to §c§lSURVIVAL");
                         return false;
		               }
                       $player = $this->getServer()->getPlayer($args[0]);
                       if($this->getServer()->getPlayer($args[0])){
                           $player->setGamemode(Player::SURVIVAL);
                           $sender->sendMessage($this->impladePrefix. "§aYou have successfully changed §f". $player->getName() . "§a's gamemode to §c§lSURVIVAL");
                           $player->sendMessage($this->impladePrefix. $sender->getName() . " §achanged your gamemode to §c§lSURVIVAL");
                        }else{
                           $sender->sendMessage($this->impladePrefix. "§cPlayer not found in-game server!");
                           return false;
			        }
			        return true;
        	}
        
        	if(strtolower($command->getName()) === "gmc"){
        	    if(!$sender instanceof Player){
                    $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                   }
                   if(!$sender->hasPermission("implactor.gamemode")){
                       $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
                       return false;
                     }
                     if(empty($args[0])){
                         $sender->setGamemode(Player::CREATIVE); 
	                     $sender->sendMessage($this->impladePrefix. "§aYou have changed the gamemode to §e§lCREATIVE");
                         return false;
		               }
                       $player = $this->getServer()->getPlayer($args[0]);
                       if($this->getServer()->getPlayer($args[0])){
                           $player->setGamemode(Player::CREATIVE);
                           $sender->sendMessage($this->impladePrefix. "§aYou have successfully changed §f". $player->getName() . "§a's gamemode to §e§lCREATIVE");
                           $player->sendMessage($this->impladePrefix. $sender->getName() . " §achanged your gamemode to §e§lCREATIVE");
                        }else{
                           $sender->sendMessage($this->impladePrefix. "§cPlayer not found in-game server!");
                           return false;
			        }
			        return true;
        	}
        
        	if(strtolower($command->getName()) === "gma"){
        	    if(!$sender instanceof Player){
                    $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                   }
                   if(!$sender->hasPermission("implactor.gamemode")){
                       $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
                       return false;
                     }
                     if(empty($args[0])){
                         $sender->setGamemode(Player::ADVENTURE); 
	                     $sender->sendMessage($this->impladePrefix. "§aYou have changed the gamemode to §b§lADVENTURE");
                         return false;
		               }
                       $player = $this->getServer()->getPlayer($args[0]);
                       if($this->getServer()->getPlayer($args[0])){
                           $player->setGamemode(Player::ADVENTURE);
                           $sender->sendMessage($this->impladePrefix. "§aYou have successfully changed §f". $player->getName() . "§a's gamemode to §b§lADVENTURE");
                           $player->sendMessage($this->impladePrefix. $sender->getName() . " §achanged your gamemode to §b§lADVENTURE");
                        }else{
                           $sender->sendMessage($this->impladePrefix. "§cPlayer not found in-game server!");
                           return false;
			        }
			        return true;
        	}
        
        	if(strtolower($command->getName()) === "gmsc"){
        	    if(!$sender instanceof Player){
                    $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                   }
                   if(!$sender->hasPermission("implactor.gamemode")){
                       $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
                       return false;
                     }
                     if(empty($args[0])){
                         $sender->setGamemode(Player::SPECTATOR); 
	                     $sender->sendMessage($this->impladePrefix. "§aYou have changed the gamemode to §7§lSPECTATOR");
                         return false;
		               }
                       $player = $this->getServer()->getPlayer($args[0]);
                       if($this->getServer()->getPlayer($args[0])){
                           $player->setGamemode(Player::SPECTATOR);
                           $sender->sendMessage($this->impladePrefix. "§aYou have successfully changed §f". $player->getName() . "§a's gamemode to §7§lSPECTATOR");
                           $player->sendMessage($this->impladePrefix. $sender->getName() . " §achanged your gamemode to §7§lSPECTATOR");
                        }else{
                           $sender->sendMessage($this->impladePrefix. "§cPlayer not found in-game server!");
                           return false;
			        }
			        return true;
        	}
        
        	if(strtolower($command->getName()) === "clearinv"){
        	    if(!$sender instanceof Player){
                    $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                   }
                   if(!$sender->hasPermission("implactor.clear")){
                       $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
                       return false;
                     }
                     if(empty($args[0])){
                         $sender->getInventory()->clearAll();
	                     $sender->sendMessage($this->impladePrefix. "You have cleared all of your items from inventory.");
                         return false;
		               }
                       $player = $this->getServer()->getPlayer($args[0]);
                       if($this->getServer()->getPlayer($args[0])){
                           $player->getInventory()->clearAll();
                           $sender->sendMessage($this->impladePrefix. "§aYou have successfully cleared all of §f". $player->getName() . "§a's items from inventory!");
                           $player->sendMessage($this->impladePrefix. $sender->getName() . " §ahas cleared all of your items from inventory!");
                        }else{
                           $sender->sendMessage($this->impladePrefix. "§cPlayer not found in-game server!");
                           return false;
			        }
			        return true;
        	}
        
        	if(strtolower($command->getName()) === "cleararmor"){
        	    if(!$sender instanceof Player){
                    $sender->sendMessage($this->getLang("only-command-ingame-message"));
                     return false;
                   }
                   if(!$sender->hasPermission("implactor.clear")){
                       $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
                       return false;
                     }
                     if(empty($args[0])){
                         $sender->getArmorInventory()->clearAll();
	                     $sender->sendMessage($this->impladePrefix. "§fYou have cleared your armor gear from own character!");
                         return false;
		               }
                       $player = $this->getServer()->getPlayer($args[0]);
                       if($this->getServer()->getPlayer($args[0])){
                           $player->getArmorInventory()->clearAll();
                           $sender->sendMessage($this->impladePrefix. "§fYou have successfully cleared §f". $player->getName() . "§f's armor gear from their character!");
                           $player->sendMessage($this->impladePrefix. $sender->getName() . " §fhas cleared your armor gear from own character!");
                        }else{
                           $sender->sendMessage($this->impladePrefix."§cPlayer not found in-game server!");
                           return false;
			        }
			        return true;
        	}
        
        	if(strtolower($command->getName()) === "icast"){
        	    if($sender instanceof Player){
		            if($sender->hasPermission("implactor.broadcast")){
		                if(count($args) < 1){
			                $sender->sendMessage("§8§l(§6!§8)§r §cCommand usage§8:§r§7 /icast <message>");
			                return false;
			               }   
                          $sender->getServer()->broadcastMessage("§7[§bImplacast§7] §e" . implode(" ", $args));
			           }else{
				          $sender->sendMessage($this->impladePrefix. $this->getLang("no-permission-message"));
				          return false;
			            }
		            }else{
			           $sender->sendMessage($this->getLang("only-command-ingame-message"));
		               return false;
			     }
			     return true;
             }
        }
        
        public function visionMenu($sender): void{
        	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if($result === null){
             	}
                 switch($result){
                 case 0:
                 $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 1000000, 254, true));
                 $sender->sendMessage($this->impladePrefix. "§eYou have §aenabled the §bNight Vision §emode!");
                 break;
                 
                 case 1:
                 $sender->removeEffect(Effect::NIGHT_VISION);
                 $sender->sendMessage($this->impladePrefix. "§eYou have §cdisabled the §bNight Vision §emode!");
                 break;
                 
                 case 2:
                 $sender->sendMessage($this->impladePrefix. "§cYou have closed the vision menu UI mode!");
                 break;
                 }
            });
            $form->setTitle("Implactor Menu UI");
            $form->setContent("§f> §l§0Vision Mode\n§r§eIf you feel so dark out there, you can use vision mode here!");
            $form->addButton("§aENABLE", 1, "https://cdn.discordapp.com/attachments/442624759985864714/468316317351542804/On.png");
            $form->addButton("§4DISABLE", 2, "https://cdn.discordapp.com/attachments/442624759985864714/468316317351542806/Off.png");
            $form->addButton("§0CLOSE", 3, "https://cdn.discordapp.com/attachments/442624759985864714/468316717169508362/Logopit_1531725791540.png");
            $form->sendToPlayer($sender);              
        }
        
        public function botMenu($sender): void{
        	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createCustomForm(function (Player $sender, $data){
			$result = $data;
            if($result !== null){
            	$this->summonBot($sender, $result[1]);
			    $sender->getServer()->broadcastMessage("§7[§bBot§7]§f §e". $sender->getPlayer()->getName() ."§f has spawned a §bbot §fwith named §d" .$result[1]. "§f!");
			    $sender->getLevel()->addSound(new Bot($sender));
			    }
			});
			$form->setTitle("Implactor Menu UI");
			$form->addLabel("§f> §0§lBot Human\n§r§eSpawn the bot human by entering a name of the entity!");
			$form->addInput("Bot Name", "Zadey");
			$form->sendToPlayer($sender);
		}
		
		public function clearAllBotMenu($sender): void{
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function (Player $sender, $data){
			$result = $data;
			if($result === null){
				}
				switch($result){
				case 0:
		        $clearBots = 0;
		        foreach($this->getServer()->getLevels() as $level){
                    foreach($level->getEntities() as $entity){
                    if($entity instanceof BotHuman){
                        $entity->close();
                        $clearBots++;
                       }
                    }
                }
                $sender->sendMessage($this->impladePrefix. "§aYou have successfully cleared §b" .$clearBots. " §abot humans!");
                break;
               
                case 1:
                $sender->sendMessage($this->impladePrefix. "§cYou have cancelled the confirmation to clear all bot humans!");
                break;
                }
           });
           $form->setTitle("Are you sure?");
           $form->setContent("§6Do you really want to clear all bot humans in this world?\nThis will reduce lagg in-game server and some operators who have just spawned will gone and disappeared!");     
           $form->addButton("§aYES", 1, "");
           $form->addButton("§4NO", 2, "");
           $form->sendToPlayer($sender);
        }
        
        public function visibilityMenu($sender): void{
        	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if($result === null){
             	}
                 switch($result){
                 case 0:
                 $sender->addTitle("§7§l[§aON§7]", "§aEnabled the player visibility!");
                 unset($this->visibility[array_search($sender->getName(), $this->visibility)]);
			     foreach($this->getServer()->getOnlinePlayers() as $visibler) {
		         $sender->showplayer($visibler);
		         }
                 break;
                 
                 case 1:
                 $sender->addTitle("§7§l[§cOFF§7]", "§eDisabled the player visibility!");
                 $this->visibility[] = $sender->getName();
			     foreach ($this->getServer()->getOnlinePlayers() as $visibler) {
	             $sender->hideplayer($visibler);
	             }
                 break;
                 
                 case 2:
                 $sender->sendMessage($this->impladePrefix. "§cYou have closed the player visibility menu UI mode!");
                 break;
                 }
            });
            $form->setTitle("Implactor Menu UI");
            $form->setContent("§f> §0§lPlayer Visibility\n§r§eWant to be alone? Don't worry, use player visibility to make all players get hide or show!");
            $form->addButton("§aSHOW", 1, "https://cdn.discordapp.com/attachments/442624759985864714/468316318060249098/Show.png");
            $form->addButton("§4HIDE", 2, "https://cdn.discordapp.com/attachments/442624759985864714/468316318060249099/Hide.png");
            $form->addButton("§0CLOSE", 3, "https://cdn.discordapp.com/attachments/442624759985864714/468316717169508362/Logopit_1531725791540.png");
            $form->sendToPlayer($sender);
        }
        public function rainbowMenu($sender): void{
        	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
            $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if($result === null){
             	}
                 switch($result){
                 case 0:
                 if($this->rainbows[$sender->getName()] === 0){
                    $rainbowStartTask = new RainbowArmorTask($this, $sender);
                    $this->getScheduler()->scheduleRepeatingTask($rainbowStartTask, 5);
                    $sender->sendMessage($this->impladePrefix. "§aYou have enabled the rainbow armor!");
		         }
                 break;
                 
                 case 1:
                 if($this->rainbows[$sender->getName()] === 0){
                    $rainbowCancelTask = $this->rainbows[$sender->getName()];
                    $this->getScheduler()->cancelTask($rainbowCancelTask);
                    $this->rainbows[$sender->getName()] = 0;
                    $sender->getArmorInventory()->clearAll();
                    $sender->sendMessage($this->impladePrefix. "§cYou have disabled the rainbow armor!");
                 }           
                 break;
                 
                 case 2:
                 $sender->sendMessage($this->impladePrefix. "§cYou have closed the rainbow armor menu UI mode!");
                 break;
                 }
            });
            $form->setTitle("Implactor Menu UI");
            $form->setContent("§f> §l§0Rainbow Armor\n§r§eOnly for operators! Get a rainbow from your armor with using this mode!");
            $form->addButton("§aENABLE", 1, ""); // making new images.
            $form->addButton("§4DISABLE", 2, ""); // making new images.
            $form->addButton("§0CLOSE", 3, "https://cdn.discordapp.com/attachments/442624759985864714/468316717169508362/Logopit_1531725791540.png");
            $form->sendToPlayer($sender);
        }
        
        public function rainbowArmor(Player $player, int $r, int $b, int $g) : void{
		    $rainbowGear = new Rainbow($r, $b, $g);
		    $helmet = Item::get(298, 0, 1);
		    $helmet->setCustomColor($rainbowGear);
		    $chestplate = Item::get(299, 0, 1);
		    $chestplate->setCustomColor($rainbowGear);
		    $leggings = Item::get(300, 0, 1);
		    $leggings->setCustomColor($rainbowGear);
		    $boots = Item::get(301, 0, 1);
		    $boots->setCustomColor($rainbowGear);
		    $player->getArmorInventory()->setHelmet($helmet);
		    $player->getArmorInventory()->setChestplate($chestplate);
		    $player->getArmorInventory()->setLeggings($leggings);
		    $player->getArmorInventory()->setBoots($boots);
		    $player->getArmorInventory()->sendContents($player);
		    if($this->timers[$player->getName()] < 24){
			    $this->timers[$player->getName()] = $this->timers[$player->getName()] + 1;
		     }else{
			    $this->timers[$player->getName()] = 0;
		    }
	    }
	
        public function clearItems(): int{
        	$item = 0;
            foreach($this->getServer()->getLevels() as $level){
            foreach($level->getEntities() as $entity){
            	if(!$this->isEntityExempted($entity) && !($entity instanceof Creature)){
            	    $entity->close();
                    $item++;
                    }
                }
            }
            return $item;
        }
        
        public function clearMobs(): int{
        	$mobs = 0;
            foreach($this->getServer()->getLevels() as $level){
            foreach($level->getEntities() as $entity){
            	if(!$this->isEntityExempted($entity) && $entity instanceof Creature && !($entity instanceof Human)){
            	    $entity->close();
                    $mobs++;
                    }
                }
            }
            return $mobs;
        }
	
        public function exemptEntity(Entity $entity): void{
        	$this->exemptedEntities[$entity->getID()] = $entity;
        }
        
        public function isEntityExempted(Entity $entity): bool{
        	return isset($this->exemptedEntities[$entity->getID()]);
        }
}
        
