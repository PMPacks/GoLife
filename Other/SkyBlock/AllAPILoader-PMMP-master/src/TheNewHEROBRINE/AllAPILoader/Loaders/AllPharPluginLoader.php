<?php

namespace TheNewHEROBRINE\AllAPILoader\Loaders;

use pocketmine\plugin\{
	PharPluginLoader, Plugin, PluginDescription
};
use pocketmine\Server;

class AllPharPluginLoader extends PharPluginLoader{
	/**
	 * Gets the PluginDescription from the file
	 *
	 * @param string $file
	 *
	 * @return null|PluginDescription
	 */
	public function getPluginDescription(string $file) : ?PluginDescription{
		$phar = new \Phar($file);
		if(isset($phar["plugin.yml"])){
			$pluginYml = $phar["plugin.yml"];
			if($pluginYml instanceof \PharFileInfo){
				$server = Server::getInstance();
				$description = new PluginDescription($pluginYml->getContent());
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