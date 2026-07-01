<?php

namespace CC;

use pocketmine\plugin\PluginBase as pb;

use CC\Managers\ArenaManager;

final class Loader extends pb {

    public function onEnable () {
        $arenaManager = new ArenaManager($this);
    }
    
    /**public function getServer () {
        return $this->getServer();
    }*/
}
