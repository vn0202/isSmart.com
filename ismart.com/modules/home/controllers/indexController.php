<?php
function construct()
{
  load_model("index");
}
function indexAction()
{
  
  $listParentCatProduct = get_list_parent_cat_product();

  $data['listSlider']= get_list_slider();
  $data['listCatParent'] = $listParentCatProduct;
  //     $x = get_avatar_product('public/images/product/SANPHAM1/samsung3.webp;public/images/product/SANPHAM1/samsungA20.jfif;public/images/product/SANPHAM1/samsungA51.jfif');

  // echo "<img src= \"{$x}\">";
  $listBestSell = get_list_best_sell();
  $data['listBestSell']= $listBestSell;
  load_view("index", $data);
}
function listProductByParentCatAction()
{
  $catID = (int)$_GET['id'];

  $data['listCatParent'] = get_list_parent_cat_product();

  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $catParent = db_fetch_row("SELECT * FROM `tbl_parent_cat_product` WHERE `cat_id`={$catID}");
  $listCat = get_list_cat_product_by_parent($catID);
  $data['listCat'] = $listCat;
  $data['catParent'] = $catParent;
  $data['currentPage'] = $currentPage;
  $data['total'] = count(get_list_product_by_cat_parent($catID));

  $listProduct = get_list_product_by_cat_parent($catID, $currentPage);


  if (isset($_POST['btn_submit'])) {
    $actions = (int)$_POST['select'];
    switch ($actions) {
      case 1:
        usort($listProduct, build_sorter("product_title"));
        break;
      case 2:
        usort($listProduct, build_sorter("product_title", "ASC"));
        break;
      case 3:
        usort($listProduct, build_sorter("product_price"));
        break;
      case 4:
        usort($listProduct, build_sorter("product_price", "ASC"));
        break;
    }
  }
  $data['listProduct'] = $listProduct;


  load_view("productByCatParent", $data);
}
function listProductBySubCatAction()
{
  $catID = (int)$_GET['id'];
  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $data['currentPage'] = $currentPage;

  $data['listCatParent'] = get_list_parent_cat_product();

  $subCatID = (int)$_GET['subCat'];
// $_SESSION['brand']= $subCatID;
$data['subCat']= $subCatID;
  $data['catTitle'] = get_cat_title($subCatID);
  $data['listCatByCat'] = get_list_product_by_cat($subCatID);
  $listProduct = get_list_product_by_cat($subCatID, $currentPage);
  $data['totalProduct'] = count(get_list_product_by_cat($subCatID));

  if (isset($_POST['btn_submit'])) {
    $actions = (int)$_POST['select'];
    switch ($actions) {
      case 1:
        usort($listProduct, build_sorter("product_title"));
        break;
      case 2:
        usort($listProduct, build_sorter("product_title", "ASC"));
        break;
      case 3:
        usort($listProduct, build_sorter("product_price"));
        break;
      case 4:
        usort($listProduct, build_sorter("product_price", "ASC"));
        break;
    }
  }
  $data['listProduct'] = $listProduct;

  $catParent = db_fetch_row("SELECT * FROM `tbl_parent_cat_product` WHERE `cat_id`={$catID}");
  $data['catParent'] = $catParent;
  $data['subCat'] = $subCatID;


  load_view("productByCat", $data);
}
function handleFilterAction()
{
  // if(isset($_SESSION['brand'])){
  //   $brand= $_SESSION['brand'];
  //   unset($_SESSION['brand']);
  // }
  // else{

    $brand = empty($_POST['brand']) ? "" : " AND `cat_id`={$_POST['brand']}";
  // }

  $catID = $_POST['catParent'];
  $range = (int)$_POST['range'];
  $catProduct = db_fetch_array("SELECT * FROM `tbl_cat_product` WHERE `cat_parent`={$catID}");
  $catProduct = array_column($catProduct, "cat_id");
  $catProduct = implode(",", $catProduct);

  switch ($range) {
    case 1:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price`<5000000 {$brand} ");
      break;
    case 2:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price` BETWEEN 5000000 AND 10000000  {$brand}");
      break;
    case 3:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price` BETWEEN 10000000 AND 15000000 {$brand}");
      break;
    case 4:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price` BETWEEN 15000000 AND 20000000 {$brand}");
      break;
    case 5:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price` >20000000 {$brand}");
      break;
  }


  // $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price`<5000000 ");

  echo json_encode($listProduct);
}
function handleFilterBrandAction()
{
  $catID = $_POST['catParent'];
  $range = isset($_POST['range']) ? $_POST['range'] : null;
  $brand = "AND `cat_id`={$_POST['brand']}";
  $catProduct = db_fetch_array("SELECT * FROM `tbl_cat_product` WHERE `cat_parent`={$catID}");
  $catProduct = array_column($catProduct, "cat_id");
  $catProduct = implode(",", $catProduct);
  if(!empty($range))
  {

    switch ($range) {
      case 1:
        $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price`<5000000 {$brand} ");
        break;
      case 2:
        $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price` BETWEEN 5000000 AND 10000000  {$brand}");
        break;
      case 3:
        $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price` BETWEEN 10000000 AND 15000000 {$brand}");
        break;
      case 4:
        $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price` BETWEEN 15000000 AND 20000000 {$brand}");
        break;
      case 5:
        $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price` >20000000 {$brand}");
        break;
    }
  }
else{

  $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`={$_POST['brand']}");
}

$sendData['listProduct'] = $listProduct;
$brandTitle = db_fetch_row("SELECT `cat_title` FROM `tbl_cat_product` WHERE `cat_id`={$_POST['brand']}");
$sendData['brand']=$brandTitle['cat_title']; 


  // $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price`<5000000 ");

  echo json_encode($sendData);
}
function handleFilterByBrandAction(){
  $brand = (int)$_POST['brand'];
  // $catID = $_POST['catParent'];
  $range = (int)$_POST['range'];
  
  $listProduct=[];

  switch ($range) {
    case 1:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`='{$brand}' AND `product_price`< 5000000");
      break;
    case 2:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`='{$brand}' AND `product_price` BETWEEN 5000000 AND 10000000 ");
      break;
    case 3:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`='{$brand}' AND `product_price` BETWEEN 10000000 AND 15000000");
      break;
    case 4:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`='{$brand}' AND `product_price` BETWEEN 15000000 AND 20000000");
      break;
    case 5:
      $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id`='{$brand}' AND `product_price` > 20000000");
      break;
  }


  // $listProduct = db_fetch_array("SELECT * FROM `tbl_product` WHERE `cat_id` IN ($catProduct) AND `product_price`<5000000 ");

  echo json_encode($listProduct);

}
function seemoreAction()
{
  $catID = $_POST['catID'];
  $listProduct = get_list_product_by_cat_parent($catID);
  $result =[];
foreach($listProduct as $product)
{
 $item=[];
 $item['id']= $product['product_id'];
 $item['title']= $product['product_title'];
 $item['thumb']= get_avatar_product($product['product_thumb']);
 $item['link']= "chi-tiet-san-pham/".replace_white($product['product_title']).'-'. $product['product_id']."html" ;
 $item['price']= convert_currency($product['product_price']);
 if(!empty($product['old_price'])){
  $item['old_price']= convert_currency($product['old_price']);
 }
 else{
  $item['old_price']="";
 }
  array_push($result,$item);
}
  echo json_encode($result);
}
function handleBannerLeftAction()
{
  $listBanner = db_fetch_array("SELECT * FROM `tbl_banner` WHERE `status`='2' AND `position`='1'");
 foreach ($listBanner as &$banner)
 {
$banner['banner_thumb']= "admin/".$banner['banner_thumb'];
 }
  echo json_encode($listBanner); 
}
function handleBannerTopAction()
{
  $listBanner = db_fetch_array("SELECT * FROM `tbl_banner` WHERE `status`='2' AND `position`='2'");
 foreach ($listBanner as &$banner)
 {
$banner['banner_thumb']= "admin/".$banner['banner_thumb'];
 }
  echo json_encode($listBanner); 
}