<?php 
function construct()
{
    load_model('index');
}
function indexAction()
{
    
    global $errors;
    if(isset($_POST['order'])){
        is_valid_name();
        is_valid_email();
        is_valid_address();
        is_valid_phone();
        if(empty($errors))
        {

             create_infor_customer();
             create_infor_order();
          $content = get_content_email();
            send_email($_POST['email'],$_POST['fullname'],"Đặt hàng thành công",$content );

            foreach($_SESSION['cart']['buy'] as $key=>$item)
            {
                substract_product($item['product_id'],$item['qty']);
                unset($_SESSION['cart']['buy'][$key]);

            }

            unset($_SESSION['cart']['checkout']['totalCost']);
            unset($_SESSION['cart']['checkout']['totalProduct']);

             redirect_to("cam-on-quy-khach.html");
        }
    }
    load_view("index");
}
function thankAction()
{

    load_view("thank");
    

}
function buyDirectAction()
{
    $productId = (int)$_GET['id'];
    if(check_stocking($productId))
    {
            $prouctInfor = get_infor_product_by_id($productId);
            $data['product']= $prouctInfor;
            global $errors;
    if(isset($_POST['order'])){
        is_valid_name();
        is_valid_email();
        is_valid_address();
        is_valid_phone();
        if(empty($errors))
        {

             create_infor_customer();
             create_infor_order($prouctInfor);
          $content = get_content_email();
            send_email($_POST['email'],$_POST['fullname'],"Đặt hàng thành công",$content );
            substract_product($productId,1);
        
             redirect_to("?mod=checkout&action=thank");
        }
    }
            load_view("buyDirect",$data);

    }
    else{
        $_SESSION['outOf']= true;
        redirect_to("?mod=home");
    }
}
?>