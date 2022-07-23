<?php get_header() ?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sibar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?page=add_page" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page"></div>
                <div class="section-detail">

                    <div class="filter-wp clearfix">

                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=pages">Tất cả <span class="count">(<?php echo count(get_list_page())?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=pages">Đã đăng <span class="count">(<?php echo get_number_posted_page()?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=pages&action=confirm">Chờ xét duyệt <span class="count">(<?php echo get_number_unconfirm_page()?>)</span> |</a></li>
                            <li class="trash"><a href="?mod=pages&action=garbage">Thùng rác <span class="count">(<?php echo get_number_garbage()?>)</span></a></li>
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
                                <option value="1">Xác nhận</option>
                                <option value="2">Xóa</option>
                            </select>
                            <input type="submit" name="btn_update" value="Áp dụng">

                    </div>
                    <?php if(empty($list_unconfirm)){
                        echo "<p>Hiện chưa có trang nào được tạo</p>" ;}
                        else{?>
                    <div class="table-responsive">

                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($list_unconfirm as $page){
                                    $i++;
                                     ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $page['page_id']?>"></td>
                                    <td><span class="tbody-text"><?php echo $i?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $page['page_title']?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=pages&action=updatePage&id=<?php echo $page['page_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=pages&action=delete&id=<?php echo $page['page_id']?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php get_status($page['status']) ?></span></td>
                                    <td><span class="tbody-text"><?php get_creator($page['creator'])?></span></td>
                                    <td><span class="tbody-text"><?php echo date('d/m/Y',$page['date_cre'])?></span></td>
                                </tr>
                                     <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php }?>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title="">
                                << /a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>