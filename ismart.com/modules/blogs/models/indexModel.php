<?php 
function get_list_post(){
    $result = db_fetch_array("SELECT *FROM `tbl_post` WHERE `is_garbage`!='0' AND `status`=1 " );
    return $result;

}

 function get_list_post_by_page($currentPage){
     global $numberPerPage;
     $offset= ($currentPage-1)*$numberPerPage;
     $result= db_fetch_array( "SELECT * FROM `tbl_post` WHERE `is_garbage`!='0' AND `status`=1 LIMIT $offset,$numberPerPage ");
     return $result;

 }
 
function get_cat_title($postCatID){
$result = db_fetch_row("SELECT*FROM `tbl_sub_cat` WHERE `cat_id`={$postCatID}");
return $result;
}
function get_active_page($page){
    global $currentPage;
    if($page==$currentPage){
        return "active";
    }
    return "";


}
function get_list_best_product()
{
    $result= db_fetch_array("SELECT * FROM `tbl_product` WHERE `outstanding`='2'");
    return $result;
}
function get_avatar_product($productThumb){
    $result = explode(";",$productThumb);
    return "admin/".$result[0];
  
}
?>