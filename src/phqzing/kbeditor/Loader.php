<?php


namespace phqzing\kbeditor;


use pocketmine\plugin\PluginBase;


class Loader extends PluginBase {


    private static $kbData = [];
    private static $generalKB = [];
    public static $only_players = true;


    public function onEnable():void
    {
        $this->saveDefaultConfig();

        $config = $this->getConfig()->getAll();
        self::$kbData = $config["world-kb"];
        self::$generalKB = $config["general-kb"];
        self::$only_players = $config["only-players"];

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }


    public static function getKnockBack(string $world):array|null
    {
        if(isset(self::$kbData[$world]))
        {
            return self::$kbData[$world];
        }
        return empty(self::$generalKB) ? null : self::$generalKB;
    }
}
