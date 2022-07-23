<?php
function get_pagin($totalPost, $numberPerPage, $currentPage, $baseUrl = '')
{
    $totalPage = ceil($totalPost / $numberPerPage);
    if ($totalPage > 1) {
        $pagin = "<ul>";
        for($i=1; $i <= $totalPage; $i++)
        {
             $pagin.= "<li>{$i}</li>";
             
        }

        $pagin .= "</ul>";
    }
}
