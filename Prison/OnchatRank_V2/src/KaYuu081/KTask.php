<?php

namespace KaYuu081;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\Player;
use KaYuu081\Main;

Class KTask extends Task{


    public function __construct(Main $plugin, Player $player){

        $this->plugin = $plugin;
        $this->player = $player;
    }
    public function onRun($currentTick):void{
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
			$gr = $this->plugin->getRankUpRank($player);
			$gr2 = $this->plugin->getRankUpRankPrice($player);
			$gr3 = $this->plugin->getRankUpRankName($player);
				 $player->sendTip("      §f• §l§eCurrent Rank§b:§6 $gr §b•••>§e Next Rank§b:§6 ". $gr3." §b|§6 $gr2 §f•" );
        }
	}
}

    