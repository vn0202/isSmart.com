<?php
function construct()
{
    load_model("index");
}
function indexAction()
{
    if (isset($_POST['sm_action'])) {
        if (!empty($_POST['checkItem'])) {


            $action = (int)$_POST['actions'];
            switch ($action) {
                case 1:
                    foreach ($_POST['checkItem'] as $item) {
                        $banner = db_fetch_row("SELECT * FROM `tbl_banner` WHERE `banner_id`={$item}");
                        unlink($banner['banner_thumb']);
                        db_delete("tbl_banner", "`banner_id`={$item}");
                    }
                    break;
                case 2:
                    foreach ($_POST['checkItem'] as $item) {
                        db_update("tbl_banner", ['status' => '1'], "`banner_id`={$item}");
                    }
                    break;
                case 3:
                    foreach ($_POST['checkItem'] as $item) {

                        db_update("tbl_banner", ['status' => 2], "`banner_id`={$item}");
                    }
                    break;
                case 4:
                    foreach ($_POST['checkItem'] as $item) {
                        db_update("tbl_banner", ['position' => '1'], "`banner_id`={$item}");
                    }
                    break;
                case 5:
                    foreach ($_POST['checkItem'] as $item) {
                        db_update("tbl_banner", ['position' => '2'], "`banner_id`={$item}");
                    }
                    break;
                case 6:
                    foreach ($_POST['checkItem'] as $item) {
                        db_update("tbl_banner", ['position' => '3'], "`banner_id`={$item}");
                    }
                    break;
                
            }
          
        }
        if($_POST['actions']==7){
            db_query("UPDATE `tbl_banner` SET `status`='1'");
        }
        if($_POST['actions']==8){
            db_query("UPDATE `tbl_banner` SET `status`='2'");
        }
    }
    $type = isset($_GET['type']) ? $_GET['type'] : 1;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    switch ($type) {
        case 1:
            $listBanner = get_list_banner_by_page($currentPage);
            break;
        case 2:
            $listBanner = get_banner_by_position_and_page(1, $currentPage);
            break;
        case 3:
            $listBanner = get_banner_by_position_and_page(2, $currentPage);
            break;
        case 4:
            $listBanner = get_banner_by_position_and_page(3, $currentPage);
            break;
    }
    // $listBanner = get_list_banner();
    $data['active'] = $type;
    $data['listBanner'] = $listBanner;
    $data['currentPage'] = $currentPage;
    load_view('index', $data);
}
function addAction()
{
    global $errors;
    if (isset($_POST['btn-submit'])) {
        is_valid_link();
        is_valid_thumb();
        if (empty($_POST['status'])) {
            $errors['status'] = "Bạn chưa chọn trạng thái";
        }


        if (empty($errors)) {
            $dir = "public/images/banner/";
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            // $dir = rtrim($dir, "\/");
            $file = $dir . pathinfo($_FILES['file']['name'], PATHINFO_BASENAME);
            $file = auto_rename_file($file, $dir);
            move_uploaded_file($_FILES['file']['tmp_name'], $file);
            $infor = [
                'date_cre' => time(),
                'creator' => $_SESSION['id'],
                'banner_thumb' => $file,
                'position' => (int)$_POST['position'],
                'status' => (int)$_POST['status'],
                'link' => $_POST['slug'],

            ];
            db_insert("tbl_banner", $infor);
        }
    }


    load_view("add");
}
