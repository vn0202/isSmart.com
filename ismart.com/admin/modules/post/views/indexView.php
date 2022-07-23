<?php get_header()?>
<div id="main-content-wp" class="list-cat-page">
    <div class="wrap clearfix">
        <?php get_sibar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách danh mục</h3>
                    <a href="?mod=post&action=addcat" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                               
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=0;
                            foreach($list_post_cat as $key=>$cat){ $i++;?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php  echo "<b>$i</b>" ;?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo "<b>$key</b>"?></a>
                                        </div> 
                                        
                                    </td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"></span></td>
                                </tr>
                                <?php $j=0;
                            foreach($cat as $c){ $j++;?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text"><?php  echo $j ;?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php get_sub($c['scope'])?></a>
                                        </div> 
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=post&action=delete&id=<?php echo $c['cat_id']?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"></span></td>
                                    <td><span class="tbody-text"><?php get_status( $c['status'])?></span></td>
                                    <td><span class="tbody-text"><?php echo get_creator($c['creator'])?></span></td>
                                    <td><span class="tbody-text"><?php echo date("d/m/Y",$c['date_cre'])?></span></td>
                                </tr>
                                
                                <?php }}?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Thứ tự</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr> 
                            </tfoot>
                        </table>
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
<?php get_footer()?>