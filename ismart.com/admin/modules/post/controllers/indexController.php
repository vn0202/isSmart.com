<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    $data = [];
    $list = get_list_cat_by_title();
    $list2 = array_column($list, "cat_title");
    $numberCat = count($list2);
    for ($i = 0; $i < $numberCat; $i++) {
        if (is_exist_title($list[$i]['cat_title'], $i, $list2) != 1) {
            $data[$list[$i]['cat_title']][] = $list[$i];
            for ($j = $i + 1; $j < $numberCat; $j++) {
                if ($list[$i]['cat_title'] == $list[$j]['cat_title']) {
                    $data[$list[$i]['cat_title']][] = $list[$j];
                }
            }
        }
    }
    $data_send['list_post_cat'] = $data;

    load_view('index', $data_send);
}
function deleteAction()
{
    if (isset($_GET['id'])) {

        $idDelete = (int)$_GET['id'];
        if (is_exist_id('tbl_sub_cat', $idDelete)) {
            db_delete('tbl_sub_cat', "cat_id={$idDelete}");
        }
    }
    redirect_to("?mod=post");
}

function addcatAction()
{
    global $errors;

    if (isset($_POST['btn_add_cat'])) {
        if (empty($_POST['title'])) {
            $errors['title'] = "Bạn cần nhập trường này";
        } else {
            $pattern = "/^[a-zA-Z](.){6,20}$/";
            $title = $_POST['title'];
            if (!preg_match($pattern, $title)) {
                $errors['title'] = "Tiêu đề chỉ chứa các ký tự thường";
            } else {
                $cat['cat_title'] = $title;
            }
        }
        if (empty($_POST['cat_parent'])) {
            $errors['cat_parent'] = " Bạn cần chọn chủ đề cha";
        } else {
            $cat['cat_parent'] = $_POST['cat_parent'];
        }
        $cat['scope'] = $_POST['scope'];
        $cat['creator'] = $_SESSION['id'];
        $cat['date_cre'] = time();
        if (empty($errors)) {
            if (is_exist_cat($cat['cat_title'], $cat['scope'])) {
                $errors['fail'] = "Danh mục đã tồn tại";
            } else {

                db_insert('tbl_sub_cat', $cat);
            }
        }
    }
    $list_cat = get_list_parent_cat();
    $data['list_cat'] = $list_cat;
    load_view("addcat", $data);
}
function showListPostAction()
{

   
    global $numberPerPage;
    global $config;
    $numberPerPage = $config['numberProductPerPage'];
 
    $currentPage = isset($_GET['page']) ? $_GET['page']: 1;
    $currentPage= (int)$currentPage;
    $totalPost = count(get_list_post());
 
    $list_post = get_list_post_by_page($currentPage);
    $data['list_post']= $list_post;
    $data['totalPost']= $totalPost;
    $data['currentPage']= $currentPage;
    $data['numberPerPage']= $numberPerPage;
    
    load_view("listPost",$data);
}
function addPostAction()
{
    global $errors;
    global $post_infor;
    global $conn;
    $list_cat  = get_sub_cat();
    $data['list_cat'] = $list_cat;
    if (isset($_POST['btn_submit'])) {
        is_post_title();
        is_desc();
        is_detail();
        is_image_post();
        is_parent_cat();
        is_slug();
        if (empty($errors['post_thumb'])) {
            $dir = "public/images/post_thumb/";
            $namefile = pathinfo($_FILES['post_thumb']['name'], PATHINFO_BASENAME);
            $file = $dir . $namefile;
            move_uploaded_file($_FILES['post_thumb']['tmp_name'], $file);
            $post_infor['post_title'] = $_POST['post_title'];
            $post_infor['post_desc'] = $_POST['post_desc'];
            $post_infor['post_content'] = $_POST['post_content'];
            $post_infor['creator'] = $_SESSION['id'];
            $post_infor['date_cre'] = time();
            $post_infor['post_thumb'] = $file;
            $post_infor['cat_id'] = (int)$_POST['parent_cat'];
            $post_infor['scope'] = $_POST['scope'];
            // $post_infor['slug']=
            db_insert("tbl_post", $post_infor);
            $id = mysqli_insert_id($conn);
            $slug = $_POST['slug'] . "-{$id}.html";
            $slug = convert_name($slug);
            db_update('tbl_post', ['slug' => $slug], "`post_id`={$id}");
            unset($_POST);
        }
    }
    load_view("addPost", $data);
}
function processListPostAction()
{

    // global $data;
    $id = (int)$_SESSION['id'];
    $admin = get_admin($id);
    if ($admin['role'] != 1) {
        echo " Chỉ có admin mới có quyền xóa thành viên hay đổi quyền cho thao tác này ";
    } else {

        if ($_POST['actions'] === '0') {
            redirect_to("?mod=post&action=showListPost");
        } elseif ($_POST['actions'] === '1') {

            $list = $_POST['checkItem'];
            foreach ($list as $ID) {
                $ID = (int)$ID;
                db_delete("tbl_post", "`post_id`={$ID}");
            }
            redirect_to("?mod=post&action=showListPost");
        } elseif ($_POST['actions'] === '2') {
            $listsPostID = $_POST['checkItem'];


            foreach ($listsPostID as $id) {
                $id=(int)$id;
                db_update("tbl_post",['is_garbage'=>0],"`post_id`=$id");
            }
            redirect_to("?mod=post&action=showListPost");
        }
    }
}


function deletePostAction()
{
    $postID = (int)$_GET['id'];
    db_delete("tbl_post", "post_id={$postID}");
    redirect_to("?mod=post&action=showListPost");
}
function updatePostAction()
{
    $postID = (int)$_GET['id'];
    $flag = db_is_exist("tbl_post", "post_id={$postID}");
    if ($flag) {
        global $errors;
        $list_cat  = get_sub_cat();
        $data['list_cat'] = $list_cat;
        if (isset($_POST['btn_update'])) {
            is_post_title();
            is_desc();
            is_detail();
            is_image_post();
            is_parent_cat();

            if (empty($errors)) {
                $dir = "public/images/post_thumb/";
                $namefile = pathinfo($_FILES['post_thumb']['name'], PATHINFO_BASENAME);
                $file = $dir . $namefile;
                move_uploaded_file($_FILES['post_thumb']['tmp_name'], $file);
                $post_infor['post_title'] = $_POST['post_title'];
                $post_infor['post_desc'] = $_POST['post_desc'];

                $post_infor['cat_id'] = $_POST['parent_cat'];
                $post_infor['date_edit'] = time();
                $post_infor['editor'] = $_SESSION['id'];
                $post_infor['scope'] = $_POST['scope'];
                db_update("tbl_post", $post_infor, "post_id={$postID}");
            }
        }
        $post = db_fetch_row("SELECT*FROM `tbl_post` WHERE `post_id`={$postID}");

        $data['post'] = $post;
        load_view('updatePost', $data);
    } else {

        redirect_to("?mod=post&action=showListPost");
    }
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
            if ($action == 1) {
                foreach ($list_unconfirm as $list) {
                    db_update('tbl_post', ['status' => '1'], "post_id={$list['post_id']}");
                }
                redirect_to("?mod=post&action=showListPost");
            }
        }
        $data['list_unconfirm'] = $list_unconfirm;
        load_view('confirm', $data);
    }
}
function showPostedAction()
{
    $list_posted = get_list_posted();
    $data['list_posted'] = $list_posted;
    load_view("posted", $data);
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
                    db_update('tbl_post', ['is_garbage' => '1'], "post_id={$l}");
                }
            }
        }
        if ($action == 2) {
            if (!empty($listItem)) {
                foreach ($listItem as $l) {
                    $l=(int)$l;
                    db_delete("tbl_post", "post_id={$l}");
                   
                }
            }
        }

  
    }
    load_view("garbage", $data);
}
