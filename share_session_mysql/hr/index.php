<?php

require '/var/www/domain/DBSession.php';

$_SESSION['userinfo'] = array(
    'name' => 'hr',
);

var_dump($_SESSION['userinfo']);
