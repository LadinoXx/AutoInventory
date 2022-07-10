<?php

namespace LadinoXx\AutoInventory;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\EventPriority;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase {

    /**
     * @var EventsManagers
     */
    public $eventsmanagers;
    /**
     * @return void
     */
    public function onEnable() : void
    {
        $this->eventsmanagers = new EventsManagers($this);
        $this->registerEvents();
        $this->getLogger()->info("Plugin AutoInventory ligado, feito por LADINO#0001");
    }

    /**
     * @return void
     */
    public function registerEvents() : void
    {
        $this->getServer()->getPluginManager()->registerEvent(
            BlockBreakEvent::class,
            function (BlockBreakEvent $ev) : void
            {
                if (!$ev->isCancelled()) {
                    $ev->setDrops($this->eventsmanagers->eventIsVallid($ev->getDrops(), $ev->getPlayer()));
                }
            },
            EventPriority::HIGHEST,
            $this,
            false
        );
    }
}
