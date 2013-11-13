<?php
/*
* Here we start with including all our files
*
* First we're going to read the config files
*/

if(!empty($config['application'])){
	require_once(rtrim($config['application'],'/').'/config/config.php');
}

require_once($config['application'].'/config/database.php');
?>