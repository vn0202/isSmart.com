<?php 
function convert_currency($number,$unit="đ"){
    return number_format($number,0,'.','.').$unit;
}
function replace_white($string){
    return str_replace(" ","-",$string);
}
function handlePhone($phone)
{
   if(strlen($phone)>10){
  $temp = str_split($phone,4);
  return $temp[0].".".$temp[1].".".$temp[2];
   }
   else{
    $temp = substr($phone,0,4);
    $rest= substr($phone,5,);
    $temp2= str_split($rest,3);
    return $temp.'.'.$temp2[0].'.'.$temp2[1];
   }

}
?>