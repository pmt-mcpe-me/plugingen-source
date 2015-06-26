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

class GeneratedFunctionContainer{
	/** @var int */
	public $visibility = T_PUBLIC;
	public $name;
	/** @var string[] */
	public $params = [];
	/** @var string */
	public $code = "";
	public function toString(){
		$out = ClassGenerator::visibilityToString($this->visibility);
		$out .= " function $this->name(";
		$out .= implode(", ", $this->params);
		$out .= "){";
		$out .= ClassGenerator::STANDARD_EOL;
		$out .= "\t\t";
		$out .= str_replace(ClassGenerator::STANDARD_EOL, ClassGenerator::STANDARD_EOL . "\t\t", $this->code);
		$out .= ClassGenerator::STANDARD_EOL . "\t}";
		return $out;
	}
}
