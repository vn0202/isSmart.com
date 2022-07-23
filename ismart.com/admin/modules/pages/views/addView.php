<?php get_header()?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sibar()?>
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php if(isset($_POST['btn_submit'])){
                        global $errors;
                        if(empty($errors)){
                            emit_success("Tạo trang thành công");
                        }
                    } ?>
                    <form method="POST">
                        <label for="page_title">Tiêu đề</label>
                        <input type="text" name="page_title" id="page_title">
                        <?php emit_error('page_title')?>
                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <?php emit_error('slug')?>
                        <label for="content">Content</label>
                        <textarea name="page_content" id="page_content" class="ckeditor"></textarea>
                     <?php emit_error('page_content') ?>
                        <button type="submit" name="btn_submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>