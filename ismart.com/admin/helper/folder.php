<?php 
function read_dir($dir){
    $dir = rtrim($dir,"/");
    $listFile = [];
    if(is_dir($dir)){

        $lists=scandir($dir);
     foreach($lists as $d){
        if($d !='.' && $d!='..'){
            $temp = $dir."/".$d;
            array_push($listFile,$temp);
        }
     }
    }
    
  return $listFile;
    
}
// delete all file and subdir
function remove_dir($dir,$flag=true){
    $dir= rtrim($dir,"/");
if(is_dir($dir)){
    $lists = scandir($dir);
    foreach($lists as $item){
        
        if($item !='.' && $item !=".."){
            if(is_dir($dir."/".$item)){
                remove_dir($dir."/".$item);
            }
            else{
        unlink($dir."/".$item);
            }
        }
    }
    reset($lists);
    if($flag==true)
    {
        rmdir($dir);
    }
}
}
function auto_rename_file($file, $folder)
{
    $folder = rtrim($folder, "\/");
    if (is_dir($folder)) {
        $nameFile = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        $temp = $folder . "/" . $nameFile . "." . $extension;
        if (file_exists($temp)) {
            $i = 1;
            while (file_exists($temp)) {
                $temp = $folder . "/" . $nameFile . "-Copy-" . $i . "." . $extension;
                $i++;
            }
        }
        return $temp;
    }
}

?>