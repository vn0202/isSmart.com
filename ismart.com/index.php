<?php
/**
 * ================== SET DEFAULT ===================
 * 
 */
$app_path = dirname(__FILE__);
define("APPPATH", $app_path);
// set default path to core folder
$core_folder= "core";
define("COREPATH", APPPATH. DIRECTORY_SEPARATOR. $core_folder);
// set default to libraries folder
$lib_folder= "libraries";
define("LIBPATH", APPPATH. DIRECTORY_SEPARATOR. $lib_folder);
// set default to helper folder
$helper_folder= "helper";
define("HELPERPATH", APPPATH. DIRECTORY_SEPARATOR. $helper_folder);
// set default to config folder
$config_folder= "config";
define("CONFIGPATH", APPPATH . DIRECTORY_SEPARATOR. $config_folder );
// set default to layout folder
$layout = "layout";
define("LAYOUTPATH",APPPATH .DIRECTORY_SEPARATOR. $layout);
//set default path to module
$modules = "modules";
define("MODULESPATH", APPPATH. DIRECTORY_SEPARATOR. $modules);


// redirect to appload
require COREPATH. DIRECTORY_SEPARATOR. "appload.php";

?>