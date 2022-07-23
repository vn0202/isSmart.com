<?php get_header()?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sibar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php if(isset($_POST['btn_add_cat']))emit_success("Tạo thành công")?>
                    <?php if(isset($_POST['btn_add_cat']))emit_error("fail")?>
                    <form method="POST">
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="cat_title" id="title">
                        <?php  emit_error("cat_title")?>
                      
                        
                        <button type="submit" name="btn_add_cat" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>