<?php

namespace KaYuuSetVip;

#Server Player
use pocketmine\{Server, Player};
#Base
use pocketmine\plugin\PluginBase;
#Event
use pocketmine\event\Listener;
#TextFormat
use pocketmine\utils\TextFormat;
#COMMAND
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};
#PACKET
use pocketmine\event\server\DataPacketReceiveEvent;
#API
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§c♦Plugin §bRulesUi §cBy MamChamPlu\n\n §ePlugin §bRules §6Đã Kích Hoạt\n♦♦♦♦♦♦♦♦");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args): bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "setvip":
			$this->mainFrom($player);
			break;
            case "removevip":
			$this->mainFrom2 ($player);
		}
		return true;
	}
	
	public function mainFrom($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, $data){
				$result = $data[0];
				$sender = $event->getPlayer();
				if($result != null){
					$this->Ten = $data[0];
					$this->Rank = $data[1];
					$this->Day = $data[1];
					$this->getServer()->getCommandMap()->dispatch($sender, "grouptime " . $this->Ten." ".$this->Rank." ".$this->Day);
				}
			});
			$form->setTitle("§bRank Time");
			
			$form->addInput("Tên người chơi");
	$form->addInput("Rank");
		$form->addInput("Thời Gian");
			$form->sendToPlayer($sender);
	}
	public function mainFrom2($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, $data){
				$result = $data[0];
				$sender = $event->getPlayer();
				if($result != null){
					$this->Ten = $data[0];
					$this->Rank = $data[1];
					$this->Day = $data[1];
					$this->getServer()->getCommandMap()->dispatch($sender, "grouptimeremove " . $this->Ten." ".$this->Rank." ".$this->Day);
				}
			});
			$form->setTitle("§bRank Time");
			
			$form->addInput("Tên người chơi");
	$form->addInput("Rank");
		$form->addInput("Thời Gian");
			$form->sendToPlayer($sender);
	
	
}
}	