<?php

namespace HealFeedUI;

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
use HealFeedUI\Main;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getLogger()->info("§aStarting HealFeedUI plugin...");
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
        if($cmd->getName() == "heal"){
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cYou can't use this command here!", false);
                return true;
        }
    }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
		    $heal = $this->getConfig()->get("heal.cost");
			if($money >= $heal){
				
               $this->eco->reduceMoney($sender, $heal);
               $sender->setHealth(20);
			   $sender->setFood(20);
			   $sender->sendMessage($this->getConfig()->get("heal.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("heal.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("heal.cancelled"));
                        break;
            }
        });
        $form->setTitle("• §aThanh Máu Và Thanh Đói");
        $form->setContent($this->getConfig()->get("heal.content"));
        $form->setButton1("• §eXác Nhận", 1);
        $form->setButton2("• §cHủy", 2);
        $form->sendToPlayer($sender);

    /*public function FeedUI($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
		    $money = $this->eco->myMoney($sender);
		    $feed = $this->getConfig()->get("feed.cost");
			if($money >= $feed){
				
               $this->eco->reduceMoney($sender, $feed);
               $sender->setFood("20");
			   $sender->sendMessage($this->getConfig()->get("feed.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("feed.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("feed.cancelled"));
                    #If player click "NO" it will close the UI.
                        break;
            }
        });
        $form->setTitle("• §aThanh Đói");
        $form->setContent($this->getConfig()->get("feed.content"));
        $form->setButton1("• §eXác minh", 1);
        $form->setButton2("• §cHủy", 2);
        $form->sendToPlayer($sender);
    }*/
	return true;
	}
    public function onDisable(){
        $this->getLogger()->info("§cDisabling HealUI plugin...");
    }
}
