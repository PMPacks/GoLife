<?php

namespace KaYuu081;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat as C;
use pocketmine\utils\TextFormat;
use pocketmine\level\sound\FizzSound;
use pocketmine\level\sound\PopSound;
use pocketmine\math\Vector3;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Login extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->Info(C::GREEN. "Enabled!");
		$this->auth = $this->getServer()->getPluginManager()->getPlugin("SimpleAuth");
        if (!$this->auth) {
            $this->getLogger()->error(TextFormat::RED.("RegisterUI couldn't loaded."));
            $this->getLogger()->error(TextFormat::RED.("Unable to find SimpleAuth plugin"));
            return;
        }
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->saveDefaultConfig();
        $this->reloadConfig();
        
        $this->getLogger()->info("AuthUI successfully loaded.");
		}
	public function onDisable(){
        $this->getLogger()->info("- JoinLogin Đã Bị Lỗi Và Ngắt Kết Nối!");
    }
		# Thanks to the SimpleAuthHelper developers for this function.
    private function hash($salt, $password){
	return bin2hex(hash("sha512", $password . $salt, true) ^ hash("whirlpool", $salt . $password, true));
    }
    public function authenticate($pl,$password) {
        $provider = $this->auth->getDataProvider();
        $data = $provider->getPlayerData($pl->getName());
        
        return hash_equals($data["hash"], $this->hash(strtolower($pl->getName()), $password));
        
    }
	
		public function onJoin(PlayerJoinEvent $event){		
		$player = $event->getPlayer();
		$this->playtap($player);
		}
			public function playtap($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data) {
            $result = $data;
        			
            switch($result){
                case 0:
			if(!$this->auth->isPlayerRegistered($sender)){
            $this->affterplay2($sender);
           
        } else if ($this->auth->isPlayerRegistered($sender) && !$this->auth->isPlayerAuthenticated($sender)){
            $this->affterplay($sender);  
        }				
			break;
			case 1:
			
			break;
			}
            if($result === null){
                return true;
			}				
			});
			$form->setTitle("§e§lA N G L E §6B L O C K");
	$form->setContent("§eChào mừng bạn đã đến §e§lANGLE§6BLOCK\n\n§c[§f+§c]§e Member:\n§b-> §eCác §cADMIN §esẽ hướng dẫn các bạn tận tình nếu bạn vẫn chưa rõ trò chơi\n§b->§eCó quyền báo cáo các §cADMIN §enếu họ không giúp đỡ\n§c[§f-§c] §eNOTE:\n§b-> §eTuân thủ các quy định được đặt ra\n§b-> §eSuwr dụng Hack, Cheats sẽ bị xử nghiêm khắc\n\n§6Chơi trò chơi vui vẻ !");
            $form->addButton("§6§lPLAY");
			$form->sendToPlayer($sender);
             			
			
		} 
		
	 public function loginForm($player){
        $level = $player->getLevel();
        $x = $player->getX();
        $y = $player->getY();
        $z = $player->getZ();
        $pos = new Vector3($x, $y, $z);
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $player, $data) use ($level, $pos){
            if (!$data[1]){
                return $player->kick(TextFormat::GREEN . TextFormat::BOLD . $this->getConfig()->get("login-form-empty-password-field"));
            }
            
            if ($this->authenticate($player, $data[1])){
                $level->addSound(new PopSound($pos));
                $this->auth->authenticatePlayer($player);
            } else {
                $level->addSound(new FizzSound($pos));
                $this->loginForm($player);
            }
					


        });
        $form->setTitle(TextFormat::GREEN . TextFormat::BOLD . $this->getConfig()->get("login-form-title"));
        $form->addLabel(TextFormat::BOLD . TextFormat::AQUA . $this->getConfig()->get("login-form-text1"));
        $form->addInput($this->getConfig()->get("login-form-text2"), $this->getConfig()->get("login-form-password-field"));
        $form->sendToPlayer($player);
    }
    
    public function registerForm($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $sender, $data) use ($player){
            if (!$data[1]){
                if (!$data[1]){
                    return $player->kick(TextFormat::GREEN . TextFormat::BOLD . $this->getConfig()->get("register-form-empty-password-field"));
                }
            } else {
                $this->auth->registerPlayer($sender, $data[1]);
                if ($this->auth->isPlayerRegistered($sender)){
                    $this->auth->authenticatePlayer($sender);
                };
            }
        });
        $form->setTitle(TextFormat::GREEN . TextFormat::BOLD . $this->getConfig()->get("register-form-title"));
        $form->addLabel(TextFormat::BOLD . TextFormat::AQUA . $this->getConfig()->get("register-form-text1"));
        $form->addInput($this->getConfig()->get("register-form-text2"), $this->getConfig()->get("register-form-password-field"));
        $form->sendToPlayer($player);
    }
	public function affterplay($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            /*if($result === null){
                return true;
            }*/             
            switch($result){
                case 0:
        $name = $player->getName();
			if(!$this->auth->isPlayerAuthenticated($player)){
				$this->loginForm($player);                        				
        }
	
                break;
            case 1:
			break;
            }
            });
            $form->setTitle("§e§lA N G L E §6B L O C K");
	$form->setContent("§eĐăng nhập vào §e§lANGLE§6BLOCK\n\n§eLogin:\n§b-> §eNếu bạn đã có mật khẩu thì hãy nhập mật khẩu\n\n§6           HÃY THỰC HIỆN !");
            $form->addButton("§6§lLOGIN");
            $form->sendToPlayer($player); 
            return false;			
            
	}
	public function affterplay2($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $s, int $data = null){
            $result = $data;  
            /*if($result === null){
                return true;
            }*/			
            switch($result){
				case 0:
		    $name = $s->getName();				
			if(!$this->auth->isPlayerRegistered($s)){
				$this->registerForm($s);
				
			}
			break;
            }
            });
            $form->setTitle("§e§lA N G L E §6B L O C K");
	$form->setContent("§eĐăng nhập vào §e§lANGLE§6BLOCK\n\n§c[§f+§c]§e Register:\n§b-> §eNếu bạn chưa có đăng kí hãy nhấn mật khẩu cần tạo\n§c[§f-§c]\n\n§6               HÃY THỰC HIỆN !");
            $form->addButton("§6§lREGISTER");
            $form->sendToPlayer($player); 	
             return false;				
	        
				}
 
								 
    				 
				
		
	
	}
