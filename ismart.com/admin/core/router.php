<?php 
session_start();
ob_start();
/**
 * ================== ROUTER ==============================
 * 
 * This file has function to interactive with controller
 * 
 */

 // check if admin has loggined
 if((!isset($_SESSION['is_login']))&&( get_action()!='login')){
    redirect_to("?mod=admin&action=login");
 }
 
else{

    $request= MODULESPATH. DIRECTORY_SEPARATOR .  get_module(). DIRECTORY_SEPARATOR ."controllers".DIRECTORY_SEPARATOR. get_controller()."Controller.php";
    if(file_exists($request)){
        require $request;
    }
    else{
        echo "Can't find {$request}";
   
    }
    $action= get_action()."Action";
    call_function(['construct',$action]);
 
}
 
?>