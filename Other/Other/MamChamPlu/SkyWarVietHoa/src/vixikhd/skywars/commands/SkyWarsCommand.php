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

namespace vixikhd\skywars\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use vixikhd\skywars\arena\Arena;
use vixikhd\skywars\SkyWars;

/**
 * Class SkyWarsCommand
 * @package skywars\commands
 */
class SkyWarsCommand extends Command implements PluginIdentifiableCommand {

    /** @var SkyWars $plugin */
    protected $plugin;

    /**
     * SkyWarsCommand constructor.
     * @param SkyWars $plugin
     */
    public function __construct(SkyWars $plugin) {
        $this->plugin = $plugin;
        parent::__construct("skywars", "SkyWars commands", \null, ["sw"]);
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return mixed|void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!$sender->hasPermission("sw.cmd")) {
            $sender->sendMessage("§cBạn không có quyền sử dụng lệnh!");
            return;
        }
        if(!isset($args[0])) {
            $sender->sendMessage("§cDùng: §7/sw help");
            return;
        }

        switch ($args[0]) {
            case "help":
                if(!$sender->hasPermission("sw.cmd.help")) {
                    $sender->sendMessage("§cBạn không có quyền sử dụng lệnh!");
                    break;
                }
                $sender->sendMessage("§a> Lệnh SkyWars:\n" .
                    "§7/sw help : Hiển thị bảng hỗ trợ lệnh\n".
                    "§7/sw create : Tạo khu vực SkyWars \n".
                    "§7/sw remove : Huỷ bỏ khu vực SkyWars\n".
                    "§7/sw set : Thiết đặt khu vực SkyWars\n".
                    "§7/sw arenas : Hiển thị bảng khu vực đã có");

                break;
            case "create":
                if(!$sender->hasPermission("sw.cmd.create")) {
                    $sender->sendMessage("§cBạn không có quyền sử dụng lệnh!");
                    break;
                }
                if(!isset($args[1])) {
                    $sender->sendMessage("§cDùng: §7/sw create <arenaName>");
                    break;
                }
                if(isset($this->plugin->arenas[$args[1]])) {
                    $sender->sendMessage("§c> Khu vực $args[1] đã tồn tại!");
                    break;
                }
                $this->plugin->arenas[$args[1]] = new Arena($this->plugin, []);
                $sender->sendMessage("§a> Khu vực $args[1] đã được tạo!");
                break;
            case "remove":
                if(!$sender->hasPermission("sw.cmd.remove")) {
                    $sender->sendMessage("§cBạn không có quyền sử dụng lệnh!");
                    break;
                }
                if(!isset($args[1])) {
                    $sender->sendMessage("§cDùng: §7/sw remove <arenaName>");
                    break;
                }
                if(!isset($this->plugin->arenas[$args[1]])) {
                    $sender->sendMessage("§c> Khu vực $args[1] không tìm thấy!");
                    break;
                }

                /** @var Arena $arena */
                $arena = $this->plugin->arenas[$args[1]];

                foreach ($arena->players as $player) {
                    $player->teleport($this->plugin->getServer()->getDefaultLevel()->getSpawnLocation());
                }

                if(is_file($file = $this->plugin->getDataFolder() . "arenas" . DIRECTORY_SEPARATOR . $args[1] . ".yml")) unlink($file);
                unset($this->plugin->arenas[$args[1]]);

                $sender->sendMessage("§a> Khu vực đã được xoá!");
                break;
            case "set":
                if(!$sender->hasPermission("sw.cmd.set")) {
                    $sender->sendMessage("§cBạn không có quyền sử dụng lệnh!");
                    break;
                }
                if(!$sender instanceof Player) {
                    $sender->sendMessage("§c> Lệnh này chỉ dùng được trong trò chơi!");
                    break;
                }
                if(!isset($args[1])) {
                    $sender->sendMessage("§cDùng: §7/sw set <arenaName>");
                    break;
                }
                if(isset($this->plugin->setters[$sender->getName()])) {
                    $sender->sendMessage("§c> Bạn đang ở trong chế độ thiết lập!");
                    break;
                }
                if(!isset($this->plugin->arenas[$args[1]])) {
                    $sender->sendMessage("§c> Khu vực $args[1] không tìm thấy!");
                    break;
                }
                $sender->sendMessage("§a> Bạn đã chọn chế độ thiết lâp.\n".
                    "§7- Dùng §lhelp §r§7để hiện thị bảng lệnh\n"  .
                    "§7- Hoặc §ldone §r§7để rời khỏi chế độ thiết lập");
                $this->plugin->setters[$sender->getName()] = $this->plugin->arenas[$args[1]];
                break;
            case "arenas":
                if(!$sender->hasPermission("sw.cmd.arenas")) {
                    $sender->sendMessage("§cBạn không có quyền sử dụng lệnh!");
                    break;
                }
                if(count($this->plugin->arenas) === 0) {
                    $sender->sendMessage("§6> Hiện có 0 khu vực.");
                    break;
                }
                $list = "§7> Các khu vực:\n";
                foreach ($this->plugin->arenas as $name => $arena) {
                    if($arena->setup) {
                        $list .= "§7- $name : §cĐã tắt\n";
                    }
                    else {
                        $list .= "§7- $name : §aĐã bật\n";
                    }
                }
                $sender->sendMessage($list);
                break;
            default:
                if(!$sender->hasPermission("sw.cmd.help")) {
                    $sender->sendMessage("§cBạn hông có quyền sử dụng lệnh ở đây!");
                    break;
                }
                $sender->sendMessage("§cDùng: §7/sw help");
                break;
        }

    }

    /**
     * @return SkyWars|Plugin $plugin
     */
    public function getPlugin(): Plugin {
        return $this->plugin;
    }

}
