<?php get_header()?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php  get_sibar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                    <a href="?mod=product&action=addProduct" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <?php if(empty($listProduct)){
                    echo "<p>Hiện chưa có sản phẩm nào</p>";}
                    else{
                ?>
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=product&action=showListProduct">Tất cả <span class="count">(<?php echo get_total_product()?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=product&action=showPostedProduct">Đã đăng <span class="count">(<?php echo get_number_posted_product()?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=product&action=showUnconfirmProduct">Chờ xét duyệt<span class="count">(<?php echo get_number_unconfirm_product()?>)</span> |</a></li>
                            <li class="pending"><a href="?mod=product&action=showGarbage">Thùng rác<span class="count">(<?php  echo get_total_garbage()?>)</span></a></li>
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
                                <option value="1">Công khai</option>
                                <option value="2">Chờ duyệt</option>
                                <option value="3">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="btn_action" value="Áp dụng">
                      
                    </div>
                    <div class="table-responsive">

                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=0;
                                
                                foreach($listProduct as $product){
                                    $i++;
                                    ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php  echo $product['product_id']?>"></td>
                                    <td><span class="tbody-text"><?php echo $i?></h3></span>
                                    <td><span class="tbody-text"><?php echo $product['code']?></h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="<?php $listThumb= get_product_thumb($product['product_id']);
                                            echo $listThumb[0];?>" alt="">
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $product['product_title']?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=product&action=updateProduct&id=<?php echo $product['product_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=product&action=deleteProduct&id=<?php echo $product['product_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo convert_price_to_string($product['product_price']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo get_title_cat($product['cat_id']) ?></span></td>
                                    <td><span class="tbody-text"><?php get_status($product['status']) ?></span></td>
                                    <td><span class="tbody-text"><?php echo get_creator($product['creator']) ?></span></td>
                                    <td><span class="tbody-text"><?php  echo date('d/m/Y',$product['date_cre'])?></span></td>
                                </tr>
                              <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Mã sản phẩm</span></td>
                                    <td><span class="tfoot-text">Hình ảnh</span></td>
                                    <td><span class="tfoot-text">Tên sản phẩm</span></td>
                                    <td><span class="tfoot-text">Giá</span></td>
                                    <td><span class="tfoot-text">Danh mục</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </form>
                </div>
                <?php }?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <!-- <ul id="list-paging" class="fl-right">
                       
                    </ul> -->
                    <?php
                  $totalProduct=get_total_product();
                    echo get_pagin($totalProduct,$currentPage,"?mod=product&action=showListProduct&page=");

                     ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
if(!empty($_SESSION['noExist'])){
    echo "<script>alert('Không tồn tại sản phẩm')</script>";
    unset($_SESSION['noExist']);

}
if(!empty($_SESSION['noPermiss'])){
    echo "<script>alert('Chỉ quản trị viên mới có quyền thực hiện các thao tác này')</script>";
    unset($_SESSION['noPermiss']);
}
get_footer();
?>