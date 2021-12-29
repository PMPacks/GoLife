<?php

namespace Muarank\CPEVN;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\{Player, Server};
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\item\Item;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as CP;
use pocketmine\math\Vector3;
use jojoe7777\FormAPI;

class Main extends PluginBase implements Listener{
	public $tag = "";
	
	public function onEnable(){
		$this->getLogger()->info(CP::GREEN . "Enable Plugin by §cZero§bSky");
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch(strtolower($cmd->getName())){
			case "muavip":
			if(!($sender instanceof Player)){
				$this->getLogger()->info(CP::RED . "Please Dont Use that command in here.");
				return true;
			}
			$tien = $this->point->myMoney($sender);
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null) {
				}
				switch ($result) {
					case 0:
					$sender->sendMessage("§c");
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
			$form->setContent("• §bSử Dụng Point Để mua! - Point của bạn:§e ". $tien);
			$form->addButton("•§c Thoát", 0);
			$form->addButton("§c♦ §eVIP§6-§bI§c ♦️", 1);
			$form->addButton("§c♦ §eVIP§6-§bII§c ♦", 2);
			$form->addButton("§c♦ §eVIP§6-§bIII§c ♦", 3);
			$form->addButton("§c♦ §eVIP§6-§bIV§c ♦", 4);
			$form->addButton("§c♦ §eVIP§6-§bV§c ♦", 5);
			$form->sendToPlayer($sender);
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
		$item->setCustomName("• §aThanh Long Bảo Kiếm");
		$item->setLore(array("§b Thanh Long Bảo Kiếm Là 1 Thanh Kiếm Thất Truyền Từ Đời Nhà Thanh.\n §c•§a Rồng Trời Giáng Trần §c•\n §c•§a Kháng Long Hữu Hối §c•\n§b Đây Là Bảo Vật Chỉ Nhận khi Mua Play3 và Event Drop!"));
        $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 200));
		$item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(10), 50));
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
				break;
			}
		});
		
		$form->setTitle("§f•§e Mua§6 VIP§f •");
		$form->setContent("• §eMua §aVIP§e-§cIV §evới giá 100 Point,bạn có muốn mua không?Các quyền lợi của §aVIP§e-§cIV §e:\n §c► §a/tp\n §c► §a/fly\n §c► §a/size\n§c ►§a /wing\n§c►§a /feed");
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
				break;
			}
		});
		
		$form->setTitle("§f•§e Mua§6 VIP§f •");
		$form->setContent("• §eMua §aVIP§e-§cV §evới giá 200 Point ,bạn có muốn mua không?Các quyền lợi của §aVIP§e-§cV §e:\n §c►§a /tp\n §c►§a /fly\n §c►§a /size\n §c►§a /vanish(vanish là tàng hình)\n§c ►§a /wing\n§c ►§a /feed");
		$form->setButton1("• §aMUA", 1);
		$form->setButton2("• §cHuỷ bỏ", 2);
		$form->sendToPlayer($sender);
	}
	
	public function processor(Player $player, string $string): string{
		$string = str_replace("{name}", $player->getName(), $string);
		return $string;
	}
}