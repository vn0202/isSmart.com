<?php
function get_list_slider()
{
    $result = db_fetch_array("SELECT * FROM `tbl_slider` WHERE  `garbage`!='2' ORDER BY `slider_order` ASC");
    return $result;
}
function is_valid_thumb()
{
    global $errors;
    if (!isset($_FILES['file'])) {
        $errors['thumb_slider'] = "Bạn cần chọn file để upload";
    } else {
        $fileExtention  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $validExtentions = ['jpg', 'webp', 'png', 'jpeg'];
        if (!in_array($fileExtention, $validExtentions)) {
            $errors['thumb_slider'] = " Chỉ hỗ trợ định dạng jpg,jpeg,png, webp";
        } else {
            $fileSize = $_FILES['file']['size'];
            if ($fileSize > 20 * 1024 * 1024) // not allow size of file greater than 20MB
            {
                $errors['thumb_slider'] = "Kích thước file của bạn quá lớn. Lựa chọn nhỏ hơn 20MB";
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

function create_order_slider()
{
$result = db_fetch_array("SELECT * FROM `tbl_slider`");
if(empty($result))
{
    $order = 0;
}
else{
$arrayOrder = array_column($result,"slider_order");
sort($arrayOrder);
$order=$arrayOrder[count($arrayOrder)-1];
}
return $order;
    
}
function insert_slider_into_db($file)
{
    // global $file;
    $time = time();
    $orderSlider = (int)create_order_slider();
   
    if($orderSlider==0)
    {
        $orderSlider=1;
    }
    else{
        $orderSlider++;
    }
    $infor = [
        "date_cre" => $time,
        "creator" => $_SESSION['id'],
        "slider_link" => $_POST['slug'],
        "status" => $_POST['status'],
        "slider_order" => $orderSlider,
        "slider_thumb" => $file,
    ];
    db_insert("tbl_slider", $infor);
}
function get_list_slider_by_condition($condition)
{
    $result = db_fetch_array("SELECT * FROM `tbl_slider` WHERE {$condition}");
    return $result;

}
function get_status($status)
{
return $status==1 ? "Đã duyệt" : "Chờ phê duyệt";
}
function get_creator($id)
{
    $result = db_fetch_row("SELECT * FROM `tbl_admin` WHERE `id`={$id}");
    return $result['username'];
}

function auto_write_order($sliderID)
{
    $slider = db_fetch_row("SELECT * FROM `tbl_slider` WHERE `slider_id`={$sliderID}");
    $sliderOrder = $slider['slider_order'];
$listSlider = db_fetch_array("SELECT * FROM `tbl_slider` WHERE `slider_order`>{$sliderOrder}");
foreach ($listSlider as $item)
{
    $newOrder = $item['slider_order']-1;
    db_update("tbl_slider",['slider_order'=>$newOrder],"`slider_id`={$item['slider_id']}");

}
}