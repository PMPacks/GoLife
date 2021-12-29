<?php

namespace PocketMoney;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

use PocketMoney\constants\PlayerType;
use PocketMoney\event\MoneyUpdateEvent;
use PocketMoney\event\TransactionEvent;

class PocketMoney extends PluginBase implements Listener
{
    /* @var Config */
    private $users;
    /* @var Config */
    private $system;

    private $messages;



    // <- API

    /**
     * @api
     *
     * return if $account is registered
     *
     * @param string $account
     * @return bool
     */
    public function isRegistered($account)
    {
        return $this->users->exists($account);
    }

    /**
     * @api
     *
     * return default money
     *
     * @return int
     */
    public function getDefaultMoney()
    {
        return $this->system->get("default_money");
    }

    /**
     * @api
     *
     * return $account's money
     *
     * @param string $account
     * @return int|false
     */
    public function getMoney($account)
    {
        if (!$this->isRegistered($account)) return false;
        return $this->users->get($account)['money'];
    }

    /**
     * @api
     *
     * return $account's account type
     *
     * @param string $account
     * @return int|false
     */
    public function getType($account)
    {
        if (!$this->isRegistered($account)) return false;
        return $this->users->get($account)['type'];
    }

    /**
     * @api
     *
     * return if $account is hid
     *
     * @param string $account
     * @return bool
     */
    public function getHide($account)
    {
        if (!$this->isRegistered($account)) return false;
        return $this->users->get($account)['hide'];
    }

    /**
     * @api
     *
     * $sender pays $receiver $amount PM
     * return if the transaction is succeeded
     *
     * @param string $sender
     * @param string $receiver
     * @param int $amount
     * @return bool
     */
    public function payMoney($sender, $receiver, $amount)
    {
        if (!is_numeric($amount) or $amount < 0) return false;
        if (!$this->isRegistered($sender)) return false;
        if (!$this->isRegistered($sender)) return false;
        if (!$this->grantMoney($sender, -$amount, false)) return false;
        if (!$this->grantMoney($receiver, $amount, false)) return false;
        $this->getServer()->getPluginManager()->callEvent(
            new MoneyUpdateEvent(
                $this,
                $sender,
                $this->getMoney($sender),
                MoneyUpdateEvent::CAUSE_PAY));
        $this->getServer()->getPluginManager()->callEvent(
            new MoneyUpdateEvent(
                $this,
                $receiver,
                $this->getMoney($receiver),
                MoneyUpdateEvent::CAUSE_PAY));

        $this->getServer()->getPluginManager()->callEvent(
            new TransactionEvent(
                $this,
                $sender,
                $receiver,
                $amount,
                TransactionEvent::TRANSACTION_PAY));

        return true;
    }

    /**
     * @api
     *
     * set $amount to $account's money
     * return if the transaction is succeeded
     *
     * @param string $account
     * @param int $amount
     * @return bool
     */
    public function setMoney($account, $amount)
    {
        if (!$this->isRegistered($account)) return false;
        if (!is_numeric($amount) or $amount < 0) return false;
        $this->users->set($account, array_merge($this->users->get($account), array("money" => $amount)));
        $this->users->save();
        $this->getServer()->getPluginManager()->callEvent(
            new MoneyUpdateEvent(
                $this,
                $account,
                $amount,
                MoneyUpdateEvent::CAUSE_SET));
        return true;
    }

    /**
     * @api
     *
     * grant $amount to $account
     * return if the transaction is succeeded
     *
     * @param string $account
     * @param int $amount
     * @param bool $callEvent
     * @return bool
     */
    public function grantMoney($account, $amount, $callEvent = true)
    {
        if (!$this->isRegistered($account)) return false;
        $targetMoney = $this->getMoney($account);
        if (!is_numeric($amount) or ($targetMoney + $amount) < 0) return false;
        $this->users->set($account, array_merge($this->users->get($account), array("money" => $targetMoney + $amount)));
        $this->users->save();
        if ($callEvent) {
            $this->getServer()->getPluginManager()->callEvent(
                new MoneyUpdateEvent(
                    $this,
                    $account,
                    $this->getMoney($account),
                    MoneyUpdateEvent::CAUSE_GRANT));
        }

        return true;
    }

    /**
     * @api
     *
     * set $account's hide mode
     * return if the transaction is succeeded
     *
     * @param string $account
     * @param bool $hide
     * @return bool
     */
    public function setAccountHideMode($account, $hide)
    {
        if (!$this->isRegistered($account)) return false;
        $this->users->set($account, array_merge($this->users->get($account), array('hide' => $hide)));
        $this->users->save();
        return true;
    }

    /**
     * @api
     *
     * switch $account's hide mode
     * return if the transaction is succeeded
     *
     * @param bool $account
     * @return bool
     */
    public function switchHideMode($account)
    {
        if (!$this->isRegistered($account)) return false;
        $hide = $this->users->get($account)['hide'];
        $this->users->set($account, array_merge($this->users->get($account), array('hide' => !$hide)));
        $this->users->save();
        return true;
    }

    /**
     * @api
     *
     * hide $account
     * return if the transaction is succeeded
     *
     * @param string $account
     * @return bool
     */
    public function hideAccount($account)
    {
        if (!$this->isRegistered($account)) return false;
        if ($this->getType($account) !== PlayerType::NonPlayer) return false;
        $this->users->set($account, array_merge($this->users->get($account), array('hide' => true)));
        $this->users->save();
        return true;
    }

    /**
     * @api
     *
     * unhide $account
     * return if the transaction is succeeded
     *
     * @param string $account
     * @return bool
     */
    public function unhideAccount($account)
    {
        if (!$this->isRegistered($account)) return false;
        $this->users->set($account, array_merge($this->users->get($account), array('hide' => false)));
        $this->users->save();
        return true;
    }

    /**
     * @api
     *
     * return number of account
     *
     * @return int
     */
    public function getNumberOfAccount()
    {
        return count($this->users->getAll());
    }

    /**
     * @api
     *
     * return total money
     *
     * @return int
     */
    public function getTotalMoney()
    {
        $sum = 0;
        foreach ($this->users->getAll() as $account) {
            $sum += $account['money'];
        }
        return $sum;
    }

    /**
     * @api
     *
     * create $account
     * return if the transaction is succeeded
     *
     * @param string $account
     * @param int|string $type
     * @param bool $hide
     * @param bool|int $money
     * @return bool
     */
    public function createAccount($account, $type = PlayerType::NonPlayer, $hide = false, $money = false)
    {
        if ($this->isRegistered($account)) return false;
        //return new SimpleError(SimpleError::AccountAlreadyExist, "\"$account\" already exists");
        $money = ($money === false ? 0 : $money);
        if (!is_numeric($money) or $money < 0) return false;
        //return new SimpleError(SimpleError::InvalidAmount, "Invalid amount");
        if (!is_numeric($type)) {
            if (strtolower($type) === "player") {
                $type = PlayerType::Player;
            } elseif (strtolower($type) === "nonplayer") {
                $type = PlayerType::NonPlayer;
            } else {
                return false;
                //return new SimpleError(SimpleError::InvalidAmount, "Invalid amount");
            }
        }
        $this->users->set($account, array("money" => $money, "type" => $type, "hide" => $hide));
        $this->users->save();
        return true;
    }

    /**
     * @api
     *
     * delete $account
     * return if the transaction is succeeded
     *
     * @param string $account
     * @return bool
     */
    public function deleteAccount($account)
    {
        if (!$this->isRegistered($account)) return false;
        //return new SimpleError(SimpleError::AccountNotExist, "\"$account\" does not exist");
        $this->users->remove($account);
        $this->users->save();
        return true;
    }

    /**
     * @api
     *
     * return ranking
     *
     * @param int $amount
     * @param bool $includeHideAccount
     * @return array
     */
    public function getRanking($amount, $includeHideAccount = false)
    {
        $result = array();
        $temp = array();
        foreach ($this->users->getAll() as $name => $value) {
            if ($includeHideAccount) {
                $temp[$name] = $value['money'];
            } elseif (!$value['hide']) {
                $temp[$name] = $value['money'];
            }
        }
        arsort($temp);
        $key = array_keys($temp);
        $val = array_values($temp);
        for ($i = 0; $i < $amount; $i++) {
            $tKey = array_shift($key);
            if (is_null($tKey)) break;
            $tVal = array_shift($val);
            if (is_null($tVal)) break;
            $result[$tKey] = $tVal;
        }
        return $result;
    }

    // API ->


    public function onLoad()
    {
    }

    public function onEnable()
    {
        if (!file_exists($this->getDataFolder())) @mkdir($this->getDataFolder(), 0755, true);
        $this->users = new Config($this->getDataFolder() . "user.yml", Config::YAML);
        $this->system = new Config($this->getDataFolder() . "system.yml", Config::YAML, array("default_money" => 0, "currency" => "Coin"));
        $this->users->save();
        $this->system->save();

        $this->saveResource("messages.yml", false);
        $this->messages = $this->parseMessages((new Config($this->getDataFolder() . "messages.yml"))->getAll());

		
	 $this->getLogger()->info("§l§bCoin Edit By Phuongaz");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDisable()
    {
        $this->users->save();
        $this->system->save();
    }

    public function onCommand(CommandSender $sender, Command $command,  string $label, array $args):bool
    {
        if ($sender instanceof Player) return $this->onCommandByUser($sender, $command, $label, $args);
        switch ($command->getName()) {
			//UI
			case "acoin":
			 $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                   case 0:
				 //top
				 $this->getServer()->getCommandMap()->dispatch($sender, "coin top");
				 break;
				 case 1:
				 //pay
				 $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $event, array $data){
								              $result = $data[0];
											$sender = $event;
				if($result != null){
					$this->Ten = $data[0];
					$this->Coin = $data[1];
					 $this->getServer()->getCommandMap()->dispatch($sender, "coin pay ".$this->Ten." ".$this->Coin);
			}
		});
		   $form->setTitle("§l§aPAY COIN");
		   $form->addLabel("§l§b Nhập đầy đủ thông tin");
		   $form->addInput("§6§l Nhập Tên người cần Giao dịch");
		   $form->addInput("§6§l Nhập Số Coin cần giao Dịch");
		   $form->sendToPlayer($sender);
		   break;
		   case 2:
		   
			 $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $event, array $data){
								              $result = $data[0];
											
				if($result != null){
					$this->Ten = $data[0];
					
					 $this->getServer()->getCommandMap()->dispatch($sender, "coin view ".$this->Ten);
			}
		});
		   $form->setTitle("§l§aVIEW COIN");
		   $form->addLabel("§l§b Nhập đầy đủ thông tin");
		   $form->addInput("§6§l Nhập Tên người cần xem");
		   $form->sendToPlayer($sender);
		   break;
		   case 3:
		    $this->getServer()->getCommandMap()->dispatch($sender, "coin gia");
			break;
			case 4:
			   $this->getServer()->getCommandMap()->dispatch($sender, "buyvip");
			 break;
			 case 5:
			    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });
   $form->setTitle("§a§lNẠP COIN");
$form->addLabel("§6§lThông tin liên hệ");
$form->addLabel("§b§lFacebook:§6 fb.com/Http.SextopOne.net");
$form->addLabel("§c§cEmail:§6 phuongphuong6882@gmail.com");
$form->addLabel("§a§lSố Điện Thoại:§6 Cập Nhật....");
$form->addLabel("§a§lNếu bạn đang muốn nạp thẻ hảy\nLiên hệ một trong những cách trên");
$form->sendToPlayer($sender);
			break;
			}
		});
	$form->setTitle("§l§bCOIN SYSTEM");
	$form->setContent("§a§lMY COIN: ".$this->getMoney($sender->getName()));
	$form->addButton("§l§6TOP COIN");
	$form->addButton("§l§cPAY COIN");
	$form->addButton("§l§dGIÁ COIN");
	$form->addButton("§l§eMUA VIP");
	$form->addButton("§l§1NẠP COIN");
	$form->sendToPlayer($sender);
			
			
			break;
            case "coin":
			
                $subCommand = strtolower(array_shift($args));
                switch ($subCommand) {
                    case "":
                   $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });  
   $form->setTitle("§a-+=[]» §bCOIN SYSTEM§a «[]=+-");
   //$form->addLabel("/money help( or /money )");
                         $form->addLabel("§b/coin view <account>");
                      //  $form->addLabel("/coin create <account>");
                     //  $form->addLabel("/coin hide <account>");
                    //   $form->addLabel("/money unhide <account>");
                   
				   $form->addLabel("§b/coin set <target> <amount>");
                      $form->addLabel("§b/coin  <target> <amount>");
                        $form->addLabel("/coin top <TOP>");
                        //$form->addLabel("/coin stat");
						$form->sendToPlayer($sender);
break;
                    case "view":
                        $account = array_shift($args);
                        if (is_null($account)) {
                            $sender->sendMessage($this->getMessage("view.usage"));
                            break;
                        }

                        $money = $this->getMoney($account);
                        $type = $this->getType($account);
                        $hide = $this->getHide($account);
                        if ($money === false || $type === false || $hide === true) {
                            $sender->sendMessage($this->getMessage("view.fail"));
                            break;
                        }
                        $type = ($type === PlayerType::Player) ? $this->getMessage("view.type.player") : $this->getMessage("view.type.non-player");
                        $hide = ($hide === false) ? $this->getMessage("view.hide.false") : $this->getMessage("view.hide.true");
                        $result = $this->getMessage("view.result");
                        $result = str_replace("{{account}}", $account, $result);
                        $result = str_replace("{{money}}", $this->getFormattedMoney($money), $result);
                        $result = str_replace("{{type}}", $type, $result);
                        $result = str_replace("{{hide}}", $hide, $result);
                     //   $sender->sendMessage($result);
						 $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });  
   $form->setTitle("§a-+=[]» §bCOIN SYSTEM§a «[]=+-");
   $form->addLabel($result);
   $form->sendToPlayer($sender);
                        break;



                    case "set":
                        $target = array_shift($args);
                        $amount = array_shift($args);
                        if (is_null($target) or is_null($amount)) {
                            $sender->sendMessage($this->getMessage("set.usage"));
                            break;
                        }
                        if (!$this->setMoney($target, $amount)) {
                            $sender->sendMessage($this->getMessage("set.fail"));
                            break;
                        }
                        $sender->sendMessage($this->getMessage("set.result.console"));
                        if (($player = $this->getServer()->getPlayer($target)) instanceof Player) {
                            $result = $this->getMessage("set.result.target");
                            $result = str_replace("{{money}}", $this->getFormattedMoney($amount), $result);
                            $player->sendMessage($result);
                        }
                        break;

                    case "grant":
                        $target = array_shift($args);
                        $amount = array_shift($args);
                        if (is_null($target) or is_null($amount)) {
                            $sender->sendMessage($this->getMessage("grant.usage"));
                            break;
                        }
                        if (!$this->grantMoney($target, $amount)) {
                            $sender->sendMessage($this->getMessage("grant.fail"));
                            break;
                        }
                        $sender->sendMessage($this->getMessage("grant.result.console"));
                        if (($player = $this->getServer()->getPlayer($target)) instanceof Player) {
                            $result = $this->getMessage("grant.result.target");
                            $result = str_replace("{{money}}", $this->getFormattedMoney($amount), $result);
                            $player->sendMessage($result);
                        }
                        break;
                   case "recoin":
				   
				if($sender->isOp()){
				if(count($args) < 3){
   $sender->sendMessage("/coin recoin <người chơi> <số lượng>");
}
          if(isset($args[0], $args[1])){
   $player = $this->getServer()->getPlayer($args[0]); 
          if($player !== null){
   
   $name = $player->getName();
   $this->grantMoney($name, -$args[1], true);
   $sender->sendMessage("§f»§aXóa thành công§e $args[1] §bCoin§a của §e$name!");
   $player->sendMessage("§eBạn bị §cADMIN§e tịch thu§a $args[1] §bCoin");
     }else{
   $sender->sendMessage("§f»§cNgười chơi §b$args[0] §ckhông online!"); 
} 			
}else{
   $sender->sendMessage("§a/coin recoin <người chơi> <số lượng>");
}
}else{
   $sender->sendMessage("§cerror");
   return true;
}
break;
                    case "top":
                        $amount = array_shift($args);
                        if (is_null($amount)) {
                            $sender->sendMessage($this->getMessage("top.usage"));
                            break;
                        }
                      //  $sender->sendMessage($this->getMessage("top.title"));
                        //$sender->sendMessage($this->getMessage("top.decoration"));
                        $rank = 1;
                        foreach ($this->getRanking($amount) as $name => $money) {
                            $item = $this->getMessage("top.item");
                            $item = str_replace("{{rank}}", $rank, $item);
                            $item = str_replace("{{name}}", $name, $item);
                            $item = str_replace("{{money}}", $this->getFormattedMoney($money), $item);
                        						 $sender->sendMessage($item);

  							                            $rank++;


                        }
                       // $sender->sendMessage($this->getMessage("top.decoration"));
                        break;

                   /* case "stat":
                        $total = $this->getTotalMoney();
                        $accounts = $this->getNumberOfAccount();
                        $average = floor($total / $accounts);
                        $result = $this->getMessage("stat.result");
                        $result = str_replace("{{total}}", $this->getFormattedMoney($total), $result);
                        $result = str_replace("{{average}}", $average, $result);
                        $result = str_replace("{{accounts}}", $accounts, $result);
                        $sender->sendMessage($result);
                        break;*/

                    default:
                        $sender->sendMessage(str_replace("{{subCommand}}", $subCommand, $this->getMessage("system.error.invalidsubcommand")));
                        break;
                }
                return true;

            default:
                return false;
        }
    }

    private function onCommandByUser(CommandSender $sender, Command $command,string $label, array $args):bool
    {
        switch ($command->getName()) {
			
			case "admincoin":
			 if(!$sender->isOp()){
				 $sender->sendMessage("§cYou no permission");
				 return true;
			 }else{
				  $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                   case 0:
				    $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $event, array $data){
								              $result = $data[0];
											
				if($result != null){
					$this->Ten = $data[0];
					$this->Coin = $data[1];
					 $this->getServer()->getCommandMap()->dispatch($sender, "coin set ".$this->Ten." ".$this->Coin);
			}
		});
		   $form->setTitle("§l§aSET COIN COIN");
		   $form->addLabel("§l§b Nhập đầy đủ thông tin");
		   $form->addInput("§6§l Nhập Tên người cần chỉnh");
		   $form->addInput("§6§l Nhập Số Coin cần chỉnh");
		   $form->sendToPlayer($sender);
			break;
			case 1:
			 $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $event, array $data){
								              $result = $data[0];
											
				if($result != null){
					$this->Ten = $data[0];
					$this->Coin = $data[1];
					 $this->getServer()->getCommandMap()->dispatch($sender, "coin grant ".$this->Ten." ".$this->Coin);
			}
		});
		   $form->setTitle("§l§aADD COIN");
		   $form->addLabel("§l§b Nhập đầy đủ thông tin");
		   $form->addInput("§6§l Nhập Tên người cần Cho");
		   $form->addInput("§6§l Nhập Số Coin cần cho");
		   $form->sendToPlayer($sender);
		   break;
		   case 2:
		    $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $event, array $data){
								              $result = $data[0];
											
				if($result != null){
					$this->Ten = $data[0];
					$this->Coin = $data[1];
					 $this->getServer()->getCommandMap()->dispatch($sender, "coin recoin ".$this->Ten." ".$this->Coin);
			}
		});
		   $form->setTitle("§l§aREDUCE COIN");
		   $form->addLabel("§l§b Nhập đầy đủ thông tin");
		   $form->addInput("§6§l Nhập Tên người cần Trừ");
		   $form->addInput("§6§l Nhập Số Coin cần trừ");
		   $form->sendToPlayer($sender);
			}
		});
		$form->setTitle("§b§aADMINE COIN FORM");
		$form->addButton("§l§e» §6SET COIN§e «");
		$form->addButton("§l§e» §bADD COIN§e «");
		$form->addButton("§l§e» §cREDUCE COIN§e «");
		$form->sendToPlayer($sender);
		
			 }
			 break;
				case "acoin":
			 $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                   case 0:
				 //top
				 $this->getServer()->getCommandMap()->dispatch($sender, "coin top");
				 break;
				 case 1:
				 //pay
				 $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $event, array $data){
								              $result = $data[0];
											
				if($result != null){
					$this->Ten = $data[0];
					$this->Coin = $data[1];
					 $this->getServer()->getCommandMap()->dispatch($sender, "coin pay ".$this->Ten." ".$this->Coin);
			}
		});
		   $form->setTitle("§l§aPAY COIN");
		   $form->setContent("§c Nếu lỗi sử dụng lệnh §b/coin pay <name> <coin>");
		   $form->addLabel("§l§b Nhập đầy đủ thông tin");
		   $form->addInput("§6§l Nhập Tên người cần Giao dịch");
		   $form->addInput("§6§l Nhập Số Coin cần giao Dịch");
		   $form->sendToPlayer($sender);
		   break;
		   case 2:
		   
			 $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function (Player $event, array $data){
								              $result = $data[0];
											
				if($result != null){
					$this->Ten = $data[0];
					
					 $this->getServer()->getCommandMap()->dispatch($sender, "coin view ".$this->Ten);
			}
		});
		   $form->setTitle("§l§aVIEW COIN");
		   $form->addLabel("§l§b Nhập đầy đủ thông tin");
		   $form->addInput("§6§l Nhập Tên người cần xem");
		   $form->sendToPlayer($sender);
		   break;
		   case 3:
		    $this->getServer()->getCommandMap()->dispatch($sender, "coin gia");
			break;
			case 4:
			   $this->getServer()->getCommandMap()->dispatch($sender, "buyvip");
			 break;
			 case 5:
			    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });
   $form->setTitle("§a§lNẠP COIN");
$form->addLabel("§6§lThông tin liên hệ");
$form->addLabel("§b§lFacebook:§6 fb.com/Http.SextopOne.net");
$form->addLabel("§c§cEmail:§6 phuongphuong6882@gmail.com");
$form->addLabel("§a§lSố Điện Thoại:§6 Cập Nhật....");
$form->addLabel("§a§lNếu bạn đang muốn nạp thẻ hảy\nLiên hệ một trong những cách trên");
$form->sendToPlayer($sender);
			break;
			}
		});
	$form->setTitle("§l§bＣＯＩＮ ＳＹＳＴＥＭ");
	$form->setContent("§e§l•§c MY COIN:§a ".$this->getMoney($sender->getName()));
	$form->addButton("§l§e» §6TOP COIN§e «");
	$form->addButton("§l§e» §cPAY COIN§e «");
	$form->addButton("§l§e» §3VIEW COIN§e «");
	$form->addButton("§l§e» §dGIÁ COIN§e «");
	$form->addButton("§l§e» §2MUA VIP§e «");
	$form->addButton("§l§e» §1NẠP COIN§e «");
	$form->sendToPlayer($sender);
	break;
            case "coin":
                $subCommand = strtolower(array_shift($args));
                switch ($subCommand) {
                    case "": 
				/*$money = $this->getMoney($sender->getName());
					 $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });
   $form->setTitle("§e-=- §bCOIN SYSTEM§e -=-");
   $form->addLabel("§aYour coin:§6 $money");
   $form->sendToPlayer($sender);*/
    $this->getServer()->getCommandMap()->dispatch($sender, "acoin");
                       
                   //     $sender->sendMessage($this->getFormattedMoney($money));
                        break;
						 case "set":
                        $target = array_shift($args);
                        $amount = array_shift($args);
                        if (is_null($target) or is_null($amount)) {
                            $sender->sendMessage($this->getMessage("set.usage"));
                            break;
                        }
                        if (!$this->setMoney($target, $amount)) {
                            $sender->sendMessage($this->getMessage("set.fail"));
                            break;
                        }
                        $sender->sendMessage($this->getMessage("set.result.console"));
                        if (($player = $this->getServer()->getPlayer($target)) instanceof Player) {
                            $result = $this->getMessage("set.result.target");
                            $result = str_replace("{{money}}", $this->getFormattedMoney($amount), $result);
                            $player->sendMessage($result);
                        }
                        break;
						case "gia":
			 if (!isset($args[0])){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, array $data){
                });
	$form->setTitle("§0§l-+=[§4||§0]§2 COIN§0 [§4||§0]=+-");
	$form->addLabel("§l§a10.000 VND§e = §620 §2Coin");
	$form->addLabel("§l§a20.000 VND §e=§6 30§2 Coin");
	$form->addLabel("§l§a50.000 VND§e =§6 70 §2Coin");
		$form->addLabel("§a§l100.000 VND §e=§6 150 §2Coin");
			$form->addLabel("§l§a200.000 VND§e =§6 300 §2Coin");

     $form->addLabel("§a--------------------------------");
	 $form->sendToPlayer($sender);
                    return true;
                }
           break;
		                       case "grant":
							   	if($sender->isOp()){
                        $target = array_shift($args);
                        $amount = array_shift($args);
                        if (is_null($target) or is_null($amount)) {
                            $sender->sendMessage($this->getMessage("grant.usage"));
                            break;
                        }
                        if (!$this->grantMoney($target, $amount)) {
                            $sender->sendMessage($this->getMessage("grant.fail"));
                            break;
                        }
                        $sender->sendMessage($this->getMessage("grant.result.console"));
                        if (($player = $this->getServer()->getPlayer($target)) instanceof Player) {
                            $result = $this->getMessage("grant.result.target");
                            $result = str_replace("{{money}}", $this->getFormattedMoney($amount), $result);
                            $player->sendMessage($result);
                        }
				}else{
   $sender->sendMessage("§cerror");
   return true;
}
                        break;
                   case "recoin":
				   
				if($sender->isOp()){
				if(count($args) < 3){
   $sender->sendMessage("/coin recoin <người chơi> <số lượng>");
}
          if(isset($args[0], $args[1])){
   $player = $this->getServer()->getPlayer($args[0]); 
          if($player !== null){
   
   $name = $player->getName();
   $this->grantMoney($name, -$args[1], true);
   $sender->sendMessage("§f»§aXóa thành công§e $args[1] §bCoin§a của §e$name!");
   $player->sendMessage("§eBạn bị §cADMIN§e tịch thu§a $args[1] §bCoin");
     }else{
   $sender->sendMessage("§f»§cNgười chơi §b$args[0] §ckhông online!"); 
} 			
}else{
   $sender->sendMessage("§a/coin recoin <người chơi> <số lượng>");
}
}else{
   $sender->sendMessage("§cerror");
   return true;
}
break;
				break;
                    case "help":
                        if ($sender->hasPermission("pocketmoney.help")) {
								 $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });
   $form->setTitle("§e-=- §bCOIN SYSTEM§e -=-");
                         $form->addLabel("§a/coin help");
 $form->addLabel("§a/coin view <account>");
 $form->addLabel("§a/coin gia để xem giá Acoin");
                           $form->addLabel("§a/coin pay <target>");
                          //  $sender->sendMessage("/money create <account>");
                         //   $sender->sendMessage("/money hide <account>");
                          //  $sender->sendMessage("/money unhide <account>");
                         //   $sender->sendMessage("/money wd <target> <amount>");
                           $form->addLabel("§a/coin top <Số Trang>");
						   $form->sendToPlayer($sender);
                         //   $sender->sendMessage("/money stat");
                        } else {
                            $sender->sendMessage($this->getMessage("system.error.permission"));
                        }
                        break;

                    case "view":
                        if ($sender->hasPermission("pocketmoney.view")) {
                            $account = array_shift($args);
                            if (is_null($account)) {
                                $sender->sendMessage($this->getMessage("view.usage"));
                                break;
                            }

                            $money = $this->getMoney($account);
                            $type = $this->getType($account);
                            $hide = $this->getHide($account);
                            if ($money === false || $type === false || $hide === true) {
                                $sender->sendMessage($this->getMessage("view.fail"));
                                break;
                            }
                            $type = ($type === PlayerType::Player) ? $this->getMessage("view.type.player") : $this->getMessage("view.type.non-player");
                            $hide = ($hide === false) ? $this->getMessage("view.hide.false") : $this->getMessage("view.hide.true");
                            $result = $this->getMessage("view.result");
                            $result = str_replace("{{account}}", $account, $result);
                            $result = str_replace("{{money}}", $this->getFormattedMoney($money), $result);
                            $result = str_replace("{{type}}", $type, $result);
                            $result = str_replace("{{hide}}", $hide, $result);
 $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
   $form = $api->createCustomForm(function (Player $sender, array $data){
   });  
   $form->setTitle("§a-+=[]» §bCOIN SYSTEM§a «[]=+-");
   $form->addLabel($result);
   $form->sendToPlayer($sender);
                            //$sender->sendMessage($result);
                        } else {
                            $sender->sendMessage($this->getMessage("system.error.permission"));
                        }
                        break;

                    case "pay":
                        if ($sender->hasPermission("pocketmoney.pay")) {
                            $target = array_shift($args);
                            $amount = array_shift($args);
                            if (is_null($target) or is_null($amount)) {
                                $sender->sendMessage($this->getMessage("pay.usage"));
                                break;
                            }
                            if (!$this->payMoney($sender->getName(), $target, $amount)) {
                                $sender->sendMessage($this->getMessage("pay.fail"));
                                break;
                            }
                            $formattedAmount = $this->getFormattedMoney($amount);
                            $senderMessage = $this->getMessage("pay.result.sender");
                            $senderMessage = str_replace("{{target}}", $target, $senderMessage);
                            $senderMessage = str_replace("{{money}}", $formattedAmount, $senderMessage);
                            $sender->sendMessage($senderMessage);
                            if (($targetPlayer = $this->getServer()->getPlayer($target)) instanceof Player) {
                                $targetMessage = $this->getMessage("pay.result.target");
                                $targetMessage = str_replace("{{sender}}", $sender->getName(), $targetMessage);
                                $targetMessage = str_replace("{{money}}", $formattedAmount, $targetMessage);
                                $targetPlayer->sendMessage($targetMessage);
                            }
                        } else {
                            $sender->sendMessage($this->getMessage("system.error.permission"));
                        }

                        break;


                    case "top":
                        if ($sender->hasPermission("pocketmoney.top")) {
                            $amount = array_shift($args);
                          
                         	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
						$form = $api->createCustomForm(function (Player $player, array $data){
                });
                $amount = 10;
                if (is_null($amount)) {
                    $sender->sendMessage($this->getMessage("top.usage"));
                    break;
                }
                $rank = 1;
				$form->addLabel("§a-§b XẾP HẠNG TOP COIN§a -");
                foreach ($this->getRanking($amount) as $name => $money) {
                    $item = $this->getMessage("top.item");
                    $item = str_replace("{{rank}}", $rank, $item);
                    $item = str_replace("{{name}}", $name, $item);
                    $item = str_replace("{{money}}", $this->getFormattedMoney($money), $item);
					$form->addLabel($item);
                    $rank++;
                }
				 $form->sendToPlayer($sender);
                return true;
                         //   $sender->sendMessage($this->getMessage("top.decoration"));

                        } else {
                            $sender->sendMessage($this->getMessage("system.error.permission"));
                        }

                   


                        break;

                    default:
                        $sender->sendMessage(str_replace("{{subCommand}}", $subCommand, $this->getMessage("system.error.invalidsubcommand")));
                        break;
                }
                return true;

            default:
                return false;
        }
		return true;
    }

    public function onPlayerJoin(PlayerJoinEvent $event)
    {
        $username = $event->getPlayer()->getName();
        ;
        if ($this->createAccount($username, PlayerType::Player, false, $this->getDefaultMoney()) === true) {
            $this->getLogger()->info("$username has been registered to Coins");
        }
    }

    private function parseMessages(array $messages)
    {
        $result = [];
        foreach($messages as $key => $value){
            if(is_array($value)){
                foreach($this->parseMessages($value) as $k => $v){
                    $result[$key . "." . $k] = $v;
                }
            }else{
                $result[$key] = $value;
            }
        }
        return $result;
    }

    private function getMessage($key)
    {
        return isset($this->messages[$key]) ? $this->messages[$key] : $key;
    }

    private function getFormattedMoney($money)
    {
        return $money . " " . $this->system->get("currency");
    }
}
