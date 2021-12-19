<?php

require '/var/www/domain/DBSession.php';

$_SESSION['userinfo'] = array(
    'name' => 'napi',
);

var_dump($_SESSION['userinfo']);
