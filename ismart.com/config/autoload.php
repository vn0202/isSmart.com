<?php 
defined("APPPATH") or exit("Can't access thí page");
/**
 * ===================== AUTO LOADER ========================
 * 
 * It is used to automatically load the neccessary file when app start
 * 
 * You when pass the file and parent's file in to array
 * 
 * example: If you want include database.php and it is child of libraries
 * $autoload['lib']=['database'];
 */
$autoload['lib']= ['database',"url",'email'];
/**
 * example 2: If you want to include data.php in helper 
 */
$autoload['helper']=['data','string'];

?>