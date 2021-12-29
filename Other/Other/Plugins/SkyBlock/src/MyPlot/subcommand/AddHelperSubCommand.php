<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class AddHelperSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return ($sender instanceof Player) and $sender->hasPermission("myplot.command.addhelper");
    }

    public function execute(CommandSender $sender, array $args) {
		if (!empty($args)) {
            return false;
        }
		
		$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
            if($api === null || $api->isDisabled()){
            }
            $form = $api->createCustomForm(function(Player $sender, array $data){
              $result = $data[0];
              if($result != null){
                $helper = $result;
        $player = $sender->getServer()->getPlayer($sender->getName());
        $plot = $this->getPlugin()->getPlotByPosition($player->getPosition());
        if ($plot === null) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("notinplot"));
            return true;
        }
        if ($plot->owner !== $sender->getName() and !$sender->hasPermission("myplot.admin.addhelper")) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("notowner"));
            return true;
        }
        if (!$plot->addHelper($helper)) {
            $sender->sendMessage($this->translateString("addhelper.alreadyone", [$helper]));
            return true;
        }
        if ($this->getPlugin()->getProvider()->savePlot($plot)) {
            $sender->sendMessage($this->translateString("addhelper.success", [$helper]));
        } else {
            $sender->sendMessage(TextFormat::RED . $this->translateString("error"));
        }
        return true;
              }
            });
            $form->setTitle("Thêm Người Chơi Vào Đảo");
            $form->addInput("Nhập Tên Người Muốn Thêm");
            $form->sendToPlayer($sender);

        
    }
}
