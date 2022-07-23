<?php 

defined("APPPATH") OR exit (" Can't access this page");
/** 
 * ================ Include necessary file =================
 * 
 */
// include base.php 
require COREPATH. DIRECTORY_SEPARATOR."base.php";
// include config autoload
require CONFIGPATH. DIRECTORY_SEPARATOR . "autoload.php";
// include config database
require CONFIGPATH . DIRECTORY_SEPARATOR . "database.php";
//include config default_path
require CONFIGPATH . DIRECTORY_SEPARATOR ."default_path.php";


// Auto load file when app start
if(is_array($autoload)){
    foreach ($autoload as $type=>$lists){
        if(!empty($lists)){
            foreach($lists as $file){
                load($type, $file);
            }
        }

    }
}

db_connect();

require COREPATH. DIRECTORY_SEPARATOR. "router.php";


?>