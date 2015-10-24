<?php
session_start();
error_reporting(0);
ini_set('display_errors', 'Off');
require '../vendor/autoload.php';

// Loading dotenv
$dotenv = new Dotenv\Dotenv(realpath(__DIR__ . '/..'));
$dotenv->overload();

/**
 * Config
 */
$config = [];
//It can be found at https://api.slack.com/web
$config['token']                = $_SERVER['SLACK_TOKEN'];
$config['domain']               = $_SERVER['SLACK_DOMAIN'];
$config['channels']             = (empty($_SERVER['SLACK_CHANNELS'])) ? null : trim($_SERVER['SLACK_CHANNELS']);
//Messages on page
$config['message']['header']    = $_SERVER['SLACK_HEADER'];
$config['message']['subheader'] = $_SERVER['SLACK_SUB_HEADER'];
$config['message']['succeed']   = (empty($_SERVER['SLACK_INVITE_SUCCEED'])) ? 'An invitation has been sent to your email, please check it.' : $_SERVER['SLACK_INVITE_SUCCEED'];
$config['message']['fail']      = (empty($_SERVER['SLACK_INVITE_FAIL'])) ? 'Oops! An error occured.' : $_SERVER['SLACK_INVITE_FAIL'];
//html title
$config['title']                = $_SERVER['SLACK_TITLE'];
//Google reCAPTCHA
$config['recaptcha']['sitekey'] = $_SERVER['RECAPTCHA_SITEKEY'];
$config['recaptcha']['secret'] = $_SERVER['RECAPTCHA_SECRET'];

define('BASE_PATH', realpath('../') . '/');

$route = empty($_GET['route']) ? 'index' : $_GET['route'];
$inviter = new \Slack\Inviter($config);

$whiteList = ['index', 'send'];
if( in_array($route, $whiteList) ) {
    $inviter->$route();
} else {
    $inviter->index();
}
