<?php

namespace TheNewHEROBRINE\AllAPILoader\Loaders;

use FolderPluginLoader\FolderPluginLoader;
use pocketmine\plugin\{
	Plugin, PluginDescription
};
use pocketmine\Server;

class AllFolderPluginLoader extends FolderPluginLoader{
	/**
	 * Gets the PluginDescription from the file
	 *
	 * @param string $file
	 *
	 * @return null|PluginDescription
	 */
	public function getPluginDescription(string $file) : ?PluginDescription{
		if(is_dir($file) and file_exists($file . "/plugin.yml")){
			$yaml = @file_get_contents($file . "/plugin.yml");
			if($yaml != ""){
				$server = Server::getInstance();
				$description = new PluginDescription($yaml);
				if($server->getPluginManager()->getPlugin($description->getName()) instanceof Plugin){
					//Not load when a plugin with the same name is already loaded
					return null;
				}elseif(!in_array($server->getApiVersion(), $description->getCompatibleApis())){
					try{
						$api = (new \ReflectionClass(PluginDescription::class))->getProperty("api");
						$api->setAccessible(true);
						$api->setValue($description, [$server->getApiVersion()]);
						return $description;
					}catch(\ReflectionException $e){
					}
				}
				return $description;
			}
		}

		return null;
	}

}