<?php get_header();

?>
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sibar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách slider</h3>
                    <a href="?mod=slider&action=addNewSlider" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all <?php if($type==1) echo 'active'?>" ><a href="?mod=slider">Tất cả <span class="count">(<?php echo count(get_list_slider())?>)</span></a> |</li>
                            <li class="publish <?php if($type==2) echo 'active'?>"><a href="?mod=slider&type=2">Đã đăng <span class="count">(<?php echo count(get_list_slider_by_condition("`status`='1' AND `garbage`!='2'"))?>)</span></a> |</li>
                            <li class="pending <?php if($type==3) echo 'active'?>"><a href="?mod=slider&type=3">Chờ xét duyệt<span class="count">(<?php echo count(get_list_slider_by_condition("`status`='2' AND `garbage`!='2'"))?>)</span></a></li>
                            <li class="pending <?php if($type==4) echo 'active'?>"><a href="?mod=slider&type=4">Thùng rác<span class="count">(<?php echo count(get_list_slider_by_condition("`garbage`='2'"))?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="POST" action="" class="form-actions">
                            <select name="actions">
                              <?php if($type!=4 ){?>
                                <option value="0">Tác vụ</option>
                                <option value="1">Công khai</option>
                                <option value="2">Chờ duyệt</option>
                                <option value="3">Bỏ vào thủng rác</option>
                              <?php }else{?>
                                <option value="4">Khôi phục</option>
                                <option value="5">Xóa</option>
                                <?php }?>
                               
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                       
                    </div>
                    <?php if(!empty($listSlider)){?>
                    <div class="table-responsive">
                      
                        <table class="table list-table-wp" >

                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Link</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody id="nghia">
                                <?php
                                $i=0;
                                 foreach($listSlider as $item){
                                    $i++;
                                    ?>
                                <tr ondrop="drop(event)" ondragover="allowDrop(event)" ondragstart="dragStart(event)" draggable="true" id="id-<?php echo $item['slider_id']?>" data-id="<?php echo $item['slider_id']?>">
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['slider_id']?>"></td>
                                    <td ><span class="tbody-text slider_STT"><?php echo $i?></h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="<?php echo $item['slider_thumb']?>" alt="">
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['slider_link']?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td ><span class="tbody-text slider_order"><?php echo $item['slider_order']?></span></td>
                                    <td><span class="tbody-text"><?php echo get_status($item['status'])?></span></td>
                                    <td><span class="tbody-text"><?php echo get_creator($item['creator'])?></span></td>
                                    <td><span class="tbody-text"><?php echo date("d/m/Y",$item['date_cre'])?></span></td>
                                </tr>
                            <?php }?>  
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Hình ảnh</span></td>
                                    <td><span class="tfoot-text">Link</span></td>
                                    <td><span class="tfoot-text">Thứ tự</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </form>
                    <?php }else{
                        echo "<p> Hiện chưa có slider nào ..</p>";
                    }?>
                </div>
            </div>
            <?php if(!empty($listSlider)){?>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
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
            <?php }?>
          
        </div>
    </div>
</div>
<?php get_footer()?>