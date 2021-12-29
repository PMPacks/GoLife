<?php

/* -----[MuaZCoinUI]-----
* Update Screen UI System.
* Version: 2.0
* Editor: BlackPMFury
* This Test Plugin.
*/

namespace MuaZcoin\DoiTien;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use jojoe7777\FormAPI;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase{
	public $tag = "";
	
	public function onEnable(){
		$this->getServer()->getLogger()->info($this->tag . " §l§aEnable MuaZCoin System....");
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
	}
	
	public function onLoad(): void{
		$this->getServer()->getLogger()->notice("Loading Data.....");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch($cmd->getName()){
			case "muapoint":
			if(!($sender instanceof Player)){
				$this->getLogger()->notice("Please Dont Use that command in here.");
				return true;
			}
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 0:
					$sender->sendMessage("§c");
					break;
					case 1:
					$this->information($sender);
					break;
					case 2:
					$this->doiZCoin($sender);
					break;
				}
			});
			
			$form->setTitle("§d♦§c Mua§6 Point§d ♦");
			$form->setContent($this->tag . "•§c Xem lại xu của bạn trước kia mua");
			$form->addButton("• §cThoát", 0);
			$form->addButton("• §bThông Tin", 1);
			$form->addButton("• §6Mua Point", 2);
			$form->sendToPlayer($sender);
		}
		return true;
	}
	
	public function information($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
		});
		$form->setTitle("§f•§b Thông Tin");
		$form->addLabel("§f•§e Xem thông tin");
		$form->addLabel("• §cCách Mua§e Point");
		$form->addLabel("• §aNhập Số Point cần thiết vào Ô Input");
		$form->addLabel("• §a100k xu = 1 Point");
		$form->sendToPlayer($sender);
	}
	
	public function doiZCoin($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			
			$data[0] >= 1;
			$tien = $this->money->myMoney($sender);
			if($tien >= $data[0]*100000){
				$sender->sendMessage("§f•§a Bạn đã mua§e " . $data[0] . "§6 Point");
				$this->money->reduceMoney($sender, $data[0]*100000);
				$this->point->addMoney($sender, $data[0]);
			}else{
				$sender->sendMessage($this->tag . "• §cKhông Đủ Xu!");
				return true;
			}
		});
		$form->setTitle("•§e Đổi§6 Point");
		$form->addInput("• §aNhập Số Point cần Mua");
		$form->sendToPlayer($sender);
	}
	
	
}