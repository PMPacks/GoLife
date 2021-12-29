<?php

namespace supernapthe;

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

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§c✒\n\n\n§aPlugin §cGmail Donate\n§d•§6 Code by:§a AmGM\n		\n§c✒");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args): bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "donate":
			$this->mainFrom($player);
			break;		
		}
		return true;
	}
	
	public function mainFrom($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $event, array $data){
		$player = $event->getPlayer();
		$result = $data[0];
		if($result === null){
		}
		switch($result){							
			case 0:
			$this->gmail1($player);
			break;
			case 1:
			$this->gmail2($player);
			break;
			}					
		});					
$form->setTitle("§l§c•§6 thông tin Nạp Thẻ UI§c •");
				    $form->addButton("§a♦§c Nạp thẻ qua Gmail♦\n§l §c♦email nạp thẻ:Levanloc8112@gmail.com");
				    $form->addButton("§a♦§c Nạp thẻ qua Facebook♦\n♦ ib fb:https://www.facebook.com/levanlocvip123");
					$form->addButton("§l§a♦sau khi nạp xog chờ OP duyệt và nhận kit♦\n chúc các bạn thành công♦");
					$form->addButton("§l§b•thoát ra•");
					$form->sendToPlayer($player);
	}
	
	public function gmail1($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
		$form = $api->createCustomForm(function (Player $event, array $data){
		$player = $event->getPlayer();
		$result = $data[0];
		if($result != null){
		$this->pin = $result;
		$this->seri = $data[1];
		$this->loaicard = $data[2];
		$event->sendMessage("§c❤§6 Nhập thẻ thành công!§c ❤\n§a•§b Hãy vào ứng dụng §cGamil§b và nhập như sau:\n§bToinapthe".$this->loaicard."pinla".$this->pin."seri".$this->seri." ");
		$sender->sendNessage("§c❤§6 Nhập thẻ thành công!§c ❤\n§a•§b Hãy vào ứng dụng §cGamil§b và nhập như sau:\n§bToinapthe".$this->loaicard."pinla".$this->pin."seri".$this->seri." ");
		
		}
		});
						
				   $form->setTitle("§l§c♦§6 Nạp thẻ thông qua Gmail 1§c ♦");
                                      $form->addLabel("§c❤§b Để §anạp thẻ §bqua §cGmail 1 §bvui lòng thực hiện như sau:\n\n§b•§e Ghi mã pin của thẻ\n§b•§e Ghi seri của thẻ\n§b•§e Ghi loại card bạn nạp\n§a->§b Bạn sẽ nhận được một cú pháp riêng\n§a•§6 Vào ứng dụng Gmaill\n§c•§d Ghi tên trong game của bạn\n§b•§6 Nhập cú pháp\n§a|§c Sau đó gửi qua §6Gmaill: §bthieukien333@gmail.com §a|");
                             $form->addInput("§cPIN thẻ");
                   $form->addInput("§cSeri thẻ");
                   $form->addInput("§cLoại thẻ");
				    $form->addButton("§l§c->§b Trở Lại");
				    $form->sendToPlayer($player);
	}
	
	public function gmail2($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
		$form = $api->createCustomForm(function (Player $event, array $data){
		$player = $event->getPlayer();
		$result = $data[0];
		if($result != null){
		$this->pin = $result;
		$this->seri = $data[1];
		$this->loaicard = $data[2];
				$event->sendMessage("§c❤§6 Nhập thẻ thành công!§c ❤\n§a•§b Hãy vào ứng dụng §cGamil§b và nhập như sau:\n§bToinapthe".$this->loaicard."pinla".$this->pin."seri".$this->seri." ");
		$sender->sendNessage("§c❤§6 Nhập thẻ thành công!§c ❤\n§a•§b Hãy vào ứng dụng §cGamil§b và nhập như sau:\n§bToinapthe".$this->loaicard."pinla".$this->pin."seri".$this->seri." ");
		
		}
		});
 $form->setTitle("§l§c♦§6 Nạp thẻ thông qua Gmail 2§c ♦");
                   $form->addLabel("§c❤§b Để §anạp thẻ §bqua §cGmail 1 §bvui lòng thực hiện như sau:\n\n§b•§e Ghi mã pin của thẻ\n§b•§e Ghi seri của thẻ\n§b•§e Ghi loại card bạn nạp\n§a->§b Bạn sẽ nhận được một cú pháp riêng\n§a•§6 Vào ứng dụng Gmaill\n§c•§d Ghi tên trong game của bạn\n§b•§6 Nhập cú pháp\n§a|§c Sau đó gửi qua §6Gmaill: §bnguyendongquymuathi@gmail.com §a|");
                             $form->addInput("§cPIN thẻ");
                   $form->addInput("§cSeri thẻ");
                   $form->addInput("§cLoại thẻ");
				    $form->addButton("§l§c->§b Trở Lại");
				    $form->sendToPlayer($player);
	}
}
