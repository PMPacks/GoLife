<?php
declare(strict_types=1);

namespace NCDAutoClearLagg;

use pocketmine\scheduler\Task;

class TimerTask extends Task{

    private $plugin;
    private $seconds;

    public function __construct(Main $plugin, int $seconds){
        $this->plugin = $plugin;
        $this->seconds = $seconds;
    }

    public function onRun(int $currentTick): void{
        $times = is_array($this->plugin->settings->get("times")) ? $this->plugin->settings->get("times") : [];
        if(in_array($this->seconds, $times)){
                $message = $this->plugin->settings->get("time-left-message");
                $message = str_replace("{SECONDS}", $this->seconds, $message);
                $this->plugin->getServer()->broadcastMessage($message);
        }
        if($this->seconds == 0){
            if($this->plugin->settings->get("items")) $this->plugin->clearItems();
            if($this->plugin->settings->get("mobs")) $this->plugin->clearMobs();
            $this->plugin->getScheduler()->scheduleRepeatingTask(new TimerTask($this->plugin, (int) $this->plugin->settings->get("seconds")), 20);
            $this->plugin->getScheduler()->cancelTask($this->getTaskId());
        }
        $this->seconds--;
    }
}