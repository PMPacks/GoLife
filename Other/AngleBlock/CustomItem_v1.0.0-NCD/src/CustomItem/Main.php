<?php 

namespace CustomItem;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantInstance;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

Class Main extends PluginBase implements Listener{

 public function onEnable(){
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
   }
   
   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
   switch($cmd->getName()){
   case "setitemname":
   $name = $sender->getName();
	  $text = implode(" ", $args);
$item = $sender->getInventory()->getItemInHand();
$item->setCustomname($text);
$sender->getInventory()->setItemInHand($item);
$sender->sendMessage("§aBạn đã đổi tên §athành công");
 break;
 return true;
 case "setitemlore":
  $name = $sender->getName();
 $item = $sender->getInventory()->getItemInHand();
  $lore = implode(" ", $args);
  
   $item->setLore(explode("\\n", $lore));
 
 
$sender->getInventory()->setItemInHand($item);
$sender->sendMessage("§aBạn đã tạo §cLore thành công");
break;
return true;
 
   }
 return true;
  }
 }