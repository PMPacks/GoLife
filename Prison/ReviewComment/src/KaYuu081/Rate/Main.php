<?php


namespace KaYuu081\Rate;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use jojoe7777\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as CP;

class Main extends PluginBase{
	public $tag = "";
	public $config;
	
	public function onEnable(){
		$this->getServer()->getLogger()->info($this->tag . " §l§aRateBE by KaYuu081");
		
		$this->ratefile = new Config($this->getDataFolder(). "Rating.yml", Config::YAML);
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->getResource("config.yml");
	}
	
	public function onLoad(): void{
		$this->getServer()->getLogger()->notice("Loading.....");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		if(!($sender instanceof Player)){
				$this->getLogger()->notice("Please Dont Use that command in here.");
				return false;
			}
		switch($cmd->getName()){
			case "rate":
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $s, $data){
			switch($data[0]){
				case 0:
				$rate = "5 Sao";

				break;
				case 1:
				$rate = "4 Sao";
	
				break;
				case 2:
				$rate = "3 Sao";
				
				break;
				case 3:
				$rate = "2 Sao";
				
				break;
				case 4:
				$rate = "1 Sao";
				
				break;
			}
			
			$this->getServer()->getLogger()->notice("Có bạn  ".$s->getName().", RATE Rating.yml");
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
				$form = $api->createCustomForm(Function (Player $player, $data){
				});
				
			$form->setTitle($this->getConfig()->get("success.text"));
			$form->addLabel($this->tag . "Cảm ơn bạn " . $s->getName() ." Đã Rate " . $rate . " Cho Server");
			$form->addLabel($this->tag . "Các OP sẽ khắc phục và vấn đề bạn đưa ra sớm nhất có thể \n Chúc bạn chơi game vui vẻ");
			$form->sendToPlayer($s);
			
			$this->ratefile->set( $s->getName(), ["Rating" => $rate, "Nhận xét" => $data[1]]);
			$this->ratefile->save();
		});
		$form->setTitle($this->getConfig()->get("rating.text"));
		$form->addDropdown("→ §eRate", ["5 Sao / Very Good", "4 Sao / Good", "3 Sao / Normal", "2 Sao / Bad", "1 Sao / Badly"]);
		$form->addInput("→ §eNhận xét:");
		$form->sendToPlayer($sender);
		return true;
	}
	switch($cmd->getName()){
			case "adrate":
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $s, $data){
		});
		$form->setTitle("§f• §aRating List ");
		$form->addLabel("§fList #1:");
		$form->addLabel("• §6Tên:§c ". $sender->getName());
		$form->addLabel("• §eĐánh giá: §c". $rate);
		$form->addLabel("• §eGóp ý: §c". $data[0]);
		$form->sendToPlayer($sender);
	}
	return true;
}
}
	
		
	
			
			