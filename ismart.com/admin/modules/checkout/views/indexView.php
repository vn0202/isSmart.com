<?php get_header()?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sibar()?>
        <div id="content" class="fl-right">
           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all <?php echo $active== 0 ? 'active': ""?>"><a href="?mod=checkout&type=0"  >Tất cả đơn <span class="count">(<?php echo count(get_list_order())?>)</span></a> |</li>
                            <li class="publish <?php echo $active== 1 ? 'active': ""?>"><a href="?mod=checkout&type=1">Đã duyệt <span class="count">(<?php echo get_number_by_condtion("`is_checked`='2'")?>)</span></a> |</li>
                            <li class="pending <?php echo $active== 2 ? 'active': ""?>"><a href="?mod=checkout&type=2">Chờ xét duyệt<span class="count">(<?php echo get_number_by_condtion("`is_checked`='1'")?>)</span> |</a></li>
                            <li class="finished <?php echo $active== 3 ? 'active': ""?>"><a href="?mod=checkout&type=3">Đã giao <span class="count">(<?php echo get_number_by_condtion("`status`='2'")?>)</span> |</a></li>
                            <li class="dispathing <?php echo $active==4 ? 'active': ""?>"><a href="?mod=checkout&type=4">Đang vận chuyển <span class="count">(<?php echo get_number_by_condtion("`status`='1'")?>)</span> </a></li>
                            
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <?php if($active==2){?>
                <form method="POST" action="" class="form-actions">
                      
                            <select name="actions">
                                
                                <option value="0">Tác vụ</option>
                                <option value="1">Duyệt</option>
                                
                               
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                            <?php }?>
                    </div>
                    <?php  if(!empty($listOrder)){?>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số mặt hàng</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="tfoot-text">Thanh toán</span></td>

                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                  foreach($listOrder as $item){ $i++;
                                  $customer = get_infor_customer($item['cus_id']);
                                  ?>
                                    

                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $item['order_id']?>"></td>
                                    <td><span class="tbody-text"><?php echo $i; ?></h3></span>
                                    <td><span class="tbody-text">ISMART-<?php echo $item['order_id']?></h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $customer['fullname'] ?></a>
                                        </div>
                                        
                                    </td>
                                    <td><span class="tbody-text"><?php echo count( get_number_product_in_order($item["order_id"]))?></span></td>
                                    <td><span class="tbody-text"><?php echo convert_price_to_string($item['total_cost'],"VNĐ")?></span></td>
                                    <td><span class="tbody-text"><?php get_type_payment($item['is_checkout'])?></span></td>
                                    <td><span class="tbody-text"><?php echo date("d/m/Y",$item['date_cre'])?></span></td>
                                    <td><a href="?mod=checkout&action=detailOrder&id=<?php echo $item['order_id']?>" title="" class="tbody-text">Chi tiết</a></td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                    <td><span class="tfoot-text">Họ và tên</span></td>
                                    <td><span class="tfoot-text">Số mặt hàng</span></td>
                                    <td><span class="tfoot-text">Tổng giá</span></td>
                                    <td><span class="tfoot-text">Thanh toán</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                    <td><span class="tfoot-text">Chi tiết</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php }else{
                echo " Hiện chưa có đơn hàng nào";
            }?>
                </div>
            </div>
            <div class="section" id="paging-wp">

                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <!-- <ul id="list-paging" class="fl-right">
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
                    </ul> -->
                    <?php 
                  echo   get_pagin($total,$currentPage,"?mod=checkout&page=");
                    ?>
                </div>
            </div>
            </form>

          
            
        </div>
    </div>
</div>
<?php get_footer()?>