<?php

/*
 * LegionPE Theta
 *
 * Copyright (C) 2015 PEMapModder and contributors
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PEMapModder
 */

namespace pg\lib;

use pg\lib\exe\Statement;

class Event{
	const EVENT_EXPLANATIONS = [
		"World/Physics" => [
			"Physics" => [
				"pocketmine\\event\\block\\BlockSpreadEvent" => "when grass/mycelium spreads",
				"pocketmine\\event\\block\\LeavesDecayEvent" => "when leaves decay",
			],
			"Chunks" => [
				"pocketmine\\event\\level\\ChunkLoadEvent" => "when a chunk is loaded",
				"pocketmine\\event\\level\\ChunkUnloadEvent" => "when a chunk is unloaded",
				"pocketmine\\event\\level\\ChunkPopulateEvent" => "when a chunk is populated",
			],
			"World" => [
				"pocketmine\\event\\level\\LevelInitEvent" => "when a new level is loaded",
				"pocketmine\\event\\level\\LevelLoadEvent" => "when a level is loaded",
				"pocketmine\\event\\level\\LevelSaveEvent" => "when a level is saved",
				"pocketmine\\event\\level\\LevelUnloadEvent" => "when a level is unloaded",
				"pocketmine\\event\\level\\SpawnChangeEvent" => "when a world's spawn is changed",
			],
		],
		"General Entities" => [
			"Entity spawns" => [
				"pocketmine\\event\\entity\\EntitySpawnEvent" => "when an entity is spawned",
				"pocketmine\\event\\entity\\ItemSpawnEvent" => "when a dropped item spawns",
			],
			"Entity despawns" => [
				"pocketmine\\event\\entity\\EntityBlockChangeEvent" => "when a falling block hits the ground and becomes a solid block",
				"pocketmine\\event\\entity\\EntityDeathEvent" => "when an entity (but not a player) dies",
				"pocketmine\\event\\entity\\EntityDespawnEvent" => "when an entity despawns",
				"pocketmine\\event\\entity\\ItemDespawnEvent" => "when a dropped item despawns",
			],
			"Entity health" => [
				"pocketmine\\event\\entity\\EntityCumbustEvent" => "when an entity is set on fire by a fire block, a lava block or an entity on fire",
				"pocketmine\\event\\entity\\EntityDamageEvent" => "when an entity gets damaged",
				"pocketmine\\event\\entity\\EntityRegainHealthEvent" => "when an entity regains health",
			],
			"Entity actions" => [
				"pocketmine\\event\\entity\\ProjectileLaunchEvent" => "when a projectile is launched",
				"pocketmine\\event\\entity\\ProjectileHitEvent" => "when a projectile hits a block or an entity",
				"pocketmine\\event\\entity\\ExplosionPrimeEvent" => "when an explosion is about to occur",
				"pocketmine\\event\\entity\\EntityExplodeEvent" => "when an explosion occurs",
				"pocketmine\\event\\entity\\EntityShootBowEvent" => "when an entity shoots an arrow",
			],
		],
		"Player and entity movement" => [
			"pocketmine\\event\\entity\\EntityMotionEvent" => "when an entity changes its speed/moving direction",
			"pocketmine\\event\\entity\\EntityLevelChangeEvent" => "when an entity moved from a level to another",
			"pocketmine\\event\\entity\\EntityTeleportEvent" => "when an entity is teleported",
			"pocketmine\\event\\player\\PlayerBedEnterEvent" => "when a player enters a bed",
			"pocketmine\\event\\player\\PlayerBedLeaveEvent" => "when a player leaves a bed",
			"pocketmine\\event\\player\\PlayerMoveEvent" => "when a player moves (every tick)",

		],
		"Player actions" => [
			"Joining" => [
				"pocketmine\\event\\player\\PlayerPreLoginEvent" => "when a player attempts to connect",
				"pocketmine\\event\\player\\PlayerLoginEvent" => "when a player starts receiving chunks",
				"pocketmine\\event\\player\\PlayerJoinEvent" => "when a player spawns (use PlayerRespawnEvent for setting spawn positions)",
			],
			"Quiting" => [
				"pocketmine\\event\\player\\PlayerKickEvent" => "when a player is kicked by the server, by plugins or by admins",
				"pocketmine\\event\\player\\PlayerQuitEvent" => "when a player fails to connect to the server, gets kicked or actively disconnects",
			],
			"Health" => [
				"pocketmine\\event\\player\\PlayerDeathEvent" => "when a player dies",
				"pocketmine\\event\\player\\PlayerRespawnEvent" => "when a player spawns or respawns",
			],
			"Inventory and Containers" => [
				"pocketmine\\event\\entity\\EntityArmorChangeEvent" => "when an entity (especially a player)'s armor changes",
				"pocketmine\\event\\entity\\EntityInventoryChangeEvent" => "when a slot in an entity inventory changes",
				"pocketmine\\event\\inventory\\CraftItemEvent" => "when an item is crafted",
				"pocketmine\\event\\player\\PlayerItemHeldEvent" => "when the player holds a different item (by choosing a new hotbar slot or by choosing a new slot in his inventory",
				"pocketmine\\event\\player\\PlayerItemConsumeEvent" => "when a player consumes an item by the style of \"eating\"",
				"pocketmine\\event\\inventory\\InventoryOpenEvent" => "when a player starts viewing a container", // NOTE remember to prevent firing this when the target inventory is a PlayerInventory
				"pocketmine\\event\\inventory\\InventoryCloseEvent" => "when a player stops viewing a container", // NOTE remember to prevent firing this when the target inventory is a PlayerInventory
				"pocketmine\\event\\inventory\\InventoryTransactionEvent" => "when something is transferred between two inventories/containers",
				"pocketmine\\event\\inventory\\FurnaceSmeltEvent" => "when a furnace smelts an item",
				"pocketmine\\event\\inventory\\FurnaceBurnEvent" => "when a furnace consumes a piece of fuel",

			],
			"Block interaction" => [
				"pocketmine\\event\\player\\PlayerInteractEvent" => "when a player touches a block (taps a block, begins to break a block or long-clicks the air",
				"pocketmine\\event\\block\\BlockPlaceEvent" => "when a block is placed (after touching the block)",
				"pocketmine\\event\\block\\BlockBreakEvent" => "when a player finished breaking a block",
				"pocketmine\\event\\block\\SignChangeEvent" => "when text is written onto a sign",
				"pocketmine\\event\\player\\PlayerAnimationEvent" => "when a player swings his arm",
				"pocketmine\\event\\player\\PlayerBucketEmptyEvent" => "when a player empties a bucket",
				"pocketmine\\event\\player\\PlayerBucketFillEvent" => "when a player fills a bucket",
			],
			"Other world interaction" => [
				"pocketmine\\event\\player\\PlayerDropItemEvent" => "when a player drops an item",
				"pocketmine\\event\\inventory\\InventoryPickupItemEvent" => "when a player picks up a dropped item",
				"pocketmine\\event\\inventory\\InventoryPickupArrowEvent" => "when a player picks up an arrow",
			],
			"pocketmine\\event\\player\\PlayerAchievementAwardedEvent" => "when a player has got an achievement",
			"pocketmine\\event\\player\\PlayerGameModeChangeEvent" => "when a player's gamemode is changed",
		],
		"Chat-related" => [
			"pocketmine\\event\\player\\PlayerCommandPreprocessEvent" => "when a player sends something in chat, command or not command",
			"pocketmine\\event\\player\\PlayerChatEvent" => "when a player chats",
		],
		"RCON/Server Core" => [
			"pocketmine\\event\\server\\LowMemoryEvent" => "when the server is having low memory",
			"pocketmine\\event\\server\\RemoteServerCommandEvent" => "when RCON sends a command",
			"pocketmine\\event\\server\\ServerCommandEvent" => "when console sends a command",
		],
		"Advanced/Nerdy stuff" => [
			"pocketmine\\event\\Player\\PlayerCreationEvent" => "when a player is created before anything else is set up",
			"pocketmine\\event\\plugin\\PluginEnableEvent" => "when a plugin is enabled",
			"pocketmine\\event\\plugin\\PluginDisableEvent" => "when a plugin is disabled",
			"pocketmine\\event\\server\\DataPacketSendEvent" => "when a data packet is send",
			"pocketmine\\event\\server\\DataPacketReceiveEvent" => "when a data packet is received",
		],
		"Non-events" => [
				"pocketmine\\event\\server\\QueryRegenerateEvent" => "for processing the data sent to clients and server lists",
			],
	];
	/** @var string */
	public $eventClassName, $eventName;
	/** @var int */
	public $priority = EventPriority::NORMAL;
	/** @var bool */
	public $ignoreCancelled = true;
	/** @var Statement[] */
	public $eventHandler = [];
}
