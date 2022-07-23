<?php 
session_start();
ob_start();
if(!isset($_SESSION['cart']))
{
    $_SESSION['cart']['buy']=[];
    $_SESSION['cart']['checkout']=[];
    
}
require APPPATH. DIRECTORY_SEPARATOR ."modules".DIRECTORY_SEPARATOR. get_module(). DIRECTORY_SEPARATOR . "controllers". DIRECTORY_SEPARATOR. get_controller()."Controller.php";
$action = get_action();
$action= $action."Action";

call_function(['construct', $action]);


?>