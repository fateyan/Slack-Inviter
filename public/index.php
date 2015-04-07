<?php
session_start();
require '../vendor/autoload.php';
/**
 * Config
 */
$config = array();
//---put your token there, it can be found on https://api.slack.com/web ---//
$config['token']  = getenv('SLACK_TOKEN');

$config['domain'] = getenv('SLACK_DOMAIN');
//---put your channel id there (divide by comma[,]), it can be found on https://api.slack.com/methods/channel.list/test ---//
$config['channels'] = trim(getenv('SLACK_CHANNELS'));
//---The welcome message on div---//
$config['welcomeMessage'] = getenv('SLACK_WELCOME_MESSAGE');
//---html title---//
$config['title'] = getenv('SLACK_TITLE');


$method = empty($_GET['method']) ? 'index' : $_GET['method'];
$object = new \Fateyan\SlackInviter($config);

if( method_exists($object, $method) ) {
    $object->$method();
} else {
    $object->index();
}

