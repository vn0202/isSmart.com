<?php

//check list:
/**1. Xây dựng giao diện
 * 2. Xây dựng chức hàm validate
 * ============fullName=======
 * 2.1 Xây dựng validate fullName:
 * 2.1.1 Kiểm tra xem tên có trống không.nêu có thông báo lỗi luôn
 * 
 */

 function is_fullname(){
    global $errors;
    
    if (empty($_POST["fullname"])) {
        $errors["fullname"] = "Bạn chưa nhập tên đầy đủ củ bạn";
    }
  
};
//=======================check username=================
 function is_username()  {
     global $errors;
    
    if (empty($_POST["username"])) {
        $errors["username"] = " Bạn chưa nhập tên đăng nhập";
    } else {
        $username = $_POST["username"];
        $pattern = "/^[A-z0-9_@$]+$/";
        if (preg_match($pattern, $username)) {
            if (strlen($username  )<6 ){
                $errors["username"] = " Tên đăng nhập quá ngắn, tối thiểu 6 ký tự";
            } elseif (strlen($username) > 32) {
                $errors["username"] = "Tên đăng nhập quá dài, tối đa 32 ký tự";
            } elseif(is_account_exist('username',$username))
            {
                $errors['username']="Tài khoản này đã tồn tại!";
            }
           
        } else {
            $errors["username"] = "Tên đăng nhập gồm các chữ cái, số và các ký tự _@$";
        }
    }
};
//=======================check password =================

function is_password()  {
    global $errors;
  
    if (empty($_POST["password"])) {
        $errors["password"] = "Bạn chưa nhập mật khẩu";
    } else {
        $password = $_POST["password"];
        $pattern = "/^[\w\d_!@#$%^&*()]{6,32}$/";
        if (preg_match($pattern, $password)) {
            if (!preg_match("/[A-Z]/", $password)) {
                $errors["password"] = " Mật khẩu phải có ít nhất 1 ký tự hoa";
            } elseif (!preg_match("/[a-z]/", $password)) {
                $errors["password"] = "Mật khẩu phải có ít nhất 1 ký tự thường";
            } elseif (!preg_match("/[\d]/", $password)) {
                $errors["password"] = "Mật Khẩu phải có ít nhất 1 ký tự số";
            } 
        } else {
            $errors["password"] = "Mật khẩu không đúng định dạng";
        }
    }
};
//========================check email========================
 function is_email() {
     global $errors;
   
    if (empty($_POST["email"])) {
        $errors["email"] = "Bạn chưa nhập email của bạn";
    } else {
        $email = $_POST["email"];
        $pattern = "/^[a-z][a-z0-9\._]{2,31}@[a-z0-9]{3,}(\.[a-z]{2,4}){1,2}$/";
        if (preg_match($pattern, $email)) {
            if(is_account_exist('email',$email)){
                $errors['email']= "Email này đã được kích hoạt";
            }
           
        } else{
            $errors["email"] = " Địa chỉ eamil k hợp lệ";
        }
    }
};
//===================check phone===========================
 function is_phone()  {
    global $errors;
    global $user_infor;
    if (empty($_POST["phone"])) {
        $errors['phone']  = " Bạn chưa nhập số điện thoại";
    } else {
        $phone = $_POST["phone"];
        $pattern = "/(09[01236789]|08[12345689]|03[2-9]|07[0678])[0-9]{6,8}/";
        if (preg_match($pattern, $phone)) {
            $user_infor["phone"] = trim(htmlentities($phone)) ;
        } else {
            $errors["phone"] = "Số điện thoại không hợp lệ";
        }
    }
};
  


function is_account_exist($type, $name){
    global $conn;
    
    $sql = "SELECT *FROM `tbl_admin` WHERE `{$type}`='" . escape_string($name)."'";
$mysqli_result= db_query($sql);
if(mysqli_num_rows($mysqli_result)>0)
{
    return true;
}
return false;

}
function get_role($id){
    $admin = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `id`={$id}");
    return $admin['role'];
}