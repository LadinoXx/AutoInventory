<?php

namespace LadinoXx\AutoInventory;

use LadinoXx\AutoInventory\Loader;
use pocketmine\player\Player;

class EventsManagers {

    public $plugin;

    public function __construct(Loader $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @param Array $drops
     * @param Player $player
     * @return array
     */
    public function eventIsVallid(Array $drops, Player $player) : array
    {
        $notdropeds = [];
        foreach($drops as $item) {
            if($player->getInventory()->canAddItem($item)) {
                $player->getInventory()->addItem($item);
            }else{
                $notdropeds[] = $item;
            }
        }
        return $notdropeds;
    }
}