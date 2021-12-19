<?php
header("Content-Type:text/html;charset=utf-8");
/* 打开图片 */
	//1.配置图片路径
	$src = '002.jpg';
	//2.获取图片的基本信息
	$info = getimagesize($src);
	//3.通过图像的编号获取图像的类型
	$type = image_type_to_extension($info[2], false);
	//4.在内存中创建一个和我们图像一样的图像
	$fun = "imagecreatefrom{$type}";
	//5.把要操作的图片复制到内存中
	$image = $fun($src);

/* 操作图片 */
	//1.设置水印的路径
	$imageMark = "2.gif";
	//2.获取水印图片的基本信息
	$info2 = getimagesize($imageMark);
	//3.通过水印的图像编号来获取水印的图片类型
	$type2 = image_type_to_extension($info2[2], false);
	//4.在内存中创建一个和我们水印图像一样的图像类型
	$fun2 = "imagecreatefrom{$type2}";
	//5.把水印图片复制到我们的内存中
	$water = $fun2($imageMark);
	//6.给原始图片添加水印图片
	imagecopymerge($image, $water, 20, 30, 0, 0, $info2[0], $info2[1], 50);
	//7.销毁水印图片
	imagedestroy($water);

/* 输出图片 */
	//在浏览器中输出图片
	header("Content-Type:", $info['mime']);
	$funs = "image{$type}";
	$funs($image);
	//保存图片
	$funs($image, 'imageMark.' . $type);

/* 销毁图片 */
	imagedestroy($image);