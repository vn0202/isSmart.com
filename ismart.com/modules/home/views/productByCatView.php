<?php get_header() ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $catParent['cat_title'] ?></a>
                    </li>
                    <?php if (isset($catTitle)) { ?>
                        <li>
                            <a href="" title=""><?php echo $catTitle['cat_title'] ?></a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">
                        <?php echo $catParent['cat_title'] ?>
                    </h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Tổng <?php echo count($listProduct) ?> sản phẩm </p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <button type="submit" name="btn_submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php if (!empty($listProduct)) { ?>
                        <ul class="list-item clearfix">
                            <?php

                            foreach ($listProduct as $product) { ?>
                                <li>
                                    <a href="chi-tiet-san-pham/<?php echo replace_white($product['product_title']).'-'. $product['product_id']?>.html" title="" class="thumb-background" style="background-image: url('<?php echo (get_avatar_product($product['product_thumb'])) ?>') ;">
                                        <!-- <img src="public/images/img-pro-17.png"> -->
                                    </a>
                                    <a href="chi-tiet-san-pham/<?php echo replace_white($product['product_title']).'-'. $product['product_id']?>.html" title="" class="product-name"><?php echo $product["product_title"] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo convert_currency($product['product_price']) ?></span>
                                        <?php if (!empty($product['old_price'])) { ?>
                                            <span class="old"><?php echo convert_currency($product['old_price']) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&action=addProductToCart&id=<?php echo $product['product_id']?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=checkout&action=buyDirect&id=<?php echo $product['product_id'] ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else {
                        echo " Hiện chưa có sản phẩm nào !";
                    } ?>
                </div>
            </div>
            <div class="section" id="paging-wp">
              
                <?php
     
                $catParentID = $catParent['cat_id'];
                echo get_pagin($totalProduct, $currentPage, "?mod=home&action=listProductBySubCat&id={$catParentID}&subCat={$subCat}&page=");

                ?>
            </div>
        </div>
        <div class="sidebar fl-left subCat" data-id="<?php echo $subCat?>">

            <?php get_sibar('cat-product') ?>
            <?php get_sibar('filter');?>
            
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>