<?php

namespace pg\lib;

class Project{
	private $desc;
	public $namespace;
	public $mainClass;
	/** @var Command[] */
	public $cmds = [];
	/** @var Event[] */
	public $events = [];
	public function __construct($name, $version, array $authors){
		$this->namespace = $this->generateClassName();
		$this->mainClass = "MainClass";
		$this->desc = new PluginDescription([
			"name" => $name,
			"version" => $version,
			"authors" => $authors,
			"main" => $this->namespace . "\\" . $this->mainClass,
			"api" => ["1.12.0"],
		], false);
	}
	public function generateClassName(){
		$out = "_PluginGenerator_";
		for($i = 0; $i < 16; $i++){
			$r = mt_rand(0, 62);
			if($r < 26){
				$out .= chr(ord("A") + $r);
				continue;
			}
			$r -= 26;
			if($r < 26){
				$out .= chr(ord("a") + $r);
				continue;
			}
			$r -= 26;
			$out .= ($r === 10 ? "_" : chr(ord("0") + $r));
		}
		return $out;
	}
	/**
	 * @return PluginDescription
	 */
	public function getDesc(){
		return $this->desc;
	}
}
