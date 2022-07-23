<?php 
function get_page_by_id($id){
    $result = db_fetch_row("SELECT *FROM `tbl_page` WHERE `page_id`={$id}");
return $result;
}
function get_list_best_sell()
{
    $result= db_fetch_array("SELECT * FROM `tbl_product` WHERE `outstanding`='2'");
    return $result;
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