<?php 
get_header();
?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?page=info_account" title="">Cập nhật thông tin</a>
                </li>
                <li>
                    <a href="?page=list_post" title="">Thoát</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="old_pass" id="pass-old">
                        <?php  emit_error('old_pass')?>
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="new_pass" id="pass-new">
                        <?php  emit_error('new_pass')?>

                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_pass" id="confirm-pass">
                        <?php  emit_error('confirm_pass')?>

                        <button type="submit" name="btn_submit" id="btn-submit">Cập nhật</button>
                        <?php 
                        if(isset($_POST['btn_submit']))
                        emit_success("Cập nhật thành công");
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
get_footer();
?>