<?php get_header() ?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sibar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
            <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách banner</h3>
                    <a href="?mod=banner&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all <?php echo $active == 1 ? 'active' : '' ?>"><a href="?mod=banner">Tất cả <span class="count">(<?php echo count(get_list_banner()) ?>)</span></a></li>
                            <li class="left <?php echo $active == 2 ? 'active' : '' ?>"><a href="?mod=banner&type=2">Banner trái <span class="count">(<?php echo count(get_banner_by_position(1)) ?>)</span></a></li>
                            <li class="top <?php echo $active == 3 ? 'active' : '' ?>"><a href="?mod=banner&type=3">Banner trên <span class="count">(<?php echo count(get_banner_by_position(2)) ?>)</span></a></li>
                            <li class="bottom <?php echo $active == 4 ? 'active' : '' ?>"><a href="?mod=banner&type=4">Banner dưới <span class="count">(<?php echo count(get_banner_by_position(3)) ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Xóa</option>
                                <option value="2">Dừng hoạt động</option>
                                <option value="3">Hoạt động</option>
                                <option value="4">Đổi sang trái</option>
                                <option value="5">Đổi lên trên </option>
                                <option value="6">Đổi xuống dưới </option>
                                <option value="7">Tắt tất cả  </option>
                                <option value="8">Bật tất cả  </option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                    </div>
                    <div class="table-responsive">
                        <?php if (!empty($listBanner)) { ?>
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Link</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Vị trí</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($listBanner as $banner) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $banner['banner_id']?>"></td>
                                            <td><span class="tbody-text"><?php echo $i; ?></h3></span>
                                            <td>
                                                <div class="tbody-thumb">
                                                    <img src="<?php echo $banner['banner_thumb'] ?>" alt="">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $banner['link'] ?></a>
                                                </div>
                                                <!-- <ul class="list-operation fl-right">
                                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul> -->
                                            </td>
                                            <td><span class="tbody-text"><?php echo get_author($banner['creator']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_postion($banner['position']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_status($banner['status']) ?></span></td>
                                            <td><span class="tbody-text"><?php echo date("d/m/Y", $banner['date_cre']) ?></span></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Hình ảnh</span></td>
                                        <td><span class="tfoot-text">Tên file</span></td>
                                        <td><span class="tfoot-text">Người tạo</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
                                    </tr>
                                </tfoot>
                        </form>

                            </table>
                        <?php } else {
                            echo "<p>Hiện chưa có banner nào</p> ";
                        } ?>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    
                    <?php
                    switch ($active) {
                        case 1:
                            $total = count(get_list_banner());
                            break;
                        case 2:
                            $total = count(get_banner_by_position(1));
                            break;
                        case 3:
                            $total = count(get_banner_by_position(2));
                            break;
                        case 4:
                            $total = count(get_banner_by_position(2));
                            break;
                    }
                    echo get_pagin($total, $currentPage, "?mod=banner&page=");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>