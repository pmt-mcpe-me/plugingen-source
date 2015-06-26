<?php

namespace pg\lib;

class Command{
	public static $CLASS_NAMES_IN_USE = [];
	public $project;
	public $name;
	public $desc;
	public $usage;
	public $permission = null;
	public $aliases = [];
	public $executor;
	private $className;
	public function __construct($name, $desc, $usage){
		$this->project = getProject();
		$this->name = $name;
		$this->desc = $desc;
		$this->usage = $usage;
		$this->executor = new CommandExecutor($this);
	}
	public function getClassName(){
		if(!isset($this->className)){
			$name = preg_replace('/[^A-Za-z_]/', "_", ucfirst($this->name));
			while(isset(self::$CLASS_NAMES_IN_USE[$name])){
				$name .= "_";
			}
			self::$CLASS_NAMES_IN_USE[$name] = $this->name;
			return $this->className = $name;
		}
		return $this->className;
	}
	public function generateFile(){
		$file = new ClassGenerator($this->project->namespace, $this->getClassName());
		$file->addImport($this->project->namespace . "\\resources\\GeneratedPluginCommandAbstract");
		$file->setSuperClass("GeneratedPluginCommandAbstract");
		$__construct = new GeneratedFunctionContainer;
		$__construct->name = "__construct";
		$file->addImport($this->project->namespace . "\\MainClass");
		$__construct->params = ['MainClass $main'];
		$__construct->code = "parent::__construct({$this->ex($this->name)}, {$this->ex($this->desc)}, {$this->ex($this->usage)}, {$this->ex($this->aliases)}, {$this->ex($this->permission)}, \$main);";
		$file->addFunction($__construct);
		$e = new GeneratedFunctionContainer;
		$e->name = "e";
		$e->params = ['CommandSender $sender', '$args'];
		$e->code = $this->executor->exportExecuteFunction();
		$file->addFunction($e);
		return $file;
	}
	protected function ex($var){
		return var_export($var, true);
	}
}
