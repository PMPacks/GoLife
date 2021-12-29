<?php

namespace KaYuu081\MuaPoint;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use jojoe7777\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as CP;

class Main extends PluginBase{
	
	public $moneyerror = "•§c Không Đủ Xu....";
	public $title = "•§e Đổi§6 Point";
	public $config;
	
	public function onEnable(){
		$this->getServer()->getLogger()->info(" §l§aMuaPoint by KaYuu081");
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
			case "muapoint":
          $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($s);
		  $money2 = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myMoney($s);
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 0:
					$this->information($sender);
					break;
					case 1:
					$this->goiPoint1($sender);
					break;
					case 2:
					$this->goiPoint2($sender);
					break;
					case 3:
					$this->goiPoint3($sender);
					break;
					case 4:
					$this->goiPoint4($sender);
					break;
					case 5:
					$this->goiPoint5($sender);
					break;
				}
			});
			
			$form->setTitle("§d§c• Mua§6 Gói Point§d ");
			$form->setContent("§f•§e Your Money: §6".$money." §b|§f" . " •§e Your Point: §6" .$money2);
			$form->addButton("• §6Hướng Dẫn", 0);
			$form->addButton("• §eGói Point I\n§610000000$ §b= §610", 1);
			$form->addButton("• §eGói Point II\n§62500000$ §b= §625", 2);
			$form->addButton("• §eGói Point III\n§650000000$ §b= §650", 3);
			$form->addButton("• §eGói Point IV\n§690000000$ §b= §6100", 4);
			$form->addButton("• §eGói Point V\n§6150000000$ §b= §6200", 5);
			$form->sendToPlayer($s);
	}
	return true;
	}
		public function information($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
		});
		$form->setTitle("§f•§6 Cửa Hàng Mua Point");
		$form->addLabel("§f•§a Xem thông tin");
		$form->addLabel("§b• §cCách mua§e Gói§d Point");
		$form->addLabel("§b• §aChọn §eGói §dPoint cần đổi");
		$form->addLabel("§b• §eBấm §aXác Nhận §eđể hoàn thành giao dịch");
		$form->sendToPlayer($sender);
	}
	public function goiPoint1($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			    $money = $this->money->myMoney($sender);
				$cost = 10;
				if($money >= $cost){
					$this->point->addMoney($sender, $cost);
					$this->money->reduceMoney($sender, 10000000);
					$sender->sendMessage("•§e Bạn đã mua thành công §aGói Point §1I.");
				}else{
					$sender->sendPopup($this->moneyerror);
					return true;
				}
			 break;
			         case 2:
					$command = "muapoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					 break;
				}
			 
		});
		$form->setTitle($this->title);
		$form->setContent("§aGói Point §1I §b| §e10 Point §6= §e1000000 Xu\n • §eBạn có xác nhận mua Gói Point I không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	public function goiPoint2($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			    $money = $this->money->myMoney($sender);
				$cost = 25;
				if($money >= $cost){
					$this->point->addMoney($sender, $cost);
					$this->money->reduceMoney($sender, 2500000);
					$sender->sendMessage("•§e Bạn đã mua thành công §aGói Point §1II.");
				}else{
					$sender->sendPopup($this->moneyerror);
					return true;
				}
			 break;
			         case 2:
					$command = "muapoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
				}
			 
		});
		$form->setTitle($this->title);
		$form->setContent("§aGói Point §1II §b| §e25 Point §6= §e25000000 Xu\n • §eBạn có xác nhận mua Gói Point II không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	public function goiPoint3($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			   $money = $this->money->myMoney($sender);
				$cost = 50;
				if($money >= $cost){
					$this->point->addMoney($sender, $cost);
					$this->money->reduceMoney($sender, 50000000);
					$sender->sendMessage("•§e Bạn đã mua thành công §aGói Point §1III.");
				}else{
					$sender->sendPopup($this->moneyerror);
					return true;
				}
			 break;
			         case 2:
					$command = "muapoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
				}
			 
		});
		$form->setTitle($this->title);
		$form->setContent("§aGói Point §1III §b| §e50 Point §6= §e50000000 Xu\n • §eBạn có xác nhận mua Gói Point III không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	public function goiPoint4($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			    $money = $this->money->myMoney($sender);
				$cost = 100;
				if($money >= $cost){
					$this->point->addMoney($sender, $cost);
					$this->money->reduceMoney($sender, 90000000);
					$sender->sendMessage("•§e Bạn đã mua thành công §aGói Point §1IV.");
				}else{
					$sender->sendPopup($this->moneyerror);
					return true;
				}
			 break;
			         case 2:
					$command = "muapoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
				}
			 
		});
		$form->setTitle($this->title);
		$form->setContent("§aGói Point §1IV §b| §e100 Point §6= §e90000000 Xu ( Khuyến Mãi 10% )\n • §eBạn có xác nhận mua Gói Point IV không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	public function goiPoint5($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createModalForm(Function (Player $sender, $data){
			$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 1:
			   $money = $this->money->myMoney($sender);
				$cost = 200;
				if($money >= $cost){
					$this->point->addMoney($sender, $cost);
					$this->money->reduceMoney($sender, 150000000);
					$sender->sendMessage("•§e Bạn đã mua thành công §aGói Point §1V.");
				}else{
					$sender->sendPopup($this->moneyerror);
					return true;
				}
			 break;
			         case 2:
					$command = "muapoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
				}
			 
		});
		$form->setTitle($this->title);
		$form->setContent("§aGói Point §1V §b| §e200 Point §6= §e150000000 Xu ( Khuyến Mãi 25%)\n • §eBạn có xác nhận mua Gói Point V không?");
		$form->setButton1("• §aXác Nhận", 1);
		$form->setButton2("• §aHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
			
    }