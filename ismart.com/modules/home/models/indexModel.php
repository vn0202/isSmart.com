<?php 
function get_list_parent_cat_product(){
    $result  = db_fetch_array("SELECT * FROM `tbl_parent_cat_product`");
    return $result;
}
function get_list_cat_product_by_parent_cat($parentID){
    $result= db_fetch_array("SELECT *FROM `tbl_cat_product` WHERE `cat_parent`={$parentID}");
    return $result;

}
function get_list_cat_product()
{
    $result =db_fetch_array(("SELECT * FROM `tbl_cat_product`"));
    return $result;
}
function get_list_product_by_cat($catID,$currentPage=""){
    global $config;
    $catID=(int)$catID;

    $numberPerPage= $config['numberPerPage'];
    if(!empty($currentPage))
    {
        $offset= ($currentPage-1)*$numberPerPage;
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`={$catID} AND `status`='2' LiMIT {$offset},{$numberPerPage}");

    }
    else{

        $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`={$catID} AND `status`='2'");
    }
    return $result;

}
function get_cat_title($catID)
{
$result = db_fetch_row("SELECT `cat_title` FROM `tbl_cat_product` WHERE `cat_id`={$catID} ");
return $result;
}
// function get_list_product_by_cat_parent($parentID)
// {
//     $listCatProductChild =  get_list_cat_product_by_parent_cat($parentID);
//     $result=[];
//  foreach($listCatProductChild as $cat){
//     $temp = get_list_product_by_cat($cat['cat_id']);
//    $result= array_merge($temp,$result);

//  }
    
//     // $result = db_fetch_array("SELECT * FROM `tbl_product`");
//     return $result;

// }
function get_list_product_by_cat_parent($parentID,$currentPage="", $order="")

{

    global $config;
    $numberPerPage =(int) $config['numberPerPage'];
    $listCatProductChild =  get_list_cat_product_by_parent_cat($parentID);
    $listCatProductChild= array_column($listCatProductChild,"cat_id");
    $result=[];
    $listCatProductChild = implode(",",$listCatProductChild);
    if(!empty($currentPage))
    {
        $offset = (int)($currentPage -1) * $numberPerPage;
        
  $result=  db_fetch_array("SELECT * FROM `tbl_product`  WHERE `cat_id` IN ($listCatProductChild) LIMIT $offset,$numberPerPage  ");

    }
 else{

     $result=  db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($listCatProductChild) ");
 }

    
    // $result = db_fetch_array("SELECT * FROM `tbl_product`");
    return $result;
}
function get_avatar_product($productThumb){
    $result = explode(";",$productThumb);
    return "admin/".$result[0];
  
}
function get_outstanding_product()
{
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `outstanding`='2'");
    return $result;
}
function cmp($string1, $string2,$option="DES"){

    if($string1 ==$string2)
    {
        return 0;

    }
    if($option=="DES"){
        return ($string1 > $string2) ? -1: 1;
    }
    else{
        return ($string1 < $string2) ? -1: 1;
    }
}
function build_sorter($key,$option="DES") {
    return function ($a, $b) use ($key,$option) {
        return cmp($a[$key], $b[$key],$option);
    };
}
function get_list_cat_product_by_parent($parentCat){
    $parentCat=(int)$parentCat;
    $result= db_fetch_array("SELECT * FROM `tbl_cat_product` WHERE `cat_parent`={$parentCat}");
    return $result;
}
function get_list_best_sell()
{
    $result  = db_fetch_array("SELECT * FROM `tbl_product` WHERE `best_sell`='2'");
    return $result;
}

function get_list_slider()
{
    $result= db_fetch_array("SELECT *FROM `tbl_slider` WHERE `garbage`!='2' AND `status`='1'");
    return $result;
}


?>