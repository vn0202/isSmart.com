<?php get_header()?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sibar()?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <?php if(isset($_POST['btn-submit'])) emit_success("thêm slider")?>
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <!-- <label for="title">Tên slider</label>
                        <input type="text" name="title" id="title"> -->
                        <label for="title">Link</label>
                        <input type="text" name="slug" id="slug" value="<?php  if(isset($_POST['btn-submit'])) set_value("slug") ?>">
                        <?php emit_error("slug") ?>
                        <!-- <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"></textarea> -->
                        <!-- <label for="title">Thứ tự</label>
                        <input type="text" name="num_order" id="num-order"> -->
                        <!-- <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="public/images/img-thumb.png">
                            <?php emit_error("thumb_slider")?>
                        </div> -->
                        <input type="file" name="file" id="upload-thumb" >

                        <div class="group-thumb">

                        </div>
                        <?php emit_error("slider_thumb") ?>

                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1" <?php if(!empty($_POST['status']) && $_POST['status']==1) echo "selected='selected'"?>>Công khai</option>
                            <option value="2" <?php if(!empty($_POST['status']) && $_POST['status']==2) echo "selected='selected'"?>>Chờ duyệt</option>
                        </select>
                        <?php emit_error("status") ?>

                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>