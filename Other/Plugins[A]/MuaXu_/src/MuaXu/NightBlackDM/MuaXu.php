<?php

namespace MuaXu\NightBlackDM;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use jojoe77777\FormAPI;
class MuaXu extends PluginBase implements Listener{

public function onLoad(){
$this->getLogger()->info("-\n§l§e===============\n  §l§bMuaXu By Night\n§l§e===============\n-");
}

public $prefix = "§l•§a[§bMuaXu§a]§f•§r";
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->getLogger()->info($this->prefix . "§a Mua Xu Đã Bật");
$this->coin = $this->getServer()->getPluginManager()->getPlugin("Coins");
$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
$this->getServer()->getPluginManager()->getPlugin("FormAPI");
}

public function onCommand(CommandSender $s, Command $cmd, string $label, array $args):bool {
switch($cmd->getName()){
  case "muaxu":
$nchinh = $s->getName();
$mycoin = $this->coin->getMoney($nchinh);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§a•§b Coin Của Bạn: §d".$mycoin);
  $form->addLabel("§a•10.000$ Xu - 10 Coin - [goi1]");
  $form->addLabel("§a•20.000$ Xu - 20 Coin - [goi2]");
  $form->addLabel("§a•30.000$ Xu - 30 Coin - [goi3]");
  $form->addLabel("§a•40.000$ Xu - 40 Coin - [goi4]");
  $form->addLabel("§a•50.000$ Xu - 50 Coin - [goi5]");
  $form->addLabel("§a•§6√ §b Dùng : /muaxu [goi1->goi5]");
  $form->sendToPlayer($s); 
  if(isset($args[0])){
  if(isset($args[0])){
  switch(strtolower($args[0])){
  
  case "goi1":
$n1 = $s->getName();
$com11 = "tell ".$n1." §b Bạn Đã Mua Xu Thành Công";
$com21 = "tell ".$n1." §c Bạn Mua Xu Thất Bại";
$c1 = $this->coin->getMoney($n1);
if($c1 < 10) {
  $s->sendMessage($this->prefix . "§l§c Không Đủ Coin ! Mua Xu thất Bại!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com21);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §c      Mua Xu Không Thành Công!");
  $form->sendToPlayer($s); 
  
  }else{
  $s->sendMessage($this->prefix . "§l§a Đủ Coin ! Mua Thành Công!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com11);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §a      Mua Xu Thành Công!");
  $form->sendToPlayer($s); 
  
  $this->getServer()->broadcastMessage("§l§b Người Chơi ".$n1." Đã Mua §aThành Công §eGói Xu 1");
  $this->eco->addMoney($n1, 10000);
  $this->coin->grantMoney($n1, -10, true);
  }
  
return true;
   break;
   }
   }

}
if(isset($args[0])){
if(isset($args[0])){
switch(strtolower($args[0])){ 
   
  case "goi2":
$n2 = $s->getName();
$com12 = "tell ".$n2." §b Bạn Đã Mua Xu Thành Công";
$com22 = "tell ".$n2." §c Bạn Mua Xu Thất Bại";
$c2 = $this->coin->getMoney($n2);
if($c2 < 20) {
  $s->sendMessage($this->prefix . "§l§c Không Đủ Coin ! Mua Xu thất Bại!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com22);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §c      Mua Xu Không Thành Công!");
  $form->sendToPlayer($s); 
  
  }else{
  $s->sendMessage($this->prefix . "§l§a Đủ Coin ! Mua Thành Công!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com12);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §a      Mua Xu Thành Công!");
  $form->sendToPlayer($s); 
  
  $this->getServer()->broadcastMessage("§l§b Người Chơi ".$n2." Đã Mua §aThành Công §eGói Xu 2");
  $this->eco->addMoney($n2, 20000);
  $this->coin->grantMoney($n2, -20, true);
  }
  
return true;
   break;
   }
   }

}
if(isset($args[0])){
if(isset($args[0])){
switch(strtolower($args[0])){ 
   
  case "goi3":
$n3 = $s->getName();
$com13 = "tell ".$n3." §b Bạn Đã Mua Xu Thành Công";
$com23 = "tell ".$n3." §c Bạn Mua Xu Thất Bại";
$c3 = $this->coin->getMoney($n3);
if($c3 < 30) {
  $s->sendMessage($this->prefix . "§l§c Không Đủ Coin ! Mua Xu thất Bại!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com23);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §c      Mua Xu Không Thành Công!");
  $form->sendToPlayer($s); 
  
  }else{
  $s->sendMessage($this->prefix . "§l§a Đủ Coin ! Mua Thành Công!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com13);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §a      Mua Xu Thành Công!");
  $form->sendToPlayer($s); 
  
  $this->getServer()->broadcastMessage("§l§b Người Chơi ".$n3." Đã Mua §aThành Công §eGói Xu 3");
  $this->eco->addMoney($n3, 30000);
  $this->coin->grantMoney($n3, -30, true);
  }
  
return true;
   break;
   }
   }

}
if(isset($args[0])){
if(isset($args[0])){
switch(strtolower($args[0])){ 
   
  case "goi4":
$n4 = $s->getName();
$com14 = "tell ".$n4." §b Bạn Đã Mua Xu Thành Công";
$com24 = "tell ".$n4." §c Bạn Mua Xu Thất Bại";
$c4 = $this->coin->getMoney($n4);
if($c4 < 40) {
  $s->sendMessage($this->prefix . "§l§c Không Đủ Coin ! Mua Xu thất Bại!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com24);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §c      Mua Xu Không Thành Công!");
  $form->sendToPlayer($s); 
  
  }else{
  $s->sendMessage($this->prefix . "§l§a Đủ Coin ! Mua Thành Công!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com14);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §a      Mua Xu Thành Công!");
  $form->sendToPlayer($s); 
  
  $this->getServer()->broadcastMessage("§l§b Người Chơi ".$n4." Đã Mua §aThành Công §eGói Xu 4");
  $this->eco->addMoney($n4, 40000);
  $this->coin->grantMoney($n4, -40, true);
  }
  
return true;
   break;
   }
   }

}
if(isset($args[0])){
if(isset($args[0])){
switch(strtolower($args[0])){ 
   
  case "goi5":
$n5 = $s->getName();
$com15 = "tell ".$n5." §b Bạn Đã Mua Xu Thành Công";
$com25 = "tell ".$n5." §c Bạn Mua Xu Thất Bại";
$c5 = $this->coin->getMoney($n5);
if($c5 < 50) {
  $s->sendMessage($this->prefix . "§l§c Không Đủ Coin ! Mua Xu thất Bại!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com25);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §c      Mua Xu Không Thành Công!");
  $form->sendToPlayer($s); 
  
  }else{
  $s->sendMessage($this->prefix . "§l§a Đủ Coin ! Mua Thành Công!");
  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $com15);
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $s, array $data){

 });
  $form->setTitle("§l§e-=====[§bMua Xu§e]=====-");
  $form->addLabel("§l§b ⇨ §a      Mua Xu Thành Công!");
  $form->sendToPlayer($s); 
  
  $this->getServer()->broadcastMessage("§l§b Người Chơi ".$n5." Đã Mua §aThành Công §eGói Xu 5");
  $this->eco->addMoney($n5, 50000);
  $this->coin->grantMoney($n5, -50, true);
  }
   
}
  }
return true;
}
return true;
}
}
}