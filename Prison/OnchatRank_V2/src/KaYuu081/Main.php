<?php

namespace KaYuu081;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\scheduler\Task;
use pocketmine\item\Item;
use KaYuu081\Main;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase implements Listener{
	
	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->Info(C::GREEN. "Đã bật write by KaYuu081!");
		$this->rankUp = $this->getServer()->getPluginManager()->getPlugin("RankUp");
		
		}
	
	public function getRankUpRank($player){
			$group = $this->rankUp->getRankUpDoesGroups()->getPlayerGroup($player);

			if($group !== false){
				return $group;
			}else{
				return "A";
			}
		}
	public function getRankUpRankPrice($player){
			$nextRank = $this->rankUp->getRankStore()->getNextRank($player);

			if($nextRank !== false){
				return $nextRank->getPrice();
			}else{
				return "Max Rank";
			}
		}
	public function getRankUpRankName($player){
			$nextRank = $this->rankUp->getRankStore()->getNextRank($player);

			if($nextRank !== false){
				return $nextRank->getName();
			}else{
				return "kkkk";
			}
		}
		
	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();      
		$name = $player->getName();
		$ev = $this->getRankUpRank($player);
	    $player->setDisplayName("§b[§a". $ev  ."§b]§r ".$player->getName());
		}
		 public function onItemHeld(PlayerItemHeldEvent $ev){


        $task = new KTask($this, $ev->getPlayer());
        $this->tasks[$ev->getPlayer()->getId()] = $task;
        $this->getScheduler()->scheduleRepeatingTask($task, 1);
		 }
	}
