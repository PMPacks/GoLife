<?php

namespace KaYuu081\AFPoint;

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
	
	public function onEnable(){
		$this->getServer()->getLogger()->info($this->tag . " §l§aAFPOINT by KaYuu081");
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		
		$this->rp = new Config($this->getDataFolder(). "Donation.yml", Config::YAML);
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->getResource("Config.yml");
	}
	
	public function onLoad(): void{
		$this->getServer()->getLogger()->notice("Loading.....");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch($cmd->getName()){
			case "afpoint":
			if(!($sender instanceof Player)){
				$this->getLogger()->notice("Please Dont Use that command in here.");
				return true;
			}
			$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myMoney($sender);
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $s, $data){
				$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 0:
					$this->NapThe($s);
					break;
					case 1:
					$this->MuaXu($s);
					break;
					case 2:
					$this->MuaRank($s);
					break;
					case 3:
					$this->MuaAFPoint($s);
					break;
				}
			});
			$form->setTitle("§d•§e AF§bPoint §d• ");
			$form->setContent("•§e§l Your Point: §6§l" .$money);
			$form->addButton("• §6Nạp Thẻ", 0);
			$form->addButton("• §6Mua Gói Xu", 1);
		    $form->addButton("• §6Mua §bVIP",2 );
			$form->addButton("• §6Mua §eAFPoint", 3);
			$form->sendToPlayer($sender);
	}
	return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        public function NapThe($player){
		$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myMoney($player);
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 0:
					$sender->sendMessage("§f•§b Bạn đã thoát khỏi nạp thẻ");
					$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
					case 1:
					$this->thongTin($sender);
					break;
					case 2:
					$this->napthe2($sender);
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
			$form->setContent("•§e§l Your Point: §6§l" .$money);
			$form->addButton("•§c Thoát", 0);
			$form->addButton($this->getConfig()->get("Profile.title"), 1);
			$form->addButton($this->getConfig()->get("Donation.title"), 2);
			$form->addButton("•§c Facebook Admin", 3);
			//$form->addButton("• §cThử Thẻ", 4);
			$form->sendToPlayer($player);
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
	
	public function napthe2($sender){
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
				$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
				$form = $api->createCustomForm(Function (Player $sender, $data){
				});
				$form->setTitle($this->getConfig()->get("plugin.title"));
				$form->addLabel("§e§l Vui lòng kiểm tra lại thẻ §b|§c THẺ KHÔNG HỢP LỆ §6!");
				$form->sendToPlayer($sender);
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
	
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	        public function MuaXu($player){
			$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myMoney($player);
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
			$form->setContent($this->tag . "•§e Your Point: §6" .$money);
			$form->addButton("• §6Hướng Dẫn", 0);
			$form->addButton("• §eGói Xu I", 1);
			$form->addButton("• §eGói Xu II", 2);
			$form->addButton("• §eGói Xu III", 3);
			$form->addButton("• §eGói Xu IV", 4);
			$form->addButton("• §eGói Xu V", 5);
			$form->sendToPlayer($player);
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
	
//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
    public function MuaRank($player){
           $tien = $this->point->myMoney($player);
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null) {
				}
				switch ($result) {
					case 0:
					$sender->sendMessage("§c");
					$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
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
			$form->setContent("• Point của bạn:§e ". $tien);
			$form->addButton("•§c Thoát", 0);
			$form->addButton("§c♦ §eVIP§6-§bI§c ", 1);
			$form->addButton("§c♦ §eVIP§6-§bII§c ", 2);
			$form->addButton("§c♦ §eVIP§6-§bIII§c ", 3);
			$form->addButton("§c♦ §eVIP§6-§bIV§c ", 4);
			$form->addButton("§c♦ §eVIP§6-§bV§c ", 5);
			$form->sendToPlayer($player);
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


    public function MuaAFPoint($player){
		$money = $this->getServer()->getPluginManager()->getPlugin("PointAPI")->myMoney($player);
		$money2 = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player);
            $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(Function (Player $sender, $data){
				
				$result = $data;
				if ($result == null){
				}
				switch ($result) {
					case 0:
					$sender->sendMessage("§cĐã huỷ bỏ giao dịch");
					$command = "afpoint";
					$this->getServer()->getCommandMap()->dispatch($sender, $command);
					break;
					case 1:
					$this->information2($sender);
					break;
					case 2:
					$this->doiZCoin($sender);
					break;
				}
			});
			
			$form->setTitle("§d♦§c Mua§6 Point§d ♦");
			$form->setContent("•§e§l Your Point: §6§l" .$money. " §b|§r " . "•§e§l Your Money: §6§l" .$money2);
			$form->addButton("• §rThoát", 0);
			$form->addButton("• §rThông Tin", 1);
			$form->addButton("• §6Mua Point", 2);
			$form->sendToPlayer($player);
		}
	
	public function information2($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
		});
		$form->setTitle("§f•§b Thông Tin Đổi Xu");
		$form->addLabel("§f•§e Xem thông tin");
		$form->addLabel("• §cCách Mua§e Point");
		$form->addLabel("• §aNhập Số Point cần thiết vào Ô Nhập");
		$form->addLabel("• §aNhập Làm Sao Đừng Quá Số Xu Hiện Có Của Bạn");
		$form->addLabel("• §a100k xu = 1 Point");
		$form->sendToPlayer($sender);
	}
	
	public function doiZCoin($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			
			
		});
		$form->setTitle("•§e Đổi§6 Point");
		$form->addInput("• §aNhập Số Point cần Mua");
		$form->sendToPlayer($sender);
	}	
	
}