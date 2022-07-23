<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <?php if (!empty($listSlider)) {
            ?>
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <?php foreach ($listSlider as $item) { ?>
                            <a href="<?php echo $item['slider_link'] ?>">


                                <div class="item" style="background-image: url('<?php echo "admin/" . $item['slider_thumb'] ?>');">
                                    <!-- <img src="public/images/slider-01.png" alt=""> -->
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="section" id="support-wp">

                <div class="section-detail">
                    <ul class="list-item clearfix">

                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">


                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <?php $listOutstanding = get_outstanding_product();
                    if (!empty($listOutstanding)) {


                    ?>
                        <ul class="list-item">
                            <?php
                            foreach ($listOutstanding as $product) {
                            ?>
                                <li>
                                    <a href="chi-tiet-san-pham/<?php echo replace_white($product['product_title']) . '-' . $product['product_id'] ?>.html" title="" class="thumb-background" style="background-image: url('<?php echo (get_avatar_product($product['product_thumb'])) ?>') ;">
                                        <!-- <img src="public/images/img-pro-05.png"> -->
                                    </a>
                                    <a href="chi-tiet-san-pham/<?php echo replace_white($product['product_title']) . '-' . $product['product_id'] ?>.html" title="" class="product-name"><?php echo $product['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo convert_currency($product['product_price']) ?></span>
                                        <?php
                                        ?>
                                        <span class="old"><?php
                                                            if (!empty($product['old_price'])) {
                                                                echo convert_currency($product['old_price']);
                                                            } ?></span>

                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&action=addProductToCart&id=<?php echo $product['product_id'] ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?page=checkout" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else {
                        echo "<p>Hiện chưa có sản phẩm nổi bật nào</p>";
                    } ?>
                </div>
            </div>
            <?php

            foreach ($listCatParent as $catParent) {
                $listProduct = get_list_product_by_cat_parent($catParent['cat_id']);
                if (!empty($listProduct)) {
            ?>

                    <div class="section" id="list-product-wp">


                        <div class="section-head">
                            <h3 class="section-title"><?php echo $catParent['cat_title'] ?></h3>
                        </div>
                        <?php ?>
                        <div class="section-detail">

                            <ul class="list-item clearfix " id="list-item-<?php echo $catParent['cat_id'] ?>">
                                <?php
                                $i = 0;
                                foreach ($listProduct as $product) {
                                    $i++;
                                ?>
                                    <li>
                                        <a href="chi-tiet-san-pham/<?php echo replace_white($product['product_title']) . '-' . $product['product_id'] ?>.html" title="" class="thumb-background" style="background-image: url('<?php echo (get_avatar_product($product['product_thumb'])); ?>');">

                                        </a>
                                        <a href="chi-tiet-san-pham/<?php echo replace_white($product['product_title']) . '-' . $product['product_id'] ?>.html" title="" class="product-name"><?php echo $product['product_title'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo convert_currency($product['product_price']) ?></span>
                                            <?php
                                            ?>
                                            <span class="old"><?php
                                                                if (!empty($product['old_price'])) {
                                                                    echo convert_currency($product['old_price']);
                                                                } ?></span>

                                        </div>
                                        <div class="action clearfix">
                                            <a href="?mod=cart&action=addProductToCart&id=<?php echo $product['product_id'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="?mod=checkout&action=buyDirect&id=<?php echo $product['product_id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                <?php
                                    if ($i == 12) {
                                        echo "<p class='see-more' data-id='{$catParent['cat_id']}'> Xem thêm </p>";
                                        break;
                                    }
                                } ?>
                            </ul>
                        </div>
                    </div>
            <?php }
            } ?>

        </div>
        <div class="sidebar fl-left">

            <?php
            $data['listCatParent'] = $listCatParent;
            get_sibar('cat-product', $data) ?>
            <?php get_sibar("best-sell-product") ?>



            <!-- <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                       
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="public/images/img-pro-11.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="public/images/img-pro-12.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="public/images/img-pro-05.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="public/images/img-pro-22.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="public/images/img-pro-23.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="public/images/img-pro-18.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        <li class="clearfix">
                            <a href="?page=detail_product" title="" class="thumb fl-left">
                                <img src="public/images/img-pro-15.png" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                <div class="price">
                                    <span class="new">15.190.000đ</span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> -->
            <?php 
            $bannerLeft = get_banner_by_position(1);
            if(!empty($bannerLeft)){
              
            ?>
            <div class="section banner-under" id="banner-wp">
                <div class="section-detail">
                    <a href="<?php echo $bannerLeft[0]['link']?>" title="" class="thumb" >
                        <!-- <img src="" alt=""> -->
                    </a>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>


<?php get_footer() ?>
<?php
if (isset($_SESSION['noExist'])) {
    if ($_SESSION['noExist'] === true) {
?>
        <script>
            alert('sản phẩm không tồn tại')
        </script>
<?php
        unset($_SESSION['noExist']);
    }
} ?>
<?php if (isset($_SESSION['addSuccess']) || isset($_SESSION['outOf'])) {
?>
    <div id="notify-add" style="display: block;">
        <div id="notify__add-content">
            <p class="notify-content">
                <?php
                if (isset($_SESSION['addSuccess']))
                    echo "  Bạn đã thêm sản phẩm thành công  vào giỏ hàng";
                else {
                    echo " Sản phẩm này hiện không còn hàng trong kho. Rất xin lỗi quý khách vì sự bất tiện này.!";
                }
                ?>

            </p>
            <i class="fa fa-times close-icon" aria-hidden="true"></i>
            <div>
                <div class="section" id="feature-product-wp">


                    <div class="section-head">
                        <h3 class="section-title">Just for you</h3>
                    </div>
                    <div class="section-detail">
                        <?php $listOutstanding = get_outstanding_product();
                        if (!empty($listOutstanding)) {


                        ?>
                            <ul class="list-item">
                                <?php
                                foreach ($listOutstanding as $product) {
                                ?>
                                    <li>
                                        <a href="?mod=product&id=<?php echo $product['product_id'] ?>" title="" class="thumb-background" style="background-image: url('<?php echo (get_avatar_product($product['product_thumb'])) ?>') ;">
                                            <!-- <img src="public/images/img-pro-05.png"> -->
                                        </a>
                                        <a href="?mod=product&id=<?php echo $product['product_id'] ?>" title="" class="product-name"><?php echo $product['product_title'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo convert_currency($product['product_price']) ?></span>
                                            <?php
                                            ?>
                                            <span class="old"><?php
                                                                if (!empty($product['old_price'])) {
                                                                    echo convert_currency($product['old_price']);
                                                                } ?></span>

                                        </div>

                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else {
                            echo "<p>Hiện chưa có sản phẩm nổi bật nào</p>";
                        } ?>
                    </div>
                </div>
            </div>

        </div>

    </div>

<?php
    unset($_SESSION['addSuccess']);
    unset($_SESSION['outOf']);
}

?>