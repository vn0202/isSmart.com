<?php 
function db_connect()
{
    global $db;
    global $conn;
    $conn= mysqli_connect($db['host'],$db['username'], $db['password'], $db['database']);
    if(!$conn){
        die("Connect to database fail". mysqli_connect_error());
    }
}
function db_query($query_string){
    global $conn;
    $mysql_result = mysqli_query($conn,$query_string);
    if(!$mysql_result){
        db_query_error("Query error", $query_string);

    }
   
        return $mysql_result;
    
}
function db_fetch_row($query_string){
    $mysql_result= db_query($query_string);
   
    $result = mysqli_fetch_assoc($mysql_result);
    mysqli_free_result($mysql_result);
    return $result;
}
function db_fetch_array($query_string){
    $result=[];
    $mysql_result= db_query($query_string);
   
    if(mysqli_num_rows($mysql_result)>0){
        while($row= mysqli_fetch_assoc($mysql_result)){
            $result[]= $row;
        }
        mysqli_free_result($mysql_result);
      
    }
    return $result;

}
function escape_string($val){
    global $conn;
    return mysqli_real_escape_string($conn, $val);
}
function db_insert($table_name, $data=[]){
   global $conn;
        $fields = implode(",",array_keys( $data));
        $values= "";
        if(!empty($data)){
            foreach ($data as $key=>$val){
                if($val===NULL){
                    $values.="NULL, ";
                }
                else{
                    $values.= "'". escape_string($val). "', ";
                }
            }
        $values= substr($values, 0,-2);
        }
      db_query("INSERT INTO `$table_name` ($fields) VALUES ($values)");

    return mysqli_affected_rows($conn);
    
}
function db_update($table_name, $data, $where){
    global $conn;
    $sql="";
    foreach ($data as $field=>$value){
        if($value===NULL){
            $sql.=$field."=NULL, ";
        }
        else{
            $sql.= $field. "='". escape_string($value). "', ";
        }
        

    }
    $sql= substr($sql,0, -2);
    db_query("UPDATE `$table_name` SET $sql WHERE {$where}");
    return mysqli_affected_rows($conn);

}
function db_delete($table_name, $where){
global $conn;
db_query("DELETE FROM `$table_name` WHERE {$where}");
return mysqli_affected_rows($conn);
}
function db_sql_error($message, $query_string = "") {
    global $conn;

    $sqlerror = "<table width='100%' border='1' cellpadding='0' cellspacing='0'>";
    $sqlerror.="<tr><th colspan='2'>{$message}</th></tr>";
    $sqlerror.=($query_string != "") ? "<tr><td nowrap> Query SQL</td><td nowrap>: " . $query_string . "</td></tr>\n" : "";
    $sqlerror.="<tr><td nowrap> Error Number</td><td nowrap>: " . mysqli_errno($conn) . " " . mysqli_error($conn) . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> Date</td><td nowrap>: " . date("D, F j, Y H:i:s") . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> IP</td><td>: " . getenv("REMOTE_ADDR") . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> Browser</td><td nowrap>: " . getenv("HTTP_USER_AGENT") . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> Script</td><td nowrap>: " . getenv("REQUEST_URI") . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> Referer</td><td nowrap>: " . getenv("HTTP_REFERER") . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> PHP Version </td><td>: " . PHP_VERSION . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> OS</td><td>: " . PHP_OS . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> Server</td><td>: " . getenv("SERVER_SOFTWARE") . "</td></tr>\n";
    $sqlerror.="<tr><td nowrap> Server Name</td><td>: " . getenv("SERVER_NAME") . "</td></tr>\n";
    $sqlerror.="</table>";
    $msgbox_messages = "<meta http-equiv=\"refresh\" content=\"9999\">\n<table class='smallgrey' cellspacing=1 cellpadding=0>" . $sqlerror . "</table>";
    echo $msgbox_messages;
    exit;
}
function db_is_exist($table_name, $where){
    global $conn;
    $result= db_fetch_row("SELECT*FROM `$table_name` WHERE {$where}");
    if(!empty($result)){
        return true;
    }
    return false;
}
function get_banner_by_position($position)
{
    $result = db_fetch_array("SELECT * FROM `tbl_banner` WHERE `position`={$position} AND `status`='2'");
return $result;

}
function get_infor_shop()
{
    $result = db_fetch_row("SELECT * FROM `tbl_infor`");
    return $result;
}
