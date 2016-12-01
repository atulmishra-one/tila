<?php
include('inc/config.php');
$config = new config;
include 'inc/func.php';



include('url.php');
include('controller.php');
include('model.php');
include('catelog.php');
include('load.php');
include('mysqli.php');

$catelog = new catelog();
$catelog->set('config', $config);
$catelog->set('config_item', $config->config);



$url = new url($catelog);
$catelog->set('url', $url);
$url->parse();



$load = new load($catelog);
$catelog->set('load', $load);


$db = new MyDatabase($catelog);
$catelog->set('db', $db);

//print_r($catelog);
 


if (is_array($url->uri))
    if (count($url->uri) > 0)
        $parms = $url->uri;
    else
        $parms = array();
else
    $parms = array();

if( is_object( $url->obj ) ) {
	if( method_exists($url->obj, $url->action ) )
	call_user_func_array(array($url->obj, $url->action), $parms);
}



