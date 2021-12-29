<?php

declare(strict_types=1);

namespace NCDAutoClearLagg;

use pocketmine\entity\Creature;
use pocketmine\entity\Entity;
use pocketmine\entity\Human;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{

    /** @var Config $settings */
    public $settings;

    public function onEnable(): void{
        @mkdir($this->getDataFolder());
        $this->saveResource("settings.yml");
        $this->settings = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
        if(is_numeric($this->settings->get("seconds"))){
            $this->getScheduler()->scheduleRepeatingTask(new TimerTask($this, (int) $this->settings->get("seconds")), 20);
        }else{
            $this->getLogger()->error("Plugin Disabled! Please enter a number for the seconds");
            $this->getServer()->getPluginManager()->disablePlugin($this);
        }
    }

    public function clearItems(){
        $i = 0;
        foreach($this->getServer()->getLevels() as $level){
            foreach($level->getEntities() as $entity){
                if(!($entity instanceof Creature)){
                    $entity->close();
                    $i++;
                }
            }
        }
        $message = $this->settings->get("clear-item");
        $message = str_replace("{COUNT}", $i, $message);
        $this->getServer()->broadcastMessage($message);
    }

    public function clearMobs(){
        $i = 0;
        foreach($this->getServer()->getLevels() as $level){
            foreach($level->getEntities() as $entity){
                if($entity instanceof Creature && !($entity instanceof Human)){
                    $entity->close();
                    $i++;
                }
            }
        }
        $message = $this->settings->get("clear-mob");
        $message = str_replace("{COUNT}", $i, $message);
        $this->getServer()->broadcastMessage($message);
    }
}