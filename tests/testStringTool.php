<?php
require_once '../vendor/autoload.php';
$str='hello word';
$len = \phpTools\StringTools::strlen($str);
echo 'length= '.$len.PHP_EOL;