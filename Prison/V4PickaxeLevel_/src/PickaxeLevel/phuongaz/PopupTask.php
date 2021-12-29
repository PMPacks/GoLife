<?php

namespace PickaxeLevel\phuongaz;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\Player;
use PickaxeLevel\phuongaz\Main;

Class PopupTask extends Task{


    public function __construct(Main $plugin, Player $player){

        $this->plugin = $plugin;
        $this->player = $player;
    }

    public function onRun($currentTick){
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            $level = $this->plugin->getLevel($player);
            $exp = $this->plugin->getExp($player);
            $next = $this->plugin->getNextExp($player);
            $pickaxename = $this->plugin->getNamePickaxe($player);
            $i = $player->getInventory()->getItemInHand();
            $hand = $i->getCustomName();
            $it = explode(" ", $hand);
            $damage = $i->getDamage();
            if ($it[0] == "§l§c|§b") {
                /*if ($damage > 30) {
                    $i->setDamage(0);
                    $player->getInventory()->setItemInHand($i);
                    $player->sendMessage("§c•§e Cúp đã được sửa chữa miễn phí ");
                }
			if($this->plugin->getLevel($player) == 10){
					if(!$i->getId() == 278){
						$item = Item::get(278,0,1)->setCustomName("$pickaxename");
						$player->getInventory()->setItemInHand($item);
						$player->sendMessage("§c•§6 Cúp đã được §dLuyện§6 thành cúp §bkim cương");
					}
			}*/
                if($this->plugin->getLevel($player) == 100) {
       $player->sendPopup("  §l§e⚡§b SUPPER §6: §fPickaxe §e⚡\n" . "§c•§4 EXP§g:§a " . $exp ."§l§c /§a ".$next. "§c |§a Level§f: §a" . $level."\n→ §d§lSIÊU CẤP CÚP");

                }elseif($this->plugin->getLevel($player) == 50){
                    $player->sendPopup("  §l§e⚡§b VICTORY §6: §fPickaxe §e⚡\n" . "§b•§c EXP§g:§a " . $exp ."§l§f /§a ".$next. "§c |§a Level§f: §a" . $level."\n→§e CAO CẤP CÚP");

                }else{
                    $player->sendPopup("  §l§6⚡§b INFERIOR §6: §fPickaxe §e⚡\n" . "§f•§d EXP§g:§a " . $exp ."§l§c /§a ".$next. "§c |§b Level§f: §6" . $level."\n→ §fCƠ BẢN CÚP ");

                }
                         } else {
                $this->plugin->getScheduler()->cancelTask($this->getTaskId());
            }
        }
	}
}

    