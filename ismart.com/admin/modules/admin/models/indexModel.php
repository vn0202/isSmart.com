<?php 
function get_infor_shop()
{
    $result = db_fetch_row("SELECT * FROM `tbl_infor`");
    return $result;
}
function is_email() {
    global $errors;
    if(isset($errors['email']))
    {
        unset($errors['email']);
    }
  
   if (empty($_POST["email"])) {
       $errors["email"] = "Bạn chưa nhập email của bạn";
   } else {
       $email = $_POST["email"];
       $pattern = "/^[a-z][a-z0-9\._]{2,31}@[a-z0-9]{3,}(\.[a-z]{2,4}){1,2}$/";
       if (!preg_match($pattern, $email)) {
        $errors["email"] = " Địa chỉ eamil k hợp lệ";          
       } 
   }
};
function is_phone()  {
    global $errors;
    if(isset($errors['phone']))
    {
        unset($errors['phone']);
    }
    
    if (empty($_POST["phone"])) {
        $errors['phone']  = " Bạn chưa nhập số điện thoại";
    } else {
        $phone = $_POST["phone"];
        $pattern = "/^((09[01236789]|08[12345689]|03[2-9]|07[0678])[0-9]{6,8}\-*){1,2}$/";
        if (!preg_match($pattern, $phone)) {
            $errors["phone"] = "Số điện thoại không hợp lệ";

        } 
    }
};
  function is_name_shop()
  {
    global $errors;
  if(empty($_POST['name'])){
    $errors['name']= "Bạn cần đặt tên shop";
  }
  else{
    $pattern= "/^[^#$%\^\*&]{5,20}$/";
    if(!preg_match($pattern,$_POST['name'])){
        $errors['name']= "Tên shop không được chứa các ký tự đặc biệt";
    }
  }
  }
  function is_address()
  {
    global $errors;
    if(isset($errors['address']))
    {
        unset($errors['address']);
    }
    if(empty($_POST['address']))
    {
        $errors['address']= 'Bạn cần cung cấp địa chỉ shop';
    }
    else{
        $pattern="/^[^!@$%*]{6,100}$/";
        if(!preg_match($pattern,$_POST['address'])){
            $errors['address']= "Địa chỉ không hợp lệ";
        }
    }
  }
?>