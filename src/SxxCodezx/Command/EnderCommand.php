<?php

namespace SxxCodezx\Command;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;

use SxxCodezx\Sounds;

use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use muqsit\invmenu\InvMenu;

class EnderCommand extends Command {

    public function __construct()
    {
        parent::__construct("ec", "Open EnderChest", null, ["enderchest"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            $name = $sender->getName();
            $ender = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
            $ender->setName($name." §5EnderChest");
            $inv = $ender->getInventory();
            $inv->setContents($sender->getEnderInventory()->getContents());
            $ender->setListener(function (InvMenuTransaction $transaction) use ($sender): InvMenuTransactionResult{
            $sender->getEnderInventory()->setItem($transaction->getAction()->getSlot(), $transaction->getIn());
            return $transaction->continue();
            });
            $ender->send($sender);
            Sounds::addSound($sender, 'random.enderchestopen', 50 ,1);
        }else{
        }
    }
}