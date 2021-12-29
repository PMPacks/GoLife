<?php

namespace MamChamPlu;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class SkyBlockUI extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("- SkyBlockUI Enabled! by KaYuu081");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§4Hãy Cài Plugin FormAPI Để Được Trải Nghiệm");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "sb":
        if(!($sender instanceof Player)){
                $sender->sendMessage("Console không khả thi với lệnh!");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                        break;
                    case 1:
					$command = "skyblock help";
					            $this->getServer()->getCommandMap()->dispatch($sender, $command);                       
					    break;
                    case 2:
					$command = "warp SkyBlock";
					            $this->getServer()->getCommandMap()->dispatch($sender, $command);
                    $command = "skyblock auto";
					            $this->getServer()->getCommandMap()->dispatch($sender, $command);
					$command = "skyblock claim";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
                    case 3:
					$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, $data){
				$result = $data[0];
				$sender = $event->getPlayer();
				if($result != null){
					$this->warp = $data[0];
					$this->getServer()->getCommandMap()->dispatch($sender, "skyblock warp " . $this->warp);
				}
			});
			$form->setTitle("§cWARP §aSKY§eBLOCK");
			
			$form->addInput("§eĐịnh Dạng Là §6X;Y §eNhé");
			$form->sendToPlayer($sender);
			break;
                    case 4:
                    $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, $data){
				$result = $data[0];
				$sender = $event->getPlayer();
				if($result != null){
					$this->addhelp = $data[0];
					$this->getServer()->getCommandMap()->dispatch($sender, "skyblock addhelper " . $this->addhelp);
				}
			});
			$form->setTitle("§aADDHELPER §aSKY§eBLOCK");
			$form->addInput("§eTên Người Muốn Thêm Vào §6Đảo");
			$form->addLabel("§b[§a+§b] §6->§e Ghi Tên Phía Dưới Để Thêm Người Chơi Khác Vào Đảo");
			$form->sendToPlayer($sender);
			
			            break;
					case 5:
					$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, $data){
				$result = $data[0];
				$sender = $event->getPlayer();
				if($result != null){
					$this->removehelp = $data[0];
					$this->getServer()->getCommandMap()->dispatch($sender, "skyblock removehelper " . $this->removehelp);
				}
			});
			$form->setTitle("§cREMOVEHELPER §aSKY§eBLOCK");
			$form->addInput("§eTên Người Muốn Xóa Khỏi §6Đảo");
			$form->addLabel("§b[§a+§b] §6->§e Ghi Tên Phía Dưới Để Xóa Người Chơi Khác Khỏi Đảo");
			$form->sendToPlayer($sender);			
			            break;
					case 6:
                    $command = "skyblock info";
					            $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
					case 7:
					$command = "warp SkyBlock";
					            $this->getServer()->getCommandMap()->dispatch($sender, $command);
$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, $data){
				$result = $data[0];
				$sender = $event->getPlayer();
				if($result != null){
					$this->removehelp = $data[0];
					$this->getServer()->getCommandMap()->dispatch($sender, "skyblock home " . $this->removehelp);
				}
			});
			$form->setTitle("§eHOME §aSKY§eBLOCK");
			$form->addInput("§eSố §6Đảo");
			$form->addLabel("§b[§a+§b] §6->§e Ghi số đảo mà bạn cần tp tới nếu bạn có 2 đảo trở lên");
			$form->sendToPlayer($sender);
                        break;		
            }
        });
        $form->setTitle("§l§aSky§bBlock");
        $form->setContent("§e§l→§eAngle §6Sky§ablock");
        $form->addButton("→§eBack To §eMENU", 0);
        $form->addButton("→§cHELP", 1);
        $form->addButton("→§cAUTO §cAND §cCLAIM", 2);
        $form->addButton("→§cWARP", 3);
        $form->addButton("→§cADDHELPER", 4);
		$form->addButton("→§cREMOVEHELPER", 5);
		$form->addButton("→§cINFO", 6);
		$form->addButton("→§cHOME", 7);
        $form->sendToPlayer($sender);
        }
        return true;
    }

    public function onDisable(){
        $this->getLogger()->info("- SkyBlockUI Đã Bị Lỗi Và Ngắt Kết Nối!");
    }
}
