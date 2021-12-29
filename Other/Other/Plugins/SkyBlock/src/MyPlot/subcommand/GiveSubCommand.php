<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class GiveSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return ($sender instanceof Player) and $sender->hasPermission("myplot.command.give");
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
        $player = $sender->getServer()->getPlayer($sender->getName());
        $plot = $this->getPlugin()->getPlotByPosition($player->getPosition());
        if ($plot === null) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("notinplot"));
            return true;
        }
        if ($plot->owner !== $sender->getName()) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("notowner"));
            return true;
        }

        $newOwner = $this->getPlugin()->getServer()->getPlayer($result);
        if (!($newOwner instanceof Player)) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("give.notonline"));
            return true;
        } elseif ($newOwner === $player) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("give.toself"));
            return true;
        }

        $maxPlots = $this->getPlugin()->getMaxPlotsOfPlayer($newOwner);
        $plotsOfPlayer = count($this->getPlugin()->getProvider()->getPlotsByOwner($newOwner->getName()));
        if ($plotsOfPlayer >= $maxPlots) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("give.maxedout", [$maxPlots]));
            return true;
        }
            $plot->owner = $newOwner->getName();
            if ($this->getPlugin()->getProvider()->savePlot($plot)) {
                $plotId = TextFormat::GREEN . $plot . TextFormat::WHITE;
                $oldOwnerName = TextFormat::GREEN . $sender->getName() . TextFormat::WHITE;
                $newOwnerName = TextFormat::GREEN . $newOwner->getName() . TextFormat::WHITE;
                $sender->sendMessage($this->translateString("give.success", [$newOwnerName]));
                $newOwner->sendMessage($this->translateString("give.received", [$oldOwnerName, $plotId]));
            } else {
                $sender->sendMessage(TextFormat::RED . $this->translateString("error"));
            }
        return true;
		}
            });
            $form->setTitle("Chuyển Quyền Sở Hữu Đảo");
            $form->addInput("Nhập Tên Người Muốn Chuyển");
            $form->sendToPlayer($sender);
    }
}
