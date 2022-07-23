<?php 
function construct(){
load_model("index");
}
function indexAction(){
   global $numberPerPage;
   global $config;
   $numberPerPage =$config['numberPerPage'] ;

   $currentPage = isset($_GET['page']) ? $_GET['page']: 1;
   $currentPage= (int)$currentPage;
   $totalPost = count(get_list_post());

   $list_post = get_list_post_by_page($currentPage);
   $data['showBanner']= true;
   $data['list_post']= $list_post;
   $data['totalPost']= $totalPost;
   $data['currentPage']= $currentPage;
   $data['numberPerPage']= $numberPerPage;
   
   load_view("index",$data);
} 
function detailAction(){
   $postID=(int) $_GET['id'];
  if( !db_is_exist("tbl_post","post_id= {$postID}")){
     echo "<p> Bài viết này không tồn tại</p>";
  }
  else{
     $post = db_fetch_row("SELECT *FROM `tbl_post` WHERE `post_id`={$postID}");
    $data['post']= $post;
    load_view('detail',$data);
  }
}
?>