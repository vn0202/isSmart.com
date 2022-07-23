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
                    <form method="POST" action="?mod=admin&controller=teamAdmin&action=change">
                        <?php foreach($admin as $ad){?>
                        <label for="">Quyền Admin: <?php echo $ad['username']?></label>
                        <br>
                        <br>
                        
                        <input type="radio" name="licens-<?php echo $ad['id']?>" id="manager" value="1-<?php echo $ad['id']?>"><label for="manager">Quản trị viên</label>
                        <input type="radio" name="licens-<?php echo $ad['id']?>"  id="editor" value="2-<?php echo $ad['id']?>"><label for="editor">Biên tập viên</label>
                        <input type="radio" name="licens-<?php echo $ad['id']?>"   id="collaborator" value="3-<?php echo $ad['id']?>" checked><label for="collaborator">Cộng tác viên</label>
                        <br><br>
                        <?php }?>
                       
                        <input type="submit" name="changeLicensor" value="Thay đổi quyền ">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>