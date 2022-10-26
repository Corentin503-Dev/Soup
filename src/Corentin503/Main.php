<?php

namespace Corentin503;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Le plugin c'est bien activé !");
    }
    public function onUse(PlayerItemUseEvent $event)
    {
        $item = $event->getItem();
        $player = $event->getPlayer();
        $config = new Config($this->getDataFolder() . "config.yml");

        if ($item->getId() === $config->get("id") and $item->getMeta() === $config->get("meta")) {
            $itemfac = ItemFactory::getInstance()->get($config->get("id"), $item->getMeta() === $config->get("meta"), 1);

            $player->getInventory()->remove($itemfac);
            $player->setHealth($player->getHealth() + $config->get("hp"));
        }
    }
}