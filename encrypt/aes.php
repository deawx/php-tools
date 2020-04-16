<?php

//$a = openssl_get_cipher_methods();
//print_r($a);

$data = "I'm Shershon, I'm working hard to get a good life!";
$id = uniqid();
$key = md5($id);
$iv = substr($key, 0, 16);
$method = 'aes-128-cbc';

$secret = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
var_dump($secret);
$plain = openssl_decrypt($secret, $method, $key, OPENSSL_RAW_DATA, $iv);
var_dump($plain);