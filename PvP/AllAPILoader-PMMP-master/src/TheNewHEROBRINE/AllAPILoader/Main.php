<?php

namespace TheNewHEROBRINE\AllAPILoader;

use FolderPluginLoader\FolderPluginLoader;
use pocketmine\plugin\{
	PluginBase, PluginLoadOrder
};
use TheNewHEROBRINE\AllAPILoader\Loaders\{
	AllFolderPluginLoader, AllPharPluginLoader, AllScriptPluginLoader
};

class Main extends PluginBase{

	public function onEnable(){
		$classLoader = $this->getServer()->getLoader();

		$this->getServer()->getPluginManager()->registerInterface(new AllPharPluginLoader($classLoader));

		$this->getServer()->getPluginManager()->registerInterface(new AllScriptPluginLoader());

		if(class_exists(FolderPluginLoader::class)){
			$this->getServer()->getPluginManager()->registerInterface(new AllFolderPluginLoader($classLoader));
		}

		$this->getServer()->getPluginManager()->loadPlugins($this->getServer()->getPluginPath(), [AllPharPluginLoader::class, AllScriptPluginLoader::class, AllFolderPluginLoader::class]);
		$this->getServer()->enablePlugins(PluginLoadOrder::STARTUP);
	}
}