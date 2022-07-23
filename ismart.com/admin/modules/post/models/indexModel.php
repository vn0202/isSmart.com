<?php
function get_list_parent_cat()
{
    $list = db_fetch_array("SELECT*FROM `tbl_post_cat_parent`");
    return $list;
}
function get_list_post_cat($id)
{
    $list = db_fetch_array("SELECT *FROM `tbl_sub_cat` WHERE `cat_parent`={$id}");

    return $list;
}
function get_sub($scope)
{

    if ($scope == 1) {
        echo "--Trong nước";
    } elseif ($scope == 2) {
        echo "-- Thế giới";
    }
}
function get_role($id){
    $result = db_fetch_row("SELECT `role` FROM `tbl_admin` WHERE `id`={$id}");
    return $result['role'];
}
function get_status_parent($cat_id)
{
    $list_post_cat = get_list_post_cat($cat_id);
    foreach ($list_post_cat as $cat) {
        if ($cat['status'] == 1) {
            return 1;
        }
    }
    return 0;
}
function is_exist_id($tbl_name, $id)
{
    $mysql = db_query("SELECT *FROM `$tbl_name` WHERE `cat_id`={$id}");
    if (mysqli_num_rows($mysql) > 0) {
        return true;
    }
    return false;
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

function get_list_cat_by_title()
{
    $list = db_fetch_array("SELECT * FROM `tbl_sub_cat`");
    return $list;
}
function is_exist_title($title, $index, $array)
{
    $lenArray = count($array);
    if ($index < $lenArray) {
        $pos = $index - 1;
        while ($pos > 0) {
            if ($array[$pos] == $title){
                return 1;
            }
            $pos--;
        }
    }
    return 0;
}
function is_exist_cat($cat_parent,$scope){
    $result = db_query("SELECT*FROM `tbl_sub_cat` WHERE `cat_title`=\"$cat_parent\" AND `scope`={$scope}");
    if(mysqli_num_rows($result)>0){
        return true;
    }
    return false;

}
function get_list_post(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `is_garbage`!='0'");
    return $result;
}
function get_number_confirm(){
    $result = db_fetch_array("SELECT * FROM `tbl_post` WHERE `status`='1' AND `is_garbage`!='0'");
    return count($result);
}
function get_number_unconfirm(){
    $result= db_fetch_array("SELECT * FROM `tbl_post` WHERE `status`='0' AnD `is_garbage`!='0'");
    return count($result);
}
function get_number_garbage(){
    $result= db_fetch_array("SELECT * FROM `tbl_post` WHERE `is_garbage`='0'");
    return count($result);
}
function get_cat($id){
$result = db_fetch_row("SELECT `cat_title` FROM `tbl_sub_cat` WHERE `cat_id`={$id}");
return $result['cat_title'];
}
function get_sub_cat(){
    return db_fetch_array("SELECT *FROM `tbl_sub_cat`");
}
function is_slug(){
    global $errors;
    if(empty($_POST['slug'])){
        $errors['slug']="Bạn cần thiết lập link thân thiện";
    }
}
//update and add post
function is_image_post(){
    global $errors;
    if(!isset($_FILES['post_thumb'])){
        $errors['post_thumb']= " Bạn cần chọn ảnh cho bài viết";
    }
    else{
        $file= $_FILES['post_thumb']['name'];
        $extension= pathinfo($file,PATHINFO_EXTENSION);
   
        $extensionSupported =['jpg','webp','png','jpeg'];
        if(!in_array($extension,$extensionSupported)){
$errors['post_thumb']= " Chỉ hỗ trợ định dạng jpg, png,webp,jpeg";
        }
        else{
            $size = $_FILES['post_thumb']['size'];
            if($size > 20*1024*1024){
                $errors['post_thumb']= "kích thước file quá lớn";
            }
        }

    }
    
}

function is_post_title()
{
    global $errors;
    if(empty($_POST['post_title'])){
        $errors['post_title'] = " Bạn cần đặt tiêu đề bài viết";
    }
    else{
        $pattern = "/[^!@#$%^&]+/";
        if(!preg_match($pattern,$_POST['post_title'])){
            $errors= "Tiêu đề chỉ chứa các chữ cái và số";
        }
    }
}
function is_desc(){
    global $errors;
    if(empty($_POST['post_desc'])){
        $errors['post_desc']= "Bạn cần cung cấp mô tả bài viết";
    }
    
}
function is_detail(){
    global $errors;
    if(empty($_POST['post_content'])){
$errors['post_content']=  "Bạn cần cung cấp chi tiết bài viết";
    }
}
function is_parent_cat(){
    global $errors;
    if(empty($_POST['parent_cat'])){
        $errors['parent_cat']= " Bạn cần chọn thư mục cha";
    }
}
function get_list_unconfirm(){
    $result= db_fetch_array("SELECT * FROM `tbl_post` WHERE `status`='0' AND `is_garbage`!=0");
    return $result;
}
function get_list_posted(){
    $result = db_fetch_array("SELECT *FROM `tbl_post` WHERE `status`=1 AND `is_garbage`!=0" );
    return $result;
}
function get_list_garbage(){
    $result= db_fetch_array("SELECT *FROM `tbl_post` WHERE `is_garbage`='0'");
    return $result;
}
function delete_garbage_thump(){

}
function get_list_post_by_page($currentPage){
    global $numberPerPage;
    $offset= ($currentPage-1)*$numberPerPage;
    $result= db_fetch_array( "SELECT * FROM `tbl_post` WHERE `is_garbage`!='0' AND `status`=1 LIMIT $offset,$numberPerPage ");
    return $result;

}