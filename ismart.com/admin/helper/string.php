<?php 
function convert_price_to_string($price, $unit = "VNĐ")
{
    $price = (int)$price;
    return  number_format($price, 0, ".", ".") . $unit;
}
?>