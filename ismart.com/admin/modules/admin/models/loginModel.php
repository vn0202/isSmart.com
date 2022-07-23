<?php 
function is_username(){
    global $errors;
    if(empty($_POST['username'])){
        $errors['username']= "Bạn không được để trống trường này";
    }
}
function is_password($case){
    global $errors;
    if(empty($_POST[$case])){
        $errors[$case]= "Bạn không được để trống trường này";
    }
    else{
        if($case=='confirm_pass'){
            if($_POST['new_pass']!=$_POST['confirm_pass']){
                $errors[$case]= "Xác thực mật khẩu không chính xác";
            }

        }
        else{

            $pass= $_POST[$case];
            if(strlen($pass)< 6 || strlen($pass)> 32){
                $errors[$case]= " Mật khẩu tối thiểu 6 ký tự và tối đa 32 ký tự";
            }
            else{
                $pattern = "/^[a-zA-z0-9\-_+*&^%$#@!]{6,32}$/";
                if(!preg_match($pattern, $pass)){
                    $errors[$case]= "Mật khẩu bao gồm các chữ cái, chữ số và các ký tự (!@#$%^&*)";
                }
                elseif(!preg_match("/[a-z]{1,}/", $pass)){
                    $errors[$case]= "Mật khẩu phải có ít nhất 1 ký tự thường";
                }
                elseif(!preg_match("/[A-Z]{1,}/", $pass)){
                    $errors[$case]= " Mật khâu phải có ít nhất 1 ký tự hoa";
                }
            }
        }
    }
  
}
function check_login($username, $password){
   $admin= db_fetch_row("SELECT * FROM `tbl_admin` WHERE `username`='$username' OR `email`='$username'");
if(!empty($admin)){
    if($admin['password']==$password){
        return $admin;
    }
    else{
        return false;
    }

}
return false;

}

?>