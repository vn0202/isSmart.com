<?php 
function get_list_page(){
    $result= db_fetch_array("SELECT * FROM `tbl_page` WHERE `is_garbage`='0'");
    return $result;
}
function is_title(){
    global $errors;
    if(empty($_POST['page_title'])){
        $errors['page_title']= " Bạn nên đặt chủ đề trang";
    }

}
function is_slug(){
    global $errors;
    if(empty($_POST['slug'])){
        $errors['slug']= " Bạn nên đặt link thân thiện cho trang";
    }
}
function is_content(){
    global $errors;
    if(empty($_POST['page_content'])){
        $errors['page_content']= " Bạn cần cung cấp nội dung trang";
    }
}

function get_number_posted_page(){
    $result= db_fetch_array("SELECT *FROM `tbl_page` WHERE `status`='1' AND `is_garbage`='0' ");
    return count($result);
}
function get_number_unconfirm_page(){
    $result= db_fetch_array("SELECT *FROM `tbl_page` WHERE `status`='0' AND `is_garbage`='0' ");
    return count($result);
}
function get_number_garbage(){
    $result= db_fetch_array("SELECT *FROM `tbl_page` WHERE `is_garbage`='1' ");
    return count($result);

}
function  get_status($status)
{
    if ($status == 1) {
        echo " Hoạt động";
    } else {
        echo " Không hoạt động";
    }
}
function get_creator($id)
{
    $admin = db_fetch_row("SELECT*FROM `tbl_admin` WHERE `id`={$id}");
    echo $admin['username'];
}
function get_list_garbage(){
    $result= db_fetch_array("SELECT *FROM `tbl_page` WHERE `is_garbage`='1'");
    return $result;
}
function get_list_unconfirm(){
    $result= db_fetch_array("SELECT * FROM `tbl_page` WHERE `status`='0' AND `is_garbage`='0'");
    return $result;
}
function get_role($id){
    $result = db_fetch_row("SELECT `role` FROM `tbl_admin` WHERE `id`={$id}");
    return $result['role'];
}
function get_posted_page(){
    $result= db_fetch_array("SELECT * FROM `tbl_page` WHERE `status`='1' AND `is_garbage`='0'");
    return $result;
}
