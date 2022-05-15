<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'SRRH');
defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'includes');


require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."functions.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."user.php"); 
require_once(LIB_PATH.DS."accomodation.php");
require_once(LIB_PATH.DS."guest.php"); 
require_once(LIB_PATH.DS."reserve.php");  
//Load Core objects

require_once(LIB_PATH.DS."database.php");

//load database-related classes
?>