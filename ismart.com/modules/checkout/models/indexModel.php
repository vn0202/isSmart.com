<?php 
function is_valid_name()
{
    global $errors;
    if(empty($_POST['fullname'])){
        $errors['fullname']= "Bạn cần nhập tên đầy đủ của bạn";
    }
    else{
        $fullname = $_POST['fullname'];
        $pattern = "/^[^!@$%&\*]{6,40}$/";
        if(!preg_match($pattern,$fullname)){
            $errors['fullname']= "Tên bạn chỉ được chứa các ký tự thường và in hoa";
        }
    }
}
function is_valid_email()
{
    global $errors;
    if(empty($_POST['email']))
    {
        $errors['email']= "Bạn cần điền địa chỉ email của bạn";
    }
    else{
        $email = $_POST['email'];
        $pattern="/^[a-z][a-z0-9\._]{2,31}@[a-z0-9]{3,}(\.[a-z]{2,4}){1,2}$/";
        if(!preg_match($pattern,$email)){
            $errors['email']= " email không hợp lệ";
        }
    
}
}
function is_valid_address()
{
    global $errors;
    if(empty($_POST['address'])){
        $errors['address']= " Bạn cần cung cấp thông tin địa chỉ nhận hàng";

    }
    else{
        $address= $_POST['address'];
        $pattern= "/^[^!#%&\*]+$/";
        if(!preg_match($pattern,$address))
        {
            $errors['address']= 'Địa chỉ nhận hàng không hợp lệ';
        }
    }
}
function is_valid_phone()
{
    global $errors;
    if(empty($_POST['phone'])){
        $errors['phone']= " Bạn cần cung cấp số điện thoại để tiện cho việc nhận hàng";
    }
    else{
        $phone= $_POST['phone'];
        $pattern = "/(09[01236789]|08[12345689]|03[2-9]|07[0678])[0-9]{6,8}/";
        if(!preg_match($pattern,$phone)){
            $errors['phone']= "Số điện thoại không đúng định dạng";
        }
    }
}
function create_infor_customer()
{
    $email= $_POST['email'];
    $customer  = db_fetch_row("SELECT * FROM `tbl_customer` WHERE `email`='$email'");

if(!empty($customer)){

    db_update("tbl_customer",['number_ordered'=>$customer['number_ordered']+1],"`customer_id`={$customer['customer_id']}");
    

}else{

    $infor=[
        'fullname'=>trim($_POST['fullname']),
        'email'=>trim($_POST['email']),
        'phone'=>trim($_POST['phone']),
        "address"=>trim($_POST['address']),
        "date_cre"=>time(),
    ];

    db_insert("tbl_customer",$infor);
}

}
function convert_infor_order($product=[])
{
    $string ="";

    if(empty($product)){

    
    foreach($_SESSION['cart']['buy'] as $item){
           $string.= $item['product_id']."-".$item['qty'].";";

    }
}
else{
        $string= $product['product_id']."-"."1".";";
}
    $string= substr($string,0,-1);
    return $string;
}
function create_infor_order($product=[])
{
    $email= trim($_POST['email']);
   $customer = db_fetch_row("SELECT * FROM `tbl_customer` WHERE `email`='$email'");
   $pay = ($_POST['payment-method']==1) ? 1 :2;

   if(empty($product))
   {

   
$infor = [
    'cus_id'=>$customer['customer_id'],
    'product_infor'=>convert_infor_order(),
    "date_cre"=>time(),
    "is_checkout"=>$pay,
    'total_cost'=>$_SESSION['cart']['checkout']['totalCost'],
];
   }
   else{
    $infor = [
        'cus_id'=>$customer['customer_id'],
        'product_infor'=>convert_infor_order($product),
        "date_cre"=>time(),
        "is_checkout"=>$pay,
        'total_cost'=>$product['product_price'],
    ];

   }
db_insert("tbl_order",$infor);
}
function get_content_email()
{
    $content = "<p>
    cảm ơn Quý Khách hàng {$_POST['fullname']} đã quan tâm và ủng hộ shop chúng tôi . Đơn hàng của quý 
    khách bao gồm:
    <table?>
    <thead>
    <tr>
    <th> Sản phẩm</th>
    <th> Số lượng</th>
    <th> Tổng tiền</th>
    </tr>
    </thead>
    <tbody>
   ";
    foreach ($_SESSION['cart']['buy'] as $item){
        $productTotal = convert_currency($item['product_total']);
      $content.= "<tr>
      <td> {$item['product_title']}</td>
      
      <td> {$item['qty']}</td>
      <td> {$productTotal}</td>
      </tr>";
    }
    $totalCost  = convert_currency($_SESSION['cart']['checkout']['totalCost']);
    $content.="<tr>Tổng tiền  : <b>$totalCost</b> </tr>";
$content.="
</tbody>
</table>
</p>";
return $content;
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
function get_infor_product_by_id($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`={$id}");
    return $result;
}
 function substract_product($id,$number)
 
 {
    $number= (int)$number;
    $id= (int)$id;
    $product = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`={$id}");
    $restNumberProduct= $product['product_number']- $number;
  db_update("tbl_product",['product_number'=>$restNumberProduct],"`product_id`={$id}");
 }
?>