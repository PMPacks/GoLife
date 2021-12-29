<?php

namespace Wings;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use Wings\Tasks\{DevilWing, AngleWing};
use pocketmine\Player;
use jojoe77777\FormAPI;
use pocketmine\utils\Config;

class Main extends PluginBase{

	public $taskwingdevil;
	public $taskwingthienthan;
	public $wingdevil = [];
	public $wingthienthan = [];

	/** @var Config */
	public $config;
	public $checker;

	public function onEnable () : void{
		$this->taskwingdevil = new DevilWing($this);
		$this->taskwingthienthan = new AngleWing($this);
		$this->saveResource("time.yml");
		$config = new Config($this->getDataFolder() . "time.yml", Config::YAML);
		$this->checker = $config->get("time-update");
		$this->getServer()->getLogger()->info("§b         
| |  | (_)            
| |  | |_ _ __   __ _ 
| |/\| | | '_ \ / _` |
\  /\  / | | | | (_| |
 \/  \/|_|_| |_|\__, |
                 __/ |
                |___/ 
§aMake by MrDinDuck and RushToEasy[Wing modules]");
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		if ($cmd == "wing"){
			if(!$sender instanceof Player){
				$sender->sendMessage("§l§9Wings§e>§r§c Ingame only!");
				return true;
			}
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createSimpleForm(function (Player $player, ?int $data){
				if(!is_null($data)) {
					switch($data) {
						case 0:
							if(!$player->hasPermission("devil.wing")){
								$player->sendMessage("§c• Bạn không có quyền làm điều này");
								return true;
							}
							$name = $player->getName();
								if(in_array($name, $this->wingthienthan)) {
									unset($this->wingthienthan[array_search($name, $this->wingthienthan)]);
									$player->sendMessage("§c•§a Cánh đã được bật");
									$this->wingdevil[] = $name;
								}
									if(!in_array($name, $this->wingdevil)){
										$this->wingdevil[] = $name;
										$player->sendMessage("§c•§a Cánh đã được bật");
									}
									break;
						case 1:
							if(!$player->hasPermission("thienthan.wing")){
								$player->sendMessage("§c• Bạn không có quyền làm điều này");
								return true;
							}
							$name = $player->getName();
								if(in_array($name, $this->wingdevil)) {
									unset($this->wingdevil[array_search($name, $this->wingdevil)]);
									$player->sendMessage("§c•§e Cánh đã được bật");
									$this->wingthienthan[] = $name;
								}
									if(!in_array($name, $this->wingthienthan)){
										$this->wingthienthan[] = $name;
										$player->sendMessage("§c•§a Cánh đã được bật");
									}
									break;
						case 2:
						$name = $player->getName();
							if(in_array($name, $this->wingdevil)){
								unset($this->wingdevil[array_search($name, $this->wingdevil)]);
								$player->sendMessage("§d•§c Cánh đã được tắt");
								}elseif(in_array($name, $this->wingthienthan)){
								unset($this->wingthienthan[array_search($name, $this->wingthienthan)]);
								$player->sendMessage("§d•§c Cánh đã được tắt");
								}
								break;
								case 3:
								
								break;
								}
					}
				});
			$form->setTitle("§b§l❄§9Wings Menu§b❄");
			$form->setContent("•§c Cách wing của§d Server");
			$form->addButton("• §4Devil");
			$form->addButton("• §bAngle");
			$form->addButton("• §cTắt cánh");
			$form->addButton("• §cThoát");
            $form->sendToPlayer($sender);
		}
		return true;
	}
}
