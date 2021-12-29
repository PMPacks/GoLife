<?php
namespace maru\pmchair;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\entity\Entity;
use pocketmine\entity\Zombie as FakeRidingEntity;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\network\mcpe\protocol\SetEntityLinkPacket;
use pocketmine\network\mcpe\protocol\RemoveEntityPacket;
use pocketmine\network\mcpe\protocol\types\EntityLink;
use pocketmine\math\Vector3;
class Chair extends Position{
	private $id;
	private $entity;
	public function __construct(Entity $entity, $x, $y, $z, Level $level){
		parent::__construct($x, $y, $z, $level);
		$this->entity = $entity;
		$this->id = Entity::$entityCount++;
	}
	public function getId(){
		return $this->id;
	}
	public function getEntity(){
		return $this->entity;
	}
	public function spawnTo(Player $player){
		$pk = new AddEntityPacket();
		$pk->entityRuntimeId = $this->id;
		$pk->motion = new Vector3(0, 0, 0);
		$pk->position = $this->asVector3()->add(0.5, 1.8, 0.5);
		$pk->type = FakeRidingEntity::NETWORK_ID;
		$flags = 1 << Entity::DATA_FLAG_INVISIBLE;
		$flags ^= 1 << Entity::DATA_FLAG_NO_AI;
		$flags ^= 1 << Entity::DATA_FLAG_CAN_SHOW_NAMETAG;
		$flags ^= 1 << Entity::DATA_FLAG_ALWAYS_SHOW_NAMETAG;
		$pk->metadata = [
			Entity::DATA_FLAGS => [Entity::DATA_TYPE_LONG, $flags]
		];
		$player->dataPacket($pk);
		$pk = new SetEntityLinkPacket();
		$pk->link = new EntityLink();
		$pk->link->fromEntityUniqueId = $this->id;
		$pk->link->toEntityUniqueId = $this->entity->getId();
		$pk->link->type = 0b01;
		$pk->link->bool1 = true;
		$player->dataPacket($pk);
		$player->sendTip(" \n ");
		$player->sendPopup("§a§lGhost§6Royal");
		//$this->entity->setGenericFlag(Entity::DATA_FLAG_NO_AI, true);
	}
	public function spawnToAll(){
		foreach($this->level->getPlayers() as $player){
			$this->spawnTo($player);
		}
	}
	public function despawnFrom(Player $player){
		if($player === $this->entity){
			//$this->entity->setGenericFlag(Entity::DATA_FLAG_NO_AI, false);
		}
		$pk = new RemoveEntityPacket();
		$pk->entityUniqueId = $this->id;
		$player->dataPacket($pk);
	}
	public function despawnFromAll(){
		foreach($this->level->getPlayers() as $player){
			$this->despawnFrom($player);
		}
	}
}
