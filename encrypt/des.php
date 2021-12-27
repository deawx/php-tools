<?php

//$a = openssl_get_cipher_methods();
//print_r($a);

$data = "I'm Shershon, I'm working hard to get a good life!";
$key = uniqid();
$method = 'des-cbc';

$secret = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, '12345678');
var_dump($secret);
$plain = openssl_decrypt($secret, $method, $key, OPENSSL_RAW_DATA, '12345678');
var_dump($plain);

