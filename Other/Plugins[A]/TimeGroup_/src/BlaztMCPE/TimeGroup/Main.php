<?php
namespace BlaztMCPE\TimeGroup;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
    public function onEnable() {
		@mkdir($this->getDataFolder());
        Server::getInstance()->getPluginManager()->registerEvents($this, $this);
        Server::getInstance()->getLogger()->info("§aPlugin TimeRank Enable!");
        $this->config = new Config($this->getDataFolder()."players.yml", Config::YAML, []);
		$this->config->save();
		$this->manager = new Config($this->getDataFolder()."config.yml", Config::YAML, [
		"DefaultGroup" => "Guest",
		"Vip_End_Message" => "§cRank của bạn đã hết hạn.",
		]);
		$this->manager->save();
		/*$this->tags = new Config($this->getDataFolder()."tags.yml", Config::YAML, [
		"Dono" => "§a(DONO)§f {PLAYER}",
		
		]);
		$this->tags->save();*/
    }
    public function onDisable() {
        Server::getInstance()->getLogger()->info("§cPlugin TimeRank Disable!");
		$this->config->save();
		$this->manager->save();
    }
    public function onJoin(PlayerJoinEvent $ev){
        $player = $ev->getPlayer();
		if($this->config->exists($player->getName())){
        $date_at = date("d-m-Y");
        $date_ex = $this->config->get($player->getName())["Date-Expire"];
		$date_at2 = explode("-", $date_at);
		$date_ex2 = explode("-", $date_ex);
		if($date_at2[0] >= $date_ex2[0]){
			if($date_at2[1] >= $date_ex2[1]){
				if($date_at2[2] >= $date_ex2[2]){
					$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setrank ".$player->getName() ." ".$this->manager->get("DefaultGroup"));
					$player->sendTip($this->manager->get("Vip_End_Message"));
					$this->config->remove($player->getName());
					$this->config->save();
					$this->getServer()->getLogger()->info("§8[§6VIP§8] §aRank của người chơi §6".$player->getName()." §ađã hết hạn!");
				}
			}
			}
		}
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool {
        switch($command->getName()){
            case "timegroup":
                if(strtolower($args[0]) == "view"){
                    foreach($this->config->getAll() as $conf => $cf){
                        $sender->sendMessage("§8[§6BM§8] §aNick: §b$conf §aRank: §b".$cf["Tag"]."§a ngày hết hạn: §b".$cf["Date-Expire"]);
                    }
                }
                if(!isset($args[2])){
                    $sender->sendMessage("§8[§6VIP§8] §cUse /timegroup add (player) (group) <Day>");
                    $sender->sendMessage("§8[§6VIP§8] §cUse /timegroup view");
                }
                if(strtolower($args[0]) == "add"){
                $target = $this->getServer()->getPlayer($args[1]);
                if($target === null){
                    $sender->sendMessage("§8[§6VIP§8] §cNgười chơi ".$args[1]." không tìm thấy trên máy chủ");
                    return true;
                }
                $date_at = date("d-m-Y");
                $date_ex = date("d-m-Y", strtotime("+$args[3] days"));
                $this->config->set($target->getName(), ["Date-Seted" => $date_at, "Date-Expire" => $date_ex, "Seted-for-Staff" => $sender->getName(), "Rank" => $args[2]]);
                $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setrank ".$target->getName() ." ".$args[2]);
				//$target->setDisplayName($this->tags->get($args[2]));
                $this->config->save();
                $sender->sendMessage("§a[§bVIP§a]§b Đã thêm thành công người chơi§d $args[1] §athành§d $args[2] §bTrong§d $args[3] §bNgày!");
				$target->sendMessage("§aBạn vừa nhận được Rank§e $args[2] §aTrong§e $args[3] §aNgày");
                }
              
                break; 
        case "srankui":
     $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$result = $data[0];
				$sender = $event->getPlayer();
				if($result != null){
					$this->Ten = $data[0];
					$this->Rank = $data[1];
					$this->Day = $data[1];
					$this->getServer()->getCommandMap()->dispatch($sender, "timegroup add " . $this->Ten." ".$this->Rank." ".$this->Day);
				}
			});
			$form->setTitle("§aSET TIME RANK");
			
			$form->addInput("Tên người chơi");
	$form->addInput("Rank");
		$form->addInput("Ngày");
			$form->sendToPlayer($sender);
			break;
        }
        return true;
    }
}