<?php
require 'vendor/autoload.php';
require 'config.inc.php';

$method = empty($_GET['method']) ? 'index' : $_GET['method'];
$object = new Fateyan\SlackInviter($config);

if( method_exists($object, $method) ) {
    $object->$method();
} else {
    $object->index();
}

