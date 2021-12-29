<?php

/** -==•[ReportSPN]•==-
*
* Report Everybody is Abuse The Rules of Server.
*/

namespace ReportUI\SPNVN;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\Config;
use pocketmine\{Player, Server};
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use jojoe7777\FormAPI;

class Main extends PluginBase implements Listener{
	public $tag = "";
	public $report = "•§aReport§r";
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info($this->tag . " §cReport§aSPN is Always Online.....");
		$this->getLogger()->info("\n\n§c§l•§b R༶E༶P༶O༶R༶T༶S༶P༶N༶V༶N༶ §6Version §e4\n§c❤️ §aStarting Plugin By §cBlackPMFury\n\n");
		$this->rp = new Config($this->getDataFolder() . "Report.yml", Config::YAML, []);
		$this->rp->save();
		$this->cr = new Config($this->getDataFolder() ."Cancel-Report.yml", Config::YAML, []);
		$this->cr->save();
	}
	
	public function onJoin(PlayerJoinEvent $ev){
		$player = $ev->getPlayer();
		if($this->rp->exists($player->getName())){
			$player->sendMessage($this->report . "§a You have a Report in Email!");
		}else{
			$player->sendMessage($this->report . "§e You do not have Any Report, G'Day!");
		}
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch(strtolower($cmd->getName())){
			case "report":
			if(!($sender instanceof Player)){
				$this->getServer()->getLogger()->warning("Sử dụng trong server!");
				return true;
			}
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
					$this->onReport($sender);
					break;
					case 2:
					$this->onAdminTools($sender);
					break;
				}
			});
			
			$form->setTitle("§6>> ".$this->report."§6 <<");
			$form->addButton("§f•§c Thoát", 0);
			$form->addButton("§f•§6 Tố cáo", 1);
			$form->addButton("§f•§6 Report Manager", 2);
			$form->sendToPlayer($sender);
		}
		return true;
	}
	
	public function onReport($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			switch($data[2]){
				case 0:
				$reason = "•§c Hack Game/Speed";
				break;
				case 1:
				$reason = "•§c Lừa Đảo/Trộm Cắp";
				break;
				case 2:
				$reason = "•§c Không Tôn Trọng Người Chơi/Staff";
				break;
				case 3:
				$reason = "•§c Cố Ý Gây War/Chửi Người chơi Khác";
				break;
				case 4:
				$reason = "•§c Ý kiến của bạn";
				break;
			}
			$this->rp->set( $sender->getName(), ["Tên" => $data[1], "Lý Do" => $reason, "Lý Do Khác" => $data[3]]);
			$this->rp->save();
			$sender->sendMessage($this->report . "•§aTố Cáo§c ".$data[1]."§a Thành Công!");
			$this->getServer()->getLogger()->info($this->report . "•§a Trường Hợp §c".$reason."§a Của §c".$data[1]."§a Bị báo Cáo Bởi§e ". $sender->getName());
			$sender->sendMessage($this->tag . "•§aĐợi Hệ Thống Xét Duyệt!");
			$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "tell ".strtolower($data[1])." §eBạn bị tố cáo bởi§a ".$sender->getName()."§e với lý do §c".$reason." \ ". $data[3]);
			if(!(isset($data[3]))){
				$sender->sendMessage("•§c [1] §aĐiền Rõ Lý Do Tuỳ Chọn Nếu Có!");
				return true;
			}
		});
		$form->setTitle("§f•§a Tố Cáo");
		$form->addLabel("§f•§6 Tố Cáo Đúng Lý Do Là Tốt Nhấn Để xét duyệt!");
		$form->addInput("•§6 Tên");
		$form->addDropdown("•§a Lý Do", ["Hack Game/Speed", "Cố Ý Trộm Đồ", "Lừa Đảo", "Không Tôn Trọng Người Khác/Staff", "Others Reason"]);
		$form->addInput("• §aLý Do Khác (Opitions)");
		$form->sendToPlayer($sender);
	}
	
	public  function onAdminTools($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(Function (Player $sender, $data){
			
			$ketqua = $data;
			if ($ketqua == null) {
			}
			switch ($ketqua) {
				case 0:
				$this->onCancelReport($sender);
				break;
				case 1:
				$this->managerReport($sender);
				break;
			}
		});
		$form->setTitle("§f• §aManager Report");
		$form->addButton("•§c Huỷ Tố Cáo", 0);
		$form->addButton("•§c Manager Report", 1);
		$form->sendToPlayer($sender);
	}
	
	public function onCancelReport($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			$this->cr->set( $sender->getName(), ["Tên" => $data[1], "Lý Do Huỷ" => $data[2]]);
			$this->cr->save();
			$sender->sendMessage($this->report . "•§a Huỷ Đơn Tố cáo Của §c".$data[1]."§a Thành Công!");
			$this->rp->remove($sender->getName());
		});
		$form->setTitle("§f•§aHuỷ Tố Cáo");
		$form->addLabel("• §eHuỷ Đơn Tố Cáo Nếu Bạn Nhầm Lẫn!");
		$form->addInput("• §eTên:");
		$form->addInput("• §eLý Do Huỷ:");
		$form->sendToPlayer($sender);
	}
	
	public function managerReport($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $sender, $data){
			if($sender->hasPermission("Manager.Admin")){
				$sender->sendMessage("§c");
			}else{
				$sender->sendMessage("§cBạn không có quyền để xem Report Manager Admin!");
			}
		});
		$form->setTitle("§f• §aManager Report");
		$form->addLabel("§fReport #1:");
		$form->addLabel("• §eTên Người bị Tố Cáo:§c ". $this->rp->get("Tên"));
		$form->addLabel("• §eLý Do: §c". $this->rp->get("Lý Do"));
		$form->addLabel("• §eLý Do khác (Nếu Có):§c ". $this->rp->get("Lý Do Khác"));
		$form->sendToPlayer($sender);
	}
	
	/**public function managerReport($sender){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(Function (Player $sender, $data){
		});
		$form->setTitle("§f•§aManager Report");
		$form->addLabel("§aĐang Bảo Trì Hệ Thống!");
		$form->sendToPlayer($sender);
	}*/
}