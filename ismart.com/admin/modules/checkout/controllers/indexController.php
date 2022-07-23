<?php
function construct()
{
    load_model("index");
}
function indexAction()
{
    if (isset($_POST['sm_action'])) {
        if ($_POST['actions'] == 1) {
            if (!empty($_POST['checkItem'])) {

                foreach ($_POST['checkItem'] as $item) {
                    $item = (int)$item;
                    db_update("tbl_order", ["is_checked" => "2"], "`order_id`={$item}");
                }
            }
        }
    }
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $data['currentPage']= $currentPage;
    $type = isset($_GET['type']) ? $_GET['type']: 0;
    $active = $type;
    // switch ($type) {
    //     case 0:
    //         $listOrder = get_list_order();
    //         break;
    //     case 1:
    //         $listOrder = get_list_order("WHERE `is_checked`='2'");
    //         break;
    //         case 2:
    //             $listOrder= get_list_order("WHERE `is_checked`='1'");
    //             break;
    //     case 3:
    //         $listOrder= get_list_order("WHERE `status`='2'");
    //         break;
    //     case 4:
    //         $listOrder=get_list_order("WHERE `status`='1'");
    //         break;
    // }
    switch ($type) {
        case 0:
            $listOrder = get_list_order_by_page($currentPage);
            $total= get_list_order();
            break;
        case 1:
            $listOrder = get_list_order_by_page($currentPage,"WHERE `is_checked`='2'");
            $total= get_list_order("WHERE `is_checked`='2'");

            break;
            case 2:
                $listOrder= get_list_order_by_page($currentPage,"WHERE `is_checked`='1'");
            $total= get_list_order("WHERE `is_checked`='1'");

                
                break;
        case 3:
            $listOrder= get_list_order_by_page($currentPage,"WHERE `status`='2'");
            $total= get_list_order("WHERE `status`='2'");

            break;
        case 4:
            $listOrder=get_list_order_by_page($currentPage,"WHERE `status`='1'");
            $total= get_list_order("WHERE `status`='1'");

            break;
    }
    $data['active'] =$active;
$data['total']= count($total);
    $data['listOrder'] = $listOrder;
    load_view('index', $data);
}
function customerAction()
{
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $listCustomer = get_list_customer_by_page($currentPage);
    $data['listCustomer']= $listCustomer;
    $data['currentPage']= $currentPage;
    $data['total']= get_total_customer();

    load_view("listCustomer",$data);
}
function detailOrderAction()
{

    $orderID = $_GET['id'];
    $orderID = (int)$orderID;

    if (isset($_POST['sm_status'])) {
        db_update("tbl_order", ['status' => (int)$_POST['status']], "`order_id`={$orderID}");
    }
    $order = db_fetch_row("SELECT * FROM `tbl_order` WHERE `order_id`={$orderID}");
    $productInfor = get_number_product_in_order($orderID);
    $data['productInfor'] = $productInfor;

    $data['order'] = $order;

    load_view('detailOrder', $data);
}
