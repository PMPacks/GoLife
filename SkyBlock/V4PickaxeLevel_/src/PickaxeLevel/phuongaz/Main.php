<?php

namespace PickaxeLevel\phuongaz;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerDropItemEvent, PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\utils\Config;
use pocketmine\entity\Effect;
use pocketmine\network\protocol\SetTitlePacket;
use pocketmine\item\enchantment\{Enchantment, EnchantmentInstance};
use PickaxeLevel\phuongaz\PopupTask;
use DaPigGuy\PiggyCustomEnchants\Main as CE;

class Main extends PluginBase implements Listener{


	public function onEnable(){


		$this->lv = new Config($this->getDataFolder() . "user.yml", Config::YAML);
		$this->level = new Config($this->getDataFolder() . "level.yml", Config::YAML);
		$this->saveDefaultConfig();
		$this->config = $this->getConfig();
		$this->config->save();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info("\n\n§c§l❤§b P༶I༶C༶K༶A༶X༶E༶ L༶E༶V༶E༶L༶ §6Version§e 2\n§c❤§b By Phuongaz and Shin1134\n\n");
		$this->eco =  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->point =  $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		$this->CE =  $this->getServer()->getPluginManager()->getPlugin("PiggyCustomEnchants");
        if(is_null($this->point)){
            $this->getLogger()->warning("Please download [PointAPI]: github.com/ZzKino/PointAPI"   );
        }else{
            $this->getLogger()->notice("Loading PickaxeLEVEL by Phuongaz");
        }
       // $this->point =  $this->getServer()->getPluginManager()->getPlugin("PiggyCustomEnchantments");
	}
	public function getNamePickaxe($player){
		if($player instanceof Player){
			$p = $player->getName();
		}
		$this->lv->load($this->getDataFolder() . "user.yml", Config::YAML);
			$pa = "§l§c|§b ANGLE §aPICKAXE§c  ❤ §6".$p;
		return $pa;
	}

	public function onJoin(PlayerJoinEvent $ev){
		$p = $ev->getPlayer()->getName();
		if(!($this->lv->exists(strtolower($p)))){
			$this->getLogger()->notice(" Không tìm thấy dữ liệu $p ");
			$this->getLogger()->notice(" Tạo dữ liệu $p ");
			$this->lv->set(strtolower($p), ["Level" => 1, "exp" => 0, "nextexp" => 100]);
			$this->lv->save();
			$this->level->set(strtolower($p), 1);
	      	$this->level->save();
			$p1 = $ev->getPlayer();
			$player = $ev->getPlayer();
			$inv = $player->getInventory();  
			$item = Item::get(278, 0, 1);
			$item->setCustomName($this->getNamePickaxe($player));
			//$item->setLore($this->getLore());
			$inv->addItem($item);
			$player->sendMessage("§f[§c+§f]§e Cúp đã được thêm vào túi đồ của bạn , bạn có thể mua lại nó bằng lệnh §6/muacup");
			return true;
		}
	}




    public function onItemHeld(PlayerItemHeldEvent $ev){


        $task = new PopupTask($this, $ev->getPlayer());
        $this->tasks[$ev->getPlayer()->getId()] = $task;
        $this->getScheduler()->scheduleRepeatingTask($task, 1);

        $p = $ev->getPlayer();
        $contents = $p->getInventory()->getContents();
        $i = $p->getInventory()->getItemInHand();
       /* if ($damage > 30) {
            $i->setDamage(0);
            $player->sendMessage("§l§6⚒§e Cúp đã được sửa chữa miễn phí ");
        }*/
        if(isset($this->need[$p->getName()])){
			$icn = $i->getCustomName();
			$i->setCustomName(str_replace("❤§6 ".($this->lv->get(strtolower($p->getName()))["Level"] - 1), "❤§6 ".$this->lv->get(strtolower($p->getName()))["Level"], $icn));
            if($this->getLevel($p) == 10){
                $i = Item::get(278,0,1);
                $i->setCustomName(str_replace("❤§6 ".($this->lv->get(strtolower($p->getName()))["Level"] - 1), "❤§6 ".$this->lv->get(strtolower($p->getName()))["Level"], $icn));
                $p->sendMessage("§f[§c+§f]§e Cúp của bạn đã được nâng cấp");
            //    $item->setLore($this->getLore());
			}
			
            if(in_array($this->getLevel($p), array(10, 20))){

            }
            if(in_array($this->getLevel($p), array(2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 64, 66, 68, 70, 72, 74, 76, 78, 80, 82, 84, 86, 88, 90, 92, 94, 96, 98, 100, 102, 104, 106, 108, 108, 110, 112, 114, 116, 118, 120, 122, 124, 126, 128, 130, 132, 134, 136, 138, 140, 142, 144, 146, 148, 150, 152, 154, 156, 158, 160, 162, 164, 166, 168, 170, 172, 174, 176, 178, 180, 182, 184, 186, 188, 190, 192, 194, 196, 198, 200, 202, 204, 206, 208, 208, 210, 212, 214, 216, 218, 220, 222, 224, 226, 228, 230, 232, 234, 236, 238, 240, 242, 244, 246, 248, 250, 252, 254, 256, 258, 260, 262, 264, 266, 268, 270, 272, 274, 276, 278, 280, 282, 284, 286, 288, 290, 292, 294, 296, 298, 300, 302, 304, 306, 308, 308, 310, 312, 314, 316, 318, 320, 322, 324, 326, 328, 330, 332, 334, 336, 338, 340, 342, 344, 346, 348, 350, 352, 354, 356, 358, 360, 362, 364, 366, 368, 370, 372, 374, 376, 378, 380, 382, 384, 386, 388, 390, 392, 394, 396, 398, 400, 402, 404, 406, 408, 408, 410, 412, 414, 416, 418, 420, 422, 424, 426, 428, 430, 432, 434, 436, 438, 440, 442, 444, 446, 448, 450, 452, 454, 456, 458, 460, 462, 464, 466, 468, 470, 472, 474, 476, 478, 480, 482, 484, 486, 488, 490, 492, 494, 496, 498, 500))){
                $id = 15;
                $lv = $this->getLevel($p)/2.5;
                $i->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment($id), $lv));
                $p->sendMessage("§f[§c+§f]§e Cúp đã được cường hóa: §cHiệu xuất§e Cấp độ §c".$lv);
            }elseif(in_array($this->getLevel($p), array(51, 53, 55, 57, 59, 61, 63, 65, 67, 69, 71, 73, 75, 77, 79, 81, 83, 85, 87, 89, 91, 93, 95, 97, 99, 101, 103, 105, 107, 109, 111, 113, 115, 117, 119, 121, 123, 125, 127, 129, 131, 133, 135, 137, 139, 141, 143, 145, 147, 149, 151, 153, 155, 157, 159, 161, 163, 165, 167, 169, 171, 173, 175, 179, 181, 183, 185, 187, 189, 191, 193, 195, 197, 199, 201, 203, 205, 207, 209, 211, 213, 215, 217, 219, 221, 223, 225, 227, 229, 231, 233, 235, 237, 239, 241, 243, 245, 247, 249, 251, 253, 255, 257, 259, 261, 263, 265, 267, 269, 271, 273, 275, 279, 281, 283, 285, 287, 289, 291, 293, 295, 297, 299, 301, 303, 305, 307, 309, 311, 313, 315, 317, 319, 321, 323, 325, 327, 329, 331, 333, 335, 337, 339, 341, 343, 345, 347, 349, 351, 353, 355, 357, 359, 361, 363, 365, 367, 369, 371, 373, 375, 379, 381, 383, 385, 387, 389, 391, 393, 395, 397, 399, 401, 403, 405, 407, 409, 411, 413, 415, 417, 419, 421, 423, 425, 427, 429, 431, 433, 435, 437, 439, 441, 443, 445, 447, 449, 451, 453, 455, 457, 459, 461, 463, 465, 467, 469, 471, 473, 475, 479, 481, 483, 485, 487, 489, 491, 493, 495, 497, 499))){
                    $id = 18;
                    $lv = $this->getLevel($p)/3;
                    $i->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment($id), $lv));
                    $p->sendMessage("§f[§c+§f]§e Cúp đã được cường hóa: §cGia tài§e Cấp độ §c".$lv);
                }
            $p->getInventory()->setItemInHand($i);
			switch($this->getLevel($p)){
				case 50:
					$this->addCE(new ConsoleCommandSender(), "Energizing", 1, $p->getName());
				break;
				case 100:
					$this->addCE(new ConsoleCommandSender(), "Jackpot", 1, $p->getName());
				break;
				case 150:
					$this->addCE(new ConsoleCommandSender(), "Energizing", 2, $p->getName());
				break;
                case 200:
					$this->addCE(new ConsoleCommandSender(), "Jackpot", 2, $p->getName());
				break;	
                case 250:
					$this->addCE(new ConsoleCommandSender(), "Haste", 1, $p->getName());
				break;	
                case 300:
					$this->addCE(new ConsoleCommandSender(), "Jackpot", 3, $p->getName());
				break;
                case 350:
					$this->addCE(new ConsoleCommandSender(), "Haste", 2, $p->getName());
				break;	
                case 400:
					$this->addCE(new ConsoleCommandSender(), "Jackpot", 4, $p->getName());
				break;		
                case 450:
					$this->addCE(new ConsoleCommandSender(), "Haste", 3, $p->getName());
				break;
                case 500:
					$this->addCE(new ConsoleCommandSender(), "Jackpot", 5, $p->getName());
				break;				
			}			
            unset($this->need[$p->getName()]);
        }

    }
	public function onBreak(BlockBreakEvent $ev){
		$p = $ev->getPlayer();
		$name = $p->getName();
		$i = $p->getInventory()->getItemInHand();
		$icn = $i->getCustomName();
		$pas = explode(" ", $icn);
		if($pas[0] == "§l§c|§b"){
			if(strpos($icn, $name)  == false){
				$ev->setCancelled(true);
				$p->sendMessage("§f[§c+§f]§c Vật Phẩm Không Phải Của Bạn");
			}
		}


		if(!$ev->isCancelled()){
		    if($pas[0] == "§l§c|§b"){
   //   if((int)$pas[4] == $this->getLevel($p)){
	  
				$block = $ev->getBlock();
				$name = strtolower($p->getName());
				$n = $this->lv->get($name);
				
				//  if(in_array($block->getId(), array(16, 56, 129, 14, 15, 21))){
               switch($block->getId()) {
                   case 56:
                       $this->addExp($p, 4);
                       break;
                   case 14:
                       $this->addExp($p, 3);
                       break;
                   case 15:
                       $this->addExp($p, 4);
                       break;
                   case 16:
                       $this->addExp($p, 2);
                       break;
                   case 129:
                       $this->addExp($p, 6);
                       break;
                   case 133:
                       $this->addExp($p, 8);
                       break;
                   case 57:
                           $this->addExp($p, 7);
                   case 42:
                       $this->addExp($p, 6);
                   case 41:
                       $this->addExp($p, 6);
                       break;
                   default:
                       $this->addExp($p, 2);
                       break;

                }
			//	$this->addExp($p ,rand(1,3));
				//$p->sendPopup($this->getNamePickaxe($p)."\n"."§l§a⚒§e ".$n["exp"]."§c/§e ".$n["nextexp"]."§a ⚒");
				if($this->getExp($p) >= $this->getNextExp($p)){
					$this->setLevel($p, $this->getLevel($p) +1);
					$p->addTitle("§c•§aPickaxe Level: §e".$this->getLevel($p));
					$money = $this->getLevel($p) * 1000;
					if(in_array($this->getLevel($p), array(100,200,300,400,500 ))){
					    $point = $this->getLevel($p)/2;
                        $this->point->addMoney($p->getName(), $point);
                    }
					$this->eco->addMoney($p->getName(), $money);
					$p->sendMessage("§f[§c+§f]§e Bạn được cộngc $money §exu");
				//	$p->sendMessage("§l§c•§6 Cúp Của Bạn Đã Được Nâng Cấp");
                    $this->getServer()->broadcastMessage("§f[§c+§f]§e Cúp của người chơi§c ".$p->getName()."§e Vừa lên cấp§c : ".$this->getLevel($p));
					$this->need[$p->getName()] = true;
				}
		//	}
	  }
		}
	}
	 /*   public function onChat(PlayerChatEvent $ev){
	$p = $ev->getPlayer();
	$name = $p->getName();
	$p->setDisplayName("§c(§b".$this->getLevel($p)."§c)§r ".$p->getName());
	}*/
     public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
		 if(!($sender instanceof Player)){
				$this->getServer()->getLogger()->info("§l§c CONSOLE Không khả thi với lệnh!");
				return true;
				}
         if($cmd->getName() == "muacup"){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $s, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:	
					 $name = $s->getName();
					 $economy = EconomyAPI::getInstance();
                     $mymoney = $economy->myMoney($s);
					if($mymoney < 10000) {
						$s->sendMessage("§l⚒§b§cKhông chấp nhận giao dịch này !§b");
						}else{
                    if(!$s == null){
                        if($s->isOnline()) {
                            $inv = $s->getInventory();
                            if ($this->getLevel($s)){
                                $cup = Item::get(278, 0, 1);
                        }
                            $pickname = $this->getNamePickaxe($s);
                            $cup->setCustomName($pickname);
                            $inv->addItem($cup);
							$economy->reduceMoney($s, 10000);
                            $s->sendMessage("§f[§c+§f]§e Bạn đã mua §6FarmerPickaxe §evới giá §b10000$");
                        }
                    }
                }
				break;
				case 2:
				$s->sendPopup("Đã đóng");
				break;
				}
			});	
        $form->setTitle("• §eBuy §eAngle§6Pickaxe");
        $form->setContent("§b Bạn có xác nhận mua §6FarmerPickaxe với giá §e10000$ ?");
        $form->setButton1("• §eXác Nhận", 1);
        $form->setButton2("• §cHủy Bỏ", 2);
        $form->sendToPlayer($sender);		
         }elseif($cmd->getName() == "topfarmer"){
			/* $topcup = $this->level->getAll();
			 $topcupm	 = "    §e§c❤§e Xếp hạng Cúp §c❤     ";
			 $unit = "§l§a Cấp";
			 if(count($topcup) > 0){
			arsort($topcup);
			$i = 1;
			foreach($topcup as $name => $money){
				$message = " §bHạng §e".$i."§b thuộc về §c".$name."§b Với §e".$money." §a$unit\n";
                $message = " §bHạng §e".$i."§b thuộc về §c".$name."§b Với §e".$money." §a$unit\n";
				if($i >= 5){
					break;
					}
					++$i;
				}
			}else{
				$sender->sendMessage("§b§l•§6 Data level not found");
				return true;
			}
			$sender->sendMessage($topcupm);
			$sender->sendMessage($message);
		
		 */
		 $max = 0;
				 $c = $this->level->getAll();			
            $max = count($c);
				$max = ceil(($max / 5));
				$page = array_shift($args);
				$page = max(1, $page);
				$page = min($max, $page);
				$page = (int)$page;
			
				$aa = $this->level->getAll();
				arsort($aa);
				$i = 0;
			
					$sender->sendMessage("• §l§c§6 Xếp Hạng Farmer §a •".$page."§f/§a".$max."§c ⚒");

				
				foreach($aa as $b=>$a){
				if(($page - 1) * 5 <= $i && $i <= ($page - 1) * 5 + 4){
				$i1 = $i + 1;
				
				$message = " §l§bHạng §e".$i1."§b thuộc về §c".$b."§b Với §e".$a." §aCấp\n";
				if(!$sender instanceof Player){
					 	$sender->sendMessage($message);
	
				}else{
				//$sender->sendMessage(" §l§6[§a".$i1."§6] §b".$b." §6» §d".$a);
				$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
				$form = $formapi->createCustomForm(function(Player $player, ?array $data){
				
				});
				$form->setTitle("§l§f☸§c TOP PICKAXE LEVEL §a".$page."§f/§a".$max." §f☸");
				
				$form->addLabel("§l§c⚒§6 Xếp Hạng Cấp Cúp §a".$page."§f/§a".$max."§c ⚒");
				
				$form->addLabel($message);
				
				$form->addInput("§b§lTrang");
				$form->sendToPlayer($sender);
			
				}
				$i++;
				
				}
		 }
		 
         return true;
     }
	 return true;
	 }

	public function getLevel($player){
		if($player instanceof Player){
		$name = $player->getName();
		}
		$level = $this->lv->get(strtolower($name))["Level"];
		return $level;
	}
	public function setLevel($player, $level){
		if($player instanceof Player){
			$name = $player->getName();
		}
      if($this->getLevel($player) >= 500){
          $nextexp = 0;
          $levelx = 500;
          $this->lv->set(strtolower($name), ["Level" => $levelx, "exp" => 0, "nextexp" => $nextexp]);
          $this->lv->save();
		  
          $player->sendMessage("§l§6♥§e Cúp bạn đã đạt cấp tối đa ");
      }else{
          $nextexp = ($this->getLevel($player)+1)*170;
          $this->lv->set(strtolower($name), ["Level" => $level, "exp" => 0, "nextexp" => $nextexp]);
          $this->lv->save();
		  /*
		  */
		//  $this->level->getAll("Level")[strtolower($name)] = $level;
		$this->level->set(strtolower($name), $level);
		$this->level->save();
		 
		  /*
		  */
      }

	}

	public function setNextExp($player, $exp){
		if($player instanceof Player){
			$player = $player->getName();
		}

		$player = strtolower($player);
		$lv = $this->lv->get($player)["nextexp"] + $exp;
		$this->lv->set($player, ["Level" => $this->lv->get($player)["Level"], "exp" => $this->lv->get($player)["exp"], "nextexp" => $lv]);
		$this->lv->save();
	}

	public function getExp($player){
		if($player instanceof Player){
			$player = $player->getName();
		}

		$player = strtolower($player);
		$e = $this->lv->get($player)["exp"];
		return $e;
	}

	public function getNextExp($player){
		if($player instanceof Player){
			$player = $player->getName();
		}

		$player = strtolower($player);
		$lv = $this->lv->get($player)["nextexp"];
		return $lv;
	}

	public function addExp($player, $exp){
		if($player instanceof Player){
			$player = $player->getName();
		}

		$player = strtolower($player);
		$e = $this->lv->get($player)["exp"];
		$lv = $this->lv->get($player)["Level"];
		$this->lv->set($player, ["Level" => $lv, "exp" => $e + $exp, "nextexp" => $this->getNextExp($player)]);
		$this->lv->save();

	}
    public function addCE(CommandSender $sender, $enchantment, $level, $target)
    {
        $plugin = $this->CE;
        if ($plugin instanceof CE) {
            if (!is_numeric($level)) {
                $level = 1;
                $sender->sendMessage(TextFormat::RED . "Level must be numerical. Setting level to 1.");
            }
            $target == null ? $target = $sender : $target = $this->getServer()->getPlayer($target);
            if (!$target instanceof Player) {
                if ($target instanceof ConsoleCommandSender) {
                    $sender->sendMessage(TextFormat::RED . "Please provide a player.");
                    return;
                }
                $sender->sendMessage(TextFormat::RED . "Invalid player.");
                return;
            }
            $target->getInventory()->setItemInHand($plugin->addEnchantment($target->getInventory()->getItemInHand(), $enchantment, $level, $sender->hasPermission("piggycustomenchants.overridecheck") ? false : true, $sender));
        }
    }



}