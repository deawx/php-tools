<?php
// require_once("../test/6.php");
require_once "./file.php";

$data = array(
	'id' =>  1,
	'name' => 'Shershon',
	'type'=>array(4,5,6),
	'test' => array(1,45,67=>array(123, 'adsa'))
);

// Response::show(200, 'success', $arr, 'json');
// Response::show(200, 'success', $arr, 'xml');
//Response::show(200, 'success', $arr, 'array');

$file = new File();
if($file->cacheData('file_cache', null)){
	// var_dump($file->cacheData('file_cache'));
	// exit;
	echo 'success';
} else{
	echo 'error';
}