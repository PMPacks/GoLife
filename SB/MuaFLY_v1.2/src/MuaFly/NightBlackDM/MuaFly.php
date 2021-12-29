<?php

namespace MuaFly\NightBlackDM;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
class MuaFly extends PluginBase implements Listener{

public function onLoad(){
$this->getLogger()->info(".\n§a-----------------------------\n§e BuyFLY By SableIamNoob\n§a-----------------------------");
}

public function onEnable(){
$this->getLogger()->info("§a Bật Plugin !");
$this->api = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
$this->getServer()->getPluginManager()->registerEvents($this, $this);
}

public function onDisable(){
$this->getLogger()->info("§4 Disabling Plugin");
}

public function onCommand(CommandSender $s, Command $cmd, string $label, array $args):bool {
switch($cmd->getName()){
  case "muafly":
$name = $s->getName();
$mymoney = $this->api->myMoney($s);
if($mymoney < 5000) {
  $s->sendMessage("§l§b❖§c Bạn không đủ tiền để mua fly§b ❖");
  }else{
  $s->sendMessage("§l§b❖§a Bạn Đã Mua Fly Thành Công §b❖");
  $s->setAllowFlight(TRUE);
  $this->api->reduceMoney($name, 5000);
  }
   return true;
  }
 }
}