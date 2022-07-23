<?php get_header('',['showBanner'=>$showBanner]) ?>
<div id="main-content-wp" class="clearfix blog-page">
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

            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog </h3>
                </div>
                <?php if (empty($list_post)) {
                    echo "<p> Hiện chưa có bài viết nào</p>";
                } else {
                ?>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach ($list_post as $post) { ?>
                                <li class="clearfix">
                                    <a href="bai-viet/<?php echo $post['slug'] ?>" title="" class="thumb fl-left" style="background-image: url(<?php echo "admin/" . $post['post_thumb'] ?>);">
                                        <!-- <img src="" alt=""> -->
                                    </a>
                                    <div class="info fl-right">
                                        <a href="bai-viet/<?php echo $post['slug'] ?>" title="" class="title"><?php echo $post['post_title'] ?></a>
                                        <span class="create-date"><?php echo date("d/m/Y", $post['date_cre']) ?></span>
                                        <p class="desc"><?php echo $post['post_desc'] ?></p>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="paging-wp">
                <?php echo get_pagin_post($totalPost, $numberPerPage, $currentPage, "?mod=blogs&page=") ?>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php
            $listBestSell = get_list_best_product();
            $data['listBestSell']= $listBestSell;
            get_sibar("best-sell-product",$data);
            
            ?>
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