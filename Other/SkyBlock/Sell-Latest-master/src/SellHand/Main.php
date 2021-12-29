<?php

/*
*   _____      _ _ 
*  / ____|    | | |
* | (___   ___| | |
*  \___ \ / _ \ | |
*  ____) |  __/ | |
* |_____/ \___|_|_|
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU Lesser General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*/

namespace SellHand;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{

	public function onLoad(){
		$this->getLogger()->info("§ePlugin Loading!");
	}

	public function onEnable(){
    	$this->getLogger()->info(TF::GREEN.TF::BOLD."
   _____      _ _ 
  / ____|    | | |
 | (___   ___| | |
  \___ \ / _ \ | |
  ____) |  __/ | |
 |_____/ \___|_|_|
 Enabled Sell by Muqsit and JackMD.
 		");
		$files = array("sell.yml", "messages.yml");
		foreach($files as $file){
			if(!file_exists($this->getDataFolder() . $file)) {
				@mkdir($this->getDataFolder());
				file_put_contents($this->getDataFolder() . $file, $this->getResource($file));
			}
		}
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->sell = new Config($this->getDataFolder() . "sell.yml", Config::YAML);
		$this->messages = new Config($this->getDataFolder() . "messages.yml", Config::YAML);
	}

	public function onDisable(){
    	$this->getLogger()->info("§cPlugin Disabled!");
  	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch(strtolower($cmd->getName())){
			case "sell":
			// Checks if command is executed by console.
			// It further solves the crash problem.
			if(!($sender instanceof Player)){
				$sender->sendMessage(TF::RED . TF::BOLD ."Error: ". TF::RESET . TF::DARK_RED ."Please use this command in game!");
				return true;
				break;
			}

				/* Check if the player is permitted to use the command */
				if($sender->hasPermission("sell") || $sender->hasPermission("sell.hand") || $sender->hasPermission("sell.all")){
					/* Disallow non-survival mode abuse */
					if(!$sender->isSurvival()){
						$sender->sendMessage(TF::RED . TF::BOLD ."§2§lError: ". TF::RESET . TF::DARK_RED ."§cPlease switch back to survival mode.");
						return false;
					}
					
					/* Sell Hand */
					if(isset($args[0]) && strtolower($args[0]) == "hand"){
						if(!$sender->hasPermission("sell.hand")){
							$error_handPermission = $this->messages->get("error-nopermission-sellHand");
							$sender->sendMessage(TF::RED . TF::BOLD . "§2§lError: " . TF::RESET . TF::RED . $error_handPermission);
							return false;
						}
						$item = $sender->getInventory()->getItemInHand();
						$itemId = $item->getId();
						/* Check if the player is holding a block */
						if($item->getId() === 0){
							$sender->sendMessage(TF::DARK_GREEN . TF::BOLD ."§2§lError: ". TF::RESET . TF::DARK_RED ."§6You aren't holding any blocks/items.");
							return false;
						}
						/* Recheck if the item the player is holding is a block */
						if($this->sell->get($itemId) == null){
							$sender->sendMessage(TF::RED . TF::BOLD ."§2§lError: §r§cThe item named ". TF::RESET . TF::DARK_GREEN . $item->getName() . TF::DARK_RED ." §ccannot be sold.");
							return false;
						}
						/* Sell the item in the player's hand */
						EconomyAPI::getInstance()->addMoney($sender, $this->sell->get($itemId) * $item->getCount());
						$sender->getInventory()->removeItem($item);
						$price = $this->sell->get($item->getId()) * $item->getCount();
						$sender->sendMessage(TF::GREEN . TF::GREEN . "§5$" . $price . " §dhas been added to your account.");
						$sender->sendMessage(TF::GREEN . "§bSold for " . TF::RED . "§3$" . $price . TF::GREEN . " §bAmount: §3" . $item->getCount() . " §bName: §3" . $item->getName() . " §bat §3$" . $this->sell->get($itemId) . " §beach.");

					/* Sell All */
					}elseif(isset($args[0]) && strtolower($args[0]) == "all"){
						if(!$sender->hasPermission("sell.all")){
							$error_allPermission = $this->messages->get("error-nopermission-sellAll");
							$sender->sendMessage(TF::RED . TF::BOLD . "§2§lError " . TF::RESET . TF::RED . $error_allPermission);
							return false;
						}
						$items = $sender->getInventory()->getContents();
						foreach($items as $item){
							if($this->sell->get($item->getId()) !== null && $this->sell->get($item->getId()) > 0){
								$price = $this->sell->get($item->getId()) * $item->getCount();
								EconomyAPI::getInstance()->addMoney($sender, $price);
								$sender->sendMessage(TF::GREEN . "§bSold for " . TF::RED . "§3$" . $price . TF::GREEN . " §bAmount: §5" . $item->getCount() . " §bName: §3" . $item->getName() . " §bat §3$" . $this->sell->get($item->getId()) . " §beach.");
								$sender->getInventory()->remove($item);
							}
						}
					}elseif(isset($args[0]) && strtolower($args[0]) == "about"){
						$sender->sendMessage(TF::RED . TF::RESET . TF::GRAY . "§aThis plugin is Sell Hand, based from Factions, and Prisons.");
					}else{
						$sender->sendMessage(TF::RED . TF::RESET . TF::DARK_RED . "§7[§6Sell §bHelp!§7]");
						$sender->sendMessage(TF::RED . "§5- " . TF::DARK_RED . "§b/sell hand " . TF::GRAY . "- §7Sell the item that's in your hand.");
						$sender->sendMessage(TF::RED . "§5- " . TF::DARK_RED . "§b/sell all " . TF::GRAY . "- §7Sell every possible thing in inventory.");
						$sender->sendMessage(TF::RED . "§5- " . TF::DARK_RED . "§b/sell about " . TF::GRAY . "- §7Plugin information");
						$sender->sendMessage(TF::RED . "§5- " . TF::DARK_RED . "§b/sell info " . TF::GRAY . "- §7Command coming soon");
						return true;
					}
				}else{
					$error_permission = $this->messages->get("error-permission");
					$sender->sendMessage(TF::RED . TF::BOLD . "§2§lError: " . TF::RESET . TF::RED . $error_permission);
				}
				break;
		}
		return true;
	}
}
