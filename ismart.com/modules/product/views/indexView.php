<?php get_header();
  $cat= get_cat_title($product['cat_id']);
  $catParent = get_cat_parent_title($cat['cat_parent']); ?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    
                    <li>
                        <a href="?mod=home&action=listProductByParentCat&id=<?php echo $catParent['cat_id'] ?>" title=""><?php 
                      
                        echo $catParent['cat_title']?>
                        </a>
                    </li>
                    <li>
                        <a href="?mod=home&action=listProductBySubCat&id=<?php echo $catParent['cat_id']?>&subCat=<?php echo $cat['cat_id']?>" title="">
                            <?php echo $cat['cat_title']?>
                        </a>
                    </li>
                    <li>
                        <a href="">

                            <?php echo $product['product_title']?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" src="<?php echo $listThumb[0]?>"   data-zoom-image="<?php echo $listThumb[0]?>" />
                        </a>
                        <div id="list-thumb">
                            <?php foreach($listThumb as $thumb){
                                ?>
                            <a href="" data-image="<?php echo $thumb?>" data-zoom-imgae="<?php echo $thumb?>">
                                <img id="zoom" src="<?php echo $thumb?>" />
                            </a>
                            <?php }?>
                          
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $product['product_title'] ?></h3>
                        <div class="desc">
                            <?php echo $product['product_desc'] ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <?php if(check_stocking($product['product_id'])){?>
                            <span class="status"><?php echo "Còn ".$product['product_number']. " sản phẩm "; ?></span>
                        <?php }else{?>
                            <span class="status outof">Hết hàng</span>

                            <?php }?>
                        </div>
                        <p class="price"><?php echo convert_currency($product['product_price']) ?></p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <a  title="Thêm giỏ hàng" class="add-cart"  data-id="<?php echo $product['product_id']?>">Thêm giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo $product['product_content'] ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php 
                        foreach($listSameProduct as $product){
                        ?>
                        <li>
                            <a href="?mod=product&id=<?php echo $product['product_id']?>" title="" class="thumb-background" style="background-image: url('<?php echo get_avatar_product($product["product_thumb"])?>');">
                                <!-- <img src=""> -->
                            </a>
                            <a href="?mod=product&id=<?php echo $product['product_id']?>" title="" class="product-name"><?php echo $product['product_title']?></a>
                            <div class="price">
                                <span class="new"><?php echo convert_currency($product['product_price'])?></span>
                              <?php if(!empty($product['old_price'])){?>
                                <span class="old">20.900.000đ</span>
                                <?php }?>
                            </div>
                            <div class="action clearfix">
                                <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <?php }?>
                     
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            
            <?php
            $data['listCatParent'] = get_list_parent_cat_product();
            get_sibar('cat-product', $data);
            ?>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>

  <div id="notify-add">
        <div id="notify__add-content">
            <p class="notify-content"> 
                <?php 
                if(isset($_SESSION['addSuccess']))
              echo "  Bạn đã thêm sản phẩm thành công  vào giỏ hàng" ; 
              else{
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
                    <?php $listOutstanding= get_outstanding_product();
                    if(!empty($listOutstanding)){

                    
                    ?>
                    <ul class="list-item">
                        <?php 
                        foreach($listOutstanding as $product){
                        ?>
                        <li>
                            <a href="?mod=product&id=<?php echo $product['product_id']?>" title="" class="thumb-background" style="background-image: url('<?php echo (get_avatar_product($product['product_thumb'])) ?>') ;">
                                <!-- <img src="public/images/img-pro-05.png"> -->
                            </a>
                            <a href="?mod=product&id=<?php echo $product['product_id']?>" title="" class="product-name"><?php echo $product['product_title']?></a>
                            <div class="price">
                                <span class="new"><?php echo convert_currency($product['product_price'])?></span>
                                <?php 
                                ?>
                                <span class="old"><?php
                                if(!empty($product['old_price'])){ echo convert_currency($product['old_price']);}?></span>
                       
                            </div>
                         
                        </li>
                       <?php }?>
                    </ul>
                    <?php }else{echo "<p>Hiện chưa có sản phẩm nổi bật nào</p>";}?>
                </div>
            </div>
            </div>

        </div>

         </div>
   
  