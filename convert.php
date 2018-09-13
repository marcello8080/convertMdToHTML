<?php

//$argv[1] = 'include/Template.md';
//$argv[2] = 'include/htmlfile.html';
include ("include/Parsedown.php");
include ("include/Logs.php");
error_reporting(0);

// create log session
$log = new Logs();
$log->writeNewLog("Convert.php called");

$document = '';
if(isset ($argv[1]) && $argv[1] != ''){
	$log->writeNewLog("Origin: " . $argv[1] . " - Destination:" . $argv[2]);
	
	if(!isset($argv[2]) || $argv[2] == ''){
		echo 'Missing destination file - use default.html';
		$log->writeNewLog("Missing destination file - use default.html<br/>");
		$argv[2] = 'default.html';
	}
	
	//open origin file
	$handle = fopen($argv[1], "r");
	if ($handle) {
		while (($line = fgets($handle)) !== false) {
			// process the line read.
			$document .= $line;
		}

		fclose($handle);
		
		// create html file
		$Parsedown = new Parsedown();
		$html_file = $Parsedown->text($document);
		
		// write html file
		if (!file_exists($argv[2])) { 
			$handle = fopen($argv[2], 'w+');
			fwrite($handle, $html_file); 
			fclose($handle);
			echo "Success " . $argv[2] . " created with success";
			$log->writeNewLog("Success " . $argv[2] . " created with success");
		}
		else{
			// error writing file
			echo 'Destination file alredy existing';
			$log->writeNewLog("Destination file alredy existing");
		}
	}
	else {
		// error opening the file.
		echo 'Origin file not found';
		$log->writeNewLog("Origin file not found");
	}
}
else{
	echo 'Missing origin file';
	$log->writeNewLog("Missing origin file");
}


?>