<?php
namespace MyPlot;

use pocketmine\utils\TextFormat;
use MyPlot\subcommand\SubCommand;
use MyPlot\subcommand\AddHelperSubCommand;
use MyPlot\subcommand\ClaimSubCommand;
use MyPlot\subcommand\DisposeSubCommand;
use MyPlot\subcommand\GenerateSubCommand;
use MyPlot\subcommand\HelpSubCommand;
use MyPlot\subcommand\HomeSubCommand;
use MyPlot\subcommand\InfoSubCommand;
use MyPlot\subcommand\HomesSubCommand;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use MyPlot\subcommand\RemoveHelperSubCommand;
use MyPlot\subcommand\AutoSubCommand;
use MyPlot\subcommand\NameSubCommand;
use MyPlot\subcommand\GiveSubCommand;
use MyPlot\subcommand\WarpSubCommand;
use jojoe77777\FormAPI;
use pocketmine\Player;

class Commands extends PluginCommand
{
    /** @var SubCommand[] */
    private $subCommands = [];

    /** @var SubCommand[]  */
    private $aliasSubCommands = [];

    public function __construct(MyPlot $plugin) {
        parent::__construct($plugin->getLanguage()->get("command.name"), $plugin);
        $this->setPermission("myplot.command");
        $this->setAliases([$plugin->getLanguage()->get("command.alias")]);
        $this->setDescription($plugin->getLanguage()->get("command.desc"));

        $this->loadSubCommand(new HelpSubCommand($plugin, "help"));
        $this->loadSubCommand(new ClaimSubCommand($plugin, "claim"));
        $this->loadSubCommand(new GenerateSubCommand($plugin, "generate"));
        $this->loadSubCommand(new InfoSubCommand($plugin, "info"));
        $this->loadSubCommand(new AddHelperSubCommand($plugin, "addhelper"));
        $this->loadSubCommand(new RemoveHelperSubCommand($plugin, "removehelper"));
        $this->loadSubCommand(new AutoSubCommand($plugin, "auto"));
        $this->loadSubCommand(new DisposeSubCommand($plugin, "dispose"));
        $this->loadSubCommand(new HomeSubCommand($plugin, "home"));
        $this->loadSubCommand(new HomesSubCommand($plugin, "homes"));
        $this->loadSubCommand(new NameSubCommand($plugin, "name"));
        $this->loadSubCommand(new GiveSubCommand($plugin, "give"));
        $this->loadSubCommand(new WarpSubCommand($plugin, "warp"));
    }

    /**
     * @return SubCommand[]
     */
    public function getCommands() {
        return $this->subCommands;
    }

    private function loadSubCommand(Subcommand $command) {
        $this->subCommands[$command->getName()] = $command;
        if ($command->getAlias() != "") {
            $this->aliasSubCommands[$command->getAlias()] = $command;
        }
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)  {
        if (!isset($args[0])) {
		$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, array $data){
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
		
       $subCommand = strtolower(array_shift($args));
        if (isset($this->subCommands[$subCommand])) {
            $command = $this->subCommands[$subCommand];
        } elseif (isset($this->aliasSubCommands[$subCommand])) {
            $command = $this->aliasSubCommands[$subCommand];
        } else {
			$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, array $data){
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

        if ($command->canUse($sender)) {
            if (!$command->execute($sender, $args)) {
                $usage = MyPlot::getInstance()->getLanguage()->translateString("subcommand.usage", [$command->getUsage()]);
				$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, array $data){
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
            }
        } else {
			$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, array $data){
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
        }
        return true;
    }
}
