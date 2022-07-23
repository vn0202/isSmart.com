<?php
function construct()
{
    load_model("index");
}
function indexAction()
{
    if (isset($_POST['sm_action'])) {
        $action = (int)$_POST['actions'];
        $listItem = $_POST['checkItem'];
        if ($action != 0 && !empty($listItem)) {


            switch ($action) {
                case 1:
                    foreach ($listItem as $item) {
                        db_update("tbl_slider", ['status' => '1'], "`slider_id`={$item}");
                    }
                    break;
                case 2:
                    foreach ($listItem as $item) {
                        db_update("tbl_slider", ['status' => '2'], "`slider_id`={$item}");
                    }
                    break;
                case 3:
                    foreach ($listItem as $item) {
                        db_update("tbl_slider", ['garbage' => '2'], "`slider_id`={$item}");
                    }
                    break;
                    case 4:
                        foreach ($listItem as $item) {
                            db_update("tbl_slider", ['garbage' => '1'], "`slider_id`={$item}");
                        }
                        break;
                        case 5:
                            foreach ($listItem as $item) {
                                auto_write_order($item);
                                $slider =db_fetch_row("SELECT * FROM `tbl_slider` WHERE `slider_id`={$item}");
                                if(file_exists($slider['slider_thumb'])){
                                    unlink($slider['slider_thumb']);
                                }
                                db_delete("tbl_slider", "`slider_id`={$item}");

                            }
                            break;
                
            }
        }
    }
    $type = isset($_GET['type']) ? $_GET['type'] : 1;

    switch ($type) {
        case 1:
            $listSlider = get_list_slider();
            break;
        case 2:
            $listSlider = get_list_slider_by_condition("`status`='1' AND `garbage`='1'");
            break;
        case 3:
            $listSlider = get_list_slider_by_condition("`status`='2' AND `garbage`='1'");
            break;
        case 4:
            $listSlider = get_list_slider_by_condition("`garbage`='2'");
            break;
    }
    $data['type'] = $type;
    

    $data['listSlider'] = $listSlider;

    load_view("index", $data);
}
function addNewSliderAction()
{
    global $errors;


    if (isset($_POST['btn-submit'])) {
        is_valid_link();
        if (empty($_POST['status'])) {
            $errors['status'] = "Bạn chưa chọn trạng thái";
        }
        if (empty($_FILES['file']['name'])) {
            $errors['slider_thumb'] = " Bạn cần chọn ảnh cho slider";
        }
        if (empty($errors)) {
            $dir = "public/images/slider/";
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            // $dir = rtrim($dir, "\/");
            $file = $dir . pathinfo($_FILES['file']['name'], PATHINFO_BASENAME);
            $file = auto_rename_file($file, $dir);
            move_uploaded_file($_FILES['file']['tmp_name'], $file);
            insert_slider_into_db($file);
        }
    }

    load_view("addSlider");
}
function handleChangeOrderAction()
{
    $dragID = (int)$_POST['dragID'];
    $targetID = (int)$_POST['dropID'];
    $dragOrder =(int)$_POST['dragOrder'];
    $dropOrder = (int)$_POST['dropOrder'];

    db_update('tbl_slider',['slider_order'=>$dropOrder],"`slider_id`='{$dragID}'");
    db_update('tbl_slider',['slider_order'=>$dragOrder],"`slider_id`='{$targetID}'");
   
}