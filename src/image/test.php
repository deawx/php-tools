<?php
require 'image.class.php';
$src = '001.jpg';
$source = '002.gif';
$local = array(
	'x' => 50,
	'y' => 400,
);
$content = 'hello,world';
$font_url = 'msyh.ttf';
$size = 20;
$color = array(
	0 => 255,
	1 => 0,
	2 => 0,
);
$local2 = array(
	'x' => 250,
	'y' => 60,
);
$angle = 10;
$alpha = 50;
$image = new Image($src);
$image->imageMark($source, $local, $alpha);
$image->thumb(400,300);
$image->fontMark($content, $font_url, $size, $color, $local2, $angle);
$image->show(); 
$image->show(); 
// $image->save('fontMark'); 