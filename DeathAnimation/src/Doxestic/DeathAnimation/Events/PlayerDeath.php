<?php


namespace Doxestic\DeathAnimation\Events;


use Doxestic\DeathAnimation\HeadEntity\Head;
use Doxestic\DeathAnimation\Main;
use Doxestic\DeathAnimation\task\DeleteHeadTask;
use pocketmine\entity\Entity;
use pocketmine\entity\Skin;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\nbt\tag\ByteArrayTag;

class PlayerDeath implements Listener
{
	public $main;

	public function __construct(Main $pl)
	{
		$this->main = $pl;
	}

	public function onDeath(PlayerDeathEvent $event){
		$player = $event->getPlayer();
		$nbt = Entity::createBaseNBT($player->getLocation()->asVector3(), null, $player->getYaw());
		$skin = new CompoundTag("Skin", [new StringTag("Name", "snx"), new ByteArrayTag("Data", str_repeat("/x00", 8192 * 2))]);
		$nbt->setTag($skin);
		$head = new Head($player->getLevel(), $nbt);
		$skin = new Skin("Head", $player->getSkin()->getSkinData(), "", "geometry.player_head", Head::GEO);
		$head->setSkin($skin);
		$head->player = $player;
		$this->main->getScheduler()->scheduleRepeatingTask(new DeleteHeadTask($this->main, $head), 20);
		$head->spawnToAll();
	}

	public function onDamage(EntityDamageEvent $event){
		if ($event->getEntity() instanceof Head){
			$event->setCancelled();
		}
	}
}