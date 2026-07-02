<?php

namespace CC\Models;

use pocketmine\Player;

class Arena {

    /** @var string */
    private $name;
    
    private $players;

    /** @var int */
    private $status = 0; //0=WAITING, 1=STARTED

    public function __construct(string $name) {
        $this->name = $name;
        $this->players=[];
    }

    public function addPlayer(Player $player) {
        $this->players[$player->getName()] = $player;
    }

    public function removePlayer(Player $player) {
        unset($this->players[$player->getName()]);
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPlayers(): array {
        return $this->players;
    }

    public function getStatus(): int {
        return $this->status;
    }
}
