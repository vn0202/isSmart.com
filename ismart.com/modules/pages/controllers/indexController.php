<?php
function construct(){
    load_model('index');
}
function indexAction(){
    $pageID= (int)$_GET['id'];
    $page = get_page_by_id($pageID);
    $data['page']= $page;
    load_view('index',$data);
    
    
}
 ?>