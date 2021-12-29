<?php

namespace AcidIslandUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("§aAcidIslandUI Turn On");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§cPlease download FormAPI. Disable plugin!");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "hethong":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cPlease run command in game !");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
					$command = "muavip";
					             $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                    $command = "muapoint";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 2:
                    $command = "muafly";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
                    case 3:
                    $command = "muafix";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 4:
                    $command = "napthe";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 5:
                    $command = "cs";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
					case 6:
					$command = "shop";
					            $this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 7:
					    break;
            }
        });
        $form->setTitle("§f•§d Hệ Thống§b");
        $form->setContent("§aChọn những command sau đây!");
        $form->addButton("§f•§a Mua§e VIP\n§r§eMua Vip", 0);
        $form->addButton("§f•§a Mua§e Point\n§r§eMua Points", 1);
        $form->addButton("§f•§a Mua§e Fly\n§r§eTìm Đảo Trống", 2);
        $form->addButton("§f•§a Mua§e Fix\n§r§eMua Fix", 3);
        $form->addButton("§f•§d Nạp Thẻ\n§r§eNạp Thẻ", 4);
        $form->addButton("§f•§c Tố Cáo\n§r§eShop Item", 5);
        $form->addButton("§f•§c Cửa hàng\n§e Shop", 6);
		$form->addButton("§f•§c Thoát\n§r§eThoát khỏi hệ thống!", 7);
        $form->sendToPlayer($sender);
        }
        return true;
    }

    public function onDisable(){
        $this->getLogger()->info("- AcidIslandUI Đã Tắt !");
    }
}
