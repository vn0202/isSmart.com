<?php 

defined("APPPATH") OR exit(" Can't access this page");

/**
 *  ================= SET SOME FILE WHEN APP Start ==================
 * 
 */
require CONFIGPATH. DIRECTORY_SEPARATOR. "autoload.php";
require CONFIGPATH . DIRECTORY_SEPARATOR . "database.php";
require CONFIGPATH. DIRECTORY_SEPARATOR . "default.php";
require CONFIGPATH . DIRECTORY_SEPARATOR. "email.php";
require COREPATH.DIRECTORY_SEPARATOR . "base.php";


// check and autoload 
if(is_array($autoload))
{
    foreach($autoload as $type=>$lists){
        if(!empty($lists)){
            foreach($lists as $list){
                load($type,$list);
            }
        }
    }
}
// connect to database
 $conn= db_connect();
require COREPATH. DIRECTORY_SEPARATOR . "router.php";

?>