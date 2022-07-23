<?php get_header() ?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php if (!empty($_SESSION['cart']['buy'])) {
            $listItem = $_SESSION['cart']['buy'] ?>
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">



                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listItem as $item) { ?>
                                <tr class="row-<?php echo $item['product_id']?>">
                                    <td><?php echo $item['code'] ?></td>
                                    <td>
                                        <a href="" title="" class="thumb">
                                            <img src="<?php echo $item['product_thumb'] ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" title="" class="name-product"><?php echo $item['product_title'] ?></a>
                                    </td>
                                    <td><?php echo convert_currency($item['product_price']) ?></td>
                                    <td>
                                        <input type="number" name="num-order" value="<?php echo $item['qty'] ?>" min='1' class="num-order" data-id="<?php echo  $item['product_id'] ?>">
                                    </td>
                                    <td class="total-cost-product-<?php echo $item['product_id'] ?>"><?php echo convert_currency($item['product_total']) ?></td>
                                    <td >
                                        <!-- <a href="?mod=cart&action=delProduct&id=<?php echo $item['product_id'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a> -->
                                        <a data-id="<?php echo $item['product_id'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span id="total-cost"><?php echo convert_currency($_SESSION['cart']['checkout']['totalCost']) ?></span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <!-- <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a> -->
                                            <a href="thanh-toan.html" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <!-- <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p> -->
                    <a href="?mod=home" title="" id="buy-more">Mua tiếp</a><br />
                    <!-- <a href="?mod=cart&action=deleteAll" title="" id="delete-cart">Xóa giỏ hàng</a> -->
                    <a  title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        <?php } else {
            echo " <p class='empty-cart'>Bạn chưa có sản phẩm nào trong giỏ hàng ... Vui lòng bấm <a href='?'> vào đây </a> để quay lại gian hàng của chúng tôi</p>";
        } ?>
    </div>
</div>
<?php get_footer(); ?>
<div id="pop__up-confirm">
    <div class="pop__up-confirm-content">
        <p class="pop__up-title">
            Xóa đơn hàng
        </p>
        <i class="fa fa-times close" aria-hidden="true"></i>

        <p class="pop__up-content">Bạn có chắc chắn muốn xóa sản phẩm khỏi đơn hàng này không ?</p>
        <div class="pop__up-confirm">
            <button class="cancel">Hủy </button>
            <button class="yes">Đồng ý</button>
        </div>


    </div>
</div>
<div id="pop__up-confirm" class="delete-cart">
    <div class="pop__up-confirm-content">
        <p class="pop__up-title">
            Xóa giỏ hàng 
        </p>
        <i class="fa fa-times close" aria-hidden="true"></i>

        <p class="pop__up-content">Bạn có chắc chắn muốn xóa các danh mục này?</p>
        <div class="pop__up-confirm">
            <button class="cancel">Hủy </button>
            <a href="?mod=cart&action=deleteAll" class="yes">Đồng ý</a>
        </div>


    </div>
</div>