<?php


namespace Doxestic\DeathAnimation\task;


use Doxestic\DeathAnimation\HeadEntity\Head;
use Doxestic\DeathAnimation\Main;
use pocketmine\scheduler\Task;

class DeleteHeadTask extends Task
{

	public $main;
	public $entity;

	private $time;

	public function __construct(Main $pl, Head $head)
	{
		$this->time = (int)$pl->config->get("time-to-take-head");
		$this->entity = $head;
		$this->main = $pl;
	}

	public function onRun(int $currentTick)
	{
		if ($this->time <= 0){
			$this->entity->kill();
			$this->main->getScheduler()->cancelTask($this->getTaskId());
		}else{
			$this->time--;
			$this->entity->setNameTag("§aHead of §d".$this->entity->player->getName()."\n§6Time until delete:\n§c".(string)$this->time);
		}
		// TODO: Implement onRun() method.
	}
}
