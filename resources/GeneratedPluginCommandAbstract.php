<?php

namespace ___PLUGIN_GENERATOR_VARIABLE_main_namespace___\cmds;

use ___PLUGIN_GENERATOR_VARIABLE_main_namespace___\CommandArgsMap;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;

abstract class GeneratedPluginCommandAbstract extends Command implements PluginIdentifiableCommand{
	/** @var Plugin */
	private $plugin;
	public function __construct($name, $description, $usage, $aliases, $permission, Plugin $plugin){
		$this->plugin = $plugin;
		parent::__construct($name, $description, $usage, $aliases);
		$this->setPermission($permission);
	}
	public function getPlugin(){
		return $this->plugin;
	}
	public function execute(CommandSender $sender, $commandLabel, array $args){
		$r = $this->e($sender, new CommandArgsMap($args));
		if(is_string($r)){
			$sender->sendMessage($r);
		}
		return true;
	}
	protected abstract function e(CommandSender $sender, CommandArgsMap $map);
}
