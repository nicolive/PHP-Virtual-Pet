<?php

// the facebook client library
include_once '../php/facebook.php';
// some basic library functions
include_once 'lib.php';
// this defines some of your basic setup
include_once 'config.php';
require('db.class.php');
require('tamagotchi.class.php');

// load smarty
define('SMARTY_DIR', $_SERVER['DOCUMENT_ROOT'] . '/bigfatpig/lib/' );
 require_once(SMARTY_DIR . 'Smarty.class.php');

 $smarty = new Smarty;
 $smarty->config_dir = SMARTY_DIR;
 $smarty->template_dir = './templates';
 $smarty->compile_dir = './templates/compile';
 $smarty->compile_check = TRUE;
 $smarty->debugging = FALSE;

// initialize facebook
$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();

// special case: show invite form
if($_GET[invite]==1) {
	include("invite.php");
	exit;
}

// special case: show canvas
if(!$start) {
	echo '<fb:iframe src="http://YOURURL/bigfatpig/?start=1" frameborder=0 width=760 height=600></fb:iframe>';
	exit;
}

// get facebook user id, initialize action
$_GET[pet] = $user;
$path = split("/",$_SERVER['HTTP_REFERER']);
$path[4] = split("\?",$path[5]);
$action = $path[4][0];

/* get friends which use the app
$fql = 'SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1='.$user.') AND is_app_user = 1';
$_friends = $facebook->api_client->fql_query($fql);
*/ 

/***************** start the app ********************************************************************************/

$tamagotchi = new Tamagotchi($_GET[pet]);

if($action == "restart") {
	$tamagotchi->restart($_GET[pet]);
}


$smarty->assign('PETID',$_GET[pet]);
$smarty->display('header.tpl');

if($tamagotchi->error == "noaccount") {
	$smarty->display('noaccount.tpl');
	exit;
}

$tamagotchi->Calculate();

if($action == "shower") {
	$showered = $tamagotchi->actionShower();
	$smarty->assign('ACTIONDONE','showered');
	$smarty->assign('ACTIONPOINTS',$showered);
	$facebook->api_client->notifications_send($_GET[pet], 'Du hast Dein Schwein geduscht! Yeah.', 'user_to_user');
}

if($action == "feed") {
	$eaten = $tamagotchi->actionFeed();
	$smarty->assign('ACTIONDONE','eaten');
	$smarty->assign('ACTIONPOINTS',$eaten);
	$tokens = array('variable1' => 'value1');
	$facebook->api_client->feed_publishUserAction('59887462220', $tokens);
}

if($action == "doc") {
	$doc = $tamagotchi->actionDoctor();
	$smarty->assign('ACTIONDONE','doc');
	$smarty->assign('ACTIONPOINTS',$doc);
}

if(ereg("play",$action)) {
	$number = split("-",$action);			
	$playResult = $tamagotchi->actionPlay($number[1]);
	$doc = $tamagotchi->actionDoctor();
	$smarty->assign('ACTIONDONE','played');
	$smarty->assign('ACTIONPOINTS',$playResult);
}

$tamagotchi->Calculate();
$info = $tamagotchi->getData();
$age = $tamagotchi->calculateAgeSize();

// calculate image
$age_minutes_awake = $age[minutes] - $tamagotchi->getNightMinsLifetime();
$step = 1;
if($age_minutes_awake > 130) $step = 2;
if($age_minutes_awake > 900) $step = 3;
if($age_minutes_awake > 1700) $step = 4;
if($age_minutes_awake > 2500) $step = 5;
if($age_minutes_awake > 3300) $step = 6;
if($age_minutes_awake > 3800) $step = 7;
if($age_minutes_awake > 4400) $step = 8;
if($age_minutes_awake > 5100) $step = 9;
if($age_minutes_awake > 5700) $step = 10;
if($age_minutes_awake > 6500) $step = 11;
if($age_minutes_awake > 7200) $step = 12;
if($age_minutes_awake > 8000) $step = 13;

$age[nice_days] = floor($age[minutes] / (24* 60));
$age[nice_hours] = floor($age[minutes]/60 - $age[nice_days] * 24);
$age[nice_minutes] = floor($age[minutes] - $age[nice_hours] * 60 - $age[nice_days] * 24 * 60);

$smarty->assign('PETINFO',$info);
$smarty->assign('STEP',$step);
$smarty->assign('AGE',$age);

$smarty->display('index.tpl');

$smarty->display('footer.tpl');

?>
