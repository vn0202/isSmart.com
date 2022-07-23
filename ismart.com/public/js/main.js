$(document).ready(function () {
    //  SLIDER
    // $("#banner-content").show();
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  ZOOM PRODUCT DETAIL
    $("#zoom").elevateZoom({ gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif' });

    //  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SCROLL TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function () {
        $('body,html').stop().animate({ scrollTop: 0 }, 800);
    });

    // CHOOSE NUMBER ORDER
    var value = parseInt($('#num-order').attr('value'));
    $('#plus').click(function () {
        value++;
        $('#num-order').attr('value', value);
        update_href(value);
    });
    $('#minus').click(function () {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
        update_href(value);
    });

    //  MAIN MENU
    $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

    //  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function (event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function () {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });

    //  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function () {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {

            //            $('.sub-menu').slideUp();
            //            $('#main-menu-respon li').removeClass('open');
            $(this).parent('li').addClass('open');
            //            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });

    $(".catParent input[name='r-price']").change(function () {
        var brand = $("input[name='r-brand']:checked").val();
        var range = $(this).val();
        let catParent = $("input[name='cat_product']").val();
        let data = {
            range: range,
            catParent: catParent,
            brand: brand
        }
        $.ajax({
            url: "?mod=home&action=handleFilter",
            method: "POST",
            data: data,
            dataType: "json",
            success: function (data) {

                let len = data.length;

                $("#list-product-wp .section-detail .list-item").empty();
                $("#paging-wp").empty();
                $(".main-content #list-product-wp .desc").empty();


                var html = "";
                if (len != 0) {
                    for (var i = 0; i < len; i++) {
                        var price = convert_currency(data[i]['product_price']);

                        var img = get_avatar_product(data[i]['product_thumb']);

                        html += `<li>
                    <a href="?mod=product&id=${data[i]['product_id']}" title="" class="thumb-background" style="background-image: url('${img}') ;">
                        
                    </a>
                    <a href="?mod=product&id=${data[i]['product_id']}" title="" class="product-name">${data[i]['product_title']}</a>
                    <div class="price">
                        <span class="new">${price}</span>
                        
                    </div>
                    <div class="action clearfix">
                        <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                    </div>
                </li>`;
                        $(".main-content #list-product-wp .desc").text(`Tổng ${len} sản phẩm`);

                    }
                }
                else {
                    html = "<p> Không có sản phẩm nào trong tầm giá này... Bạn vui lòng bấm <a href='?mod=home' > vào đây </a>  để quay lại </p>"
                }
                $("#list-product-wp .section-detail .list-item").html(html);


                // $("#main-content-wp .wp-inner .list-item").
            },
            error: function (xhr, status, error) {
                alert(error);
            }

        })

    })
    $("input[name='r-brand']").change(function () {
        var range = $("input[name='r-price']:checked").val();
        let catParent = $("input[name='cat_product']").val();
        var brand = $(this).val();
        let data = {
            brand: brand,
            catParent: catParent,
            range: range
        };
        $.ajax({
            url: "?mod=home&action=handleFilterBrand",
            method: "POST",
            data: data,
            dataType: "json",
            success: function (data) {
                let listProduct = data['listProduct'];
                let len = listProduct.length;

                $("#list-product-wp .section-detail .list-item").empty();
                $("#paging-wp").empty();
                $(".main-content #list-product-wp .desc").empty();


                var html = "";
                if (len != 0) {
                    for (var i = 0; i < len; i++) {
                        var price = convert_currency(listProduct[i]['product_price']);

                        var img = get_avatar_product(listProduct[i]['product_thumb']);

                        html += `<li>
                        <a href="?mod=product&id=${listProduct[i]['product_id']}" title="" class="thumb-background" style="background-image: url('${img}') ;">
                            
                        </a>
                        <a href="?mod=product&id=${listProduct[i]['product_id']}" title="" class="product-name">${listProduct[i]['product_title']}</a>
                        <div class="price">
                            <span class="new">${price}</span>
                            
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>`;


                    }
                    $(".main-content #list-product-wp .desc").text(`Tổng ${len} sản phẩm`);
                    $("#breadcrumb-wp .list-item li:nth-child(3)").remove();
                    var liItem = document.createElement("li");
                    var aItem = document.createElement('a');
                    aItem.setAttribute('href', `?mod=home&action=listProductBySubCat&subCat=${brand}&id=${catParent}`);
                    aItem.innerHTML = data['brand'];

                    liItem.appendChild(aItem);


                    document.querySelector("#breadcrumb-wp .list-item").appendChild(liItem);
                }
                else {
                    html = "<p> Không có sản phẩm nào trong tầm giá này... Bạn vui lòng bấm <a href='?mod=home' > vào đây </a>  để quay lại </p>"
                }
                $("#list-product-wp .section-detail .list-item").html(html);
            },
            error: function (xhr, status, error) {
                alert(error);
            }

        })
        // alert("vu Van nghia");
    })
    $(".subCat input[name='r-price']").change(function () {
        var brand = $("#main-content-wp .subCat").attr("data-id");
        // alert(brand);

        var range = $(this).val();
        let catParent = $("input[name='cat_product']").val();
        let data = {
            range: range,
            catParent: catParent,
            brand: brand
        }
        $.ajax({
            url: "?mod=home&action=handleFilterByBrand",
            method: "POST",
            data: data,
            dataType: "json",
            success: function (data) {

                let len = data.length;

                $("#list-product-wp .section-detail .list-item").empty();
                $("#paging-wp").empty();
                $(".main-content #list-product-wp .desc").empty();


                var html = "";
                if (len != 0) {
                    for (var i = 0; i < len; i++) {
                        var price = convert_currency(data[i]['product_price']);

                        var img = get_avatar_product(data[i]['product_thumb']);

                        html += `<li>
                        <a href="?mod=product&id=${data[i]['product_id']}" title="" class="thumb-background" style="background-image: url('${img}') ;">
                            
                        </a>
                        <a href="?mod=product&id=${data[i]['product_id']}" title="" class="product-name">${data[i]['product_title']}</a>
                        <div class="price">
                            <span class="new">${price}</span>
                            
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>`;
                        $(".main-content #list-product-wp .desc").text(`Tổng ${len} sản phẩm`);

                    }
                }
                else {
                    html = "<p> Không có sản phẩm nào trong tầm giá này... Bạn vui lòng bấm <a href='?mod=home' > vào đây </a>  để quay lại </p>"
                }
                $("#list-product-wp .section-detail .list-item").html(html);


                // $("#main-content-wp .wp-inner .list-item").
            },
            error: function (xhr, status, error) {
                alert(error);
            }

        })

    })
    // bật thông báo thêm sản phẩm vào giỏ hàng thành công hay thất bại
    $("#notify__add-content").animate({
        top: 0,

    })
    $(".close-icon").click(function () {
        $("#notify-add").css("display", "none")
    })
    $(".detail-product-page .add-cart").click(function () {
        var number = $(".detail-product-page #num-order").val();
        var productID = $(this).attr("data-id");
        // alert(productID);
        $.ajax({
            url: "?mod=cart&action=addProductToCart2",
            method: "POST",
            data: {
                number: number,
                productID: productID

            },
            dataType: "text",
            success: function (data) {


                $("#notify-add").css('display', "block");
                if (data != 0) {
                    $('#action-wp #num').text(data);
                    $(".notify-content").text("Bạn đã thêm sản phẩm thành công vào giỏ hàng");
                }
                else {
                    $(".notify-content").text("Sản phẩm hiện thời đã hết ..xin quý khách vui lòng xem các sản phẩm khác")
                }


            },
            error: function (xhr, status, error) {
                alert(error)
            }
        })
    })
    $('.cart-page .num-order').change(function () {
        var number = $(this).val();
        var productID = $(this).attr('data-id');
        $.ajax({
            url: "?mod=cart&action=handleChangeNumberInCart",
            method: "POST",
            data: {
                number: number,
                productID: productID,
            },
            dataType: "json",
            success: function (data) {
                var price = convert_currency(data['totalCost']);
                var totalPriceProduct = convert_currency(data['productTotal']);
                $("#total-cost").text(price);
                $('#total-cost').css('color', "red");
                $(`.total-cost-product-${productID}`).text(totalPriceProduct);
            },
            error: function (xhr, status, error) {
                alert(error);
            }
        })

    })
    // turn on notification delete product from cart
    let delID = null;
    $(".del-product").click(function () {
        $("#pop__up-confirm").css("display", "flex");
        // $("#pop__up-confirm").animate({
        //     top: 0,
        // },1000);
        delID = $(this).attr("data-id");
    })
    $("#pop__up-confirm.delete-cart .close").click(function () {
        $("#pop__up-confirm.delete-cart").css("display", "none");

    })
    $("#pop__up-confirm.delete-cart .cancel").click(function () {
        $("#pop__up-confirm.delete-cart").css("display", "none");

    })
    $("#pop__up-confirm .yes").click(function () {
        $("#pop__up-confirm").css("display", "none");
        $.ajax({
            url: "?mod=cart&action=deleteProduct",
            method: "POST",
            data: {
                delID: delID
            },
            dataType: "json",
            success: function (data) {
                var price = convert_currency(data['totalCost']);
                $(`.row-${delID}`).remove();
                $("#total-cost").text(price);
                $('#total-cost').css('color', "red");
                $("#head-body #cart-wp #btn-cart #num").text(data.numberProduct);

            },
            error: function (xhr, status, error) {
                alert(error);
            }
        })
    })
    $("#delete-cart").click(function () {
        $("#pop__up-confirm.delete-cart").css('display', 'flex');

    })
    $("#pop__up-confirm .close").click(function () {
        $("#pop__up-confirm").css("display", "none");

    })
    $("#pop__up-confirm .cancel").click(function () {
        $("#pop__up-confirm").css("display", "none");

    })
    // handle click to see more product than
    $("#main-content-wp .list-item .see-more").click(function () {
        var catID = $(this).attr('data-id');
        $.ajax({
            url: "?mod=home&action=seemore",
            method: "POST",
            data: {
                catID: catID,
            },
            dataType: "json",
            success: function (data) {
                var html = ``;
                for (var i = 0; i < data.length; i++) {
                    html += `<li>
                <a href="${data[i].link}" title="" class="thumb-background" style="background-image: url('${data[i].thumb}');"> 
                   
                </a>
                <a href="${data[i].link}" title="" class="product-name">${data[i].title}</a>
                <div class="price">
                    <span class="new">${data[i].price}</span>
                  
                    <span class="old">${data[i].old_price}</span>
           
                </div>
                <div class="action clearfix">
                    <a href="?mod=cart&action=addProductToCart&id=${data[i].id}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                    <a href="?mod=checkout&action=buyDirect&id=${data[i].id}?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                </div>
            </li>`
                };

                $('#list-item-' + catID).html(html);
                // console.log(html);
            },
            error: function (xhr, status, error) {
                alert(error)
            }
        })
    })
    // turn off the banner
    $(".icon-close-banner").click(function () {
        $("#banner-content").hide();
    })

    $.ajax({
        url: '?mod=home&action=handleBannerLeft',
        method: "POST",
        dataType: "json",
        success: function (data) {
            if (typeof interval != 'undefined') {
                clearInterval(interval);
            }
            var i = 0;
            var interval = setInterval(function () {
                if (i >= data.length) {
                    i = 0;
                }

                $('#banner-wp .thumb').css("background-image", `url('${data[i].banner_thumb}')`);
                $("#banner-wp .thumb").css("href",`${data[i].link}`);
                i++;
            }, 2000)
        },
        error: function (xhr, status, error) {
            alert(error);
        }
    })
    $.ajax({
        url: '?mod=home&action=handleBannerTop',
        method: "POST",
        dataType: "json",
        success: function (data) {
            if (typeof interval != 'undefined') {
                clearInterval(interval);
            }
            var i = 0;
            var interval = setInterval(function () {
                if (i >= data.length) {
                    i = 0;
                }

                $('#banner #banner-content').css("background-image", `url('${data[i].banner_thumb}')`);

                i++;
            }, 3000)
        },
        error: function (xhr, status, error) {
            alert(error);
        }
    })


});


function tab() {
    var tab_menu = $('#tab-menu li');
    tab_menu.stop().click(function () {
        $('#tab-menu li').removeClass('show');
        $(this).addClass('show');
        var id = $(this).find('a').attr('href');
        $('.tabItem').hide();
        $(id).show();
        return false;
    });
    $('#tab-menu li:first-child').addClass('show');
    $('.tabItem:first-child').show();

}
function get_avatar_product(thumb) {
    var pos = thumb.search(";");
    img = thumb.slice(0, pos);
    img = encodeURI(img);
    img = "admin/" + img;
    return img;
}

function convert_currency(number, unit = "đ") {
    number = number.toString();
    let temp = [];
    let len = number.length;
    if (len > 4) {
        var i = len - 3;
        while (i > 0) {
            temp.unshift(number.substr(i, 3));
            number = number.substr(0, len - 3);
            len = number.length;
            i = i - 3;
        }
        temp.unshift(number);
        return temp.join(",") + unit;
    }

    else {
        return temp + unit;
    }
}

