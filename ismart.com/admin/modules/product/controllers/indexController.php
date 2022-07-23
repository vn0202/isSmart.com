<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    $data = [];
    $listParentCat = get_cat_parent();
    $listIdParentCat = array_column($listParentCat, "cat_id");
    $listSubCat = get_list_sub_cat();

    if (!empty($listSubCat)) {
        foreach ($listSubCat as $cat) {
            if (in_array($cat['cat_parent'], $listIdParentCat)) {
                $title = get_title_parent_cat($cat['cat_parent']);
                if (!empty($title)) {
                    $data[$title['cat_title']][] = $cat;
                }
            }
        }
    }

    $data['listParentCat'] = $listParentCat;

    load_view('index', $data);
}
function addParentCatAction()
{
    global $errors;
    if (isset($_POST['btn_add_cat'])) {
        is_vaid_cat("tbl_parent_cat_product");
        if (empty($errors)) {
            $catTitle['cat_title'] = $_POST['cat_title'];
            $catTitle['creator'] = $_SESSION['id'];
            $catTitle['date_cre'] = time();

            db_insert('tbl_parent_cat_product', $catTitle);
        }
    }
    load_view('addParentCat');
}
function deleteParentCatAction()
{
    if (isset($_GET['id'])) {

        $idDelete = (int)$_GET['id'];
        if (is_exist_id('tbl_parent_cat_product', 'cat_id', $idDelete)) {
            db_delete('tbl_parent_cat_product', "cat_id={$idDelete}");
        }
    }
    redirect_to("?mod=product");
}
function renameParentCatAction()
{

    global $errors;
    if (isset($_GET['id'])) {
        $catID = (int)$_GET['id'];
        if (!is_exist_id('tbl_parent_cat_product', 'cat_id', $catID)) {
            $_SESSION['noExist'] = true;
            redirect_to("?mod=product");
        } else {
            $cat = db_fetch_row("SELECT * FROM `tbl_parent_cat_product` WHERE `cat_id`={$catID}");
            if (isset($_POST['btn_add_cat'])) {
                is_vaid_cat("tbl_parent_cat_product");
                if (empty($errors)) {
                    $catTitle = $_POST['cat_title'];
                    db_update("tbl_parent_cat_product", ['cat_title' => $catTitle], "`cat_id`={$catID}");
                }
            }
            $data['catTitle'] = $cat['cat_title'];
            load_view('renameParentCat', $data);
        }
    }
}
function addSubCatAction()
{
    global $errors;
    $listParentCat = get_cat_parent();
    if (isset($_POST['btn_add_cat'])) {
        if (empty($_POST['parent_cat'])) {
            $errors['parent_cat'] = ["Bạn chưa chọn danh mục cha"];
        }
        is_vaid_cat("tbl_cat_product");
        if (empty($errors)) {
            $catTitle['cat_title'] = $_POST['cat_title'];
            $catTitle['creator'] = $_SESSION['id'];
            $catTitle['date_cre'] = time();
            $catTitle['cat_parent'] = (int)$_POST['parent_cat'];

            db_insert('tbl_cat_product', $catTitle);
        }
    }
    $data['listParentCat'] = $listParentCat;
    load_view("addSubCat", $data);
}

function addProductAction()
{
    global $errors;
    $listParentCat = get_cat_parent();


    $data['listParentCat'] = $listParentCat;

    if (isset($_POST['btn_submit'])) {
        is_valid_thumb();

        is_valid_name_product();
        is_valid_desc();
        is_valid_content();
        is_valid_price();
        is_cat_product();
        is_code_product();
        if (empty($errors)) {
            $product['product_title'] = $_POST['product_title'];
            $product['product_desc'] = $_POST['product_desc'];
            $product['product_content'] = $_POST['product_content'];
            $product['cat_id'] = $_POST['cat_id'];
            $product['product_price'] = $_POST['product_price'];
            $product['creator'] = $_SESSION['id'];
            $product['date_cre'] = time();
            $product['status'] = $_POST['status'];
            $product['code'] = $_POST['code'];
            $product['product_number'] = $_POST['product_number'];

            $j = 1;
            $temp = "public/images/product/SANPHAM";
            $dir = $temp . $j;
            while (is_dir($dir)) {
                $j++;
                $dir = $temp . $j . "/";
            }
            mkdir($dir);
            // move_thumb_to_file("public/images/temp/", $dir);
            move_thumb_to_folder($dir);

            $lists = read_dir($dir);
            $lists = implode(";", $lists);
            $product['product_thumb'] = $lists;
            db_insert("tbl_product", $product);
            // show_data($_FILES['thumb']);
            unset($_POST);
        }
    }

    load_view("addProduct", $data);
}
function showListProductAction()
{

    if (isset($_POST['btn_action'])) {

        $checkRole  = get_role($_SESSION['id']);
        if ($checkRole != 1) {
            $_SESSION['noPermiss'] = true;
        } else {

            $listItemChecked = [];
            if (!empty($_POST['checkItem'])) {

                $listItemChecked = $_POST['checkItem'];
            }
            if (!empty($listItemChecked)) {
                $action =  $_POST['actions'];
                foreach ($listItemChecked as $item) {
                    $item = (int)$item;
                    if ($action == 1) {

                        db_update("tbl_product", ['status' => 2], "`product_id`={$item}");
                    } elseif ($action == 2) {
                        db_update("tbl_product", ['status' => 1], "`product_id`={$item}");
                    } elseif ($action == 3) {
                        db_update("tbl_product", ['is_garbage' => 1], "`product_id`={$item}");
                    }
                }
            }
        }
    }


    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $listProduct = get_list_product_by_page($currentPage, "WHERE `is_garbage`='0'");
   remove_dir("public/images/temp",false);
    $data['listProduct'] = $listProduct;
    $data['currentPage'] = $currentPage;
    load_view("listProduct", $data);
}
function updateProductAction()
{
    global $errors;
    $productID = (int)$_GET['id'];
    $dir = "public/images/temp/";
    

    if (is_exist_id('tbl_product', 'product_id', $productID)) {
        $listParentCat = get_cat_parent();

        $data['listParentCat'] = $listParentCat;
        $product = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`= {$productID}");
        $productThumb = $product['product_thumb'];
        $productThumb = explode(";", $productThumb);
        if (!empty($productThumb) && !isset($_POST['btn_upload_thumb']) && !isset($_POST['btn_update'])) {


            foreach ($productThumb as $thumb) {
                $filename = pathinfo($thumb, PATHINFO_BASENAME);
                copy($thumb, "public/images/temp/" . $filename);
            }
          
        }
        $dirTaget = pathinfo($productThumb[0], PATHINFO_DIRNAME);
       
        $data['product'] = $product;
        if (isset($_POST['btn_upload_thumb'])) {
            is_valid_thumb();
            if (empty($errors['thumb'])) {

                foreach ($_FILES['thumb']['name'] as $key => $fileName) {

                    //     // $file = basename($fileName);
                    $pathFolder = "public/images/temp/" . $fileName;
                    $pathFolder = auto_rename_file("public/images/temp/", $pathFolder);
                    move_uploaded_file($_FILES['thumb']['tmp_name'][$key], $pathFolder);
                }
            }
        }

        if (isset($_POST['btn_update'])) {
            is_valid_name_product();
            is_valid_desc();
            is_valid_content();
            is_valid_price();
            is_cat_product();
            is_code_product();
            if (empty($errors)) {
                $product['product_title'] = $_POST['product_title'];
                $product['product_desc'] = $_POST['product_desc'];
                $product['product_content'] = $_POST['product_content'];
                $product['cat_id'] = $_POST['cat_id'];
                $product['product_price'] = $_POST['product_price'];
                $product['creator'] = $_SESSION['id'];
                $product['date_edit'] = time();
                $product['status'] = $_POST['status'];
                $product['code'] = $_POST['code'];
                $product['product_number'] = $_POST['product_number'];

                remove_dir($dirTaget,false);
             
                move_thumb_to_file("public/images/temp/", $dirTaget);
 
                $lists = read_dir($dirTaget);
                $lists = implode(";", $lists);
                
                $product['product_thumb'] = $lists;
                db_update("tbl_product", $product, "`product_id`={$productID}");
                redirect_to("?mod=product&action=showListProduct");
               
            }
        }
    
        load_view("updateProduct", $data);
    }
}
function deleteThumbAction()
{
    $id = (int)$_POST['id'];
    $list = read_dir("public/images/temp/");

    unlink($list[$id]);
}
function deleteProductAction()
{
    $productID = (int)$_GET['id'];
    if (is_exist_id("tbl_product", "product_id", $productID)) {
        db_delete("tbl_product", "product_id={$productID}");
        $dir = get_folder_thumb_product($productID);
        if (is_dir($dir)) {
            remove_dir($dir);
        }
        redirect_to("?mod=product&action=showListProduct");
    } else {
        $_SESSION['noExist'] = True;
        redirect_to("?mod=product&action=showListProduct");
    }
}
function showGarbageAction()
{
    if (isset($_POST['btn_action'])) {
        $listItemChecked = [];
        if (!empty($_POST['checkItem'])) {

            $listItemChecked = $_POST['checkItem'];
        }
        if (!empty($listItemChecked)) {
            $action =  $_POST['actions'];
            foreach ($listItemChecked as $item) {
                $item = (int)$item;
                if ($action == 1) {

                    db_update("tbl_product", ['is_garbage' => '0'], "`product_id`={$item}");
                } elseif ($action == 2) {
                    db_delete("tbl_product", "`product_id`={$item}");
                    if (is_exist_id("tbl_product", "product_id", $item)) {
                        db_delete("tbl_product", "product_id={$$item}");
                        $dir = get_folder_thumb_product($item);
                        if (is_dir($dir)) {
                            remove_dir($dir);
                        }
                    } else {
                        $_SESSION['noExist'] = True;
                    }
                }
            }
        }
    }
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $listProduct = get_list_product_by_page($currentPage, "WHERE `is_garbage`= '1' ");

    $data['listProduct'] = $listProduct;
    $data['currentPage'] = $currentPage;


    $data['listProduct'] = $listProduct;
    load_view("garbage", $data);
}
function showPostedProductAction()
{
    if (isset($_POST['btn_action'])) {
        $listItemChecked = [];
        if (!empty($_POST['checkItem'])) {

            $listItemChecked = $_POST['checkItem'];
        }
        if (!empty($listItemChecked)) {
            $action =  $_POST['actions'];
            foreach ($listItemChecked as $item) {
                $item = (int)$item;
                if ($action == 1) {

                    db_update("tbl_product", ['status' => '1'], "`product_id`={$item}");
                } elseif ($action == 2) {
                    db_update("tbl_product", ['is_garbage' => '1'], "`product_id`={$item}");
                }
            }
        }
    }


    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $listProduct = get_list_product_by_page($currentPage, "WHERE `is_garbage`='0' AND `status`=2");

    $data['listProduct'] = $listProduct;

    $data['currentPage'] = $currentPage;
    load_view("postedProduct", $data);
}
function showUnconfirmProductAction()
{
    if (isset($_POST['btn_action'])) {
        $listItemChecked = [];
        if (!empty($_POST['checkItem'])) {

            $listItemChecked = $_POST['checkItem'];
        }
        if (!empty($listItemChecked)) {
            $action =  $_POST['actions'];
            foreach ($listItemChecked as $item) {
                $item = (int)$item;
                if ($action == 1) {

                    db_update("tbl_product", ['status' => '2'], "`product_id`={$item}");
                } elseif ($action == 2) {
                    db_update("tbl_product", ['is_garbage' => '0'], "`product_id`={$item}");
                }
            }
        }
    }

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $listProduct = get_list_product_by_page($currentPage, "WHERE `is_garbage`='0' AND `status`=1");

    $data['listProduct'] = $listProduct;
    $data['currentPage'] = $currentPage;

    $data['listProduct'] = $listProduct;
    load_view("confirmProduct", $data);
}
// function handleUploadThumbAction(){
//     $id = $_POST['id'];
//     $listThumb = db_fetch_row("SELECT `product_thumb` FROM `tbl_product` WHERE `product_id`={$id}");
//     $listThumb= implode("",$listThumb);
//     $listThumb = explode(";",$listThumb);
//     echo json_encode($listThumb);
// }