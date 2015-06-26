<?php

namespace pg\lib\exe;

interface Statement{
	public function explain();
	public function getPhpCode($tabs);
}
