<?php

namespace CC\Managers;

use CC\PluginAware;
use CC\Models\Arena;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config as PMC;
use pocketmine\Player;

class ArenaManager {
    //Usa un trait para evitar duplicación de código :v
    use PluginAware;

    private $arenas = [];
    private $activeMapNames = [];
    private $availableMaps = [];

    public function __construct(PluginBase $pl) {
        $this->setPlugin($pl);
        $this->setConfig("maps");
        $this->availableMaps = $this->cfg->get("maps",[]);
    }

    private function getRandomMapName() {
        $freeMaps=array_diff(
            $this->availableMaps,
            $this->activeMapNames
        );

        if(empty($freeMaps)){
            return null;
        }

        $randomKey=array_rand($freeMaps);
        return $freeMaps[$randomKey];
    }

    public function joinOrCreateArena(Player $player) {
        foreach($this->arenas as $arena){
            if($arena->getStatus() === 0){
                $arena->addPlayer($player);
            }
        }

        $mapName=$this->getRandomMapName();
        if($mapName === null){
            $player->sendMessage("§c¡No hay mapas disponibles!");
            return;
        }

        $this->activeMapNames[] = $mapName;
        $newArena = new Arena($mapName);
        $this->getServer()->loadLevel($mapName);
        $newArena->addPlayer($player);
        $this->arenas[$mapName]=$newArena;
    }
}
