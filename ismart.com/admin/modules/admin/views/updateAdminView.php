<?php  get_header();
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
        <?php get_sibar('admin')?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <label for="display-name">Họ và tên: </label>
                        <input type="text" name="fullname" id="display-name">
                        <?php  emit_error('fullname')?>
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="admin" value="<?php echo $_SESSION['username']?>" readonly="readonly" >
                        <?php  emit_error('username')?>
                       
                        <label for="email">Email</label>
                      
                        <input type="email" name="email" id="email">
                        <?php  emit_error('email')?>

                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="phone" id="tel">
                        <?php  emit_error('phone')?>

                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"></textarea>
                        <label for="avatar">Chọn ảnh đại diện: </label>
                        <input type="file" name="avatar" >
                        <?php emit_error('avatar')?>
                        <br>
                        <br>
                        <button type="submit" name="btn_submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  get_footer();?>