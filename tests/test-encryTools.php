<?php
require_once '../vendor/autoload.php';
use phpTools\EncryptTools;
// 3des key要24位，不够的话程序会自动补零
$s3desKey='aaaassssbbbggggjjjkkkeee';
$data='hello word';
$result['原文'] = $data;
$result['3des-秘钥长度'] = strlen($s3desKey);
$result['3des-加密结果'] = $encryFor3des = EncryptTools::encrypt($data,EncryptTools::STD3DES,$s3desKey);
$result['3des-解密结果'] = EncryptTools::decrypt($encryFor3des,EncryptTools::STD3DES,$s3desKey);

$aesKey='aabbaabbaabbaabb';

$encryForAes = EncryptTools::encrypt($data,EncryptTools::AES,$aesKey);
$result['aes-加密结果']  =$encryForAes;
$result['aes-解密结果']  =EncryptTools::decrypt($encryForAes,EncryptTools::AES,$aesKey);
print_r($result);
/*
 Array
(
    [原文] => hello word
    [3des-秘钥长度] => 24
    [3des-加密结果] => 0nAIBmJn6RCC5SOuw8Lw9Q==
    [3des-解密结果] => hello word
    [aes-加密结果] => K/kde9e9lZ1/KtFmikpRZQ==
    [aes-解密结果] => hello word
)
 */