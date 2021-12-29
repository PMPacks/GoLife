<?php

/**
 * Copyright 2018-2019 GamakCZ
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace vixikhd\skywars;

use pocketmine\command\Command;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\level\Level;
use pocketmine\plugin\PluginBase;
use vixikhd\skywars\arena\Arena;
use vixikhd\skywars\commands\SkyWarsCommand;
use vixikhd\skywars\math\Vector3;
use vixikhd\skywars\provider\YamlDataProvider;

/**
 * Class SkyWars
 * @package skywars
 */
class SkyWars extends PluginBase implements Listener {

    /** @var YamlDataProvider */
    public $dataProvider;

    /** @var Command[] $commands */
    public $commands = [];

    /** @var Arena[] $arenas */
    public $arenas = [];

    /** @var Arena[] $setters */
    public $setters = [];

    /** @var int[] $setupData */
    public $setupData = [];

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->dataProvider = new YamlDataProvider($this);
        $this->getServer()->getCommandMap()->register("SkyWars", $this->commands[] = new SkyWarsCommand($this));
    }

    public function onDisable() {
        $this->dataProvider->saveArenas();
    }

    /**
     * @param PlayerChatEvent $event
     */
    public function onChat(PlayerChatEvent $event) {
        $player = $event->getPlayer();

        if(!isset($this->setters[$player->getName()])) {
            return;
        }

        $event->setCancelled(\true);
        $args = explode(" ", $event->getMessage());

        /** @var Arena $arena */
        $arena = $this->setters[$player->getName()];

        switch ($args[0]) {
            case "help":
                $player->sendMessage("§a> Trợ giúp thiết lập SkyWars (1/1):\n".
                "§7help : Hiện trợ bảng hỗ trợ thiết lập\n" .
                "§7slots : Cập nhật số lượn người chơi cho khu vực\n".
                "§7level : Thiết lập level cho khu vực\n".
                "§7spawn : Thiết lập khu vực hồi sinh\n".
                "§7joinsign : Thiết lập bảng chọn \n".
                "§7savelevel : Lưu lại các địa hình của khu vực\n".
                "§7enable : Kích hoạt khu vực");
                break;
            case "slots":
                if(!isset($args[1])) {
                    $player->sendMessage("§cDùng: §7slots <int: slots>");
                    break;
                }
                $arena->data["slots"] = (int)$args[1];
                $player->sendMessage("§a> Số lượng được đặt là $args[1]!");
                break;
            case "level":
                if(!isset($args[1])) {
                    $player->sendMessage("§cDùng: §7level <levelName>");
                    break;
                }
                if(!$this->getServer()->isLevelGenerated($args[1])) {
                    $player->sendMessage("§c> Địa $args[1] không được tìm thấy!");
                    break;
                }
                $player->sendMessage("§a> Địa hình khu vực được đặt là $args[1]!");
                $arena->data["level"] = $args[1];
                break;
            case "spawn":
                if(!isset($args[1])) {
                    $player->sendMessage("§cDùng: §7setspawn <int: spawn>");
                    break;
                }
                if(!is_numeric($args[1])) {
                    $player->sendMessage("§cSố thứ tự!");
                    break;
                }
                if((int)$args[1] > $arena->data["slots"]) {
                    $player->sendMessage("§c Hiện chỉ có {$arena->data["slots"]} chỗ!");
                    break;
                }

                $arena->data["spawns"]["spawn-{$args[1]}"] = (new Vector3($player->getX(), $player->getY(), $player->getZ()))->__toString();
                $player->sendMessage("§a> Sinh ra $args[1] đặt tới X: " . (string)round($player->getX()) . " Y: " . (string)round($player->getY()) . " Z: " . (string)round($player->getZ()));
                break;
            case "joinsign":
                $player->sendMessage("§a> Nhấp vào bảng gỗ để thiết lập!");
                $this->setupData[$player->getName()] = 0;
                break;
            case "savelevel":
                if(!$arena->level instanceof Level) {
                    $player->sendMessage("§c> Lỗi khi lưu thế giới: Nó không được tìm thấy.");
                    if($arena->setup) {
                        $player->sendMessage("§6> Hãy thử lưu nó sau khi kích hoạt thế giới.");
                    }
                    break;
                }
                $arena->mapReset->saveMap($arena->level);
                $player->sendMessage("§a> Địa hình đã lưu!");
                break;
            case "enable":
                if(!$arena->setup) {
                    $player->sendMessage("§6> Khu vực đã được kích hoạt!");
                    break;
                }
                if(!$arena->enable()) {
                    $player->sendMessage("§c> Không thể tải khu vực, nó còn thiếu thông tin!");
					$player->sendMessage("§c> Hãy chắc chắn rằng bạn đã thiết lập đầy đủ!");
                    break;
                }
                $player->sendMessage("§a> Khu vực đã kích hoạt!");
                break;
            case "done":
                $player->sendMessage("§a> Bạn đã rời khỏi chế độ thiết đặt!");
                unset($this->setters[$player->getName()]);
                if(isset($this->setupData[$player->getName()])) {
                    unset($this->setupData[$player->getName()]);
                }
                break;
            default:
                $player->sendMessage("§6> Bạn đang trong chế độ thiết đặt.\n".
                    "§7- Dùng §lhelp §r§7để hiển thị lệnh hỗ trợ\n"  .
                    "§7- Hoặc §ldone §r§Để rời khỏi chế độ thiết đặt");
                break;
        }
    }

    /**
     * @param BlockBreakEvent $event
     */
    public function onBreak(BlockBreakEvent $event) {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        if(isset($this->setupData[$player->getName()])) {
            switch ($this->setupData[$player->getName()]) {
                case 0:
                    $this->setters[$player->getName()]->data["joinsign"] = [(new Vector3($block->getX(), $block->getY(), $block->getZ()))->__toString(), $block->getLevel()->getFolderName()];
                    $player->sendMessage("§a> Đã cập nhật!");
                    unset($this->setupData[$player->getName()]);
                    $event->setCancelled(\true);
                    break;
            }
        }
    }
}