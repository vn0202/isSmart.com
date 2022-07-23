<?php 
function get_infor_product_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`={$id}");
    return $result;
}
function get_avatar_product($productThumb){
    $result = explode(";",$productThumb);
    return "admin/".$result[0];
  
}
function update_cart()
{
    $_SESSION['cart']['checkout']['totalCost']=0;
     foreach($_SESSION['cart']['buy'] as &$item)
     {
        $item['product_total'] = $item['qty'] * $item['product_price'];
        $_SESSION['cart']['checkout']['totalCost']+= $item['product_total'];
     }
     $_SESSION['cart']['checkout']['totalProduct']= count($_SESSION['cart']['buy']);
}
function update_tbl($id,$condition)
{
    $product = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`={$id}");

    if($condition == "subtract")
    {

        db_update('tbl_product',['product_number'=>$product['product_number']-1],"`product_id`={$id}");
    }
    elseif($condition == "add"){
        db_update('tbl_product',['product_number'=>$product['product_number']+1],"`product_id`={$id}");
    }
}
function check_stocking($id,$number=1)
{
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`={$id}");
    if($result['product_number'] >= $number){
        return true;
    }
    else{
        return false;
    }
}
?>