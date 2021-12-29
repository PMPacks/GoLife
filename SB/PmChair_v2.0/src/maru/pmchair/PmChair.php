<?php
namespace maru\pmchair;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\level\Position;
use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\block\Stair;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
class PmChair extends PluginBase implements Listener{
	private $chairs = [];
	private $doubleTap = [];
	public function onEnable(){
		$this->getServer ()->getPluginManager ()->registerEvents($this, $this);
	}
	public function getChair(Entity $entity){
		return $this->chairs[$entity->getId()] ?? null;
	}
	public function getChairFromPosition(Position $pos){
		foreach($this->chairs as $chair){
			if($chair->equals($pos)){
				return $chair;
			}
		}
		return null;
	}
	public function isSeatOnChair(Entity $entity){
		return isset($this->chairs[$entity->getId()]);
	}
	public function seatOnChair(Entity $entity, Position $pos){
		$chair = $this->getChairFromPosition($pos);
		if($chair !== null){
			$chair->despawnFromAll();
			foreach($this->chairs as $id => $compare){
				if($compare === $chair){
					unset($this->chairs[$id]);
					break;
				}
			}
		}
		if($this->isSeatOnChair($entity)){
			$this->removeChair($entity);
		}
		$this->chairs[$entity->getId()] = $chair = new Chair($entity, $pos->getFloorX(), $pos->getFloorY(), $pos->getFloorZ(), $pos->getLevel());
		$chair->spawnToAll();
	}
	public function removeChair(Entity $entity){
		$chair = $this->getChair($entity);
		if($chair !== null){
			$chair->despawnFromAll();
			unset($this->chairs[$entity->getId()]);
		}
	}
	public function onTouch(PlayerInteractEvent $event){
		$player = $event->getPlayer();
		if(!$player->isSneaking() && $event->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK){
			$block = $event->getBlock();
			if($this->isSeatOnChair($player)){
				$this->removeChair($player);
			}else if($block instanceof Stair && ($block->getDamage() & 0b100) == 0){
				if($this->getChairFromPosition($block) !== null){
					$player->sendPopup("§8§lPlugins BY MCCreeperYT");
					return;
				}
				if(microtime(true) - ($this->doubleTap[$player->getId()] ?? -1) < 0.5){
					$this->seatOnChair($player, $block);
					unset($this->doubleTap[$player->getId()]);
				}else{
					$this->doubleTap[$player->getId()] = microtime(true);
					$player->sendPopup("");
				}
			}
		}
	}
	/**
	 * @ignoreCancelled true
	 *
	 * @priority MONITOR
	 */
	public function onEntityTeleport(EntityTeleportEvent $event){
		$entity = $event->getEntity();
		if($this->isSeatOnChair($entity)){
			$this->removeChair($entity);
		}
	}
	/**
	 * @ignoreCancelled true
	 *
	 * @priority MONITOR
	 */
	public function onEntityLevelChange(EntityLevelChangeEvent $event){
		if($event->getEntity() instanceof Player){
			foreach($this->chairs as $chair){
				if($chair->level === $event->getOrigin()){
					$chair->despawnFrom($event->getEntity());
				}else if($chair->level === $event->getTarget()){
					$chair->spawnTo($event->getEntity());
				}
			}
		}
	}
	public function onEntityDeath(EntityDeathEvent $event){
		$entity = $event->getEntity();
		if($this->isSeatOnChair($entity)){
			$this->removeChair($entity);
		}
	}
	public function onJump(PlayerJumpEvent $event){
		$player = $event->getPlayer();
		if($this->isSeatOnChair($player)){
			$this->removeChair($player);
		}
	}
	public function onQuit(PlayerQuitEvent $event){
		$player = $event->getPlayer();
		if($this->isSeatOnChair($player)){
			$this->removeChair($player);
		}
		unset($this->doubleTap[$player->getId()]);
	}
}
