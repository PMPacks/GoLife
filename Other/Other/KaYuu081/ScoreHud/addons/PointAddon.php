<?php
declare(strict_types = 1);

/**
 * @name PointAPI
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\PointAddon
 * @depend PointAPI
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use doramine\economyapi\EconomyAPI;
	use pocketmine\Player;

	class PointAddon extends AddonBase{

		/** @var EconomyAPI */
		private $economyAPI;

		public function onEnable(): void{
			$this->economyAPI = $this->getServer()->getPluginManager()->getPlugin("PointAPI");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{point}" => $this->economyAPI->myMoney($player)
			];
		}
	}
}