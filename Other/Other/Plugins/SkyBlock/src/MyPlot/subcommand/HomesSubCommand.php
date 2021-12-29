<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use MyPlot\Plot;

class HomesSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return ($sender instanceof Player) and $sender->hasPermission("myplot.command.homes");
    }

    public function execute(CommandSender $sender, array $args) {
        if (!empty($args)) {
            return false;
        }
		
		$api = $this->getPlugin()->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, $data){
                });
                    
        $player = $sender->getServer()->getPlayer($sender->getName());
        $levelName = "sb";
        $plots = $this->getPlugin()->getProvider()->getPlotsByOwner($sender->getName());
        if (empty($plots)) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("homes.noplots"));
            return true;
        }
       # $sender->sendMessage(TextFormat::DARK_GREEN . $this->translateString("homes.header"));

        usort($plots, function ($plot1, $plot2) {
            /** @var $plot1 Plot */
            /** @var $plot2 Plot */
            if ($plot1->levelName == $plot2->levelName) {
                return 0;
            }
            return ($plot1->levelName < $plot2->levelName) ? -1 : 1;
        });

        for ($i = 0; $i < count($plots); $i++) {
			//if($i == 0) continue;
            $plot = $plots[$i];
            $message = TextFormat::DARK_GREEN . ($i + 1) . ") ";
            $message .= TextFormat::WHITE . $levelName . " " . $plot;
            if ($plot->name !== "") {
                $message .= " = " . $plot->name;
            }
			$form->setTitle("§l§b♦§a Homes §b♦");
			$form->addLabel("§l§o§aCác đảo mà bạn có");
                    $form->addLabel($message);
					$form->sendToPlayer($sender);
        }
        return true;
    }
}