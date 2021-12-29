<?php

namespace KaYuu081\AFPoint;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use jojoe7777\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\item\Item;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as CP;

class Main extends PluginBase{
	public $tag = "";
	public $config;
	
	public function onEnable(){
		$this->getServer()->getLogger()->info($this->tag . " §l§aAFPOINT by KaYuu081");
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
	}
	
	public function onLoad(): void{
		$this->getServer()->getLogger()->notice("Loading.....");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch($cmd->getName()){
			case "afpoint":
			if(!($sender instanceof Player)){
				$this->getLogger()->notice("Please Dont Use that command in here.");
				return true;
			}
			$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myMoney($sender);
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $s, $data){
				$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 0:
					$command = "napthe";
					$this->getServer()->getCommandMap()->dispatch($s, $command);
					break;
					case 1:
					$command = "muaxu";
					$this->getServer()->getCommandMap()->dispatch($s, $command);
					break;
					case 2:
		            $command = "muavip";
					$this->getServer()->getCommandMap()->dispatch($s, $command);
					break;
					case 3:
				    $command = "muapoint";
					$this->getServer()->getCommandMap()->dispatch($s, $command);
					break;
				}
			});
			$form->setTitle("§d•§e AF§bPoint §d• ");
			$form->setContent("•§e§l Your Point: §6§l" .$money);
			$form->addButton("• §6Nạp Thẻ", 0);
			$form->addButton("• §6Mua Gói Xu", 1);
		    $form->addButton("• §6Mua VIP",2 );
			$form->addButton("• §6Mua Point", 3);
			$form->sendToPlayer($sender);
	}
	return true;
}
	
}