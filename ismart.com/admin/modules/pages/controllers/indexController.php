<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    $listPages = get_list_page();
    $data['listPages'] = $listPages;
    load_view('index', $data);
}
function addAction()
{
    global $errors;
    global $conn;
    if (isset($_POST['btn_submit'])) {

        is_title();
        is_slug();
        is_content();
        if (empty($errors)) {
            $page_infor['page_title'] = $_POST['page_title'];
            $page_infor['slug'] = $_POST['slug'];
            $page_infor['page_content'] = $_POST['page_content'];
            $page_infor['creator'] = $_SESSION['id'];
            $page_infor['date_cre'] = time();
            db_insert("tbl_page", $page_infor);
            $idInsert = mysqli_insert_id($conn);
            $slug = $_POST['slug'] . "-$idInsert.html";
            $slug = convert_name($slug);
            db_update('tbl_page', ['slug' => $slug], "`page_id`={$idInsert}");
        }
    }
    load_view("add");
}
function processIndexAction()
{

    // global $data;
    $id = (int)$_SESSION['id'];
    $admin = get_admin($id);
    if ($admin['role'] != 1) {
        echo " Chỉ có admin mới có quyền  cho thao tác này ";
    } else {

        if ($_POST['actions'] === '0') {
            redirect_to("?mod=pages");
        } elseif ($_POST['actions'] === '1') {

            $list = $_POST['checkItem'];
            foreach ($list as $ID) {
                $ID = (int)$ID;
                db_delete("tbl_page", "`page_id`={$ID}");
            }
            redirect_to("?mod=pages");
        } elseif ($_POST['actions'] === '2') {
            $listsPostID = $_POST['checkItem'];


            foreach ($listsPostID as $id) {
                $id = (int)$id;
                db_update("tbl_page", ['is_garbage' => '1'], "`page_id`=$id");
            }
            redirect_to("?mod=pages");
        }
    }
}

function processGarbageAction()
{

    // global $data;
    $id = (int)$_SESSION['id'];
    $admin = get_admin($id);
    if ($admin['role'] != 1) {
        echo " Chỉ có admin mới có quyền  cho thao tác này ";
    } else {

        if ($_POST['actions'] === '0') {
            redirect_to("?mod=pages");
        } elseif ($_POST['actions'] === '2') {

            $list = $_POST['checkItem'];
            foreach ($list as $ID) {
                $ID = (int)$ID;
                db_delete("tbl_page", "`page_id`={$ID}");
            }
            redirect_to("?mod=pages");
        } elseif ($_POST['actions'] === '1') {
            $listsPostID = $_POST['checkItem'];


            foreach ($listsPostID as $id) {
                $id = (int)$id;
                db_update("tbl_page", ['is_garbage' => '0'], "`page_id`=$id");
            }
            redirect_to("?mod=pages");
        }
    }
}

function deleteAction()
{
    if (isset($_GET['id'])) {

        $idDelete = (int)$_GET['id'];
        if (is_exist_id('tbl_page', $idDelete)) {
            db_delete('tbl_page', "page_id={$idDelete}");
        }
    }
    redirect_to("?mod=page");
}
function updatePageAction()
{
    $pageID = (int)$_GET['id'];
    $flag = db_is_exist("tbl_page", "page_id={$pageID}");
    if ($flag) {
        global $errors;

        if (isset($_POST['btn_update'])) {
            is_title();
            is_slug();
            is_content();
            if (empty($errors)) {
                $page['page_title']= $_POST['page_title'];
                $page['slug']= $_POST['slug'];
                $page['page_content']= $_POST['page_content'];
                db_update('tbl_page',$page,"`page_id`={$pageID}");
            }
        }
        $page = db_fetch_row("SELECT*FROM `tbl_page` WHERE `page_id`={$pageID}");

        $data['page'] = $page;
        load_view('updatePage', $data);
    } else {

        redirect_to("?mod=pages");
    }
}
function garbageAction()
{
    $list_garbage = get_list_garbage();
    $data['list_garbage'] = $list_garbage;
    if (isset($_POST['btn_update'])) {
        $listItem = $_POST['checkItem'];

        $action = (int)$_POST['actions'];
        if ($action == 1) {
            if (!empty($listItem)) {
                foreach ($listItem as $l) {
                    $l=(int)$l;
                    db_update('tbl_page', ['is_garbage' => '0'], "page_id={$l}");
                }
            }
        }
        if ($action == 2) {
            if (!empty($list)) {
                foreach ($list as $l) {
                    $l=(int)$l;
                    db_delete("tbl_page", "page_id=$l");
                }
            }
        }

        redirect_to("?mod=post&action=garbage");
    }
    load_view("garbage", $data);
}
function confirmAction()
{
    $adminID = (int)$_SESSION['id'];
    if (get_role($adminID) != 1) {
        echo " Chỉ có quản trị viên hoặc biên tập viên mới có quyền xét duyệt bài viết";
    } else {

        $list_unconfirm = get_list_unconfirm();
        if (isset($_POST['btn_update'])) {
            $action = (int)$_POST['actions'];
            $listID= $_POST['checkItem'];
            if ($action == 1) {
                foreach ($listID as $list) {
                    db_update('tbl_page', ['status' => '1'], "page_id={$list}");
                }
                redirect_to("?mod=pages");
            }
            elseif($action==2){}
        }
        $data['list_unconfirm'] = $list_unconfirm;
        load_view('confirm', $data);
    }
}
function showPostedList(){
    $lists= get_posted_page();
    $data['lists']= $lists;
    load_view('postedPage',$data);
    
}
