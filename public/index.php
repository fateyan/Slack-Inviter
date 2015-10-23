<?php
session_start();
require '../vendor/autoload.php';
/**
 * Config
 */
$dotenv = new Dotenv\Dotenv(realpath('../'));
$dotenv->load();
$config = [];
//It can be found at https://api.slack.com/web
$config['token']                = $_SERVER['SLACK_TOKEN'];
$config['domain']               = $_SERVER['SLACK_DOMAIN'];
$config['channels']             = (empty($_SERVER['SLACK_CHANNELS'])) ? null : trim($_SERVER['SLACK_CHANNELS']);
//Messages on page
$config['message']['header']    = $_SERVER['SLACK_HEADER'];
$config['message']['subheader'] = $_SERVER['SLACK_SUB_HEADER'];
$config['message']['succeed']   = (empty($_SERVER['SLACK_INVITE_SUCCEED'])) ? 'Invitation is sended to your email, check it plz.' : $_SERVER['SLACK_INVITE_SUCCEED'];
$config['message']['fail']      = (empty($_SERVER['SLACK_INVITE_FAIL'])) ? 'Oops! It has some problems.' : $_SERVER['SLACK_INVITE_FAIL'];
//html title
$config['title']                = $_SERVER['SLACK_TITLE'];

define('BASE_PATH', realpath('../') . '/');

$route = empty($_GET['route']) ? 'index' : $_GET['route'];
$inviter = new \Slack\Inviter($config);

$whiteList = ['index', 'send'];
if( in_array($route, $whiteList) ) {
    $inviter->$route();
} else {
    $inviter->index();
}
