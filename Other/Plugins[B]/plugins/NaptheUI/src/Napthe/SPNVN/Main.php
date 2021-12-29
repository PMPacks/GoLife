<?php

/* -----[NaptheUI]-----
* Updated Main UI System
* Author: BlackPMFury
* Current Plugin: NaptheUI/Phuongaz
* Version 3.0-SPECIALS
*/

namespace Napthe\SPNVN;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\{Player, Server};
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use jojoe7777\FormAPI;
use Napthe\SPNVN\Main;

class Main extends PluginBase implements Listener{
	public $tag = "";
	public $config;
	
	public function onEnable(){
		$this->getServer()->getLogger()->info($this->tag . "§l§a Enable Plugin...");
		$this->rp = new Config($this->getDataFolder(). "Donation.yml", Config::YAML);
		
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->getResource("Config.yml");
	}
	
	public function onJoin(PlayerJoinEvent $ev){
		$player = $ev->getPlayer();
		$name = $player->getName();
		if($player->isOp()){
			foreach($this->rp->get($name) as $dnt){
				if($dnt->rp->exists($name)){
				    $dnt->sendMessage($this->tag . "§b Found a donater at Donation.yml -". $this->rp->get($name));
				    return true;
				}
			}
			return true;
		}else{
			$player->sendPopup("§d/napthe§a Để ủng hộ Server nhé <3");
			return true;
		}
	}
	
	public function onLoad(): void{
		$this->getServer()->getLogger()->info("§l§b-=-=-=-=| ".$this->tag."§l§b |=-=-=-=-");
		$this->getServer()->getLogger()->notice($this->tag . "§l§a Code By BlackPMFury");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch($cmd->getName()){
			case "napthe":
			if(!($sender instanceof Player)){
				$this->getServer()->getLogger()->info($this->tag . "§l§c You can not use this command In Here!");
				return true;
			}
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 0:
					$sender->sendMessage("§f•§b Bạn đã thoát khỏi nạp thẻ");
					break;
					case 1:
					$this->thongTin($sender);
					break;
					case 2:
					$this->napthe($sender);
					break;
					case 3:
					$this->versionPlugin($sender);
					break;
					case 4:
					$this->checkStatus($sender);
					break;
				}
			});
			$form->setTitle($this->getConfig()->get("plugin.title"));
			$form->setContent($this->tag . "§f•§d Nạp Thẻ§c mua§6 Point");
			$form->addButton("•§c Thoát", 0);
			$form->addButton($this->getConfig()->get("Profile.title"), 1);
			$form->addButton($this->getConfig()->get("Donation.title"), 2);
			$form->addButton("•§c Facebook Admin", 3);
			$form->addButton("• §cCheckCard", 4);
			$form->sendToPlayer($sender);
		}
		return true;
	}
	
	public function thongTin($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
		});
		$form->setTitle($this->getConfig()->get("Profile.title"));
		$form->addLabel("• §aNạp Thẻ Giúp Bạn Mua VIP và Các Mặt Hàng Bằng Point.");
		$form->addLabel("• §cNOTE:§e Trường Hợp Thẻ Sai sẽ Bị Xoá Thẻ (Nếu Cố Ý gửi Thẻ Sai)");
		$form->sendToPlayer($sender);
	}
	
	public function napthe($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			switch($data[0]){
				case 0:
				$loaithe = "Mobiphone";
				break;
				case 1:
				$loaithe = "Vinaphone";
				break;
				case 2:
				$loaithe = "Viettel";
				break;
			}
			if(!(is_numeric($data[1]) || is_numeric($data[2]))){
				$sender->sendMessage("§a§l Phải Là Số!");
				return true;
			}
			$this->getServer()->getLogger()->notice("Donate By ".$sender->getName().", Check In Donation.yml");
			$sender->sendMessage($this->tag . " • §aSeri:§e ".$data[1].",§a Code: §e".$data[3]."\n§a Typer:§b ".$loaithe.", §aMệnh Giá: §e". $data[1]);
			$this->rp->set( $sender->getName(), ["Typer" => $loaithe, "Mệnh Giá" => $data[1], "Seri" => $data[2], "Code" => $data[3]]);
			$this->rp->save();
		});
		$form->setTitle($this->getConfig()->get("Donation.title"));
		$form->addDropdown("Dropdown", ["Mobiphone", "Vinaphone", "Viettel"]);
		$form->addInput("• §aMệnh Giá:");
		$form->addInput("• §aSeri:");
		$form->addInput("• §aCode:");
		$form->sendToPlayer($sender);
		return true;
	}
	
	public function versionPlugin($sender){
		$sender->sendMessage($this->tag . " §e3.0\n§aAuthor: BlackPMFury");
	}
	
	public function checkStatus($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			switch($data[1]){
				case 0:
				$thongtin = "• §aThành Công";
				break;
				case 1:
				$thongtin = "•§c Thất Bại";
				break;
			}
			if($sender->hasPermission("Checkcard.admintools")){
				if($thongtin == "Thất Bại"){
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "tell ".$data[0]."• §bVui Lòng Check lại thẻ cào của bạn! Lý Do: §c". $thongtin);
				    //$this->rp->remove($data[0]);
					return true;
				}elseif($thongtin == "Thành Công"){
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "tell ".$data[0]."• §aThông Tin Thẻ Của Bạn: §c". $thongtin);
				    //$this->rp->remove($data[0]);
					return true;
				}
			}else{
				$sender->sendMessage($this->tag . "§l§c You do not have permission for use this command!");
			}
		});
		$form->setTitle($this->getConfig()->get("Checkcard.title"));
		$form->addInput("• §aCheck Card");
		$form->addDropdown("•§a Chọn tác vụ", ["Thành Công", "Thất Bại"]);
		$form->sendToPlayer($sender);
	}
	
	
}