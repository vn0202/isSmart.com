<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sibar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <label for="post_title">Tiêu đề</label>
                        <input type="text" name="post_title" id="title" value="<?php echo $post['post_title']  ?>"> 
                        <?php  emit_error("post_title")?>
                    <textarea name="post_desc" id="" cols="30" rows="10"><?php echo $post['post_desc'] ?></textarea>
                    <?php  emit_error("post_desc")?>

                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <label for="post_content">Chi tiết </label>

                        <textarea name="post_content" id="desc" class="ckeditor"><?php echo $post['post_content'] ?></textarea>
                    <?php  emit_error("post_content")?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="post_thumb" id="upload-thumb">
                          
                            <img src="<?php echo $post['post_thumb']?>" id="temp_thumb">
                        </div>
                    <?php  emit_error("post_thumb")?>

                        <label>Danh mục cha</label>
                        <select name="parent_cat">
                            <option value="">--Chọn danh mục--</option>
                            <?php if (!empty($list_cat)) {
                                foreach ($list_cat as $cat) { ?>
                                    <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_title'] ?></option>

                            <?php }
                            } ?>

                        </select>
                    <?php  emit_error("parent-cat")?>
                    <div>

                        <label for="" class="no-block">Chọn chủ đề: </label>
                        <input type="radio" name="scope" value="1" id="country" checked><label for="country" class="no-block">Trong nước</label>
                        <input type="radio" name="scope" value="2" id="Thế giới"><label for="international" class="no-block">Thế giới</label>
                    </div>
                        <button type="submit" name="btn_update" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>