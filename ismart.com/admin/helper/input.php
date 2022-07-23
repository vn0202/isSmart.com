<?php
function emit_error($error)
{
    global $errors;

    if (!empty($errors[$error])) {
        echo " <p class='error'> {$errors[$error]}</p>";
    }
}
function set_value($field)
{
    global $errors;

    if (empty($errors[$field])) {
        echo $_POST[$field];
    }
}
function emit_success($field)
{
    global $errors;
    if (empty($errors)) {
        echo "<p> Bạn đã {$field} thành công</p>";
    }
}
function get_pagin($totalPost,  $currentPage, $baseUrl = '')
{
    global $config;
    $numberPerPage= $config['numberProductPerPage'];
    $totalPage = ceil($totalPost / $numberPerPage);
    if ($totalPage > 1) {
        $pagin = "<ul class='pagin fl-right'>";
        if ($currentPage != 1) {
            $prePgae = $currentPage - 1;
            $pagin .= "<li class='pagin__item'> <a class='pagin__item-link' href='{$baseUrl}{$prePgae}'>Trước</a> </li>";
        }
        //test
        $preStep = $currentPage - 2;
        $floStep = $currentPage + 2;
        if ($totalPage <= 5 || $floStep > $totalPage) {
            $floStep = $totalPage;
        }
        if ($preStep <= 0) {
            $preStep = 1;
        }

        if ($preStep >= 3) {
            $decreaseStep = $currentPage - 3;
            $pagin .= "<li class='pagin__item '><a class='pagin__item-link ' href='{$baseUrl}1'>1</a></li>";
            $pagin .= "<li class='pagin__item '><a class='pagin__item-link ' href='{$baseUrl}$decreaseStep'>....</a></li>";
        } elseif ($preStep == 2) {
            $pagin .= "<li class='pagin__item '><a class='pagin__item-link ' href='{$baseUrl}1'>1</a></li>";
        }
        for ($i = $preStep; $i <= $floStep; $i++) {
            $active = ($currentPage == $i) ? "active" : "";

            $pagin .= "<li class='pagin__item '><a class='pagin__item-link {$active}' href='{$baseUrl}{$i}'>{$i}</a></li>";
        }

        $next = $totalPage - $floStep;
        if ($next > 1) {
            $ascendStep = $currentPage + 3;

            $pagin .= "<li class='pagin__item '><a class='pagin__item-link {$active}' href='{$baseUrl}{$ascendStep}'>....</a></li>";

            $pagin .= "<li class='pagin__item '><a class='pagin__item-link {$active}' href='{$baseUrl}{$totalPage}'>$totalPage</a></li>";
        } elseif ($next == 1) {
            $pagin .= "<li class='pagin__item '><a class='pagin__item-link {$active}' href='{$baseUrl}{$totalPage}'>$totalPage</a></li>";
        }
        if ($currentPage != $totalPage) {
            $flowPage = $currentPage + 1;
            $pagin .= "<li class='pagin__item'> <a class='pagin__item-link' href= '{$baseUrl}{$flowPage}'>Sau</a> </li>";
        }
        $pagin .= "</ul>";
        return $pagin;
    }
}
function show_data($data)
{
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
