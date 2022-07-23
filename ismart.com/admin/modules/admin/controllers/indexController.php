<?php
function construct()
{
}
function loginAction()
{
    global $errors;
load_model("login");
    if (isset($_POST['btn_login'])) {

        is_password('password');
        is_username();
        if (empty($errors)) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $admin = check_login($username, $password);
            if (!empty($admin)) {
                $_SESSION['is_login'] = true;
                $_SESSION['id'] = $admin['id'];

                $_SESSION['avatar'] = $admin['avatar'];
                $_SESSION['username'] = $admin['username'];

                if (empty($_POST['remember'])) {
                    setcookie('id', $admin['id'], time() + 3600, "/");
                }
                redirect_to("?");
            } else {
                $errors['account'] = "Thông tin tài khoản không tồn tại";
            }
        }
    }
    load_view("login");
}
function registerAction()
{
    load_model("register");

      $idAdmin = (int)$_GET['id'];
      $checkRole  = get_role($idAdmin);
      if($checkRole!=1)
      {
          echo "Bạn không đủ thẩm quyền để thêm admin mới";    
      }
      else{

          global $errors;
         $user_infor=[];
          if (isset($_POST["btn_reg"])) {
      
              is_fullname();
              is_username();
              is_email();
              is_password();
              is_phone();
              if (!empty($_POST['address'])) {
                  $user_infor['address'] = $_POST['address'];
              }
              if (empty($errors)) {
                  $user_infor['fullname']= $_POST['fullname'];
                  $user_infor['username']=$_POST['username'];
                  $user_infor['email']= $_POST['email'];
                  $user_infor['password']= md5($_POST['password']);
                  $user_infor['phone']= $_POST['phone'];
                  $user_infor['address'] = $_POST['address'];
                  $user_infor['reg_date'] = time();
                  $user_infor['admin_intro']= (int)$_POST['licensor'];
                  $user_infor['role']= $_POST['licens'];
                  db_insert("tbl_admin", $user_infor);
              }
          }
          load_view("register");
      }
}
function updateAdminAction()
{
    global $adminUpdate;
    global $errors;
    load_model("updateAdmin");
    if (isset($_POST['btn_submit'])) {
        is_email_update();
        is_phone_update();
        is_username_update();
       
        is_valid_avatar();
        if (empty($errors)) {
            $id = $_SESSION['id'];
            if(!empty($_POST['email'])){
                $adminUpdate['email']= $_POST['email'];

            }if(!empty($_POST['phone'])){
                $adminUpdate['phone']= $_POST['phone'];
            }
            if(!empty($_POST['username'])){
                $adminUpdate['username']= $_POST['username'];
            }
        
            // update database 
            db_update("tbl_admin", $adminUpdate, "`id`={$id}");
            $_SESSION['avatar'] = $adminUpdate['avatar'];
            // header("Location :?mod=home");
        }
    }
    load_view("updateAdmin");
}
function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    unset($_SESSION['avatar']);
    redirect_to("?mod=admin&action=login");
}
function changePassAction()
{
    global $errors;
    if (isset($_POST['btn_submit'])) {
        $id = $_SESSION['id'];
        is_password('old_pass');
        is_password('new_pass');
        is_password('confirm_pass');
        if (empty($errors)) {
            $data["password"] = md5($_POST['new_pass']);
            db_update("tbl_admin", $data, "`id`={$id}");
        }
    }
    load_view("changePass");
}
function inforShopAction()
{
    load_model("index");
    global $errors;
    if(isset($_POST['btn_submit']))
    {
        is_phone();
        is_email();
        is_name_shop();
        is_address();
        
        if(empty($errors)){
            
            db_query("UPDATE `tbl_infor` SET  `name`='{$_POST['name']}', `phone`='{$_POST['phone']}', `slogan`='{$_POST['slogan']}', `address`='{$_POST['address']}', `email`='{$_POST['email']}'");
       
        }
    }
    $infor = get_infor_shop();
    $data['infor']= $infor;
    load_view("inforShop",$data);
}