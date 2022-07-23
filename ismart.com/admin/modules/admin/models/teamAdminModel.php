<?php 
function get_list_admin(){
    $list = db_fetch_array("SELECT *FROM `tbl_admin`");
    return $list;

}
function get_role($id){
    if($id==1){
        echo " Quản trị viên";
    }
    elseif($id==2){
        echo " Biên tập viên";
    }
    elseif($id==3){
        echo "Cộng tác viên";
    }
}
function get_licensor($licensorId){
    $admin= db_fetch_row("SELECT*FROM `tbl_admin` WHERE `id`={$licensorId}");
    echo $admin['username'];
}

?>