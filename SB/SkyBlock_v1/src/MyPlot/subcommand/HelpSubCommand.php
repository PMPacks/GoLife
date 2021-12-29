<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI;
use pocketmine\Player;

class HelpSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return $sender->hasPermission("myplot.command.help");
    }

    /**
     * @return \MyPlot\Commands
     */
    private function getCommandHandler()
    {
        return $this->getPlugin()->getCommand($this->translateString("command.name"));
    }

    public function execute(CommandSender $sender, array $args) {
        if (count($args) === 0) {
            $pageNumber = 1;
        } elseif (is_numeric($args[0])) {
            $pageNumber = (int) array_shift($args);
            if ($pageNumber <= 0) {
                $pageNumber = 1;
            }
        } else {
            return false;
        }

        if ($sender instanceof ConsoleCommandSender) {
            $pageHeight = PHP_INT_MAX;
        } else {
            $pageHeight = 5;
        }

        $commands = [];
        foreach ($this->getCommandHandler()->getCommands() as $command) {
            if ($command->canUse($sender)) {
                $commands[$command->getName()] = $command;
            }
        }
        ksort($commands, SORT_NATURAL | SORT_FLAG_CASE);
        $commands = array_chunk($commands, $pageHeight);
        /** @var SubCommand[][] $commands */
        $api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, $data){
                });
                    $form->setTitle("§l§b♦§a SkyBlock §b♦");
                    $form->addLabel("§b§l───────────────────");
                    $form->addLabel("§l§c1. §a/sb auto§7:§e Tìm một hòn đảo");
					$form->addLabel("§l§c2. §a/sb claim§7:§e Mua ngay hòn đảo");
                    $form->addLabel("§l§c3. §a/sb warp <x;y>§7:§e Chuyển đến hòn đảo theo số");
					$form->addLabel("§l§c4. §a/sb home§7:§e Vê đảo của bạn");
                    $form->addLabel("§l§c5. §a/sb homes§7:§e Xem các đảo bạn có");
					$form->addLabel("§l§c6. §a/sb info§7:§e Xem thông tin đảo");
                    $form->addLabel("§l§c6. §a/sb info§7:§e Xem thông tin đảo");
					$form->addLabel("§l§c7. §a/sb name <Tên>§7:§e Đặt tên lại cho đảo");
                    $form->addLabel("§l§c7. §a/sb name <Tên>§7:§e Đặt tên lại cho đảo");
					$form->addLabel("§l§c8. §a/sb dispose§7:§e Bỏ đảo bạn đang đứng");
                    $form->addLabel("§l§c9. §a/sb addhelper <Tên>§7:§e Thêm người chơi vào đảo của bạn");
					$form->addLabel("§l§c10. §a/sb removehelper <Tên>§7:§e Xóa người chơi khỏi đảo bạn");
					$form->addLabel("§l§c11. §a/sb give <Tên>§7:§e Trao lại đảo cho ai đó");
                    $form->addLabel("§b§l───────────────────");
					$form->sendToPlayer($sender);
        return true;
    }
}
