$(function () {
//    Show, hide slide
    var url = window.location.pathname;
    url = url.split("/");

    if (url[1] == "trang-chu") {
        $(".slideshow").removeClass("hideSlide");
    }
    if (url[1] == "") {
        $(".slideshow").removeClass("hideSlide");
    }

    $('#search_product').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $.ajax({
                url: "sanpham/search_product",
                type: "post",
                dataType: "json",
                data: {keyword: $('#search_product').val()}
            }).done(function (result) {
                console.log(result);
                var html = "";
                html += "<div class='list_product'>";
                $.each(result, function (key, item) {
                    html += "        <div class=\"col-xs-6 col-sm-4 col-md-3\">";
                    html += "            <div class=\"thumbnail\">";
                    html += "                <div class=\"img-product\">";
                    html += "                    <a href=\"" + item['alias'] + "\">";
                    html += "                        <img src=\"http:\/\/demo.com\/ci_giantshop\/public\/img\/product\/" + item['img'] + "\" alt=\"Hình ảnh sản phẩm\">";
                    html += "                    <\/a>";
                    html += "                <\/div>";
                    html += "                <div class=\"caption\">";
                    html += "                    <div class=\"item-title\">";
                    html += "                        <a href=\"" + item['alias'] + "\">";
                    html += "                            <h3>" + item['name'] + "<\/h3>";
                    html += "                        <\/a>";
                    html += "                    <\/div>";
                    html += "                    <div class=\"item-content\">";
                    html += "                        <p>";
                    html += "                            <span>" + item['price_sale'] + "<sup><u>đ<\/u><\/sup><\/span> <span class=\"is_sale\">" + item['price'] + "<sup><u>đ<\/u><\/sup><\/span><\/p>";
                    html += "                    <\/div>";
                    html += "                <\/div>";
                    html += "                <div class=\"bg_hidden\">";
                    html += "                    <a href=\"" + item['alias'] + "\" class=\"over_bg\"><\/a>";
                    html += "                    <a href=\"javascript:void(0)\" onclick=\"dat_mua('" + item['id'] + "')\" class=\"btn btn-primary dat_mua\">Đặt mua<\/a>";
                    html += "                <\/div>";
                    html += "            <\/div>";
                    html += "        <\/div>";
                });
                html += "    <\/div>";
                $(".list_product").html(html);
            });
        }
    });
    $(".nav.navbar-nav.target-active ul li").click(function () {
        $("nav.navbar-nav.target-active ul li").removeClass("active");
        $(this).addClass("active");
    });
    $(".gui_email_nhan_tin").click(function () {
        var email = "";
        email = $(".form-subcribe input[type=email]").val();
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (email == "") {
            alert("Vui lòng nhập email!");
        }
        else if (!re.test(email)) {
            alert("Vui lòng nhập lại email!");
        } else {

            $.ajax({
                url: "trangchu/signup_email",
                type: "post",
                dataType: "text",
                data: {email: email}
            }).done(function (result) {
                if (result == "1") {
                    alert("Đăng ký nhận tin thành công!");
                }
                else {
                    alert("Không thành công!");
                }
            });
            $(".form-subcribe input[type=email]").val("");
        }
        ;
    });
    $(".btnLogin").click(function () {
        var user = "", pass = "";
        user = $("input[name=username]").val();
        pass = $("input[name=password]").val();
        if (user == "" || pass == "") {
            alert("Vui lòng nhập tài khoản!");
        }
        else {
            $.ajax({
                url: "trangchu/sign_in",
                type: "post",
                dataType: "text",
                data: {user: user, pass: pass}
            }).done(function (result) {
                if (result == "1") {
                    alert("Đăng nhập thành công!");
                    location.reload();
                }
                else {
                    alert("Tài khoản hoặc mật khẩu không đúng!");
                }

            });
        }

    });

    $("#btnSignup").click(function () {
        var password = $("#pass").val();
        var confirmPassword = $("#repass").val();
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    });

    //Show login-form
    $(".sign_in").click(function () {
        $(".login-form").slideToggle();
    });
    $(".btnLogin").click(function () {
        $(".login-form").slideUp();
    });
    $(".sign_up").click(function () {
        $(".login-form").slideUp();
    });
    //Fixed-menu
    var nav = $('.mainmenu');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 133) {
            nav.addClass("fixed-menu");
        } else {
            nav.removeClass("fixed-menu");
        }
    });
    //active menu
    function stripTrailingSlash(str) {
        if (str.substr(-1) == '/') {
            return str.substr(0, str.length - 1);
        }
        return str;
    }

    var url = window.location.pathname;
    var activePage = stripTrailingSlash(url);

    $('ul.nav.target-active li a').each(function () {
        var currentPage = stripTrailingSlash($(this).attr('href'));

        if (activePage == currentPage) {
            $(this).parent().addClass('active');
        }
    });
});
//Dat mua
function dat_mua(id) {
        if ($(".name").text() == "") {
            alert("Vui lòng đăng nhập trước khi mua hàng!");
        } else {
            var filename = 'user/cart';
            var html = "";
            $.ajax({
                url: "sanpham/mua_hang",
                type: "post",
                dataType: "json",
                data: {id: id}
            }).done(function (result) {
                console.log(result);
                html += "<a href='" + filename + "'><i class='fa fa-shopping-cart'></i> </a>";
                html += "<span class='number_cart'>" + result.length + "</span>";
                $(".cart-item").html(html);
            });
        }
    };