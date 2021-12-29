<?php
namespace KaYuu081\MineRS;
use pocketmine\scheduler\Task;
use KaYuu081\MineRS\Main as M;

class Updater extends Task {
	
	public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }
	
    public function onRun($tick) {
        $this->plugin->update();
    }
}
