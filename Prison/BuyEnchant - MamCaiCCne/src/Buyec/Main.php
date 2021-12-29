<?php

namespace Buyec;

use pocketmine\{Server, Player};
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use jojoe77777\FormAPI;

Class Main extends PluginBase implements Listener{

 public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
     
   $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");  
   $this->getLogger()->info("§l§e→§b Buyec Write By Phuongaz");
   $this->getLogger()->info("§l§e→§b Buyec Edit Lại Bởi KaYuu081");
   $this->getLogger()->info("§l§e→§b Sẽ Kích Hoạt Ngay Sau Khi Server Chạy Hoàn Tất");

 }
   
   public function onCommand(CommandSender $sender, Command $cmd, string $label, $args):bool{
   if(!$sender instanceof Player){
     $sender->sendMessage("Bạn Không Phải Là Người Chơi");
     return true;
     }
     switch($cmd->getName()){
        case "angleenchants":
		
     if (!isset($args[0]))		
		{
			return true;
	 }

        $price = 1000;
        $maxlevel = 9999;
     if(!isset($args[0]) && isset($args[1])) {
       $sender->sendMessage("§l§c/buyec <id> <level>");
       $sender->sendMessage("§l§c/listec 1/2");
	   return true;
       }else{
        if(!is_numeric($args[0]) and is_numeric($args[1])){
        $sender->sendMessage("§4ID Nâng Cấp Chỉ Giới Hạn Từ §a1 Đến §a8 Thôi Nhé");
        return true;
        }
       if($sender->getInventory()->getIteminHand()->getId() == 0){
        $sender->sendMessage("§6§lKhông Có Vật Phẩm Nâng Cấp Trên Tay");
		$sender->sendMessage("§l§eKiếm Đại Cục Nào Đó TRên Tay Rồi EC Cũng Được");
        return true;
        }
        $moneytype = $args[1] * $price;
        if($this->eco->myMoney($sender->getName()) < $moneytype){
        $sender->sendMessage("§cBạn Cần Có Tiền Để Mua Nhé");
		$sender->sendMessage("§aNào Nào! Hãy Kiếm Thêm Tiền Nhé Thì Mới Có Thể Nâng Cấp Vật Phẩm Bạn Lên Cấp Độ Cao");
        }else{
         if($args[1] > $maxlevel){
          $sender->sendMessage("§l§6Cấp Cao Nhất Hiện Tại Là: ".$maxlevel);
		  $sender->sendMessage("§l§6Bạn Chỉ §aENCHANT §a Tới Cấp Độ §e: ".$maxlevel);
          }else{
            if($args[0] > 24 && $args[0] < 0){
            $sender->sendMessage("§l§cID §eNâng Cấp Này Không Có Trong Cửa Hàng");
			$sender->sendMessage("§l§cĐể §eNắm Vững Tốt Về §eID §cHay Ghi Lệnh /listec Để Lấy ID Chính Xác Nhất");
            }else{
        $item = $sender->getInventory()->getIteminHand();
       $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment($args[0]), $args[1]));
        $sender->getInventory()->setIteminHand($item);
        $this->eco->reduceMoney($sender->getName(), $moneytype);
        $sender->sendMessage("§b§lĐã Mua Thành Công Loại §6ENCHANTt§b Này");
		$sender->sendMessage("§a§lVật Phầm Trên Tay Của Bạn Đã Được Tăng Cấp Độ Của §6ENCHANT§b Mà Bạn Mua");
		return true;
}
      } 
         }
	   }
        break;
        case "buyec":
             $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, $data){
											$result = $data[0];
				$sender = $player->getPlayer();
				if($result != null){
					$this->id = $data[0];
					$this->level = $data[1];
					$this->getServer()->getCommandMap()->dispatch($sender, "angleenchants " .$this->id." ".$this->level);
				}
			});					
$form->setTitle("§e§lAngle §6Block §e");
$form->addInput("ID ENCHANT");
$form->addInput("Level");
$form->addLabel("§6ID§f là mục enchant có sẵn ở lệnh §e/listec");
$form->sendToPlayer($sender);
   
   break;
        case "listec":
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, $data){
						});
						$form->setTitle("§e§lAngle §6Block §e(§dID ENCHANT§e)");
						$form->addLabel("§l§e→§aSử Dụng Lệnh: §e/buyec");
						$form->addLabel("§l§e→§eMỗi Cấp Là 10000 Xu Nha Mấy Bạn");
						$form->addlabel("§l§e→§cLưu Ý:§4 Nâng Cấp sẽ Không Có Cộng Dồn Đâu Nhé!");
						$form->addLabel("§l§e
   §a0:§eBảo vệ
   ----------------
   §a1: §eBảo vệ khỏi lửa
   ----------------
   §a2: §eRơi nhẹ như lông chim
   ----------------
   §a3: §eBảo vệ khỏi vụ nổ
   ----------------
   §a4: §eBảo vệ khỏi vật được bắn
   ----------------
   §a5: §eGai
   ----------------
   §a6: §eHô hấp
   ----------------
   §a7: §eSải chân dưới nước
   ----------------
   §a8: §eÁp lực với nước
   ----------------
   §a9: §eSắc bén
   ----------------
   §a10: §eHại thây ma
   ----------------
   §a11: §eHại chân đốt
   ----------------
   §a12: §eBật lùi
   ----------------
   §a13: §eKhía cạnh của lửa
   ----------------
   §a14: §eNhặt
   ----------------
   §a15: §eHiệu xuất
   ----------------
   §a16: §eMềm mại
   ----------------
   §a17: §eKhông bị phá vở
   ----------------
   §a18: §eGia tài
   ----------------
   §a19: §eSức Mạnh
   ----------------
   §a20: §eĐấm
   ----------------
   §a21: §eLửa
   ----------------
   §a22: §eVô Hạn
   ----------------
   §a23: §eMay mắn
   ----------------
   §a24: §eNhử
   ----------------");
   $form->sendToPlayer($sender);
     
	 }
    	 
      return true;
}
   }
  