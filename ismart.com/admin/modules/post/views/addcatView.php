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
                        <input type="text" name="title" id="title">
                        <?php  emit_error("title")?>
                        <!-- <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug"> -->
                      
                      <div >
                      <label for="">Phạm vi: </label>
                          <input type="radio" name="scope" value="1" id="incountry" checked>
                          <label for="incountry">Trong nước </label>
                          <input type="radio"name= "scope" value="2" id="internation">
                          <label for="internation">Thế giới</label>
                      </div>
                        <label>Danh mục cha</label>
                        <select name="cat_parent">
                            <option value="">-- Chọn danh mục --</option>
                           <?php if(!empty($list_cat)){
                            foreach($list_cat as $cat){?>
                            <option value="<?php echo $cat['cat_id']?>"><?php echo $cat['cat_title'] ?></option>
 
                            <?php }}?>
                            
                        </select>
                        <?php emit_error('cat_parent')?>
                        <button type="submit" name="btn_add_cat" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer()?>