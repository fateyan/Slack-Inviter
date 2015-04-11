<?php
session_start();
require '../vendor/autoload.php';
/**
 * Config
 */
$config = array();
//---put your token there, it can be found on https://api.slack.com/web ---//
$config['token']  = $_SERVER['SLACK_TOKEN'];

$config['domain'] = $_SERVER['SLACK_DOMAIN'];
//---put your channel id there (divide by comma[,]), it can be found on https://api.slack.com/methods/channel.list/test ---//
$config['channels'] = trim($_SERVER['SLACK_CHANNELS']);
//---The welcome message on div---//
$config['header'] = $_SERVER['SLACK_HEADER'];
$config['subheader'] = $_SERVER['SLACK_SUB_HEADER'];
//---html title---//
$config['title'] = 'Join our Slack !';

define('BASE_PATH', realpath('../') . '/');

$method = empty($_GET['method']) ? 'index' : $_GET['method'];
$object = new \Fateyan\SlackInviter($config);

if( method_exists($object, $method) ) {
    $object->$method();
} else {
    $object->index();
}

