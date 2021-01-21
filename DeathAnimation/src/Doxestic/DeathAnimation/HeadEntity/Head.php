<?php


namespace Doxestic\DeathAnimation\HeadEntity;


use pocketmine\entity\Human;

class Head extends Human
{

	public $player;

	public const GEO = "
	{
	\"geometry.player_head\": {
		\"texturewidth\": 64,
		\"textureheight\": 64,
		\"visible_bounds_width\": 2,
		\"visible_bounds_height\": 1,
		\"visible_bounds_offset\": [0, 0.5, 0],
		\"bones\": [
			{
				\"name\": \"head\",
				\"pivot\": [0, 24, 0],
				\"cubes\": [
					{\"origin\": [-4, 0, -4], \"size\": [8, 8, 8], \"uv\": [0, 0]}
				]
			}
		    ]
	    }
    }";

}