<?php get_header() ?>
<div id="main-content-wp" class="list-admin">
    <div class="section" id="list-admins">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Cập nhật admin</h3>
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sibar('admin') ?>
        <div id="content" class="fl-right">

            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">

                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="?mod=admin&controller=teamAdmin&action=process" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Thay đổi quyền</option>
                                <option value="2">Xóa tài khoản </option>
                                <!-- <option value="2">Bỏ vào thủng rác</option> -->
                            </select>
                            <input type="submit" name="sm_action" value="áp dụng" />

                            <div class="table-responsive">

                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">ID</span></td>
                                            <td><span class="thead-text">Tên admin</span></td>
                                            <td><span class="thead-text">Ảnh đại diện</span></td>
                                            <td><span class="thead-text">Quyền admin </span></td>
                                            <td><span class="thead-text">Người cấp quyền </span></td>
                                            <td><span class="thead-text">Thời gian</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($listsAdmin as $admin) {
                                        ?>


                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $admin['id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $admin['id'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $admin['username'] ?></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <img src="<?php echo $admin['avatar'] ?> " alt="">
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        
                                                        <?php
                                                         get_role($admin['role']);
                                                        ?>
                                                    </div>
                                                  
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=admin&controller=teamAdmin&action=process&actions=1&id=<?php echo $admin['id'] ?>" title="Sửa" class="edit" data-id="<?php echo $admin['id']?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=admin&action=delete&controller=teamAdmin&id=<?php echo $admin['id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo get_licensor($admin['admin_intro']) ?></span></td>
                                                <td><span class="tbody-text"><?php echo date("d/m/Y", $admin['reg_date']) ?></span></td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>

                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>