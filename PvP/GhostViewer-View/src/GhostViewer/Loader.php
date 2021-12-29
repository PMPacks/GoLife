<?php

declare(strict_types=1);
namespace GhostViewer;

use pocketmine\plugin\{
	Plugin, PluginBase
};
use pocketmine\level\{
	Level, Position
};
use pocketmine\entity\{
        Entity, Effect
};
use pocketmine\event\entity\{
	EntityDamageEvent, EntityDamageByEntityEvent
};
use pocketmine\level\sound\{
	AnvilFallSound, FizzSound
};
use pocketmine\inventory\PlayerInventory;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\Player;

class Loader extends PluginBase implements Listener {
	
	private $config;
	
	public function onEnable(): void{
		$this->getLogger()->info("GhostViewer is now online after server started!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);	
		$this->config = $this->getConfig();
		$this->saveDefaultConfig();
		if($this->config->get("spawn-teleport")){
                }
	}
	
	public function onDisable(): void{
		$this->getLogger()->info("GhostViewer is now goes to offline due server stopped or error occured!");
		$this->saveDefaultConfig();
	}
	
	public function onEntityDamage(EntityDamageEvent $ev): void{
		if($ev->isCancelled()){
			return;
		}
		$entity = $ev->getEntity();
		if($entity instanceof Player and $entity->getHealth() - $ev->getDamage() <= 0){
			if($entity->getGamemode() === Player::CREATIVE){
				return;
			}
			$ev->setCancelled(true);
                        $entity->setGamemode(Player::SPECTATOR);
			$entity->addTitle("§l§cDEATH", "§eYou are now in ghost mode!");
			
			$sound = new AnvilFallSound($entity);
			$sound = new FizzSound($entity);
                        $entity->getLevel()->addSound($sound);
			
			$this->getScheduler()->scheduleDelayedTask(new GhostTask($this, $entity), $this->config->get("ressurecting-time") * 20);
			$entity->getInventory()->dropContents(new Vector3(123, 123, 123)); // - Credits: xxNiceYT
			
			if($this->config->getNested("broadcast-ghost-message.display")){
				$this->getServer()->broadcastMessage($this->ghostMessage($ev, $this->config->getNested("broadcast-ghost-message.message")));
		}
            }
	}
	
	private function ghostMessage($ev, string $messages): string{
		$messages = str_replace("×INNOCENT×", $ev->getEntity()->getName(), $message);
		$messages = str_replace("×WORLD×", $ev->getEntity()->getLevel()->getName(), $message);
		$messages = str_replace("×KILLER×", $ev->getEntity()->getLastDamageCause()->getDamager()->getName(), $message);
		return $messages;
	}
}

			
		
		
