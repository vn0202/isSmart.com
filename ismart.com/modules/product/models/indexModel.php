<?php 
function get_product_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`={$id}");
    return $result;
}
function get_list_parent_cat_product(){
    $result  = db_fetch_array("SELECT * FROM `tbl_parent_cat_product`");
    return $result;
}
function get_list_cat_product_by_parent_cat($parentID){
    $result= db_fetch_array("SELECT *FROM `tbl_cat_product` WHERE `cat_parent`={$parentID}");
    return $result;

}
function get_thumb_product($productID){
    $lists= db_fetch_row("SELECT `product_thumb` FROM `tbl_product` WHERE `product_id`={$productID}");
    $lists = implode('',$lists);
    $lists = explode(";",$lists);
    foreach($lists as &$val){
        $val="admin/".$val;

    }
    return $lists;
    
}
function get_list_same_product($catID){
    $result= db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`={$catID}");
    return $result;
}
function get_avatar_product($productThumb){
    $result = explode(";",$productThumb);
    return "admin/".$result[0];
  
}
function check_stocking($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`={$id}");
    if($result['product_number'] > 0){
        return true;
    }
    else{
        return false;
    }
}
function get_outstanding_product()
{
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `outstanding`='2'");
    return $result;
}
function get_cat_title($cat){
    $result= db_fetch_row("SELECT * FROM `tbl_cat_product` WHERE `cat_id`={$cat}");
    return $result;
}
function get_cat_parent_title($catParent){
    $result= db_fetch_row("SELECT * FROM `tbl_parent_cat_product` WHERE `cat_id`={$catParent}");
    return $result;
}
?>
