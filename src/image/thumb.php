<?php
header("Content-Type:text/html;charset=utf-8");
/* 打开图片 */
	//1.配置图片路径
	$src = '001.jpg';
	//2.
	$info = getimagesize($src);
	//3.
	$type = image_type_to_extension($info[2], false);
	//4.
	$fun = "imagecreatefrom{$type}";
	//5.
	$image = $fun($src);

/* 操作图片 */
	//1.在内存中建立一个宽300，高200的真色彩图片
	$image_thumb = imagecreatetruecolor(300, 200);
	//2.核心步骤，将原图复制到新建的真色彩的图片上，并且按照一定的比例压缩
	imagecopyresampled($image_thumb, $image, 0, 0, 0, 0, 300, 200, $info[0], $info[1]);
	//3.销毁原始图片
	imagedestroy($image);

/* 输出图片 */
	//输出到浏览器
	header("Content-Type:", $info['mime']);
	$funs = "image{$type}";
	$funs($image_thumb);
	//保存到电脑
	$funs($image_thumb, 'thumb_image.' . $type);

/* 销毁图片 */
	imagedestroy($image_thumb);