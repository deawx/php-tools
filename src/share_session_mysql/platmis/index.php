<?php

require '/var/www/domain/DBSession.php';

$_SESSION['userinfo'] = array(
    'name' => 'platmis',
);

var_dump($_SESSION['userinfo']);
