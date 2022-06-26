<?php

namespace SxxCodezx;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;

use SxxCodezx\Command\EnderCommand;
use muqsit\invmenu\InvMenuHandler;

class Loader extends Pluginbase {

    public function onEnable(): void {
        $server = Server::getInstance();
        $server->getLogger()->info("Plugin EnderChest Enabled");
        $command = $server->getCommandMap();
        $command->register("ec", new EnderCommand());
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
         }
    }
}