<?php

declare(strict_types=1);
namespace GhostViewer;

use pocketmine\level\{
	Location, Position
};
use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\level\sound\FizzSound;

use GhostViewer\Loader;

class GhostTask extends Task {
	
	private $plugin, $player;
	
	public function __construct(Loader $plugin, Player $player){
		$this->plugin = $plugin;
		$this->player = $player;
	}
	
	public function onRun(int $currentTick): void{
		$plugin = $this->plugin;
		$player = $this->player;
		$player->setGamemode(Player::SURVIVAL);
                $player->getLevel()->addSound(new FizzSound($plugin, $player));
		if($plugin->config->get("spawn-teleport")){
                   $resurrectedSpawn = $plugin->getServer()->getDefaultLevel()->getSafeSpawn();
                   $player->teleport($resurrectedSpawn);
		}
		$player->addTitle("§l§aRESPAWNED", "§eBack to human form!");
	}
}
		
	
	
