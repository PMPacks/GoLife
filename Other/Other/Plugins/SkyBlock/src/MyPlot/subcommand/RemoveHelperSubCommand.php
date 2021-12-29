<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class RemoveHelperSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return ($sender instanceof Player) and $sender->hasPermission("myplot.command.removehelper");
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
        if ($plot->owner !== $sender->getName() and !$sender->hasPermission("myplot.admin.removehelper")) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("notowner"));
            return true;
        }
        if (!$plot->removeHelper($helper)) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("removehelper.notone", [$helper]));
            return true;
        }
        if ($this->getPlugin()->getProvider()->savePlot($plot)) {
            $sender->sendMessage($this->translateString("removehelper.success", [$helper]));
        } else {
            $sender->sendMessage(TextFormat::RED . $this->translateString("error"));
        }
        return true;
              }
            });
            $form->setTitle("Xóa Người Chơi Khỏi Đảo");
            $form->addInput("Nhập Tên Người Muốn Xóa");
            $form->sendToPlayer($sender);
		
        
    }
}
