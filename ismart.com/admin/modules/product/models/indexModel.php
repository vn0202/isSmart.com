<?php

use function Aws\flatmap;

function get_cat_parent(){
    $result= db_fetch_array("SELECT *FROM `tbl_parent_cat_product`");
    return $result;
}
function get_list_sub_cat(){
    $result=db_fetch_array("SELECT*FROM `tbl_cat_product`");
    return $result;
}
function get_title_parent_cat($id){
    $id=(int)$id;
    $result= db_fetch_row("SELECT `cat_title` FROM `tbl_parent_cat_product` WHERE `cat_id`={$id}");
    return $result;

}

function  get_status($status)
{
    if ($status == 2) {
        echo " Hoạt động";
    } else {
        echo " Không hoạt động";
    }
}
function get_creator($id)
{
    $admin = db_fetch_row("SELECT*FROM `tbl_admin` WHERE `id`={$id}");
    echo $admin['username'];
}
function strip_white_space($string){
    $string= preg_replace("/[+\-* ]+/",'',$string);
    return $string;
}
function is_cat_exist($tbl_name,$cat_title){
    $listCatParent= db_fetch_array("SELECT `cat_title` FROM  `{$tbl_name}`");
    if(!empty($listCatParent)){
        foreach($listCatParent as $catParent){
            if(mb_strtolower(strip_white_space($cat_title))==mb_strtolower(strip_white_space($catParent['cat_title']))){
                return true;
            }
        }
    }
    return false;
}
function is_vaid_cat($tbl_name){
    global $errors;
    if(empty($_POST['cat_title'])){
        $errors['cat_title']= " Bạn chưa đặt tên cho danh mục cha";
    }
    else{
        $catTitle=$_POST['cat_title'];
        $pattern = "/[^\@\#\$%\^\&\*\(\)]{1,40}/";
        if(!preg_match($pattern,$catTitle)){
            $errors['cat_title']= "Bạn nên đặt tên danh mục chỉ chứa các chữ cái, số và _-";
        }
        elseif(is_cat_exist($tbl_name,$catTitle)){
$errors['cat_title']= "Danh mục này đã tồn tại";
        }
    }
}
function is_exist_id($tbl_name,$key, $id)
{
    $mysql = db_query("SELECT *FROM `$tbl_name` WHERE `$key`={$id}");
    if (mysqli_num_rows($mysql) > 0) {
        return true;
    }
    return false;
}
// ====================== product ====================
function get_list_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `is_garbage`='0'");
    return $result;
}
function get_title_cat($id){
    $id=(int)$id;
    $result= db_fetch_row("SELECT  `cat_title` FROM `tbl_cat_product` WHERE `cat_id`={$id}");
    return $result['cat_title'];

}
function is_empty($id){
    $id=(int)$id;
    $result=db_fetch_row("SELECT `number_product` FROM `tbl_product` WHERE `product_id`={$id}");
    if($result['number_product'] =0 ){
        return true;
    }
    return false;

}
// =================== handle add product ===================
function get_list_cat_product_by_parent($parentCat){
    $parentCat=(int)$parentCat;
    $result= db_fetch_array("SELECT * FROM `tbl_cat_product` WHERE `cat_parent`={$parentCat}");
    return $result;
}

// function is_valid_thumb(){
//     global $errors;
//     if(empty($_FILES['thumb']['name'])){
//         $errors['thumb']= "Bạn chưa chọn ảnh cho sản phẩm";
//     }
//     else{
//         $extensionSupport= ['jpg','webp','png','jpeg','jfif'];
//         $extension = pathinfo($_FILES['thumb']['name'],PATHINFO_EXTENSION);
//         if(!in_array($extension,$extensionSupport)){
//             $errors['thumb']= "chỉ hỗ trợ định dạng file ảnh như: jpg,webp,png,jpeg,jfif";
//         }
//         // check the size whether if is more than 20MB
//         elseif($_FILES['thumb']['size'] > 20*1024*1024){
// $errors['thumb']= " Kích thước file ảnh quá lớn ";
//         }
        

//     }
// }
function is_valid_thumb(){
    global $errors;
    if(empty($_FILES['thumb']['name'])){
        $errors['thumb']= "Bạn chưa chọn ảnh cho sản phẩm";
    }
    else{
        foreach($_FILES['thumb']['name'] as $file)
        {

            $extensionSupport= ['jpg','webp','png','jpeg','jfif'];
            $extension = pathinfo($file,PATHINFO_EXTENSION);
            if(!in_array($extension,$extensionSupport)){
                $errors['thumb']= "chỉ hỗ trợ định dạng file ảnh như: jpg,webp,png,jpeg,jfif";
            }
             
        }
        foreach($_FILES['thumb']['size'] as $size){
            if($size> 20*1024 *1024){
                $errors['thumb']= "Kich thước ảnh quá lớn";
            }
        }

    }
}
// function auto_rename_file($dir,$file){
//     $extension= pathinfo($file,PATHINFO_EXTENSION);
//         $filename = pathinfo($file,PATHINFO_FILENAME);
//     if(file_exists($file)){ 
//         $i=0;
//         while(file_exists($file)){
//             $i++;
//             $filename.="Copy-{$i}";
//             $file= $dir.$filename.".".$extension;
//         }
//     }
//     return $file;
// }
function get_folder_thumb_product($id){
    $id= (int)$id;
    $dir= "";
    $result=db_fetch_row("SELECT `product_thumb` FROM `tbl_product` WHERE `product_id`={$id}");
    if(!empty($result)){
        $result=implode("",$result);
        $result= explode(";",$result);
        $dir = pathinfo($result[0],PATHINFO_DIRNAME);
    }
    return $dir;
}
function is_valid_name_product(){
    global $errors;
    if(empty($_POST['product_title'])){
        $errors['product_title']= " Bạn cần nhập tên sản phẩm";

    }
    else{
        $pattern = "/^[^\#\$\%\&]{1,100}$/";
        if(!preg_match($pattern,$_POST['product_title'])){
            $errors['product_title']="Tên sản  phâm không được chứa các ký tự: #$%^&*! và không quá 100 ký tự"; 
        }
    }
}
function is_valid_desc(){
    global $errors;
    if(empty($_POST['product_desc'])){
        $errors['product_desc']= "Bạn cần cung cấp mô tả sản phẩm";
    }
}
function is_valid_content(){
    global $errors;
    if(empty($_POST['product_content'])){
        $errors['product_content']= " Bạn cần cung cấp mô tả chi tiết sản phẩm";
    }
}
function is_valid_price(){
    global $errors;
    if(empty($_POST['product_price'])){
        $errors['product_price']= "Bạn chưa cung cấp giá sản phẩm";
    }
    else{
        if(!preg_match("/^[0-9]+$/",$_POST['product_price'])){
            $errors['product_price']= "Giá sản phẩm chỉ được chứa các chữ số";
        }
    }
}
function is_cat_product(){
    global $errors;
    if(empty($_POST['cat_id'])){
$errors['cat_id'] = " Bạn chưa chọn danh mục cho sản phẩm";

    }
}
function is_product_number(){
    global $errors;
    if(empty($_POST['product_number'])){
        $errors['product_number']= " Bạn cần nhập số lượng sản phẩm";
    }
    elseif($_POST['product_number'] < 0){
        $errors['product_number'] = "Số lượng hàng hóa không được âm";
    }
}
function is_code_product(){
    global $errors;
    if(empty($_POST['code'])){
        $errors['code']= " Bạn chưa điền mã sản phẩm";
    }
    else{
        if(!preg_match("/[\w\d\-()\/]{5,40}/",$_POST['code'])){
            $errors['code']= " Mã sản phẩm chỉ chứa chữ và số";
        }
    }
}
function move_thumb_to_file($pathFolder, $toFolder){
    $toFolder = rtrim($toFolder,"/");
    $lists= read_dir($pathFolder);
    if(!empty($lists)){
    foreach ($lists as $l){
        $filename = pathinfo($l,PATHINFO_BASENAME);
    //   $filename= auto_rename_file($toFolder,$filename);
        copy($l,$toFolder."/".$filename);
        unlink($l);
    }
}
   
}
function get_product_thumb($productID){
    $productID= (int)$productID;
    $result  = db_fetch_row("SELECT `product_thumb` FROM `tbl_product` WHERE `product_id`= {$productID}");
    $result=implode("",$result);
    $listThumb = explode(";",$result);
    return $listThumb;
}
function get_total_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `is_garbage`='0'");
    return count($result);
}
function  get_number_unconfirm_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `is_garbage`='0' AND `status`='1'");
    return count($result);

}
function get_number_posted_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `is_garbage`='0' AND `status`='2'");
    return count($result);
    
}
function get_total_garbage(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `is_garbage`='1'");
    return count($result);
}
function get_list_garbage()
{
    $result= db_fetch_array("SELECT * FROM `tbl_product` WHERE `is_garbage`='1'");
    return $result;
}
function get_list_posted_product(){
    $result= db_fetch_array("SELECT * FROM `tbl_product` WHERE `is_garbage`='0' AND `status`='2'");
    return $result;
}
function  get_list_unconfirm_product(){
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `is_garbage`='0' AND `status`='1'");
    return $result;

}
function get_role($id){
    $id= (int)$id;
    $result = db_fetch_row("SELECT `role` FROM `tbl_admin` WHERE `id`={$id}");
    return $result['role'];
}
function get_list_product_by_page($currentPage,$where=""){
    global $config ;
    $numberProductPerPage= $config['numberProductPerPage'];
    $currentPage= (int)$currentPage;
    $offset= ($currentPage-1)*$numberProductPerPage;
    
   
        $result= db_fetch_array( "SELECT * FROM `tbl_product` {$where} LIMIT {$offset},{$numberProductPerPage}");

    
    return $result;

}
function move_thumb_to_folder($dir){
    $dir= rtrim($dir,"/");
    if(is_dir($dir))
    {
       $len =count($_FILES['thumb']['name']);
for($i = 0 ; $i < $len; $i++)
{
$file= $_FILES['thumb']['name'][$i];
    $nameFile = pathinfo($file,PATHINFO_BASENAME);
    move_uploaded_file($_FILES['thumb']['tmp_name'][$i],$dir."/".$nameFile);
}
    


 }
}

?>