<?php

$public = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCuc3nGxe7Zv2racceAs47TvGZo
B6EA5tIvmz0wIufCj0K6nuZVHss1/SIXEtT4nmr+Zj7yzaaZDT3LNd5Tjzs1G92E
WLl28uI2r/ckk58OxEkLfmtcJKpwB+CMWqLwzeGnpmRC4KYrf+cXjTKc+UXNBQZZ
I8LpLEo1nt6zTKfBIwIDAQAB
-----END PUBLIC KEY-----';

$appKey = '123';
$secretKey = '456';

$url = 'http://127.0.0.1/encrypt/server.php?';

$params['appKey'] = $appKey;
$params['orderId'] = 1;
$params['name'] = 'Shershon';
$params['password'] = '123456';
$params['time'] = time();

$queryString = http_build_query($params);

$sign = getSign($params, $secretKey);
$queryString .= "&sign=" . $sign;

$encrypt = '';
openssl_public_encrypt($queryString, $encrypt, $public);
$encrypt = urlencode($encrypt);
$url .=  "q=" . $encrypt;
var_dump($url);

function getSign($params, $secretKey) {
    ksort($params);
    $q = http_build_query($params);
    $q .= $secretKey;
    return md5($q);
}
