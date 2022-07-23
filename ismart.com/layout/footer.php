<?php 
$infor = get_infor_shop();
if(strpos($infor['phone'],"-")!==FALSE)
{


$phone = explode("-",$infor['phone']);
}
else{
    $phone=$infor['phone'];
}
?>
<div id="footer-wp">
    <div id="foot-body">
        <div class="wp-inner clearfix">
            <div class="block" id="info-company">
                <h3 class="title"><?php    echo strtoupper( $infor['name'])?></h3>
                <p class="desc"><?php echo $infor['slogan']?></p>
                <div id="payment">
                    <div class="thumb">
                        <img src="public/images/img-foot.png" alt="">
                    </div>
                </div>
            </div>
            <div class="block menu-ft" id="info-shop">
                <h3 class="title">Thông tin cửa hàng</h3>
                <ul class="list-item">
                    <li>
                        <p><?php echo $infor['address']?></p>
                    </li>
                    <li>
                        <p><?php 
                        if(is_array($phone))
                        {
                            echo handlePhone( $phone[0])." - ".handlePhone( $phone[1]);
                        }
                        else{
                            echo handlePhone($phone);
                        }
                        ?></p>
                    </li>
                    <li>
                        <p><?php echo $infor['email']?></p>
                    </li>
                </ul>
            </div>
            <div class="block menu-ft policy" id="info-shop">
                <h3 class="title">Chính sách mua hàng</h3>
                <ul class="list-item">
                    <li>
                        <a href="pages/quy-dinh-chinh-sach-8.html" title="">Quy định - chính sách</a>
                    </li>
                    <li>
                        <a href="pages/chinh-sach-bao-hanh-9.html" title="">Chính sách bảo hành - đổi trả</a>
                    </li>
                    <li>
                        <a href="pages/chinh-sach-hoi-vien-10.html" title="">Chính sách hội viện</a>
                    </li>
                    <li>
                        <a href="pages/hinh-sach-giao-hang-9.html" title="">Giao hàng - lắp đặt</a>
                    </li>
                </ul>
            </div>
            <div class="block" id="newfeed">
                <h3 class="title">Bảng tin</h3>
                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                <div id="form-reg">
                    <form method="POST" action="">
                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                        <button type="submit" id="sm-reg">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="foot-bot">
        <div class="wp-inner">
            <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
        </div>
    </div>
</div>
</div>
<div id="menu-respon">
    <a href="?page=home" title="" class="logo">VSHOP</a>
    <div id="menu-respon-wp">
        <ul class="" id="main-menu-respon">
            <li>
                <a href="?page=home" title>Trang chủ</a>
            </li>
            <li>
                <a href="?page=category_product" title>Điện thoại</a>
                <ul class="sub-menu">
                    <li>
                        <a href="?page=category_product" title="">Iphone</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Samsung</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?page=category_product" title="">Iphone X</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Iphone 8</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Nokia</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="?page=category_product" title>Máy tính bảng</a>
            </li>
            <li>
                <a href="?page=category_product" title>Laptop</a>
            </li>
            <li>
                <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
            </li>
            <li>
                <a href="?page=blog" title>Blog</a>
            </li>
            <li>
                <a href="#" title>Liên hệ</a>
            </li>
        </ul>
    </div>
</div>
<div id="btn-top"><img src="public/images/icon-to-top.png" alt=""/></div>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>