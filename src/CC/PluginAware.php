<?php

namespace CC;

use pocketmine\{
    Server,
    utils\Config,
    plugin\PluginBase
};

trait PluginAware{
    
    /** @var PluginBase */
    protected $pl;

    /** @var Config */
    protected $cfg;

    public function setPlugin(PluginBase $pl){
        $this->pl=$pl;
    }

    public function setConfig(string $k){
        $this->cfg=new Config($this->pl->getDataFolder() . $k . ".yml", Config::YAML, []);
    }

    protected function getPlugin(): PluginBase{
        return $this->pl;
    }

    protected function getServer() : Server{
        return $this->pl->getServer();
    }

    protected function getLogger() : \AttachableLogger{
        return $this->pl->getLogger();
    }
}
