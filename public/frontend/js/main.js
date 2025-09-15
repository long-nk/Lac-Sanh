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

        if ($('.hotHotel__navs').length) {
            const hotHotel__navs = new Swiper(".hotHotel__navs", {
                slidesPerView: "auto",
                spaceBetween: 30,
                freeMode: true,
                pagination: false,
                navigation: {
                    nextEl: ".hotHotel__wrap .swiper-button-next",
                    prevEl: ".hotHotel__wrap .swiper-button-prev",
                },
            });
        }

        if ($('.reviewSlider').length) {
            $('.reviewSlider').slick({
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 3500,
                infinite: true,
                lazyLoad: "progressive",
                speed: 500,
                arrows: true,
                dots: true,
                cssEase: 'linear',
            });
        }

        if($('.room__images').length) {
            $('.room__images').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                asNavFor: '.room__thumbs'
            });

            $('.room__thumbs').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.room__images',
                dots: false,
                centerMode: true,
                focusOnSelect: true
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

        $('.select-sx--title').click(function (event) {
            // Prevent click event from propagating to the document
            event.stopPropagation();

            // Toggle the 'active-model' class on click of the title
            $(this).parents('.details-raiting').find('.select-filter-model').toggleClass('active-model');
        });

        $('.js-dots').click(function () {
            $('.js-dots').removeClass('active');
            $(this).addClass('active');
            var text = $(this).find('.text').text();
            $(this).parents('.select-sx').find('.js-sx').text(text);
        });

        $(document).on('click', function (e) {
            if (!e.target.closest('.filter__content')) {
                $('.sub-filter').fadeOut(0);
                $('.sub-filter--checkn').removeClass('show-sub');
                $('.js-list-start').hide();
            }
            if (!e.target.closest('.select-sx')) {
                $('.select-filter-model').removeClass('active-model');
            }
        });

        if ($('.hotelDetail__content').length) {
            const contentHeight = $('.hotelDetail__content .content').outerHeight();
            if (contentHeight > 50) {
                $('.hotelDetail__content .content').css('max-height', '50px').after('<button type="button" class="btnViewmore mt-3">Xem thêm</button>');
            }

            $(document).on('click', '.btnViewmore', function (e) {
                e.preventDefault();
                if ($(this).hasClass('more')) {
                    $(this)
                        .removeClass('more')
                        .text('Xem thêm')
                        .siblings('.content')
                        .css('max-height', '50px');
                } else {
                    $(this)
                        .addClass('more')
                        .text('Thu gọn')
                        .siblings('.content')
                        .css('max-height', '9999px');
                }
            });
        }

        if ($('.facilityList').length) {
            const contentHeight = $('.facilityList').outerHeight();
            if (contentHeight > 24) {
                $('.facilityList').css('max-height', '24px').after('<button type="button" class="moreFacility mt-3">Xem thêm</button>');
            }

            $(document).on('click', '.moreFacility', function (e) {
                e.preventDefault();
                if ($(this).hasClass('more')) {
                    $(this)
                        .removeClass('more')
                        .text('Xem thêm')
                        .siblings('.facilityList')
                        .css('max-height', '24px');
                } else {
                    $(this)
                        .addClass('more')
                        .text('Thu gọn')
                        .siblings('.facilityList')
                        .css('max-height', '9999px');
                }
            });
        }

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