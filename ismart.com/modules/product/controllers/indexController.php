<?php 
function construct(){
    load_model("index");
}
function indexAction(){
    $productID = (int)$_GET['id'];
    if(db_is_exist("tbl_product","`product_id`={$productID}"))
    {

        $product = get_product_by_id($productID);
        $listThumb = get_thumb_product($productID);
        $listSameProduct = get_list_same_product($product['cat_id']);
        $data['listSameProduct']= $listSameProduct;
        $data['product']= $product;
        $data['listThumb']= $listThumb;
            load_view('index',$data);
    }else{
        $_SESSION['noExist']= true;
        redirect_to("?");
   
    }
}



?>
