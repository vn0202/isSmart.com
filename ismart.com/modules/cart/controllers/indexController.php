<?php 
function construct()
{
 
    load_model("index");
}
function indexAction()
{
    $listItem = $_SESSION['cart']['buy'];
    
    $data['listItem']= $listItem;
    $data['hidden']= "hidden";
    load_view('index',$data);
}
function addProductToCartAction()
{
 
    if(isset($_GET['id'])){
        
        $productID= (int)$_GET['id'];
        if(check_stocking($productID))
        {

            $product =get_infor_product_by_id($productID);
            if(!empty($_SESSION['cart']['buy'][$productID]))
            {
                $_SESSION['cart']['buy'][$productID]['qty']+=1;
                $_SESSION['cart']['buy'][$productID]['product_total'] = $_SESSION['cart']['buy'][$productID]['qty'] * $_SESSION['cart']['buy'][$productID]['product_price'];
            }
            else{
    
                $_SESSION['cart']['buy'][$productID]=[
                    'product_id'=>$productID,
                    'product_title'=>$product['product_title'],
                    'code'=>$product['code'],
                    'qty'=>1,
                    'product_price'=>$product['product_price'],
                    "product_thumb"=>get_avatar_product($product['product_thumb']),
                    'product_total'=>  $product['product_price'],
        
                ];
            }
            
          $_SESSION['addSuccess']=true;
          update_cart();
        }
        else{
            $_SESSION['outOf']= true;
        }
    }
  redirect_to("?mod=home");
}
function addProductToCart2Action()
{
        $productID= (int)$_POST['productID'];
        $number= (int)$_POST['number'];
        if(check_stocking($productID,$number))
        {

            $product =get_infor_product_by_id($productID);
            if(!empty($_SESSION['cart']['buy'][$productID]))
            {
                $_SESSION['cart']['buy'][$productID]['qty']+=$number;
                $_SESSION['cart']['buy'][$productID]['product_total'] = $_SESSION['cart']['buy'][$productID]['qty'] * $_SESSION['cart']['buy'][$productID]['product_price'];
            }
            else{
    
                $_SESSION['cart']['buy'][$productID]=[
                    'product_id'=>$productID,
                    'product_title'=>$product['product_title'],
                    'code'=>$product['code'],
                    'qty'=>$number,
                    'product_price'=>$product['product_price'],
                    "product_thumb"=>get_avatar_product($product['product_thumb']),
                    'product_total'=>  $product['product_price'],
        
                ];
            }
            // update_tbl($productID,"subtract");
         $flag=count($_SESSION['cart']['buy']); 
         update_cart();
        }
        else{
            $flag=0;
        }
    echo $flag;
    
 
}
// function delProductAction()
// {
//     $productID = (int)$_GET['id'];
//     if($_SESSION['cart']['buy'][$productID]['qty'] > 1 )
//     {
//         $_SESSION['cart']['buy'][$productID]['qty']--;
       
//     update_cart();

//     }
//     else{
//         unset($_SESSION['cart']['buy'][$productID]);
//     }
//     // unset($_SESSION['cart']);
//     // update_tbl($productID,"add");

//     redirect_to("?mod=cart");

// }
function deleteProductAction()
{
    $productID = $_POST['delID'];
    unset($_SESSION['cart']['buy'][$productID]);
update_cart();
$result=[
    "totalCost"=> $_SESSION['cart']['checkout']['totalCost'],
     "numberProduct"=>count($_SESSION['cart']['buy'])
];
echo json_encode($result);

}
function handleChangeNumberInCartAction()
{
    $productID =(int)$_POST['productID'];
    $number= $_POST['number'];
    $_SESSION['cart']['buy'][$productID]['qty']= $number;
    $_SESSION['cart']['buy'][$productID]['product_total']= $number * $_SESSION['cart']['buy'][$productID]['product_price'];
    update_cart();
    $result =[
        'totalCost'=>$_SESSION['cart']['checkout']['totalCost'],
        'totalProduct'=>$_SESSION['cart']['checkout']['totalProduct'],
        'productTotal'=>$_SESSION['cart']['buy'][$productID]['product_total'],
    ];
    echo json_encode($result);
}
 function deleteAllAction()
 {
    foreach ($_SESSION['cart']['buy'] as $key=>$val)
    {
        unset($_SESSION['cart']['buy'][$key]);

    }
    redirect_to("?mod=cart");
 }
?>