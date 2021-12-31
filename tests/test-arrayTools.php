<?php

require_once '../vendor/autoload.php';

use phpTools\ArrayTools;

$json = '[[{"id":17876,"is_new":1,"lesson_id":2857,"child_id":2858},{"id":17876,"is_new":1,"lesson_id":2857,"child_id":2858}],[{"id":17877,"is_new":1,"lesson_id":2859,"child_id":2862}],[{"id":17878,"is_new":1,"lesson_id":2860,"child_id":2863}],[{"id":17879,"is_new":1,"lesson_id":2861,"child_id":2864}],[{"id":17951,"is_new":1,"lesson_id":0,"child_id":0}]]';
$arr = json_decode($json, true);
//print_r($arr);

$arrNew = ArrayTools::arrayFilterByEmptyKey($arr, 'lesson_id');
//print_r($arrNew);