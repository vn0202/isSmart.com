<?php
function construct()
{
    load_model('teamAdmin');
}
function indexAction()
{
    global $data;
    $listsAdmin = get_list_admin();
    $data['listsAdmin'] = $listsAdmin;
    load_view('teamAdmin', $data);
}
function deleteAction()
{
    $id = (int)$_SESSION['id'];
    $admin = get_admin($id);
    if ($admin['role'] != 1) {
        echo " Chỉ có admin mới có quyền xóa thành viên";
    } else {

        $id = (int)$_GET['id'];
        db_delete("tbl_admin", "`id`={$id}");
        redirect_to("?mod=admin&controller=teamAdmin");
    }
}
function processAction()
{
    // global $data;
    $id = (int)$_SESSION['id'];
    $admin = get_admin($id);
    if ($admin['role'] != 1) {
        echo " Chỉ có admin mới có quyền xóa thành viên hay đổi quyền cho các thành viên khác ";
    } else {
        if ((isset($_GET['actions']) && $_GET['actions'] === '1')) {
            $id = (int)$_GET['id'];

            $admin = get_admin($id);
            $data['admin'] = [$admin];

            load_view('changeLicensor', $data);
        }
        if ($_POST['actions'] === '0') {
            redirect_to("?mod=admin&controller=teamAdmin");
        } elseif ($_POST['actions'] === '2') {

            $list = $_POST['checkItem'];
            foreach ($list as $ID) {
                $ID = (int)$ID;
                db_delete("tbl_admin", "`id`={$ID}");
            }
            redirect_to("?mod=admin&controller=teamAdmin");
        } elseif ($_POST['actions'] === '1') {
            $listsAdminID = $_POST['checkItem'];
            global $data_send;
            $data = [];
            foreach ($listsAdminID as $id) {
                $admin = get_admin((int)$id);
                $data[] = $admin;
            }
            $data_send['admin'] = $data;
            if (isset($_POST['changeLicensor'])) {
                foreach ($listsAdminID as $id){
                    $licence= $_POST["licens-$id"];
                    $send_data['role']= $licence;
                    db_update(`tbl_admin`,$send_data,"`id`={$id}");
                }
                
            }
            load_view('changeLicensor', $data_send);
        }
    }
}
function changeAction(){
//  $data = $_POST;
 foreach($_POST as $key=>$val){
     if($key!="changeLicensor"){
         $data[$key]=$val;
     }
 }
 foreach($data as $da){
    
   $temp = explode("-",$da);
  
   db_update("tbl_admin",['role'=>$temp[0]],"`id`={$temp[1]}");

 }
 redirect_to("?mod=admin&controller=teamAdmin");
// var_dump($data);

}