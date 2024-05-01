<?php


namespace phqzing\kbeditor;


use pocketmine\event\Listener;
use pocketmine\event\entity\{EntityDamageEvent, EntityDamageByEntityEvent};
use pocketmine\player\Player;
use pocketmine\entity\Living;
use pocketmine\math\Vector3;


class EventListener implements Listener {
 

    /**
    * @param EnityDamageEvent $ev
    * @priority MONITOR
    */
    public function onDamage(EntityDamageEvent $ev):void
    {
        $player = $ev->getEntity();

        if(Loader::$only_players)
        {
            if(!($player instanceof Player)) return;
        }
        if($ev->isCancelled()) return;
	    
        if($ev instanceof EntityDamageByEntityEvent)
        {
	    if($ev->isCancelled()) return;
            $damager = $ev->getDamager();
            if(Loader::$only_players)
            {
                if(!($damager instanceof Player) or !($player instanceof Player)) return;
            }

            $world = $damager->getWorld()->getFolderName();
            $kb = Loader::getKnockBack($world);
            if(!is_null($kb))
            {
                $horizontal = $kb["horizontal"] ?? 0.4;
                $vertical = $kb["vertical"] ?? 0.4;
                $attack_speed = $kb["attack-speed"] ?? 10;

                $deltaX = $player->getLocation()->x - $damager->getLocation()->x;
                $deltaZ = $player->getLocation()->z - $damager->getLocation()->z;

                $ev->setKnockback(0);
                $ev->setAttackCooldown((int)$attack_speed);
                $this->modifyKB($player, $deltaX, $deltaZ, $horizontal, $vertical, $vertical);
            } else {
                $ev->setAttackCooldown(10);
            }
        }
    }


    public function modifyKB(Living $player, float $deltaX, float $deltaZ, float $horizontal, float $vertical, ?float $verticalLimit = 0.4):void
    {
		$f = sqrt($deltaX * $deltaX + $deltaZ * $deltaZ);
		if($f <= 0) return;
        $f = 1 / $f;

        $motionX = $player->getMotion()->x / 2;
        $motionY = $player->getMotion()->y / 2;
        $motionZ = $player->getMotion()->z / 2;
        $motionX += $deltaX * $f * $horizontal * 2;
        $motionY += $vertical * 2;
        $motionZ += $deltaZ * $f * $horizontal * 2;

        if($motionY > ($vertical * 2)) $motionY = $vertical * 2;

        $player->setMotion(new Vector3($motionX, $motionY, $motionZ));
    }
}
