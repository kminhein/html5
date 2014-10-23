<?php
define('SITE_COMMON_DEFINE','tsg-');

$dir = "css/site/";
$files = glob($dir."*.css");
foreach ($files as $file) { 
	unset($fileChk);
	$fileChk = explode('tsg-',$file); 
	if(count($fileChk)>1) {
		$file.$newFile = str_replace('tsg-',SITE_COMMON_DEFINE,$file);
		rename($file,$newFile);
	}
}
die;
?>