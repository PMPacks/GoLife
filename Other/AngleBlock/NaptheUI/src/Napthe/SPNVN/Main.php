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
				    $dnt->sendMessage($this->tag . "§b Tìm người ủng hộ ở Donation.yml -". $this->rp->get($name));
				    return true;
				}
			}
			return true;
		}else{
			$player->sendMessage("§d/napthe§a Để ủng hộ Server nhé <3");
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
					/*case 4:
					$this->checkStatus($sender);
					break;*/
				}
			});
			$form->setTitle($this->getConfig()->get("plugin.title"));
			$form->setContent($this->tag . "§f•§d Nạp Thẻ§c mua§6 Point");
			$form->addButton("•§c Thoát", 0);
			$form->addButton($this->getConfig()->get("Profile.title"), 1);
			$form->addButton($this->getConfig()->get("Donation.title"), 2);
			$form->addButton("•§c Facebook Admin", 3);
			//$form->addButton("• §cThử Thẻ", 4);
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
		$form->addLabel("• §cNOTE:§e Trường Hợp Thẻ Sai Quá 5 Lần Sẽ Khoá Acc 10 Phút (Nếu Như Cố Tình)");
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
			}
			if(!(is_numeric($data[2]) || is_numeric($data[3]))){
				$sender->sendMessage("§a§l Phải Là Số Nhé !");
             return true;
			}

			$this->getServer()->getLogger()->notice("Ủng hộ bởi ".$sender->getName().", kiểm tra trong Donation.yml");
			$sender->sendMessage($this->tag . " • §aSeri:§e ".$data[2].",§a Mã PIN: §e".$data[3]."\n§a Typer:§b ".$loaithe.", §aMệnh Giá: §e". $menhgia);
			$this->rp->set( $sender->getName(), ["Typer" => $loaithe, "Mệnh Giá" => $menhgia, "Seri" => $data[2], "Mã PIN" => $data[3]]);
			$this->rp->save();
		});
		$form->setTitle($this->getConfig()->get("Donation.title"));
		$form->addDropdown("→ §eChọn Loại Thẻ", ["Mobiphone", "Vinaphone", "Viettel"]);
		$form->addDropdown("→ §eMệnh Giá:", ["10000", "20000", "50000"]);
		$form->addInput("→ §eSeri:");
		$form->addInput("→ §eMã PIN:");
		$form->sendToPlayer($sender);
		return true;
	}
	
	public function versionPlugin($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomform(function (Player $sender, $data){
		$player = $sender->getPlayer();
		});
	
		
$form->setTitle("§l§c•§b FACEBOOK ADMIN§c •");
				   $form->addLabel("§eĐể nạp thẻ trực tiếp bạn cần đọc kĩ thông tin và ghi đầy đủ thông tin như:\n§f•§eMệnh Giá \n§f•§eSeri \n§f•§eMã Số Thẻ\n §eNếu hệ thống báo lỗi thì sao? \n§c❤§bBạn có thể §anạp thẻ §bqua §bFacebook §bvui lòng thực hiện như sau:\n§e•Ghi tên In-Game\n§f•Ghi loại thẻ\n§f•§e Ghi mã pin của thẻ\n§f•§e Ghi seri của thẻ\n§a|§c Sau đó gửi qua §bFacebook: §6http://fb.com/kyofficial8112 (Ngốc Quá) §a|");
				    $form->sendToPlayer($sender);
		
	}
	
	/*public function checkStatus($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			switch($data[1]){
				case 0:
				$thongtin = "• §aSUCCESS";
				break;
				case 1:
				$thongtin = "•§cDENY";
				break;
			}
			if($sender->hasPermission("Checkcard.admintools")){
				if($thongtin == "DENY"){
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "tell ".$data[0]."• §bVui lòng kiểm tra lại thẻ cào của bạn! Lý Do: §c". $thongtin);
				    //$this->rp->remove($data[0]);
					return true;
				}elseif($thongtin == "SUCCESS"){
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "tell ".$data[0]."• §aThông Tin Thẻ Của Bạn Là: §c". $thongtin);
				    //$this->rp->remove($data[0]);
					return true;
				}
			}else{
				$sender->sendMessage($this->tag . "§l§c You do not have permission for use this command!");
			}
		});
		$form->setTitle($this->getConfig()->get("Checkcard.title"));
		$form->addInput("• §aThử Thẻ");
		$form->addDropdown("•§a Chọn tác vụ", ["Thành Công", "Thất Bại"]);
		$form->sendToPlayer($sender);
	}*/
	
	
}