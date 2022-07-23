<?php

use MicrosoftAzure\Storage\Common\Internal\Filters\RetryPolicy;

function get_list_banner()
{
    $result = db_fetch_array("SELECT * FROM `tbl_banner`");
    return $result;
}
function get_author($id)
{
    $id= (int)$id;
    $result = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `id`={$id}");
    return $result['username'];
}
function get_postion($pos)
{
    $pos= (int)$pos;
    if($pos==1)
    {
        return "Bên trái";
    }elseif($pos==2)
    {
        return "Bên trên";
    }
    else{
        return "Bên dưới";
    }
}
function get_status($status)
{
    $status= (int)$status;
    if($status==1){
        return "Không hoạt động";
    }else{
        return "Hoạt động";
    }
}
function get_list_banner_by_page($currentPage)
{global $config;
    $numberPerPage = (int)$config['numberProductPerPage'];
    
    $offset= ($currentPage-1)* $numberPerPage;
    $result= db_fetch_array("SELECT * FROM `tbl_banner` LIMIT {$offset},{$numberPerPage}");
    return $result;

}
function get_banner_by_position($position)
{
    $position= (int)$position;
    $result= db_fetch_array("SELECT * FROM `tbl_banner` WHERE `position`={$position}");
    return $result;
}
function get_banner_by_position_and_page($position,$currentPage){
    global $config;
    $numberPerPage = (int)$config['numberProductPerPage'];
    
    $offset= ($currentPage-1)* $numberPerPage;
    $result= db_fetch_array("SELECT * FROM `tbl_banner` WHERE `position`={$position} LIMIT {$offset},{$numberPerPage}");
    return $result;
}
function is_valid_thumb()
{
    global $errors;
    if (!isset($_FILES['file'])) {
        $errors['slider_thumb'] = "Bạn cần chọn file để upload";
    } else {
        $fileExtention  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $validExtentions = ['jpg', 'webp', 'png', 'jpeg','gif','jfif'];
        if (!in_array($fileExtention, $validExtentions)) {
            $errors['slider_thumb'] = " Chỉ hỗ trợ định dạng jpg,jpeg,png, webp,gif";
        } else {
            $fileSize = $_FILES['file']['size'];
            if ($fileSize > 20 * 1024 * 1024) // not allow size of file greater than 20MB
            {
                $errors['slider_thumb'] = "Kích thước file của bạn quá lớn. Lựa chọn nhỏ hơn 20MB";
            }
        }
    }
}

function is_valid_link()
{
    global $errors;
    if (empty($_POST['slug'])) {
        $errors['slug'] = "Bạn cần tạo link cho slider";
    } else {
        $pattern = "/[^!@#$\*<>]{1,}/";
        if (!preg_match($pattern, $_POST['slug'])) {
            $errors['slug'] = "Link không được chứa các ký tự đặc biệt";
        }
    }
}
?>