<?php get_header()?>
<div id="main-content-wp" class="clearfix detail-blog-page">
<div class="wp-inner">
<div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php echo $post['post_content']?>
        </div>
        <div class="sidebar fl-left">
            <?php
            $listBestSell = get_list_best_product();
            $data['listBestSell']= $listBestSell;
            get_sibar("best-sell-product",$data);
            
            ?>
        </div>
</div>
</div>
<?php get_footer()?>