<?php

namespace KaYuu081\MuaXu;

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
		$this->getServer()->getLogger()->info($this->tag . " §l§aMuaXu by KaYuu081");
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
			case "muaxu":
          $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($s);
		  $money2 = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myMoney($s);
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 0:
					
					break;
					case 1:
					$this->goixu1($sender);
					break;
					case 2:
					$this->goixu2($sender);
					break;
					case 3:
					$this->goixu3($sender);
					break;
					case 4:
					$this->goixu4($sender);
					break;
					case 5:
					$this->goixu5($sender);
					break;
				}
			});
			
			$form->setTitle("§d§c• Mua§6 Gói Xu§d ");
			$form->setContent("§f•§e Your Money: §6".$money." §b|§f" . " •§e Your Point: §6" .$money2);
			$form->addButton("• §6Back", 0);
			$form->addButton("• §eGói Xu I", 1);
			$form->addButton("• §eGói Xu II", 2);
			$form->addButton("• §eGói Xu III", 3);
			$form->addButton("• §eGói Xu IV", 4);
			$form->addButton("• §eGói Xu V", 5);
			$form->sendToPlayer($s);
	}
	return true;
	}
		public function information($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
		});
		$form->setTitle("§f•§6 Cửa Hàng Mua Xu");
		$form->addLabel("§f•§a Xem thông tin");
		$form->addLabel("§b• §cCách mua§e Gói§d Xu");
		$form->addLabel("§b• §aChọn §eGói §dXu cần đổi");
		$form->addLabel("§b• §eBấm §aXác Nhận §eđể hoàn thành giao dịch");
		$form->sendToPlayer($sender);
	}
	public function goixu1($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			    $point = $this->point->myMoney($sender);
				$cost = 25;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->money->addMoney($sender, 50000);
					$sender->sendMessage($this->tag . "•§e Bạn đã mua thành công §aGói Xu §1I.");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point....");
					return true;
				}
			 break;
			         case 2:
					$command = "muaxu";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					 break;
				}
			 
		});
		$form->setTitle("•§e Đổi§6 Xu");
		$form->setContent("§aGói Xu §1I §b| §e25 Point §6= §e50000 Xu\n • §eBạn có xác nhận mua Gói Xu I không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	public function goixu2($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			    $point = $this->point->myMoney($sender);
				$cost = 50;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->money->addMoney($sender, 100000);
					$sender->sendMessage($this->tag . "•§e Bạn đã mua thành công §aGói Xu §1II.");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point....");
					return true;
				}
			 break;
			         case 2:
					$command = "muaxu";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
				}
			 
		});
		$form->setTitle("•§e Đổi§6 Xu");
		$form->setContent("§aGói Xu §1II §b| §e50 Point §6= §e100000 Xu\n • §eBạn có xác nhận mua Gói Xu II không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	public function goixu3($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			    $point = $this->point->myMoney($sender);
				$cost = 100;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->money->addMoney($sender, 150000);
					$sender->sendMessage($this->tag . "•§e Bạn đã mua thành công §aGói Xu §1III.");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point....");
					return true;
				}
			 break;
			         case 2:
					$command = "muaxu";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
				}
			 
		});
		$form->setTitle("•§e Đổi§6 Xu");
		$form->setContent("§aGói Xu §1III §b| §e100 Point §6= §e150000 Xu\n • §eBạn có xác nhận mua Gói Xu III không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	public function goixu4($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			    $point = $this->point->myMoney($sender);
				$cost = 200;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->money->addMoney($sender, 200000);
					$sender->sendMessage($this->tag . "•§e Bạn đã mua thành công §aGói Xu §1IV.");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point....");
					return true;
				}
			 break;
			         case 2:
					$command = "muaxu";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
				}
			 
		});
		$form->setTitle("•§e Đổi§6 Xu");
		$form->setContent("§aGói Xu §1IV §b| §e200 Point §6= §e200000 Xu\n • §eBạn có xác nhận mua Gói Xu IV không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	public function goixu5($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			    $point = $this->point->myMoney($sender);
				$cost = 300;
				if($point >= $cost){
					$this->point->reduceMoney($sender, $cost);
					$this->money->addMoney($sender, 300000);
					$sender->sendMessage($this->tag . "•§e Bạn đã mua thành công §aGói Xu §1V.");
				}else{
					$sender->sendPopup($this->tag . "•§c Không Đủ Point....");
					return true;
				}
			 break;
			         case 2:
					$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
				}
			 
		});
		$form->setTitle("•§e Đổi§6 Xu");
		$form->setContent("§aGói Xu §1V §b| §e300 Point §6= §e300000 Xu\n • §eBạn có xác nhận mua Gói Xu V không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
			
    }