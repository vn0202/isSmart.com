
<div class="section" id="selling-wp">
    
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                       <?php  foreach($listBestSell as $product) { ?>
                        <li class="clearfix">
                            <a href="?mod=product&id=<?php echo $product['product_id']?>" title="" class="thumb fl-left">
                                <img src="<?php echo get_avatar_product($product['product_thumb'])?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?mod=product&id=<?php echo $product['product_id']?>" title="" class="product-name"><?php echo $product['product_title']?></a>
                                <div class="price">
                                    <span class="new"><?php echo convert_currency($product['product_price'])?></span>
                                   <?php 
                                   if(!empty($product['old_price'])){
                                   ?>
                                    <span class="old"><?php echo convert_currency($product['old_price'])?></span>
                                    <?php }?>
                                </div>
                                <div class="action clearfix ">
                                <a href="?mod=cart&action=addProductToCart&id=<?php echo $product['product_id']?>" title="Thêm giỏ hàng" class="add-cart ">Thêm giỏ hàng</a>
                                <a href="?mod=checkout&action=buyDirect&id=<?php echo $product['product_id'] ?>" title="Mua ngay" class="buy-now ">Mua ngay</a>
                            </div>
                            </div>
                        </li>
                        <?php }?>

                    </ul>
                </div>
            </div>