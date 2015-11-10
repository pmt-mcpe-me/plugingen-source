<?php

/**
 * pmt.mcpe.me/pg
 * Copyright (C) 2015 PEMapModder
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace pg\lib;

class ClassGenerator{
	const STANDARD_EOL = "
"; // equivalent to `chr(10)`
	const STANDARD_TAB = "	";
	/** @var string */
	private $namespace;
	/** @var string[] */
	private $imports = [];
	private $simpleName;
	private $superclass = null;
	private $interfaces = [];
	/** @var int[] populated with T_PRIVATE, T_PROTECTED or T_PUBLIC */
	private $fields = [];
	/** @var GeneratedFunctionContainer[] */
	private $functions = [];
	public function __construct($namespace, $simpleName){
		$this->namespace = $namespace;
		$this->simpleName = $simpleName;
	}
	/**
	 * @return string
	 */
	public function getNamespace(){
		return $this->namespace;
	}
	/**
	 * @return string[]
	 */
	public function getImports(){
		return $this->imports;
	}
	public function addImport($import, $as = null){
		if($as !== null){
			$import .= " as $as";
		}
		$this->imports[] = $import;
	}
	/**
	 * @param string[] $imports
	 */
	public function addImports($imports){
		foreach($imports as $import){
			$this->imports[] = $import;
		}
	}
	public function getSimpleName(){
		return $this->simpleName;
	}
	public function getSuperClass(){
		return $this->superclass;
	}
	public function setSuperClass($superclass = null){
		$this->superclass = $superclass;
	}
	public function getInterfaces(){
		return array_keys($this->interfaces);
	}
	public function addInterface($interface){
		$this->interfaces[$interface] = true;
	}
	public function removeInterface($interface){
		if(isset($this->interfaces[$interface])){
			unset($this->interfaces[$interface]);
		}
	}
	public function getFields(){
		return $this->fields;
	}
	public function addField($visibility, $name){
		$this->fields[$name] = $visibility;
	}
	public function removeField($name){
		if(isset($this->fields[$name])){
			unset($this->fields[$name]);
		}
	}
	public function getFunctions(){
		return $this->functions;
	}
	public function addFunction(GeneratedFunctionContainer $fx){
		$this->functions[$fx->name] = $fx;
	}
	public function removeFunction($name){
		if(isset($this->functions[$name])){
			unset($this->functions[$name]);
		}
	}
	public function toString(){
		$out = "<?php

namespace $this->namespace;

";
		foreach($this->imports as $import){
			$out .= "use $import;";
			$out .= self::STANDARD_EOL;
		}
		$out .= self::STANDARD_EOL;
		$out .= "class $this->simpleName";
		if($this->superclass !== null){
			$out .= " extends $this->superclass";
		}
		if(count($this->interfaces) > 0){
			$out .= " implements ";
			$out .= implode(", ", $this->interfaces);
		}
		$out .= "{";
		$out .= self::STANDARD_EOL;
		foreach($this->fields as $field => $visibility){
			$out .= "\t";
			$out .= self::visibilityToString($visibility);
			$out .= " \$$field;";
			$out .= self::STANDARD_EOL;
		}
		foreach($this->functions as $fx){
			$out .= "\t";
			$out .= $fx->toString();
			$out .= "\n";
		}
		$out .= "}";
		$out .= self::STANDARD_EOL;
		return $out;
	}
	public static function visibilityToString($visibility){
		switch($visibility){
			case \T_PRIVATE:
				return "private";
			case \T_PROTECTED:
				return "protected";
			case \T_PUBLIC:
				return "public";
		}
		throw new \RuntimeException("Unknown visibility $visibility");
	}
}
