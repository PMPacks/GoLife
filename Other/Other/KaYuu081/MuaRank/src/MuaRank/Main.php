<?php

namespace MuaRank;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase{

	public function onEnable () : void{
		$this->getServer()->getLogger()->info("MuaRank Enable > Arthor: DrDinoDuck");
		$this->pointAPI = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		if ($cmd == "muarank"){
			if(empty($args[0])){
				$sender->sendMessage("§a• §aVIP-I");
				$sender->sendMessage("•§a-§f Giá: §a15 points.§f Ghi /muarank vip1");
				$sender->sendMessage("§a• §bVIP-II");
				$sender->sendMessage("•§a-§f Giá: §a30 points.§f Ghi /muarank vip2");
				$sender->sendMessage("§a• §eVIP-III");
				$sender->sendMessage("•§a-§f Giá: §a45 points.§f Ghi /muarank vip3");
				$sender->sendMessage("§a• §6VIP-IV");
				$sender->sendMessage("•§a-§f Giá: §a60 points.§f Ghi /muarank vip4");
				$sender->sendMessage("§a• §cVIP-V");
				$sender->sendMessage("•§a-§f Giá: §a75 point.§f Ghi /muarank vip5");
				$sender->sendMessage("§a• §cVIP-VI");
				$sender->sendMessage("•§a-§f Giá: §a90 point.§f Ghi /muarank vip6");
				return true;
			}
			if(!empty($args[0])){
				switch($args[0]){
					case "vip1":
					$player1 = $sender->getName();
					$point1 = $this->pointAPI->myMoney($player1);
						if($point1 < 15){
							$sender->sendMessage("§l§aMua§bRank§e>§r§c Không đủ points!");
						}else{
						$this->pointAPI->reduceMoney($player1, 15);
						$this->getServer()->dispatchCommand(new ConsoleCommandSender(),'setgroup ' . $player1 . ' VIPI');
							$sender->sendMessage("§l§aMua§bRank§e>§r§r§a Bạn đã mua gói VIP-I");
						$this->getServer()->broadcastMessage("§l§aMua§bRank§e>§r§r§e $player1 đã mua gói VIP-I");
						}
					break;
					case "vip2":
					$player2 = $sender->getName();
					$point2 = $this->pointAPI->myMoney($player2);
						if($point2 < 30){
							$sender->sendMessage("§l§aMua§bRank§e>§r§c Không đủ points!");
						}else{
						$this->pointAPI->reduceMoney($player2, 30);
						$this->getServer()->dispatchCommand(new ConsoleCommandSender(),'setgroup ' . $player2 . ' VIPII');
							$sender->sendMessage("§l§aMua§bRank§e>§r§a Bạn đã mua gói VIP-II");
						$this->getServer()->broadcastMessage("§l§aMua§bRank§e>§r§e $player2 đã mua gói VIP-II");
						}
					break;
					case "vip3":
					$player3 = $sender->getName();
					$point3 = $this->pointAPI->myMoney($player3);
						if($point3 < 45){
							$sender->sendMessage("§l§aMua§bRank§e>§r§c Không đủ points!");
						}else{
						$this->pointAPI->reduceMoney($player3, 45);
						$this->getServer()->dispatchCommand(new ConsoleCommandSender(),'setgroup ' . $player3 . ' VIPIIV');
							$sender->sendMessage("§l§aMua§bRank§e>§r§a Bạn đã mua gói VIP-III");
						$this->getServer()->broadcastMessage("§l§aMua§bRank§e>§r§e $player3 đã mua gói VIP-III");
						}
					break;
					case "vip4":
					$player4 = $sender->getName();
					$point4 = $this->pointAPI->myMoney($player4);
						if($point4 < 60){
							$sender->sendMessage("§l§aMua§bRank§e>§r§c Không đủ points!");
						}else{
						$this->pointAPI->reduceMoney($player4, 60);
						$this->getServer()->dispatchCommand(new ConsoleCommandSender(),'setgroup ' . $player4 . ' VIPIV');
							$sender->sendMessage("§l§aMua§bRank§e>§r§a Bạn đã mua gói VIP-IV");
						$this->getServer()->broadcastMessage("§l§aMua§bRank§e>§r§e $player4 đã mua gói VIP-IV");
						}
					break;
					case "vip5":
					$player5 = $sender->getName();
					$point5 = $this->pointAPI->myMoney($player5);
						if($point5 < 75){
							$sender->sendMessage("§l§aMua§bRank§e>§r§c Không đủ points!");
						}else{
						$this->pointAPI->reduceMoney($player5, 75);
						$this->getServer()->dispatchCommand(new ConsoleCommandSender(),'setgroup ' . $player5 . ' VIPV');
							$sender->sendMessage("§l§aMua§bRank§e>§r§a Bạn đã mua gói VIP-V");
						$this->getServer()->broadcastMessage("§l§aMua§bRank§e>§r§e $player5 đã mua gói VIP-V");
						}
					break;
					default:
				$sender->sendMessage("§a• §aVIP-I");
				$sender->sendMessage("§a-§f Giá: §a15 points.§f Ghi /muarank vip1");
				$sender->sendMessage("§a• §bVIP-II");
				$sender->sendMessage("§a-§f Giá: §a30 points.§f Ghi /muarank vip2");
				$sender->sendMessage("§a• §eVIP-III");
				$sender->sendMessage("§a-§f Giá: §a45 points.§f Ghi /muarank vip3");
				$sender->sendMessage("§a• §6VIP-IV");
				$sender->sendMessage("§a-§f Giá: §a60 points.§f Ghi /muarank vip4");
				$sender->sendMessage("§a• §cVIP-V");
				$sender->sendMessage("§a-§f Giá: §a75 point.§f Ghi /muarank vip5");
				$sender->sendMessage("§a-§f That plugin writed by Zen - Owner");
						break;
				}
			}
		}
		return true;
	}
}