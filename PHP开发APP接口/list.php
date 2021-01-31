<?php
require_once "./response.php";
require_once "./db.php";
require_once "./file.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 1;
if(!is_numeric($page) || !is_numeric($pageSize)){
	return Response::show(401, "数据不合法");
}

$offset = ($page-1) * $pageSize;
$sql = "select top ".$pageSize." * from columnInfo order by sort desc";

$cache = new File();
$arr = array();
if(!$arr = $cache->cacheData('test1'.$page.'-'.$pageSize)){
	try{
		$connect = Db::getInstance()->connect();
	} catch(Exception $e){
		return Response::show(403, "数据库连接失败");
	}
	$result = sqlsrv_query($connect, $sql);
	while($row = sqlsrv_fetch_array($result)){
		$arr[] = $row['Lmname'];
	}

	if($arr){
		$cache->cacheData('test1'.$page.'-'.$pageSize, $arr, 1200);
	}
}

if($arr){
	return Response::show(200, "数据获取成功", $arr);
} else{
	return Response::show(400, "数据获取失败", $arr);
}