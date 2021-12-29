<?php
/**
*
* 
*  _____                 _            _             
* |_   _|               | |          | |            
*   | |  _ __ ___  _ __ | | __ _  ___| |_ ___  _ __ 
*   | | | '_ ` _ \| '_ \| |/ _` |/ __| __/ _ \| '__|
*  _| |_| | | | | | |_) | | (_| | (__| || (_) | |   
* |_____|_| |_| |_| .__/|_|\__,_|\___|\__\___/|_|   
*                 | |                               
*                 |_|                               
*
* Implactor (c) 2018
* This plugin is licensed under GNU General Public License v3.0!
* It is free to use, copyleft license for software and other 
* kinds of works.
* ------===------
* > Author: Zadezter
* > Team: ImpladeDeveloped
*
*
**/
declare(strict_types=1);
namespace Implactor\tasks;

use pocketmine\Player;
use pocketmine\scheduler\Task;

use Implactor\Implade;

class RainbowArmorTask extends Task {
	
	private $plugin, $player;

	public function __construct(Implade $plugin, Player $player){
		$this->plugin = $plugin;
		$this->player = $player;
	}

	public function onRun(int $currentTick): void{
		$player = $this->player;
		$plugin = $this->plugin;
		if($player->isOnline()){
			$timeColors = $plugin->timers[$player->getName()];
			$plugin->colors[$player->getName()] = $this->getTaskId();
			if($timeColors === 23) $plugin->rainbowArmor($player, 255, 0, 64);
			if($timeColors === 22) $plugin->rainbowArmor($player, 255, 0, 128);
			if($timeColors === 21) $plugin->rainbowArmor($player, 255, 0, 191);
			if($timeColors === 20) $plugin->rainbowArmor($player, 255, 0, 255);
			if($timeColors === 19) $plugin->rainbowArmor($player, 191, 0, 255);
			if($timeColors === 18) $plugin->rainbowArmor($player, 128, 0, 255);
			if($timeColors === 17) $plugin->rainbowArmor($player, 64, 0, 255);
			if($timeColors === 16) $plugin->rainbowArmor($player, 0, 0, 255);
			if($timeColors === 15) $plugin->rainbowArmor($player, 0, 64, 255);
			if($timeColors === 14) $plugin->rainbowArmor($player, 0, 128, 255);
			if($timeColors === 13) $plugin->rainbowArmor($player, 0, 191, 255);
			if($timeColors === 12) $plugin->rainbowArmor($player, 0, 255, 255);
			if($timeColors === 11) $plugin->rainbowArmor($player, 0, 255, 191);
			if($timeColors === 10) $plugin->rainbowArmor($player, 0, 255, 128);
			if($timeColors === 9) $plugin->rainbowArmor($player, 0, 255, 64);
			if($timeColors === 8) $plugin->rainbowArmor($player, 0, 255, 0);
			if($timeColors === 7) $plugin->rainbowArmor($player, 64, 255, 0);
			if($timeColors === 6) $plugin->rainbowArmor($player, 128, 255, 0);
			if($timeColors === 5) $plugin->rainbowArmor($player, 191, 255, 0);
			if($timeColors === 4) $plugin->rainbowArmor($player, 255, 255, 0);
			if($timeColors === 3) $plugin->rainbowArmor($player, 255, 191, 0);
			if($timeColors === 2) $plugin->rainbowArmor($player, 255, 128, 0);
			if($timeColors === 1) $plugin->rainbowArmor($player, 255, 64, 0);
			if($timeColors === 0) $plugin->rainbowArmor($player, 255, 0, 0);
			if($timeColors === 24) $plugin->rainbowArmor($player, 255, 0, 0); $timeColors = 0;
		 }else{
			$plugin->getScheduler()->cancelTask($this->getTaskId());
		}
	}
}
