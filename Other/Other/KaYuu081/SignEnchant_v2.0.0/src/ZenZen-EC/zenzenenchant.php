<?php

namespace SignEnchant;

use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\Player;
use pocketmine\block\Block;
use pocketmine\level\level;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\tile\Sign;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\inventory;
use pocketmine\utils\TextFormat;
use pocketmine\level\sound\AnvilUseSound;

class zenzenenchant extends PluginBase implements Listener{
	
	public $eco;
	
	public function onEnable(){
		$plugin = "SignEnchant";
		$this->getLogger()->notice("§e PLugin được phát triển bởi Hender Plugner. Hỗ trợ: FleetHD");
				$this->getLogger()->notice("§e Nhưng éo việt hoá với edit thì cũng như không ahihi :Edit by MamCham");
		$this->saveResource("config.yml");
		$this->config = new Config($this->getDataFolder()."config.yml", Config::YAML);
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(),0774,true);
		}
		
		$this->sign = new Config($this->getDataFolder()."sign.json",Config::JSON);
		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(),0774,true);
		}
		
		$this->user = new Config($this->getDataFolder()."user.json",Config::JSON);
	}
	
	public function onSignChange(SignChangeEvent $event){
		$line = $event->getLine(0);
		if($line == "Enchant"){
			$player = $event->getPlayer();
			if(!$player->isOp()){
				$player->sendMessage($this->config->get("Create"));
				return;
			}
			
			if(!is_numeric($event->getLine(2))){
				$player->sendMessage($this->config->get("Create2"));
				return;
			}
			
			$block = $event->getBlock();
			$xyz = (Int)$event->getBlock()->getX().":".(Int)$event->getBlock()->getY().":".(Int)$event->getBlock()->getZ().":".$block->getLevel()->getFolderName();
			$this->sign->set($xyz, [ "X" => $block->getX(), "Y" => $block->getY(), "Z" => $block->getZ(), "World" => $block->getLevel()->getFolderName(), "Enchant" => $event->getLine(1), "money" => (int) $event->getLine(2), "Level" => (int) $event->getLine(3), ]);
			$this->sign->save();
			$player->sendMessage($this->config->get("Create3"));
			$X = (Int)$event->getBlock()->getX();
			$Y = (Int)$event->getBlock()->getY();
			$Z = (Int)$event->getBlock()->getZ();
			$level = $block->getLevel();
			$y = $Y - 1;
			$event->setLine(0, "§4[§bZ E N §aZ E Nt§4]§r");
			$event->setLine(1, "§eEnchantID: §e".$event->getLine(1)."");
			$event->setLine(2, "§eGiá:§e ".$event->getLine(2)."§aR$");
			$event->setLine(3, "§eCấp: §e".$event->getLine(3)."");
		}
	}
	
	public function onPlayerTouch(PlayerInteractEvent $event){
		$block = $event->getBlock();
		$player = $event->getPlayer();
		$xyz = $block->getX().":".$block->getY().":".$block->getZ().":".$block->getLevel()->getFolderName();
		if($this->sign->exists($xyz)){
			if(!isset($this->a[$player->getName()])){
				$shop = $this->sign->get($xyz);
				$name = $player->getName();
				$money = EconomyAPI::getInstance()->myMoney($player);
				if($shop["money"] > $money){
					$player->sendMessage($this->config->get("Money"));
				}else{
					$name = $player->getName();
					$shop = $this->sign->get($xyz);
					EconomyAPI::getInstance()->reduceMoney($player, $shop["money"]);
					$item = $player->getInventory()->getItemInHand();
					$player->sendMessage("§eĐã Enchants §6".$shop["Enchant"]." §eCấp§6 ".$shop["Level"]." §eVới số tiền§6 ".$shop["money"]."R$, §eVào vật phẩm!");
					$player->sendTip("§a-=-=-«§4[§bZ E N §aZ E Nt§4]§a»-=-=-§r\n§a-§eVật phẩm đã được cường hoá");
					$enchantment = Enchantment::getEnchantment($shop["Enchant"]);
					$item->addEnchantment(new EnchantmentInstance($enchantment, (int) $shop["Level"]));
					$player->getInventory()->setItemInHand($item);
					$player->getLevel()->addSound(new AnvilUseSound($player));
				}
			}
		}
	}
	
	public function onBreak(BlockBreakEvent $event){
		$player = $event->getPlayer();
		$block = $event->getBlock();
		$x = $block->getX();
		$y = $block->getY();
		$z = $block->getZ();
		$world = $block->getLevel()->getName();
		$name = $player->getName();
		$xyz = (Int)$event->getBlock()->getX().":".(Int)$event->getBlock()->getY().":".(Int)$event->getBlock()->getZ().":".$world; if($this->sign->exists($xyz)){
			if($player->isOp()){
				$this->sign->remove($xyz);
				$this->sign->save();
				$player->sendMessage($this->config->get("Off"));
			}else{
				$name = $player->getName();
				$player->sendMessage($this->config->get("Off2"));
				$event->setCancelled();
			}
		}
	}
}