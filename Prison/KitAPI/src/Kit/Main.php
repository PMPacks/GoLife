<?php

namespace Kit;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use doramine\economyapi\EconomyAPI;
use Kit\libs\SimpleForm;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\inventory\Inventory;

class Main extends PluginBase implements Listener {
	
	public $plugin;
	public $mss = "Error";

	public function onEnable(){
		$this->getLogger()->info("Enable");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");	
	}
	
	public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
		///
		if(!($sender instanceof Player)){
				$this->getServer()->getLogger()->info("§l§c CONSOLE Không khả thi với lệnh!");//Nếu ko có cái lệnh này thì nếu ông xài trên console hoặc bấm lộn! thif sẽ bị die sv đấy
				return true;
				}
				///
        switch($command->getName()){
            case "kit":
            $this->formopen($sender);
            return true;
        }
        return true;
	}
	
	 public function formopen($sender){
		$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
        $form = new SimpleForm(function(Player $sender, $data){
          $result = $data;
          if($result === null){
          }
          switch($result){
              case 0:
			  //EXIT KHỎI THÊM
              break;
              case 1:
			  $name = $sender->getName();
					 $point = EconomyAPI::getInstance();
                     $mymoney = $point->myMoney($sender);
					if($mymoney < 500) {
						$sender->sendMessage($this->mss);
						}else{
              $sender->getInventory()->setItem(1, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(2, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(3, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(1, Item::get(258, 0, 1));
              $sender->getInventory()->setItem(2, Item::get(307, 0, 1));
              $point->reduceMoney($sender, 500);
			  $sender->sendMessage("Select kits: Tank");//Sai sửa :)) ok
						}
              break;
              case 2:
			  $name = $sender->getName();
					 $point = EconomyAPI::getInstance();
                     $mymoney = $point->myMoney($sender);
					if($mymoney < 200) {
						$sender->sendMessage($this->mss);
						}else{
              $sender->getInventory()->setItem(1, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(2, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(3, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(1, Item::get(368, 0, 1));
              $sender->getInventory()->setItem(2, Item::get(268, 0, 1));
              $point->reduceMoney($sender, 200);
			  $sender->sendMessage("Select kits: Tank");//tự sửa nha hơi đúi
						}
              break;
              case 3:
			  $name = $sender->getName();
					 $point = EconomyAPI::getInstance();
                     $mymoney = $point->myMoney($sender);
					if($mymoney < 300) {
						$sender->sendMessage($this->mss);
						}else{
              $sender->getInventory()->setItem(1, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(2, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(3, Item::get(0, 0, 1));
              $sender->getInventory()->setItem(1, Item::get(438, 8, 1));
              $sender->getInventory()->setItem(2, Item::get(438, 9, 1));
              $sender->getInventory()->setItem(3, Item::get(438, 36, 1));
              $point->reduceMoney($sender, 300);
			  $sender->sendMessage("");//chỗ này để thông báo kit đã chọn
						}
              break;
          }
        });
        //$config = $this->getConfig(); cái này nâng cao hơn bỏ đi xài riêng cho mik mà
        $name = $sender->getName();
        $form->setTitle("§l§eSKYWARS");
        $form->setContent("§fYour coins: §6". $money);
		$form->addButton("§c§lEXIT");
		$form->addButton("§l§7TANK\n§r§6500 coins");
		$form->addButton("§7§lENDER\n§r§6200 coins");
		$form->addButton("§7§lWITCH\n§r§6300 coins");
        $form->sendToPlayer($sender);
    }

    public function onDisable(){
        $this->getLogger()->info("");
    }
}