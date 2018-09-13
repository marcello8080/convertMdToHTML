<?php

class Logs
{
	private $file = 'log/convert.log';
	public $handle;
	
	function __construct(){
		if (!file_exists($this->file)) { 
			$this->handle = fopen($this->file, 'w');
		}
		$this->handle = fopen($this->file, 'a');
	}
	
	function __destruct(){
		fclose($this->handle);
	}
	
	function writeNewLog($text){
		fwrite($this->handle,  date("M d H:i:s") . " - ");
		fwrite($this->handle, $text . " " . PHP_EOL);
	}
}

?>