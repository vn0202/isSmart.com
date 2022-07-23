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
            <label for="display-name">Họ và tên: </label>
            <input type="text" name="fullname" id="display-name" value="<?php if (isset($_POST['btn_reg'])) {
                                                                          set_value('fullname');
                                                                        } ?>">
            <?php emit_error('fullname') ?>
            <label for="username">Tên đăng nhập</label>
            <input type="text" name="username" id="username" placeholder="admin" value="<?php if (isset($_POST['btn_reg'])) {
                                                                                          set_value('username');
                                                                                        } ?>">
            <?php emit_error('username') ?>

            <label for="email">Email</label>

            <input type="email" name="email" id="email" value="<?php if (isset($_POST['btn_reg'])) {
                                                                  set_value('email');
                                                                } ?>">
            <?php emit_error('email') ?>
            <label for="password">password</label>

            <input type="password" name="password" id="password" value="<?php if (isset($_POST['btn_reg'])) {
                                                                          set_value('password');
                                                                        } ?>">
            <?php emit_error('password') ?>
            <br>
            <br>
            <label for="tel">Số điện thoại</label>
            <input type="tel" name="phone" id="tel" value="<?php if (isset($_POST['btn_reg'])) {
                                                              set_value('phone');
                                                            } ?>">
            <?php emit_error('phone') ?>

            <label for="address">Địa chỉ</label>
            <textarea name="address" id="address">

                        </textarea>
            <div id="admin-licens">
              <label for="">Quyền Admin</label>
              <input type="radio" name="licens" id="manager" value="1"><label for="manager">Quản trị viên</label>
              <input type="radio" name="licens" id="editor" value="2"><label for="editor">Biên tập viên</label>
              <input type="radio" name="licens" id="collaborator" value="3" checked><label for="collaborator">Cộng tác viên</label>
            </div>
            <?php emit_error('avatar') ?>
            <br>
            <br>
            <input type="hidden" name="licensor" value="<?php echo $_SESSION['id'] ?>">
            <button type="submit" name="btn_reg" id="btn-submit">Tạo admin</button>
          </form>
          <?php if (isset($_POST['btn_reg'])) {
            emit_success("đăng ký thành công");
          } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>