<?php

namespace KaYuu081\MuaVip;

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
		$this->getServer()->getLogger()->info($this->tag . " §l§aMuaVip by KaYuu081");
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
	}
	
	public function onLoad(): void{
		$this->getServer()->getLogger()->notice("Loading.....");
	}
	
	public function onCommand(CommandSender $s, Command $cmd, string $label, array $args): bool{
		if(!($s instanceof Player)){
				$this->getLogger()->notice("Please Dont Use that command in here.");
				return true;
			}
		switch($cmd->getName()){
			case "muavip":
           $tien = $this->point->myMoney($s);
		   $tien2 = $this->money->myMoney($s);
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null) {
				}
				switch ($result) {
					case 0:
					
					break;
					case 1:
					$this->rank1($sender);
					break;
					case 2:
					$this->rank2($sender);
					break;
					case 3:
					$this->rank3($sender);
					break;
					case 4:
					$this->rank4($sender);
					break;
					case 5:
					$this->rank5($sender);
					break;
				}
			});
			
			$form->setTitle("• §cMua§6 VIP§f •");
			$form->setContent("§f•§e Your Money: §6".$tien." §b|§f" . " •§e Your Point: §6" .$tien2);
			$form->addButton("•§c Thoát", 0);
			$form->addButton("§c♦ §eVIP§6-§bI§c ", 1);
			$form->addButton("§c♦ §eVIP§6-§bII§c ", 2);
			$form->addButton("§c♦ §eVIP§6-§bIII§c ", 3);
			$form->addButton("§c♦ §eVIP§6-§bIV§c ", 4);
			$form->addButton("§c♦ §eVIP§6-§bV§c ", 5);
			$form->sendToPlayer($s);
		}
		return true;
	}
	
	public function rank1(Player $sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			
			$result = $data;
			if ($result == null) {
			}
			switch ($result) {
				case 1:
				$point = $this->point->myMoney($sender);
				$cost = 10;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ".strtolower($sender->getName()). " VIPI 10");
					$sender->sendMessage($this->tag . "•§a Bạn đã mua thành công gói§6 VIPI.");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point....");
					return true;
				}
				break;
				case 2:
				$sender->sendMessage($this->tag . "•§c Bạn Đã Huỷ Mua VIP!");
				$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
				break;
			}
		});
		
		$form->setTitle("•§e Mua§6 VIP§f •");
		$form->setContent("• §eMua §aVIP§e-§cI §evới giá 10 Point,bạn có muốn mua không?Các quyền lợi của §aVIP§e-§cI §e:\n §c►§a /tp");
		$form->setButton1("• §aMUA", 1);
		$form->setButton2("• §cHủy bỏ", 2);
		$form->sendToPlayer($sender);
	}
	
	public function translateMessage($scut, $message){
		$message = str_replace($scut."{name}", $sender->getName(), $message);
		return $message;
	}
	
	public function getItem($sender){
		$item = Item::get(276,0,1);
		$item->setCustomName("• §aCúp Thần Công");
		$item->setLore(array("§b Cúp Thần Công Đào Phát Biết Ngay Dân Chơi!"));
        $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(15), 20));
		$item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(23), 7 ));
		$sender->getInventory()->addItem($item);
		return true;
	}
	
	public function onDeath(PlayerDeathEvent $ev){
		$player = $ev->getPlayer();
		$pp = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
		$rank = $this->pp->getUserDataMgr()->getGroup($player);
		if($rank == "VIPI" || $rank == "VIPII" || $rank == "VIPIII" || $rank == "VIPIV" || $rank == "VIPV"){
			$player->sendMessage("•§a Bạn Là §6[§c".$rank."§6]§a Nên Sẽ Không bị phạt xu khi chết!");
			return true;
		}
	}
	
	public function rank2(Player $sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			
			$result = $data;
			if ($result == null) {
			}
			switch ($result) {
				case 1:
				$point = $this->point->myMoney($sender);
				$cost = 35;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ". strtolower($sender->getName()). " VIPII 25");
					$sender->sendMessage($this->tag . "•§a Bạn đã mua thành công gói§6 VIPII");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point");
					return true;
				}
				break;
				case 2:
				$sender->sendMessage($this->tag . "•§c Bạn Đã Huỷ Mua VIP!");
				$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
				break;
			}
		});
		
		$form->setTitle("§f•§e Mua§6 VIP§f •");
		$form->setContent("• §eMua §aVIP§e-§cII §evới giá 35 Point,bạn có muốn mua không?Các quyền lợi của §aVIP§e-§cII §e:\n §c►§a /tp\n §c►§a /fly");
		$form->setButton1("• §aMUA", 1);
		$form->setButton2("• §cHủy bỏ", 2);
		$form->sendToPlayer($sender);
	}
	
	public function rank3(Player $sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			
			$result = $data;
			if ($result == null) {
			}
			switch ($result) {
				case 1:
				$point = $this->point->myMoney($sender);
				$cost = 65;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ". strtolower($sender->getName()). " VIPIII 45");
					$sender->sendMessage($this->tag . "•§a Bạn đã mua thành công gói§6 VIPIII.");
					$this->getItem($sender);
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point");
					return true;
				}
				break;
				case 2:
				$sender->sendMessage($this->tag . "•§c Bạn Đã Huỷ Mua VIP!");
				$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
				break;
			}
		});
		
		$form->setTitle("•§e Mua§6 VIP§f •");
		$form->setContent("• §eMua §aVIP§e-§cIII §evới giá 65 Point ,bạn có muốn mua không?Các quyền lợi của §aVIP§e-§cIII §e:\n §c►§a /tp\n §c►§a /fly\n§c►§a /size\n§c ►§a /wing");
		$form->setButton1("• §aMUA", 1);
		$form->setButton2("• §cHủy bỏ", 2);
		$form->sendToPlayer($sender);
	}
	
	public function rank4($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			
			$result = $data;
			if ($result == null) {
			}
			switch ($result) {
				case 1:
				$point = $this->point->myMoney($sender);
				$cost = 85;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ". strtolower($sender->getName()). " VIPIV 85");
					$sender->sendMessage($this->tag . "•§a Bạn đã mua thành công gói§6 VIPIV");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point");
					return true;
				}
				break;
				case 2:
				$sender->sendMessage($this->tag . "•§c Bạn Đã Huỷ Mua VIP!");
				$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
				break;
			}
		});
		
		$form->setTitle("§f•§e Mua§6 VIP§f •");
		$form->setContent("• §eMua §aVIP§e-§cIV §evới giá 100 Point,bạn có muốn mua không?Các quyền lợi của §aVIP§e-§cIV §e:\n §c► §a/tp\n §c► §a/fly\n §c► §a/size\n§c ►§a /wing\n§c►§a /heal");
		$form->setButton1("• §aMUA", 1);
		$form->setButton2("• §cHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	
	public function rank5($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			
			$result = $data;
			if ($result == null) {
			}
			switch ($result) {
				case 1:
				$point = $this->point->myMoney($sender);
				$cost = 200;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setvip ". strtolower($sender->getName()). " VIPV 120");
					$sender->sendMessage($this->tag . "•§a Bạn đã mua thành công gói§6 VIPV");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point");
					return true;
				}
				break;
				case 2:
				$sender->sendMessage($this->tag . "•§c Bạn Đã Huỷ Mua§6 VIP!");
				$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
				break;
			}
		});
		
		$form->setTitle("§f•§e Mua§6 VIP§f •");
		$form->setContent("• §eMua §aVIP§e-§cV §evới giá 200 Point ,bạn có muốn mua không?Các quyền lợi của §aVIP§e-§cV §e:\n §c►§a /tp\n §c►§a /fly\n §c►§a /size\n §c►§a /vanish\n§c ►§a /wing\n§c ►§a /heal");
		$form->setButton1("• §aMUA", 1);
		$form->setButton2("• §cHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	
	public function processor(Player $player, string $string): string{
		$string = str_replace("{name}", $player->getName(), $string);
		return $string;
	}
			
    }