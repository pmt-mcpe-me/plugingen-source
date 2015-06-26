<?php

namespace pg\lib;

class Generator{
	/** @var Project */
	private $project;
	/** @var string[] */
	public $files = [];
	public function __construct(Project $project){
		$this->project = $project;
	}
	public function generate(){
		$this->generateYaml();
		$this->generateMainClass();
		$this->generateCommands();
		$this->includePhpResource("CommandArgsMap");
	}
	private function generateYaml(){
		$desc = $this->project->getDesc();
		$data = [
			"name" => $desc->getName(),
			"version" => $desc->getVersion(),
			"api" => $desc->getCompatibleApis(),
			"authors" => $desc->getAuthors(),
			"main" => $desc->getMain()
		];
		$this->addFile("plugin.yml", yaml_emit($data));
	}
	private function generateMainClass(){
		$class = new ClassGenerator($this->project->namespace, "MainClass");
		$class->addImport("pocketmine\\plugin\\PluginBase");
		$class->setSuperClass("PluginBase");
		$onEnable = new GeneratedFunctionContainer;
		$onEnable->name = "onEnable";
		foreach($this->project->cmds as $cmd){
			$pluginName = strtolower(str_replace([":", " "], "-", $this->project->getDesc()->getName()));
			$onEnable->code .= '$this->getServer()->getCommandMap()->register(' . var_export($pluginName, true) . ', new cmds\\' . $cmd->getClassName() . '($this)); // this line registers the command /' . str_replace(["\r", "\n"], "<br>", $cmd->name);
		}
		$class->addFunction($onEnable);
		$this->addFile("src/" . $this->project->namespace . "/MainClass.php", $class);
	}
	private function generateCommands(){
		foreach($this->project->cmds as $cmd){
			$include = true;
			$this->addFile("src/" . $this->project->namespace . "/cmds/" . $cmd->getClassName() . ".php", $cmd->generateFile());
		}
		if(isset($include)){
			$this->includePhpResource("GeneratedPluginCommandAbstract");
		}
	}
	private function addFile($filename, $contents){
		if($contents instanceof ClassGenerator){
			$contents = $contents->toString();
		}
		$this->files["/" . trim(str_replace("\\", "/", $filename), "/")] = $contents;
	}
	private function includePhpResource($className){
		$namespace = $this->project->namespace . "\\resources";
		$dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR;
		if(is_file($filename = $dir . $className . ".php")){
			$contents = file_get_contents($filename);
			$contents = str_replace([
				0 => "___PLUGIN_GENERATOR_VARIABLE_main_namespace___",
			], [
				0 => $namespace,
			], $contents);
			$this->addFile("src/$namespace/$className.php", $contents);
		}else{
			throw new \InvalidArgumentException("Resource $filename not found");
		}
	}
}
