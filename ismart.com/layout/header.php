<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <base href="<?php echo base_url() ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
</head>

<body>

    <div id="site">
        <div id="container">
            <?php 
            $bannerTop  =  get_banner_by_position(2);
            $infor= get_infor_shop();
            if(strpos($infor['phone'],"-")!==FALSE)
            {

            
            $phone = explode("-",$infor['phone']);
            }
            else{
                $phone=$infor['phone'];
            }
           
            if(!empty($bannerTop)){
            ?>
            <div id="banner"  <?php  if(!empty($showBanner))echo "class='show-banner'"?>>
                <div id="banner-content" style="background-image: url('<?php echo "admin/".$bannerTop[0]['banner_thumb']?>');">  
                <i class="fa fa-times icon-close-banner" aria-hidden="true"></i>

                </div>

               
            </div>
            <?php }?>
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="?" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="?mod=home" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?mod=blogs" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="pages/gioi-thieu-5.html" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="pages/lien-he-7.html" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?page=home" title="" id="logo" class="fl-left"><img src="<?php echo $infor['thumb'] ?>"/></a>
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="">
                                <input type="text" name="s" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone"><?php echo handlePhone( $phone[0])?></span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="gio-hang.html" style="color: white;">

                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num"><?php echo count($_SESSION['cart']['buy']) ?></span>
                                    </a>
                                </div>
                                <?php $number = count($_SESSION['cart']['buy']);
                                $empty = $number > 0 ? "" : "empty";
                                $class = !empty($hidden) ? "hidden" : "";
                                ?>
                                <div id="dropdown" class="<?php echo $empty . " " . $class ?>">
                                    <?php

                                    if ($number > 0) {
                                    ?>
                                        <p class="desc">Có <span><?php echo  count($_SESSION['cart']['buy']) ?></span> sản phẩm trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            <?php
                                            $listProduct = $_SESSION['cart']['buy'];
                                            if (!empty($listProduct)) {
                                                $i = 0;
                                                foreach ($listProduct as $product) {
                                            ?>
                                                    <li class="clearfix">
                                                        <a href="" title="" class="thumb fl-left">
                                                            <img src="<?php echo $product['product_thumb'] ?>" alt="">
                                                        </a>
                                                        <div class="info fl-right">
                                                            <a href="" title="" class="product-name"><?php echo $product['product_title'] ?></a>
                                                            <p class="price"><?php echo convert_currency($product['product_price']) ?></p>
                                                            <p class="qty">Số lượng: <span><?php echo $product['qty'] ?></span></p>
                                                        </div>
                                                    </li>
                                            <?php
                                                    $i++;
                                                    if ($i == 4) {

                                                        break;
                                                    }
                                                }
                                            } ?>
                                            <?php
                                            if (count($listProduct) > 4) { ?>
                                                <li class="clearfix" style="text-align:center">
                                                    <a href="?mod=cart">Xem tất cả</a>
                                                </li>

                                            <?php }    ?>

                                        </ul>


                                    <?php } else { ?>
                                        <p class="desc" style="text-align: center;"> Giỏ hàng trống </p>

                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>