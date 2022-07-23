<?php

/**
 * ================== SET BASIC FUNCTION ===========================
 * 
 */
// get header
function get_header($name = "",$data=[])
{

    if (empty($name)) {
        $name = "header";
    } else {
        $name = "header-{$name}";
    }


    $path = LAYOUTPATH . DIRECTORY_SEPARATOR . $name . ".php";
    if (file_exists($path)) {

        if(is_array($data))
        {
            foreach($data as $key=>$val)
            {
                $$key=$val;
            }
        }
        require $path;
    } else {
        echo "Can't find {$path}";
    }
}
//get_footer
function get_footer($name = "")
{
    if (empty($name)) {
        $name = "footer";
    } else {
        $name = "footer-{$name}";
    }
    $path = LAYOUTPATH . DIRECTORY_SEPARATOR . $name . ".php";
    if (file_exists($path)) {

        require $path;
    } else {
        echo "Can't find {$path}";
    }
}

function get_sibar($name = "")
{
    global $data;
    
    foreach($data as $key=>$val){
        $$key = $val;
    }
    if (empty($name)) {
        $name = "sibar";
    } else {
        $name = "sibar-{$name}";
    }
    $path = LAYOUTPATH . DIRECTORY_SEPARATOR . $name . ".php";
    if (file_exists($path)) {
        require $path;
    } else {
        echo " Can't find {$path}";
    }
}

function get_module()
{
    global $config;
    $module = isset($_GET['mod']) ? $_GET['mod'] : $config['default_module'];
    return $module;
}
function get_action()
{
    global $config;
    $action = isset($_GET['action']) ? $_GET['action'] : $config['default_action'];
    return $action;
}
function get_controller()
{
    global $config;
    $controller = isset($_GET['controller']) ? $_GET['controller'] : $config['default_controller'];
    return $controller;
}
/** 
 * ================= LOAD =========================
 * 
 * This function is used to include file when you need
 * explain:
 * $type: name of parent folder (libraries, helper);
 * $name: name of file you want
 */
function load($type, $name)
{
    if ($type == "lib") {
        $path = LIBPATH . DIRECTORY_SEPARATOR . $name . ".php";
    }
    if ($type == 'helper') {
        $path = HELPERPATH . DIRECTORY_SEPARATOR . $name . ".php";
    }
    if(file_exists($path)){
        require $path;
    }
    else{
        echo " Can't find {$path}";

    }
}

function load_view($name, $data_send=[]){
    global $data;
    $data= $data_send;
$path = MODULESPATH . DIRECTORY_SEPARATOR . get_module(). DIRECTORY_SEPARATOR. "views". DIRECTORY_SEPARATOR. $name."View.php" ;
if(file_exists($path)){
    if(is_array($data) && !empty($data)){
        foreach ($data as $key=>$val){
            $$key=$val;
        }
    }

    require $path;
}
else{
    echo " Can't find {$path}";
}
}
function load_model($name){
 $path = MODULESPATH. DIRECTORY_SEPARATOR . get_module(). DIRECTORY_SEPARATOR. "models". DIRECTORY_SEPARATOR. $name."Model.php";
 if(file_exists($path)){
     require $path;
 }
 else{
     echo " Can't find {$path}";
 }
}

function call_function($lists){
    if(is_array($lists)&& !empty($lists)){
        foreach($lists as $key=>$f){
            if(function_exists($f())){
                $f();
            }
        }
        
    }
}