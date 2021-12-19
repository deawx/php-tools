<?php

$private = '-----BEGIN PRIVATE KEY-----
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
$public = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCuc3nGxe7Zv2racceAs47TvGZo
B6EA5tIvmz0wIufCj0K6nuZVHss1/SIXEtT4nmr+Zj7yzaaZDT3LNd5Tjzs1G92E
WLl28uI2r/ckk58OxEkLfmtcJKpwB+CMWqLwzeGnpmRC4KYrf+cXjTKc+UXNBQZZ
I8LpLEo1nt6zTKfBIwIDAQAB
-----END PUBLIC KEY-----';

$content = "hello, I'm Shershon, nice to meet you!";

$encrypt = '';
$flag = openssl_private_encrypt($content, $encrypt, $private);
//var_dump($flag);
//var_dump($encrypt);

$decrypt = '';
$flag = openssl_public_decrypt($encrypt, $decrypt, $public);
var_dump($flag);
var_dump($decrypt);