<?php 
/**
 * ===================== SET SOME IMPORTAND ====================
 * 
 */
// set path app
$app_path= dirname(__FILE__);
define("APPPATH", $app_path);
/**
 * 
 * ======================= set path to core ===============
 * 
 */
$core_folder= "core";
define("COREPATH", APPPATH. DIRECTORY_SEPARATOR. $core_folder);
/**
 * 
 * ======================= set path to libraries ===============
 * 
 */
$lib_path= "libraries";
define("LIBPATH",APPPATH . DIRECTORY_SEPARATOR . $lib_path );
/**
 * 
 * ======================= set path to heler ===============
 * 
 */
$helper_path = "helper";
define("HELPERPATH", APPPATH. DIRECTORY_SEPARATOR. $helper_path);
/**
 * 
 * ======================= set path to layout ===============
 * 
 */
$layout_path= "layout";
define("LAYOUTPATH", APPPATH. DIRECTORY_SEPARATOR. $layout_path);
/**
 * 
 * ======================= set path to core ===============
 * 
 */$config_path = "config";
 define("CONFIGPATH", APPPATH . DIRECTORY_SEPARATOR  . $config_path);
/**
 * 
 * ======================= set path to module ===============
 * 
 */
$modules= "modules";
define("MODULESPATH", APPPATH .DIRECTORY_SEPARATOR . $modules);


 require COREPATH. DIRECTORY_SEPARATOR . "appload.php";


?>