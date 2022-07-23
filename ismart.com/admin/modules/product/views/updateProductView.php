<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sibar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa thông tin sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <?php if(isset($_POST['btn_update'])){
                    emit_success(" chỉnh sửa thông tin thành công");
                    
                } ?>
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_title" id="product-name" value="<?php echo $product['product_title']?>">
                        <?php emit_error("product_title")?>
                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="code" id="product-code" value="<?php  echo $product['code']?>">
                        <?php emit_error("code")?>

                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="product_price" id="price" value="<?php echo $product['product_price']?>">
                        <label for="product_number">Số lượng sản phẩm:</label>
                        <br>
                        <input type="number" name="product_number" id="product_number" min=0 value=<?php echo $product['product_number']?>>
                        <br>
                        <?php emit_error("product_number")?>

                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="desc"><?php echo $product['product_desc']?></textarea>
                        <?php emit_error("product_desc")?>

                        <label for="product_content">Chi tiết</label>
                        <textarea name="product_content" id="product_content" class="ckeditor"><?php echo $product['product_content']?></textarea>
                        <?php emit_error("product_content")?>
                      
                        <label>Hình ảnh :</label>
                        <div id="uploadFile">
                            <input type="file" name="thumb[]" id="upload-thumb" multiple>
                            <input type="submit" name="btn_upload_thumb" value="Upload" id="btn-upload-thumb">
                            <?php 
                            
                                $list = read_dir("public/images/temp/");
                            ?>
                            <ul class="group-thumb" >
                                <?php  $j=0;
                                foreach ($list as $l){?>
                            <li class="thumb-item update" data-id="<?php echo $j ?>" style="background-image: url('<?php echo $l?>');" title="Bấm để xóa"></li>
                           <?php $j++; }?>
                           </ul>
                          
                           <?php  emit_error('thumb') ;?>
                        </div>
                        <label>Danh mục sản phẩm</label>
                        <div class="group-cat">
                            <span class="choose-cat"><?php echo get_title_cat($product['cat_id'])?> </span>
                            <?php
                                if (!empty($listParentCat)) {  ?>
                            <ul class="parent-id">
                               <?php foreach($listParentCat as $parentCat){?>
                                    <li class="parent-id__item">
                                        
                                        <?php echo $parentCat['cat_title'];
                                        $listCatProduct= get_list_cat_product_by_parent($parentCat['cat_id']);
                                         if(!empty($listCatProduct)){
                                            ?>
                                        <ul class="sub-cat">
                                            <?php  foreach($listCatProduct as $cat){?>
                                            <li class="sub-cat__item" data-id="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_title']?></li>
                                          
                                        <?php }?>

                                        </ul>
                                        <?php }?>
                                    </li>
                                  
                               <?php }?>
                            </ul>
                            <?php } ?>
                        </div>
                        <?php emit_error("cat_id")?>
                        

                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="0">-- Chọn danh mục --</option>
                            <option value="1" <?php if($product['status']==1){echo "selected";} ?>>Chờ duyệt</option>
                            <option value="2" <?php if($product['status']==2){echo "selected";} ?>>Đã đăng</option>
                        </select>
                        <input type="hidden" name="cat_id" value="<?php echo $product['cat_id']?>" id="add_cat_id">
                        <input type="submit" name="btn_update" id="btn-submit" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>