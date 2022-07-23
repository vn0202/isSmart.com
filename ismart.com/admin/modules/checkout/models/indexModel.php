<?php 
function get_list_order($condition="")
{
    $result = db_fetch_array("SELECT * FROM `tbl_order` {$condition}");
    return $result;
}
function get_list_order_by_page($currentPage,$where="")
{
    global $config ;
    $numberProductPerPage= $config['numberProductPerPage'];
    $currentPage= (int)$currentPage;
    $offset= ($currentPage-1)*$numberProductPerPage;
    
   
        $result= db_fetch_array( "SELECT * FROM `tbl_order` {$where} LIMIT {$offset},{$numberProductPerPage}");

    
    return $result;
}
function get_number_product_in_order($orderID)
{
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id`={$orderID}");
    if(!empty($result))
    {
$list = [];
        $productInfor = $result['product_infor'];
        $productInfor= explode(";",$productInfor);
        foreach($productInfor as $product){
            $product= explode("-",$product);
    $list[]= [
        'product_id'=>(int)$product[0],
        'product_number'=>(int)$product[1],
    ];
            
        }
        return $list;
    }

}
function get_infor_customer($customerID){
    $customerID= (int)$customerID;
    $result= db_fetch_row("SELECT * FROM `tbl_customer` WHERE `customer_id`={$customerID}");
    return $result;
}
function get_status_order($status)
{
    if($status==1)
    {
        echo "Đang vận chuyển";
    }
    else{
        echo "Đã giao";
    }
}
function get_type_payment($type){
    if($type==1)
    {
        echo "Đã thanh toán";
    }
    else{
        echo "Thanh toán khi nhận hàng";
    }
}
function get_infor_product($productID)
{
    $productID=(int)$productID;
    $result= db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`={$productID}");
    return $result;
}
function get_avatar_product($productThumb){
    $productThumb= explode(";",$productThumb);
    return $productThumb[0];
}
function get_number_by_condtion($condition){
    $result= db_fetch_array("SELECT * FROM `tbl_order` WHERE {$condition}");
    return count($result);
}
// deal to customer
function get_list_customer_by_page($currentPage)
{
global $config;
    $currentPage= (int)$currentPage;
    $numberPerPage =$config['numberProductPerPage']; 
    $offset = ($currentPage-1)*$numberPerPage;
    $result = db_fetch_array("SELECT * FROM `tbl_customer` LIMIT {$offset},{$numberPerPage}");
    return $result;
}
function get_total_customer()
{
    $result = db_fetch_array("SELECT * FROM `tbl_customer` ");
    return count($result);
}
?>