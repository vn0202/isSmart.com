<?php

use function Dropbox\autoload;

function is_password_update()
{
    global $errors;
    global $adminUpdate;
    if (!empty($_POST['password'])) {
        $pass = $_POST['password'];
        if (strlen($pass) > 32 || strlen($pass) < 6) {
            $errors['password'] = " Mật khẩu tối thiểu 6 ký tự và tối đa 32 ký tự";
        } elseif (!preg_match("/[\w\d_!@#$%^]{6,32}/", $pass)) {
            $errors['password'] = "Mật khẩu bao gồm chữ cái, số và các ký tự (!@#$%^&*())";
        } elseif (!preg_match("/[A-Z]{1,}/", $pass)) {
            $errors['password'] = " Mật khẩu phải có ít nhất 1 ký tự hoa";
        } elseif (!preg_match("/[\d]{1,}/", $pass)) {
            $errors['password'] = "Mật khẩu phải có ít nhất 1 chữ số";
        } else {
            $adminUpdate['password'] = md5($pass);
        }
    }
}
function is_username_update()
{
    global $errors;
    global $adminUpdate;
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
        if (strlen($username) < 6 || strlen($username) > 32) {
            $errors['username'] = "Tên đăng nhập phải có ít nhất 6 ký tự và tối đa 32 ký tự";
        } else {

            $pattern = "/[a-zA-Z_][a-zA-Z0-9_!@#$%]{5,31}/";
            if (!preg_match($pattern, $username)) {
                $errors['username'] = " Tên đăng nhập chỉ gồm chữ cái, số và không bắt đầu bằng số";
            } else {
                $adminUpdate['username'] = $username;
            }
        }
    }
}

function is_valid_avatar()
{
    global $errors;
    // global $config;
    global $adminUpdate;
    if (isset($_FILES['avatar'])) {
        $extention = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $validType = ['jpg', 'png', 'webp', 'jpeg'];
        if (!in_array($extention, $validType)) {
            $errors['avatar'] = "Chỉ hỗ trợ định dạng joh,png,webp,jpeg";
        } else {
            if ($_FILES['avatar']['size'] > (20 * 1024 * 1024)) {
                $errors['avatar'] = "Dung lượng ảnh quá lớn ( Không được quá 20MB)";
            } else {
                $nameFile = basename($_FILES['avatar']['name']);
                // $dir = "public". DIRECTORY_SEPARATOR ."images". DIRECTORY_SEPARATOR. "avatar". DIRECTORY_SEPARATOR;
                $nameFile = auto_rename_file($nameFile,"public/images/avatar/");
                // $nameFile = $dir . $nameFile;
                move_uploaded_file($_FILES['avatar']['tmp_name'], $nameFile);
                $adminUpdate['avatar'] = $nameFile;
            }
        }
    }
}

// function auto_rename_file($name)
// {


//     $tmp = pathinfo($name, PATHINFO_FILENAME);
//     $dir = "public/images/avatar/";
//     $extention = pathinfo($name, PATHINFO_EXTENSION);
//     $new = $dir . $name;
//     $i = 1;
//     while (file_exists($new)) {

//         $new = $dir . $tmp . "-copy($i)." . $extention;
//         $i++;
//     }


//     return $new;
// }
function is_email_update()
{
    global $errors;

    if (!empty($_POST["email"])) {

        $email = $_POST["email"];
        $pattern = "/^[a-z][a-z0-9\._]{2,31}@[a-z0-9]{3,}(\.[a-z]{2,4}){1,2}$/";
        if (!preg_match($pattern, $email)) {
            $errors["email"] = " Địa chỉ eamil k hợp lệ";
        }
    }
};
//===================check phone===========================
function is_phone_update()
{
    global $errors;

    if (!empty($_POST["phone"])) {


        $phone = $_POST["phone"];
        $pattern = "/(09[01236789]|08[12345689]|03[2-9]|07[0678])[0-9]{6,8}/";
        if (!preg_match($pattern, $phone)) {

            $errors["phone"] = "Số điện thoại không hợp lệ";
        }
    }
};
function is_password($case)
{
    global $errors;
    $id = $_SESSION['id'];
    $admin = db_fetch_row("SELECT *FROM `tbl_admin` WHERE `id`={$id}");
    // var_dump($admin);

    if (empty($_POST[$case])) {
        $errors[$case] = "Bạn không được để trống trường này";
    } else {
        if ($case == 'confirm_pass') {
            if ($_POST['new_pass'] != $_POST['confirm_pass']) {
                $errors[$case] = "Xác thực mật khẩu không chính xác";
            }
        } elseif ($case == "old_pass") {
            if (md5($_POST['old_pass']) != $admin['password']) {
                $errors['old_pass'] = " Mật khẩu không chính xác";
            }
        }

        $pass = $_POST[$case];
        if (strlen($pass) < 6 || strlen($pass) > 32) {
            $errors[$case] = " Mật khẩu tối thiểu 6 ký tự và tối đa 32 ký tự";
        } else {
            $pattern = "/^[a-zA-z0-9\-_+*&^%$#@!]{6,32}$/";
            if (!preg_match($pattern, $pass)) {
                $errors[$case] = "Mật khẩu bao gồm các chữ cái, chữ số và các ký tự (!@#$%^&*)";
            } elseif (!preg_match("/[a-z]{1,}/", $pass)) {
                $errors[$case] = "Mật khẩu phải có ít nhất 1 ký tự thường";
            } elseif (!preg_match("/[A-Z]{1,}/", $pass)) {
                $errors[$case] = " Mật khâu phải có ít nhất 1 ký tự hoa";
            }
        }
    }
};
