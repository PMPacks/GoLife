<?php

namespace MuaFly\NightBlackDM;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use jojoe77777\FormAPI;
class MuaFly extends PluginBase implements Listener{

public function onLoad(){
$this->getLogger()->info("BuyFLY By KaYuu081");
}

public function onEnable(){
$this->getLogger()->info("§a Bật Plugin !");
$this->api = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
$this->getServer()->getPluginManager()->registerEvents($this, $this);
}

public function onDisable(){
$this->getLogger()->info("§4 Disabling Plugin");
}

public function onCommand(CommandSender $s, Command $cmd, string $label, array $args):bool {
	if(!($s instanceof Player)){
                $s->sendMessage("Console không khả thi với lệnh!");
                return true;
        }
switch($cmd->getName()){
  case "muafly":
         $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $this->FlyUI($sender);
                        break;
					case 1:
                   	$this->RemoveFlyUI($sender);
                        break;					
					case 2:
					$sender->sendMessage("§cĐã huỷ bỏ giao dịch!");
                        break;					
			}
		});
		$form->setTitle("§l§aSky§bBlock");
        $form->setContent("§e§l→§4BUY FLY HERE - 5000$");
        $form->addButton("§aMUA FLY", 0);
		$form->addButton("§4XOÁ FLY", 1);
		$form->addButton("§eThoát", 2);
		$form->sendToPlayer($s);

    }
        return true;
}
public function FlyUI($sender){
	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $s, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
					$name = $s->getName();
$mymoney = $this->api->myMoney($s);
if($mymoney < 5000) {
  $s->sendMessage("§l§b❖§c FLY OFF (DENY)§b ❖");
  }else{
  $s->sendMessage("§l§b❖§a FLY ON (SUCCESS) §b❖");
  $s->setAllowFlight(TRUE);
  $this->api->reduceMoney($name, 5000);
  }
                        break;
					
					case 2:
					$s->sendMessage("§cĐã huỷ tác vụ!");
					    break;
			}
		});
		$form->setTitle("• §eBuy §bFly");
        $form->setContent("§b Bạn có xác nhận mua Fly hay không? §bNếu có nhấn §eXác nhận §bNếu không nhấn §cHuỷ bỏ");
        $form->setButton1("• §eXác Nhận", 1);
        $form->setButton2("• §cHủy Bỏ", 2);
        $form->sendToPlayer($sender);
    }
	public function RemoveFlyUI($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $s, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
					$name = $s->getName();
					$s->setAllowFlight(FALSE);
					$s->sendMessage("§l§b❖§c FLY OFF (SUCCESS)§b ❖");
					    break;
					case 2:
					$s->sendMessage("§cĐã huỷ tác vụ!");
					    break;
			}
		});
		$form->setTitle("• §cRemove §bFly");
        $form->setContent("§b Bạn có xác nhận Xoá Fly hay không? §bNếu có nhấn §eXác nhận §bNếu không nhấn §cHuỷ bỏ");
        $form->setButton1("• §eXác Nhận", 1);
        $form->setButton2("• §cHủy Bỏ", 2);
        $form->sendToPlayer($sender);
	}
					
}