(function ($) {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    });

    function setFullHeight() {
        document.documentElement.style.setProperty('--vh', `${window.innerHeight}px`);
    }

    window.addEventListener('resize', setFullHeight);
    setFullHeight();

    $(document).ready(function () {
        AOS.init({
            disable: 'mobile',
            once: true
        });
        $('.openSearch').on('click', function (e) {
            e.preventDefault();
            $('.header__search').toggleClass('show');
        });

        $('.menu-item.hasChild').append('<button type="button" class="btnSub"><i class="far fa-chevron-down"></i></button>');
        $(document).on('click', '.openMenu', function (e) {
            e.preventDefault();
            $('body').addClass('activeMenu');
        });
        $(document).on('click', '.closeMenu', function (e) {
            e.preventDefault();
            $('body').removeClass('activeMenu');
        });
        $(document).on('click', '.btnSub', function (e) {
            e.preventDefault();
            $(this).toggleClass('active').siblings('.subMenu').slideToggle(300);
        });
        $(document).on('click', function (e) {
            if (!e.target.closest('.seaToggle')) {
                if (e.target.closest('.toggleSearch')) {
                    $('.toggleSearch').toggleClass('active').siblings('.seaToggle').slideToggle(150);
                } else {
                    $('.toggleSearch').removeClass('active').siblings('.seaToggle').slideUp(150).hide(150);
                }
            }
        });

        if ($('.heroSlider__main').length) {
            $('.heroSlider__main').slick({
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                infinite: true,
                lazyLoad: "progressive",
                speed: 1000,
                arrows: true,
                dots: true,
                fade: true,
                cssEase: 'linear',
            });
        }

        if ($('.feedback__slider').length) {
            $('.feedback__slider').slick({
                slidesToShow: 3,
                autoplay: true,
                autoplaySpeed: 5000,
                infinite: true,
                lazyLoad: "progressive",
                speed: 500,
                arrows: false,
                dots: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            arrows: false,
                            dots: true,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            arrows: false,
                            dots: true,
                        }
                    }
                ]
            });
        }
        if ($('.secSale__slider').length) {
            $('.secSale__slider').slick({
                slidesToShow: 3,
                autoplay: true,
                autoplaySpeed: 5000,
                infinite: true,
                lazyLoad: "progressive",
                speed: 500,
                arrows: true,
                dots: true,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            arrows: true,
                            dots: false,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            arrows: true,
                            dots: false,
                        }
                    }
                ]
            });
        }
        var hotHotel__navs = new Swiper(".hotHotel__navs", {
            slidesPerView: "auto",
            spaceBetween: 30,
            freeMode: true,
            pagination: false,
            navigation: {
                nextEl: ".hotHotel__wrap .swiper-button-next",
                prevEl: ".hotHotel__wrap .swiper-button-prev",
            },
        });
        if ($('.aboutPartner__slider').length) {
            $('.aboutPartner__slider').slick({
                slidesToShow: 6,
                autoplay: true,
                autoplaySpeed: 5000,
                infinite: true,
                lazyLoad: "progressive",
                speed: 500,
                arrows: false,
                dots: true,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                ]
            });
        }

        $('a[data-fancybox]').fancybox();

        if ($('.process').length) {
            $('.process').each(function () {
                const originalString = $(this).find('.title').text();
                const newString = originalString.replace(/(\d+(?:\.\d{3})*)/g, '<span class="figureNumber">$1</span>');
                $(this).find('.title').html(newString);
            });

            setTimeout(function () {
                $(window).on('scroll', function () {
                    var processPosition = $('.aboutInfo__ac').offset().top;
                    var scrollPosition = $(window).scrollTop() + $(window).height();

                    if (processPosition < scrollPosition) {
                        runCounter($('.figureNumber'));
                    }
                });
            }, 1000);
        }

        $(document).on('click', '.btnViewmore', function (e) {
            e.preventDefault();
            if ($(this).hasClass('more')) {
                $(this)
                    .removeClass('more')
                    .text('Xem thêm')
                    .closest('.info')
                    .find('.info__time')
                    .css('max-height', '72px');
            } else {
                $(this)
                    .addClass('more')
                    .text('Thu gọn')
                    .closest('.info')
                    .find('.info__time')
                    .css('max-height', '9999px');
            }
        });

        $(document).on('click', '.prodFilter__block .title', function (e) {
            e.preventDefault();
            if ($(this).hasClass('hide')) {
                $(this).removeClass('hide').siblings('.dataFilter').slideDown(300).fadeIn(300);
            } else {
                $(this).addClass('hide').siblings('.dataFilter').slideUp(300).fadeOut(300);
            }
        });

        $(document).on('click', '.quantityBtn', function (e) {
            e.preventDefault();
            const quantityInput = $(this).siblings('.quantityInput');
            const quantityInputVal = parseInt(quantityInput.val());

            console.log(quantityInputVal);


            if ($(this).hasClass('minus')) {
                if (quantityInputVal > 1) {
                    quantityInput.val(parseInt(quantityInputVal - 1));
                }
            } else if ($(this).hasClass('plus')) {
                quantityInput.val(parseInt(quantityInputVal + 1));
            }
        });

        if ($('.prodDetailContent').length) {
            $('.prodDetailContent').each(function () {
                const hContent = $(this).outerHeight();

                if (hContent > 860) {
                    $(this).css('height', '860px');
                    $(this).after('<button type="button" class="moreContent mt-4 mx-auto" data-height="' + hContent + 'px">Đọc tiếp</button>');
                }
            });

            $(document).on('click', '.moreContent', function (e) {
                e.preventDefault();
                const dataH = $(this).data('height');
                if ($(this).hasClass('more')) {
                    $(this).removeClass('more').text('Đọc tiếp').siblings('.prodDetailContent').css('height', '860px');
                } else {
                    $(this).addClass('more').text('Thu gọn').siblings('.prodDetailContent').css('height', dataH);
                }
            });
        }


        function runCounter($elements) {
            if ($elements.length) {
                $elements.each(function () {
                    const $element = $(this);
                    if (!$element.hasClass("counted")) {
                        var numberString = $element.html();
                        var cleanedNumberString = numberString.replace(/\./g, '');
                        var targetNumber = parseInt(cleanedNumberString, 10);

                        if (!isNaN(targetNumber)) {
                            $element.addClass("counted");
                            $({ countNum: 0 }).animate({ countNum: targetNumber }, {
                                duration: 3000,
                                easing: "linear",
                                step: function () {
                                    let currentNum = Math.floor(this.countNum);
                                    let formattedNum;

                                    // SỬA ĐỔI: Thêm số 0 đằng trước nếu số nhỏ hơn 10
                                    if (currentNum < 10) {
                                        formattedNum = '0' + currentNum;
                                    } else {
                                        // Giữ nguyên định dạng gốc cho các số lớn hơn hoặc bằng 10
                                        formattedNum = currentNum.toLocaleString('de-DE', {
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        });
                                    }
                                    $element.text(formattedNum);
                                },
                                complete: function () {
                                    let formattedTarget;

                                    // SỬA ĐỔI: Đảm bảo số cuối cùng cũng được định dạng tương tự
                                    if (targetNumber < 10) {
                                        formattedTarget = '0' + targetNumber;
                                    } else {
                                        formattedTarget = targetNumber.toLocaleString('de-DE', {
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        });
                                    }
                                    $element.text(formattedTarget);
                                }
                            });
                        } else {
                            console.error("Lỗi: Không thể chuyển đổi '" + numberString + "' thành số hợp lệ.");
                        }
                    }
                });
            }
        }
    });
})(jQuery)

function copyCurrentUrl() {
    // Lấy URL của trang hiện tại
    const url = window.location.href;

    // Sử dụng Clipboard API để sao chép
    navigator.clipboard.writeText(url).then(() => {
        // Thông báo thành công (bạn có thể thay bằng tooltip hoặc thay đổi text của nút)
        alert("Đã sao chép URL!");
    }).catch(err => {
        // Xử lý lỗi nếu không sao chép được
        console.error('Không thể sao chép URL: ', err);
        alert("Sao chép thất bại!");
    });
}