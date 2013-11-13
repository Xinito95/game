<?php
/*
* This document is made by Tim and Arjan
*
* Here we go...
*
*/

//put here the directory of the application map
$config['application'] = '../application';

//put here the directory of the system map
$config['system'] = '../system';

//---------------------------------------------------------
/*
* Don't make changes below
*
*/


//include the system directory
if(!empty($config['system'])){
	require_once(rtrim($config['system'],'/').'/core/start.php');
}
else {
	echo 'System directory was not found!';
}

//include the start config

?>