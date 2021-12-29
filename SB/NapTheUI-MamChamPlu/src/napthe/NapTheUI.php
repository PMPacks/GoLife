<?php

namespace napthe;

#Server Player
use pocketmine\{Server, Player};
#Base
use pocketmine\plugin\PluginBase;
#Event
use pocketmine\event\Listener;
#TextFormat
use pocketmine\utils\TextFormat;
#Effect
use pocketmine\entity\Effect;
#COMMAND
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};
#PACKET
use pocketmine\event\server\DataPacketReceiveEvent;
#API
use jojoe77777\FormAPI;

class NapTheUI extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§c♦Plugin §bNapthe §cBy MamChamPlu\n\n §ePlugin §bNạp Thẻ §6Đã Kích Hoạt\n♦♦♦♦♦♦♦♦");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args): bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "napthe":
			$this->mainFrom($player);
			break;		
		}
		return true;
	}
	
		public function mainFrom($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomform(function (Player $event, $data){
		$player = $event->getPlayer();
		});
	
		
$form->setTitle("§l§c•§6 Nạp Thẻ UI§c •");
                   $form->addLabel("§c❤§bVui lòng thực hiện như sau khi giao dịch qua §eGmail:\n\n§b•§e Ghi mã pin của thẻ\n§b•§e Ghi seri của thẻ\n§b•§e Ghi loại card bạn nạp\n§a->§b Bạn phải nhập đúng thông tin đầy đủ nếu không bạn sẽ bị huỷ giao dịch\n§a•§6 Vào ứng dụng Gmaill\n§c•§d Ghi tên trong game của bạn\n§b•§6 Nhập cú pháp\n§a|§c Sau đó gửi qua §6Gmaill: §blevanloc8112@gmail.com §a|"); 
				   $form->addLabel("§c❤§bĐể §anạp thẻ §bqua §bFacebook §bvui lòng thực hiện như sau:\n\n§b•§e Ghi mã pin của thẻ\n§b•§e Ghi seri của thẻ\n§b•§e Ghi loại card bạn nạp\n§a->§b Bạn sẽ nhận được một cú pháp riêng\n§a•§6 Vào ứng dụng Gmaill\n§c•§d Ghi tên trong game của bạn\n§b•§6 Nhập cú pháp\n§a|§c Sau đó gửi qua §bFacebook: §6http://fb.com/levanlocvip123 §a|");
				    $form->sendToPlayer($player);
	}
}
