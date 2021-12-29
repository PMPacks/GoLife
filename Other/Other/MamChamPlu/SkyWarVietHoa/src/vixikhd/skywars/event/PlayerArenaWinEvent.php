<?php

declare(strict_types=1);

namespace vixikhd\skywars\event;

use pocketmine\event\plugin\PluginEvent;
use pocketmine\Player;
use vixikhd\skywars\arena\Arena;
use vixikhd\skywars\SkyWars;
use onebone\economyapi\EconomyAPI;

/**
 * Class PlayerArenaWinEvent
 * @package skywars\event
 */
class PlayerArenaWinEvent extends PluginEvent {

    /** @var null $handlerList */
    public static $handlerList = \null;

    /** @var Player $player */
    protected $player;

    /** @var Arena $arena */
    protected $arena;

    /**
     * PlayerArenaWinEvent constructor.
     * @param SkyWars $plugin
     * @param Player $player
	 /**  
 * Arena constructor.
 * @param Server $server  
 * @param Plugin $plugin  
 */
 public function __construct(Server $server, Plugin $plugin) {  
    $server->getPluginManager()->registerEvents($this, $plugin);  
 }  
  
/**  
 * @param PlayerArenaWinEvent $event  
 */
 public function onWin(PlayerArenaWinEvent $event) {  
    $player = $event->getPlayer();  
    $this->addmoney($player, 1000);  
    $player->sendMessage("a> B?n ?? chi?n th?ng v?i 1000 xu!");  
 }  
		
/**  
 * @param Player $player  
 * @param int $coins  
 */
 public function addCoins(Player $player, int $coins) {}
     * @param Arena $arena
     */
    public function __construct(SkyWars $plugin, Player $player, Arena $arena) {
        $this->player = $player;
        $this->arena = $arena;
        parent::__construct($plugin);
    }

    /**
     * @return Player $arena
     */
    public function getPlayer(): Player {
        return $this->player;
    }

    /**
     * @return Arena $arena
     */
    public function getArena(): Arena {
        return $this->arena;
    }
}