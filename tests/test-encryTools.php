<?php

require_once '../vendor/autoload.php';

use phpTools\EncryptTools;

######################################### 对称加密 #######################################
// 3des key要24位，不够的话程序会自动补零
$s3desKey = 'aaaassssbbbggggjjjkkkeee';
$data = 'hello word';
$result['原文'] = $data;
$result['3des-秘钥长度'] = strlen($s3desKey);
$result['3des-加密结果'] = $encryFor3des = EncryptTools::encrypt($data, EncryptTools::STD3DES, $s3desKey);
$result['3des-解密结果'] = EncryptTools::decrypt($encryFor3des, EncryptTools::STD3DES, $s3desKey);

$aesKey = 'aabbaabbaabbaabb';
$encryForAes = EncryptTools::encrypt($data, EncryptTools::AES, $aesKey);
$result['aes-加密结果'] = $encryForAes;
$result['aes-解密结果'] = EncryptTools::decrypt($encryForAes, EncryptTools::AES, $aesKey);
//print_r($result);
######################################### 对称加密 #######################################

######################################### 非对称加密 #######################################
$publicKey = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCuc3nGxe7Zv2racceAs47TvGZo
B6EA5tIvmz0wIufCj0K6nuZVHss1/SIXEtT4nmr+Zj7yzaaZDT3LNd5Tjzs1G92E
WLl28uI2r/ckk58OxEkLfmtcJKpwB+CMWqLwzeGnpmRC4KYrf+cXjTKc+UXNBQZZ
I8LpLEo1nt6zTKfBIwIDAQAB
-----END PUBLIC KEY-----';
$privateKey = '-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAK5zecbF7tm/atpx
x4CzjtO8ZmgHoQDm0i+bPTAi58KPQrqe5lUeyzX9IhcS1Pieav5mPvLNppkNPcs1
3lOPOzUb3YRYuXby4jav9ySTnw7ESQt+a1wkqnAH4IxaovDN4aemZELgpit/5xeN
Mpz5Rc0FBlkjwuksSjWe3rNMp8EjAgMBAAECgYEArP4MC4YqZjnAn2BnAwSMJQHV
12GBUmCSm+zoj3x9sNzZwjBinpRL1XzwukrNcMG/vgjscWBnzaxo08PWdaw6e7u0
26z+FJeeIZ6BiTjWDP1J7HPrfCOQGbDm6d4DoSn0JfX47cD/KXSpQpEP0eOz6yxX
eRJ2VQgDCBT+5whWBCECQQDXMNjXYwsymo3z/69py9r1B1In++OlJDiSH+mv0+M/
fAxQYIQh4ggPdHJ6M1t4LYWT2gijQCzpNTNzAiMopQyzAkEAz4jIcVFvg59T0eQm
La8tAWDoOcdNG8PR1ZrXJACDDuHU2suR/TWlhZMSIbNJOhK3rr03tJedYcF8nXZP
oO2R0QJBAJ4FktboNorckC2Dr06jkpCo5Z3TDWJx7NDxemvRz2kJMQm9NoqjL4QZ
4Q73s83Wr+bZD8rCD7jZhoSIJ0Vrnp0CQCQg6swXYjNmvD/Q2PihA1O3HBZa5MiN
mWz3LLbew/IGTHjecYbEHRGY3dIyFPBgK8vmstjkgAhxl5EN9KTOVtECQGPQhaNj
LMGh+3IzuMiFUFWr4t0uLBqp4ISEcB3E1bMfctdK3VXgsbJbAGzwj+AuWMApUy4X
3OwheU/1Lk2dEB8=
-----END PRIVATE KEY-----
';
$appKey = 'app_key';
$secretKey = 'secret_key';
$url = 'http://127.0.0.1/encrypt/server.php?';
$params['appKey'] = $appKey;
$params['orderId'] = 100;
$params['name'] = 'zhangsan';
$params['password'] = '123456';
$params['time'] = time();
$queryString = http_build_query($params);
$sign = EncryptTools::getSign($params, $secretKey);
$queryString .= "&sign=" . $sign;

$encrypt = '';
EncryptTools::rsaEncrypt($queryString, $encrypt, $publicKey);
$encrypt = urlencode($encrypt);
$url .= "q=" . $encrypt;

$decrypt = '';
$queryStr = parse_url($url)['query'];
parse_str($queryStr, $queryArr);
EncryptTools::rsaDecrypt($queryArr['q'], $decrypt, $privateKey);
parse_str($decrypt, $params);
$paramSign = $params['sign'];
unset($params['sign']);
$sign = EncryptTools::getSign($params, $secretKey);
if ($sign != $paramSign) {
    echo 'error.';
} else {
    echo 'success.';
}
######################################### 非对称加密 #######################################