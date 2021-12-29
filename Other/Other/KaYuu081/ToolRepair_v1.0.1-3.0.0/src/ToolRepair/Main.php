<?php

namespace ToolRepair;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\{Utils, Config, TextFormat};
use pocketmine\command\{Command, CommandSender, CommandExecuter, CommandMap, ConsoleCommandSender};

use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\inventory\PlayerInventory;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\Server;
use pocketmine\entity\Effect;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\player\{PlayerChatEvent, PlayerCommandPreprocessEvent};
use pocketmine\item\Tool;
use pocketmine\item\Armor;

class Main extends PluginBase implements Listener{

public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
}

public function onCommand(CommandSender $sender, Command $command, $label, array $args): bool {
switch(strtolower($command->getName())){
case "fix":
if($sender instanceof Player){
$item = $sender->getInventory()->getItemInHand();
if($item instanceof Armor or $item instanceof Tool){
$id = $item->getId();
$meta = $item->getDamage();
$sender->getInventory()->removeItem(Item::get($id, $meta, 1));

$nitem = Item::get($id, 0, 1);
if($item->hasCustomName()){
$nitem->setCustomName($item->getCustomName());
}
if($item->hasEnchantments()){
foreach($item->getEnchantments() as $enchant){
$nitem->addEnchantment($enchant);
}
}
$sender->getInventory()->addItem($nitem);
$sender->sendMessage($item->getName() . " repaired successfully.");
return true;
} else {
$sender->sendMessage("This item can't be repaired.");
return false;
}
} else {
$sender->sendMessage("You're not online");
return false;
}
break;
}
}

}
