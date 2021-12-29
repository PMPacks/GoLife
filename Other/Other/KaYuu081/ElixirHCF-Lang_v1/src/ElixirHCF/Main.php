<?php

namespace ElixirHCF;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->Info(C::GREEN. "Enabled!");
		}
		
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
    $this->openMyForm($player);
		}
    public function openMyForm($player){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                break;
            }
            
            
            });
            $form->setTitle("§a§lPIXEL§6ROYAL");
            $form->setContent("§eWelcome§7, §7to §a§lPIXEL§6ROYAL\n\n§8> §7Tap to NPC to play\n§8> §7Enter the GATE to play\n§8> §7Kill people to get money\n\n§dPLAY SERVER FUN!\n\n\n");
            $form->addButton("§b§lPLAY");
            $form->sendToPlayer($player);                  
            return $form;                                            
				}
	}
