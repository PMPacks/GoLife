<?php

namespace KayDeepTry;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;


class Main extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§l§a Night§cMC§b> Tất cả các World đã được load!");
        foreach (array_diff(scandir($this->getServer()->getDataPath() . "worlds/"), [".", ".."]) as $file) {
            if ($this->getServer()->isLevelGenerated($file) && !$this->getServer()->isLevelLoaded($file)) {
                $this->getServer()->loadLevel($file);
            }
        }
    }
}