<?php get_header();
// global $errors;

?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sibar('admin') ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <label for="name">Tên shop:</label>
                        <input type="text" name="name" id="name" value="<?php echo $infor['name']?>">
                        <?php emit_error('name') ?>
                        <label for="avatar">Chọn logoshop: </label>
                        <br>
                        <input type="file" name="avatar">
                        <?php emit_error('avatar') ?>
                        <div class="thumb">
                            <img src="public/images/logo.png" alt="">
                        </div>
                        <br>
                        <label for="tel">Số điện thoại tư vấn </label>
                        <input type="tel" name="phone" id="tel" value="<?php echo $infor['phone']?>">
                        <?php emit_error('phone') ?>
                        
                        <label for="email">Email hỗ trợ </label>
                        <input type="email" name="email" id="email" value="<?php echo $infor['email']?>">
                        <?php emit_error('email') ?>


                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address" ><?php echo $infor['address']?></textarea>
                        <label for="slogan">Slogan</label>
                        <textarea  type="text" name="slogan" id="slogan">
                            <?php echo $infor['slogan']?>
                        </textarea>
                        <?php emit_error('fullname') ?>
                        <br>
                        <br>
                        <button type="submit" name="btn_submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>