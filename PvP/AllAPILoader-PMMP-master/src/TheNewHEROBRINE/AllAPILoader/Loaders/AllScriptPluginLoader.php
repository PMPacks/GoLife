<?php

namespace TheNewHEROBRINE\AllAPILoader\Loaders;

use pocketmine\plugin\{
	Plugin, PluginDescription, ScriptPluginLoader
};
use pocketmine\Server;

class AllScriptPluginLoader extends ScriptPluginLoader{
	/**
	 * Gets the PluginDescription from the file
	 *
	 * @param string $file
	 *
	 * @return null|PluginDescription
	 */
	public function getPluginDescription(string $file) : ?PluginDescription{
		$content = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

		$data = [];

		$insideHeader = false;
		foreach($content as $line){
			if(!$insideHeader and strpos($line, "/**") !== false){
				$insideHeader = true;
			}

			if(preg_match("/^[ \t]+\\*[ \t]+@([a-zA-Z]+)([ \t]+(.*))?$/", $line, $matches) > 0){
				$key = $matches[1];
				$content = trim($matches[3] ?? "");

				if($key === "notscript"){
					return null;
				}

				$data[$key] = $content;
			}

			if($insideHeader and strpos($line, "*/") !== false){
				break;
			}
		}
		if($insideHeader){
			$server = Server::getInstance();
			$description = new PluginDescription($data);
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

		return null;
	}
}