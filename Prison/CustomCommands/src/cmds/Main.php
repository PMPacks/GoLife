<?php

namespace cmds;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use jojoe77777\FormAPI;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\server\ServerCommandEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\entity\Effect;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getLogger()->info("§aStarting.....");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		
		@mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->error("§4Please install FormAPI Plugin, disabling HealUI plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        if($cmd->getName() == "instant"){
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cYou can't use this command here!", false);
                return true;
        }
    }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $sender, $data){
            $result = $data[0];
			$player = $sender->getPlayer();
            if ($result == null) {
				$sender->setMaxHealth(1 * $data[0]);
				$sender->setFood($data[1]);
            }
           
        });
        $form->setTitle("• §aThanh Máu Và Thanh Đói");
        $form->addLabel("Instant :");
        $form->addSlider("• §cHeal", 0, 40);
        $form->addSlider("• §cFood", 0, 1);
        $form->sendToPlayer($sender);
	    return true;
	}
    public function onDisable(){
        $this->getLogger()->info("§cDisabling.......");
    }
}
