<?php
header("Content-Type:text/html;charset=utf-8");
/* 打开图片 */
	//1.配置图片路径（想要操作的图片的路径）
	$src = '001.jpg';
	//2.获取图片信息（通过GD库提供的方法得到你想要处理图片的基本信息）
	$info = getimagesize($src);
	//3.通过图像的编号获得图像的类型
	$type = image_type_to_extension($info[2], false);
	//4.在内存中创建一个和图像类型一样的图像
	$fun = "imagecreatefrom{$type}";
	//5.把图像复制到内存中
	$image = $fun($src);

/* 操作图片 */
	//1.设置字体的路径
	$font = 'msyh.ttf';
	//2.填写水印的内容
	$content = '你好，慕课';
	//3.设置字体的颜色RGB和透明度 参数1 内存中的图片 2 red 3 green 4 blue
	// $color = imagecolorallocate($image, 255, 255, 255, 50);
	$color = imagecolorallocate($image, 255, 255, 255);
	//4.写入文字
	imagettftext($image, 20, 0, 20, 30, $color, $font, $content);

/* 输出图片 */
	//浏览器输出
	header("Content-Type:", $info['mime']);
	$func = "image{$type}";
	$func($image);
	//保存图片
	$func($image, 'newimage.' . $type);

/* 销毁图片 */
	imagedestroy($image);