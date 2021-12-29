<?php

namespace KaYuu081\NapThe;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use jojoe7777\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as CP;

class Main extends PluginBase{
	
	public $title = "Nạp Thẻ";
	public $error = "Thất Bại";
	public $checking = "Working . . .";
	public $config;
	
	public function onEnable(){
		$this->getServer()->getLogger()->info(" §l§aNạp Thẻ Point by KaYuu081");
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		//////////////////////////////////////////////////////////////////////////////
		$this->database = new Config($this->getDataFolder(). "admincheck.yml", Config::YAML);
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->getResource("config.yml");
	}
		public function onLoad(): void{
		$this->getServer()->getLogger()->notice("Loading.....");
	}
		public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		if(!($sender instanceof Player)){
			$this->getLogger()->notice("Please Dont Use that command in here.");
			return true;
			}
		switch($cmd->getName()){
			case "napthe":
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
			switch($data[1]){
				case 0:
				$menhgia = "10000";
				break;
				case 1:
				$menhgia = "20000";
				break;
				case 2:
				$menhgia = "50000";
				break;
				case 3:
				$menhgia = "100000";
				break;
				case 4:
				$menhgia = "200000";
				break;
				case 5:
				$menhgia = "500000";
				break;
			}
if($data[2] == null || $data[2] == "" || $data[3] == null || $data[3] == ""){
}else if(strlen($data[2]) < 8 || strlen($data[3]) < 8 || strlen($data[2]) > 20 || strlen($data[3]) > 20){
	$sender->sendMessage("§l§6- §eĐộ dài mã không phù hợp!");
	
}else if(!(is_numeric($data[2]))){
	$sender->sendMessage("§l§6- §eMã Seri sai!");
	     return false;
		}else if(!(is_numeric($data[3]))){
			$sender->sendMessage("§l§6- §eMã PIN sai!");
			return false;
			}else if(!(is_numeric($data[2]) || is_numeric($data[3]))){
				$sender->sendMessage("§l§6- §eMã Seri sai!");
				$sender->sendMessage("§l§6- §eMã PIN sai!");
				$sender->sendMessage("§l§6- §cKhuyến cáo: §6Tránh Spam!");
				return false;
			}else{
			$this->getServer()->getLogger()->notice($sender->getName(). "\n§f• §eSeri:§6 ".$data[2]."\n§f• §eMã PIN: §6".$data[3]."\n§f• §eTyper:§6 ".$loaithe."\n§f• §eMệnh Giá: §6". $menhgia);				
			$sender->sendMessage($this->checking);
			$sender->sendMessage("§f• §eSeri:§6 ".$data[2]."\n§f• §e Mã PIN: §6".$data[3]."\n§f• §e Typer:§6 ".$loaithe."\n§f• §eMệnh Giá: §6". $menhgia);
			$sender->sendMessage("§l§6- §eĐang xử lý • • •");
				
			$this->database->set( $sender->getName(), ["Typer" => $loaithe, "Mệnh Giá" => $menhgia, "Seri" => $data[2], "Mã PIN" => $data[3]]);
			$this->database->save();
			}
		});
		$form->setTitle($this->title);
		$form->addDropdown("→ §eChọn Loại Thẻ", ["Mobiphone", "Vinaphone", "Viettel"]);
		$form->addDropdown("→ §eMệnh Giá:", ["10000", "20000", "50000", "100000", "200000", "500000"]);
		$form->addInput("→ §eSeri:");
		$form->addInput("→ §eMã PIN:");
		$form->sendToPlayer($sender);
		return true;
	}
		}
}
		