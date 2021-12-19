<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

//设置缓存
//$redis->set('Shershon', 123);

//获取缓存
//echo $redis->get('Shershon');
//echo $redis->get('aihao');

//设置缓存有效期
$redis->setex('name', 12, 'txs');


