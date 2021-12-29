<?php

#  _____       _ _         _____ _          _ _____
# / ____|     | | |       |  __ (_)        | |  __ \
# | (___   __ _| | |_ _   _| |__) |__  _____| | |  | | _____   ______
# \___ \ / _` | | __| | | |  ___/ \ \/ / _ \ | |  | |/ _ \ \ / /_  /
#   ____) | (_| | | |_| |_| | |   | |>  <  __/ | |__| |  __/\ V / / /
#  |_____/ \__,_|_|\__|\__, |_|   |_/_/\_\___|_|_____/ \___| \_/ /___|
#                       __/ |
#                      |___/
## The First Ever Customizable ShopUI!
namespace AlexPads\ShopUI\SaltyPixelDevz;

use AlexPads\ShopUI\SaltyPixelDevz\libs\jojoe77777\FormAPI\CustomForm;
use AlexPads\ShopUI\SaltyPixelDevz\libs\jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Shop extends PluginBase
{

	public function onEnable(): void
	{
		$this->saveDefaultConfig();
		$this->saveResource("shop.yml");
	}

	public function onDisable()
	{
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
	{
		switch ("shop") {
			case "shop":
				if ($sender instanceof Player) {
					if ($sender->getGamemode() != 0 and $this->getConfig()->get("Survival") === true) {
						$sender->sendMessage($this->getConfig()->getNested("messages.Survival"));
						return true;
					} else {
						$this->catForm($sender);
						return true;
					}
				}
				$sender->sendMessage(TF::RED . "Please use this in-game.");
				break;
		}
		return true;

	}

	public function catForm(Player $player): void
	{
		$form = new SimpleForm(function (Player $player, int $data = null) {
			$cat = $data;
			$this->itemForm($player, $cat);
		});
		$form->setTitle($this->getConfig()->get("Title"));
		$allshop = yaml_parse_file($this->getDataFolder() . "shop.yml");
		foreach ($allshop as $name => $content) {
			$form->addButton(ucfirst($name));
		}
		$form->sendToPlayer($player);
	}

	public function itemForm(Player $player, $cat): void
	{
		$form = new SimpleForm(function (Player $player, int $data = null) use ($cat) {
			$result = $data;
			$this->buysellForm($player, $result, $cat);
		});
		$form->setTitle($this->getConfig()->get("Title"));
		$allshop = yaml_parse_file($this->getDataFolder() . "shop.yml");
		if ($cat === null) {
			$player->sendmessage($this->getConfig()->getNested("messages.thanks") . " " . $this->getConfig()->get("Title"));
		} else {
			foreach ($allshop as $categoryName => $access) {
				$category[] = $access;
			}
			foreach ($category[$cat] as $items) {
				$list = explode(":", $items);
				$form->addButton($list[3] .  " §f→ §6  " . "$" . $list[4], $list[6], $list[7]);
			}
			$form->sendToPlayer($player);
		}
	}

	public function buysellForm(Player $player, $result, $cat): void
	{
		$form = new SimpleForm(function (Player $player, int $data = null) use ($cat, $result) {
			$buydata = $data;
			if ($data === 0) {
				$this->amountForm($player, $cat, $result, $buydata);
			}
			if ($data === 1) {
				$this->amountForm($player, $cat, $result, $buydata);
			}
			if ($data === 2 or $data === null) {
				$this->catForm($player);
			}
		});
		$form->setTitle($this->getConfig()->get("Title"));
		$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player);
		$allshop = yaml_parse_file($this->getDataFolder() . "shop.yml");
		foreach ($allshop as $categoryName => $access) {
			$category[] = $access;
		}
		foreach ($category[$cat] as $items => $itemarray) {
			$itemlist[] = $itemarray;
		}
		if ($result === null) {
			$this->catForm($player);
		} else {
			$list = explode(":", $itemlist[$result]);
			$message = $this->getConfig()->getNested("messages.money");
			$form->setContent("$message $money$");
			$form->addButton("§eMua với " . " §6" . $list[4] . "§6$ " . "§e1 cái");
			$form->addButton("§cBán với" . "§6 " . $list[5] . "§6$ " . "§c1 cái");
			$form->addButton(TF::RED . TF::BOLD . "§6Trở Lại");
			$form->sendToPlayer($player);
		}
	}

	public function amountForm(Player $player, $cat, $result, $buydata): void
	{
		$form = new CustomForm(function (Player $player, $data) use ($cat, $result, $buydata) {
			$allshop = yaml_parse_file($this->getDataFolder() . "shop.yml");
			foreach ($allshop as $categoryName => $access) {
				$category[] = $access;
			}
			foreach ($category[$cat] as $items => $itemarray) {
				$itemlist[] = $itemarray;
			}
			$list = explode(":", $itemlist[$result]);
			$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player);
			if ($buydata === 0) {
				if ($data === null) {
					$this->ItemForm($player, $cat);
				} else {
					if ($money >= $list[4] * $data[1]) {
						$player->getInventory()->addItem(Item::get($list[0], $list[1], $data[1])->setCustomName($list[3]));
						$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($player, $list[4] * $data[1]);
						$message = $this->getConfig()->getNested("messages.paid-for");
						$vars = ["{amount}" => $list[2], "{item}" => $list[3], "{cost}" => $list[4] * $data[1]];
						foreach ($vars as $var => $replacement) {
							$message = str_replace($var, $replacement, $message);
						}
						$player->sendMessage($message);
						$this->itemForm($player, $cat);
					} else {
						$message = $this->getConfig()->getNested("messages.not-enough-money");
						$tags = ["{amount}" => $list[2], "{name}" => $list[3], "{cost}" => $list[4] * $data[1], "{missing}" => $list[4] * $data[1] - $money];
						foreach ($tags as $tag => $replacement) {
							$message = str_replace($tag, $replacement, $message);
						}
						$player->sendMessage($message);
						$this->itemForm($player, $cat);
					}
				}
			}
			if ($buydata === 1) {
				if ($data === null) {
					$this->ItemForm($player, $cat);
				} else {

					if ($player->getInventory()->contains(Item::get($list[0], $list[1], $data[1])) === true) {
						$player->getInventory()->removeItem(Item::get($list[0], $list[1], $data[1]));
						$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->addMoney($player, $list[5] * $data[1]);
						$message = $this->getConfig()->getNested("messages.money-received");
						$vars = ["{amount}" => $list[2], "{item}" => $list[3], "{cost}" => $list[4] * $data[1]];
						foreach ($vars as $var => $replacement) {
							$message = str_replace($var, $replacement, $message);
						}
						$player->sendMessage($message);
						$this->itemForm($player, $cat);
					} else {
						$message = $this->getConfig()->getNested("messages.not-enough-items");
						$tags = ["{amount}" => $list[2], "{name}" => $list[3], "{cost}" => $list[4] * $data[1], "{missing}" => $list[4] * $data[1] - $money];
						foreach ($tags as $tag => $replacement) {
							$message = str_replace($tag, $replacement, $message);
						}
						$player->sendMessage($message);
						$this->itemForm($player, $cat);
					}
				}
			}
			if ($buydata === 2) {
				$this->catForm($player);
			}
			if ($data === null) {
				$this->catForm($player);
			}
		});
		$allshop = yaml_parse_file($this->getDataFolder() . "shop.yml");
		foreach ($allshop as $categoryName => $access) {
			$category[] = $access;
		}
		foreach ($category[$cat] as $items => $itemarray) {
			$itemlist[] = $itemarray;
		}
		if ($result === null) {
			$this->catForm($player);
		} else {
			$list = explode(":", $itemlist[$result]);
			$form->setTitle($this->getConfig()->get("Title"));
			$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($player);
			$form->addLabel($this->getConfig()->getNested("messages.how-many") . " " . $list[3] . $this->getConfig()->getNested("messages.how-many2") . "\n" . $this->getConfig()->getNested("messages.money") . $money . "$");
			$form->addSlider("§eSố lượng §6$list[3]§e",1 ,64, $list[2], $list[2]);
			$form->sendToPlayer($player);
		}
	}
}