
<div class="section" id="category-product-wp">


    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">
        <?php if (!empty($listCatParent)) {
        ?>

            <ul class="list-item">
                <?php foreach ($listCatParent as $catParent) { ?>
                    <li>
                        <a href="danh-muc/<?php echo replace_white($catParent['cat_title'])."-". $catParent['cat_id'] ?>.html" title=""><?php echo $catParent['cat_title'] ?></a>
                        <?php $listCat = get_list_cat_product_by_parent_cat($catParent['cat_id']);
                        if (!empty($listCat)) {
                        ?>
                            <ul class="sub-menu">
                                <?php foreach ($listCat as $cat) { ?>

                                    <li>
                                        <a href="?mod=home&action=listProductBySubCat&id=<?php echo $catParent['cat_id'] ?>&subCat=<?php echo $cat['cat_id']?>" title=""><?php echo $cat['cat_title'] ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>

                <?php } ?>
            </ul>
        <?php } else {
            echo "<p>Hiện bạn chưa có danh mục nào </p>";
        } ?>
    </div>

</div>