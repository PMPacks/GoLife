<?php

namespace Vip;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\{Server, Player};
use pocketmine\event\Listener;
use jojoe77777\FormAPI;
use pocketmine\utils\TexFormat as TF; 
class Main extends PluginBase implements Listener {
    //public $p = "§e[§aVIP§e]§r ";
    public function onEnable(){
        $this->getLogger()->info("§bPlugin MUAVIP-Enable");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->coin =  $this->getServer()->getPluginManager()->getPlugin('Coins');
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§4Please install FormAPI Plugin, disabling plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
        
        
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "buyvip":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§7This command can't be used here. Sorry!");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                   case 0:
                   $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });
   $form->setTitle("§a-=-§b VIP §a-=-");
   $form->addLabel("§l§bVIP I §6| §c10 Coin§6 |§b 7 Ngày");
   $form->addLabel("§l§bVIP II §6| §c25 Coin§6 |§b 20 Ngày");
   $form->addLabel("§l§bVIP III §6| §c50 Coin§6 |§b 35 Ngày");
   $form->addLabel("§l§bVIP IV §6| §c80 Coin§6 |§b 70 Ngày");
   $form->addLabel("§l§bVIP V §6| §c200 Coin§6 |§b 150 Ngày");
   $form->sendToPlayer($sender);
   break;
         case 1:
                    if($this->coin->getMoney($sender->getName()) > 10){
										//	 $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "addvip remove ".$sender->getName());
             
                   $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "timegroup add ".$sender->getName()." VIP1 7");
                    $sender->sendMessage("§e[§aVIP§e]§r §aMua thành công §eVIP I");
                    $this->getServer()->broadcastMessage("§aĐại gia§e ".$sender->getName(). "§a vừa mua xong §bVIP I");
                    $this->coin->grantMoney($sender->getName(), -10, true);
                    }else{
                   $sender->sendMessage("§cKhông đủ Coin");                       }
         break;
                    case 2:
                    
									          if($this->coin->getMoney($sender->getName()) > 25){
												//  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "addvip remove ".$sender->getName());
   
                   $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "timegroup add ".$sender->getName()." VIP2 20");
                    $sender->sendMessage("§e[§aVIP§e]§r §aMua thành công §eVIP II");
                    $this->getServer()->broadcastMessage("§aĐại gia§e ".$sender->getName(). "§a vừa mua xong §bVIP II");
                    $this->coin->grantMoney($sender->getName(), -25, true);
                    }else{
                   $sender->sendMessage("§cKhông đủ Coin");                       }
         break;
		
                   case 3:
                     if($this->coin->getMoney($sender->getName()) > 50){
					//	 					 $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "addvip remove ".$sender->getName());
             
                   $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "timegroup add ".$sender->getName()." VIP3 35");
                    $sender->sendMessage("§e[§aVIP§e]§r §aMua thành công §eVIP III");
                    $this->getServer()->broadcastMessage("§aĐại gia§e ".$sender->getName(). "§a vừa mua xong §bVIP III");
                    $this->coin->grantMoney($sender->getName(), -50, true);
                    }else{
                   $sender->sendMessage("§cKhông đủ Coin");          }
                   break;
                   case 4:
                   
				   					  if($this->coin->getMoney($sender->getName()) > 80){
									//	  $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "addvip remove ".$sender->getName());
           
                   $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "timegroup add ".$sender->getName()." VIP4 70");
                    $sender->sendMessage("§e[§aVIP§e]§r §aMua thành công §eVIP IV");
                    $this->getServer()->broadcastMessage("§aĐại gia§e ".$sender->getName(). "§a vừa mua xong §bVIP IV");
                    $this->coin->grantMoney($sender->getName(), -70, true);
                    }else{
                   $sender->sendMessage("§cKhông đủ Coin");          }
                   break;
                    case 5:
                    if($this->coin->getMoney($sender->getName()) > 200){
					// 
                   $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "timegroup add ".$sender->getName()." VIP5 150");
                    $sender->sendMessage("§e[§aVIP§e]§r §aMua thành công §eVIP V");
                    $this->getServer()->broadcastMessage("§aĐại gia§e ".$sender->getName(). "§a vừa mua xong §bVIP V");
                    $this->coin->grantMoney($sender->getName(), -200, true);
                    }else{
                   $sender->sendMessage("§cKhông đủ Coin");          }
                   break;
				         }
                    });
                     $form->setTitle("§e-=- §aＢＵＹ ＶＩＰ§e -=-");
				 $form->setContent("§cLưu Ý: Nếu ngày Vip bạn vẫn còn,\nKhi Bạn mua vip mới, ngày Vip củ sẽ bị xóa");
				 
                     $form->addButton("§6ＰＲＩＣＥ", 0);
                     $form->addButton("§bＶＩＰ Ｉ", 1);
                     $form->addButton("§bＶＩＰ ＩＩ", 2);
                     
                     $form->addButton("§bＶＩＰ ＩＩＩ", 3);
                     
                     $form->addButton("§bＶＩＰ ＩＶ", 4);
                      $form->addButton("§bＶＩＰ Ｖ", 5);
					  
					 // $form->addButton("REMOVE VIP", 6);
                    $form->sendToPlayer($sender);
        
        
   

     }
        return true;
    }

    public function onDisable(){
        $this->getLogger()->info("MuaVip - Disabled!");
    }
}
