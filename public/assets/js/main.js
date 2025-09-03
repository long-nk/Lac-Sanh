$(document).ready(function () {
    $('i').addClass('fa');
    $('.slick-fsale').slick({
        dots: false,
        arrows: true,
        infinite: false,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            }
        ]
    });
    $('.slick-category').slick({
        dots: false,
        arrows: true,
        infinite: false,
        speed: 500,
        slidesToShow: 7,
        slidesToScroll: 7,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            }
        ]
    });

    $('.slick-dg').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
    });



    $('.slick-banner-mobile').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: true,
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true,
    });

    $('.slick-kh').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 6,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                }
            }
        ]
    });

    $('.js-show-mobile').click(function () {
        $('.menu-mobile').show();
        $('body').css('overflow', 'hidden');
    });

    $('.js-close').click(function () {
        $('.menu-mobile').hide();
        $('body').css('overflow', 'auto');
    });

    $('.mobile--button').click(function () {
        $('.menu-mobile').fadeOut();
        $('body').css('overflow', 'auto');
    });

    $('.js-option-custom').each(function () {
        var $leng = $(this).find('.option-custom').length;
        var $total = $leng - 1;
        var $text = $('.js-show span').text($total);
    });

    $('.js-show').click(function () {
        $(this).hide();
        $(this).parents('.items-zoom--content').find('.js-none').show();
        $(this).parents('.items-zoom--content').find('.option-custom').slideDown();
    });

    $('.js-none').click(function () {
        $(this).hide();
        $(this).parents('.items-zoom--content').find('.js-show').show();
        $(this).parents('.items-zoom--content').find('.option-custom').slideUp();
    });


    //Slider bài viết liên quan

    $('.relatedPosts__slider').slick({
        dots: false,
        arrows: true,
        infinite: false,
        speed: 500,
        slidesToShow: 3,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    dots: true,
                    arrows: false,
                }
            }
        ]
    });




    $('.slick-aboutus').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 500,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $('.slick-slide-services').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 500,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $('.slick-details-room').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 500,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $('.slick-mobile-icon').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 500,
        fade: false,
        slidesToShow: 5,
        slidesToScroll: 5,
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $('.slick-pn').slick({
        dots: false,
        arrows: true,
        infinite: false,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $('.slick-cnkh').slick({
        dots: true,
        arrows: true,
        infinite: false,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 2,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                    arrows: false,
                }
            }
        ]
    });

    $('.slick-nav-slide').slick({
        dots: false,
        arrows: true,
        infinite: false,
        speed: 500,
        slidesToShow: 8,
        slidesToScroll: 1,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    $('.slick-list-blog').slick({
        dots: false,
        arrows: false,
        infinite: false,
        speed: 500,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    $(document).ready(function () {
        if ($('.villa-banner-slider').length) {
            $('.villa-banner-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                dots: true,
                arrows: true,
                infinite: true,
                speed: 600,
                fade: false,
                cssEase: 'ease-in-out'
            });
        }
    });


    $('.js-show-mobile').click(function () {
        $('.menu-mobile').fadeIn();
        $('body').css('overflow', 'hidden');
    });

    $('.js-close').click(function () {
        $('.menu-mobile').fadeOut();
        $('body').css('overflow', 'auto');
    });

    $('.js-option-custom').each(function () {
        var $leng = $(this).find('.option-custom').length;
        var $total = $leng - 1;
        var $text = $('.js-show span').text($total);
    });

    $('.js-show').click(function () {
        $(this).hide();
        $(this).parents('.items-zoom--content').find('.js-none').show();
        $(this).parents('.items-zoom--content').find('.option-custom').slideDown();
    });

    $('.js-none').click(function () {
        $(this).hide();
        $(this).parents('.items-zoom--content').find('.js-show').show();
        $(this).parents('.items-zoom--content').find('.option-custom').slideUp();
    });


    $('.js-del-history').click(function () {
        $(this).hide();
        $('.js-search-history .items-sub').hide();
        $('.js-search-history').append('<p class="text-his">Chưa có lịch sử tìm kiếm gần đây</p>');
    });

    $('.js-show-address').click(function () {
        $('.sub-filter--checkn').removeClass('show-sub');
        $('.js-list-start').css('display', 'none');
        $('.daterangepicker').css('display', 'none');
        $('.sub-filter').fadeIn(100);

    });
    $(document).on('click', function (e) {
        if (!e.target.closest('.filter__content')) {
            $('.sub-filter').fadeOut(0);
            $('.sub-filter--checkn').removeClass('show-sub');
            $('.js-list-start').hide();
        }
        if(!e.target.closest('.select-sx')) {
            $('.select-filter-model').removeClass('active-model');
        }
    });

    if ($(window).width() < 767) {
        $('.js-filter-fixed .js-show-address').click(function () {
            $(this).hide();
        });
        $('.js-filter-fixed .js-sub-custom').click(function(){
            $('.js-filter-fixed .js-show-address').show();
        });
    }

    // Chữ code

    $(function () {
        moment.locale('vi');

        function calculateDays(start, end) {
            return end.diff(start, 'days');
        }

        var startDate = moment().startOf('day');
        var endDate = moment().endOf('day');
        var formattedStartDate = startDate.format('dd, DD MMMM ');
        var formattedEndDate = endDate.format('dd, DD MMMM ');

        // $(window).resize(function() {
        //     var width = $(window).width();
        //     if (width < 767){
        //         $('.data-picker').daterangepicker({
        //             alwaysShowCalendars: true,
        //             autoApply: false,
        //             applyButtonClasses: "btn btn-blue",
        //             cancelButtonClasses: "btn btn-secondary",
        //         });
        //     }
        // });
        if ($(window).width() < 767) {
            $('.data-picker').daterangepicker({
                autoUpdateInput: false,
                autoApply: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD/MM/YYYY',
                    daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                    firstDay: 1,
                    applyLabel: "Xác nhận",
                    cancelLabel: "Hủy",
                    fromLabel: "Ngày đi",
                    toLabel: "Ngày đến",
                },
                minDate: new Date(),
                startDate: startDate,
                endDate: endDate,

            }, function (start, end, label) {
                var titleFrom = "Ngày đi: " + start.format('dd, DD MMMM');
                var titleTo = "Ngày đến: " + end.format('dd, DD MMMM');
                $('.drp-selected').html(titleFrom + ' - ' + titleTo);
                var formattedStartDate = start.format('dd, DD MMMM');
                var formattedEndDate = end.format('dd, DD MMMM');
                var formattedStart = start.format('DD/MM/YYYY');
                var formattedEnd = end.format('DD/MM/YYYY');
                $('#startDate').val(formattedStartDate);
                $('#newStartDate').val(formattedStart);
                $('#startDatepp').val(formattedStartDate);
                $('#newStartDatepp').val(formattedStart);
                $('#endDate').val(formattedEndDate);
                $('#newEndDate').val(formattedEnd);
                var textst = $('#startDate').val();
                var textet = $('#endDate').val();
                var textstpp = $('#startDatepp').val();
                var textetpp = $('#endDatepp').val();
                $('#t-startdate').text(textst);
                $('#t-enddate').text(textet);

                $('#t-startdatepp').text(textst);
                $('#t-enddatepp').text(textet);

                if ($('#start-date').val() == '') {
                    $('#start-date').val(formattedStart);
                }
                if ($('#end-date').val() == '') {
                    $('#end-date').val(formattedEnd);
                }

                var days = calculateDays(start, end);
                $('#dayCount').text(days);
                $('input.day-count').val(days);

            });
        } else {
            $('.data-picker').daterangepicker({
                autoUpdateInput: false,
                autoApply: true,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD/MM/YYYY',
                    daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                    firstDay: 1,
                    applyLabel: "Xác nhận",
                    cancelLabel: "Hủy",
                    fromLabel: "Ngày đi",
                    toLabel: "Ngày đến",
                },
                minDate: new Date(),
                startDate: startDate,
                endDate: endDate,

            }, function (start, end, label) {
                var titleFrom = "Ngày đi: " + start.format('dd, DD MMMM');
                var titleTo = "Ngày đến: " + end.format('dd, DD MMMM');
                $('.drp-selected').html(titleFrom + ' - ' + titleTo);
                var formattedStartDate = start.format('dd, DD MMMM');
                var formattedEndDate = end.format('dd, DD MMMM');
                var formattedStart = start.format('DD/MM/YYYY');
                var formattedEnd = end.format('DD/MM/YYYY');
                $('#startDate').val(formattedStartDate);
                $('#newStartDate').val(formattedStart);
                $('#startDatepp').val(formattedStartDate);
                $('#newStartDatepp').val(formattedStart);
                $('#endDate').val(formattedEndDate);
                $('#newEndDate').val(formattedEnd);
                var textst = $('#startDate').val();
                var textet = $('#endDate').val();
                var textstpp = $('#startDatepp').val();
                var textetpp = $('#endDatepp').val();
                $('#t-startdate').text(textst);
                $('#t-enddate').text(textet);

                $('#t-startdatepp').text(textst);
                $('#t-enddatepp').text(textet);

                if ($('#start-date').val() == '') {
                    $('#start-date').val(formattedStart);
                }
                if ($('#end-date').val() == '') {
                    $('#end-date').val(formattedEnd);
                }

                var days = calculateDays(start, end);
                $('#dayCount').text(days);
                $('input.day-count').val(days);

            });
        }

    });


    $('.js-show-bookzoom').click(function (event) {
        $('.js-sub-custom').removeClass('show-sub');
        $('.sub-filter--checkn').addClass('show-sub');
        $('.js-list-start').css('display', 'none');
        $(".sub-filter").css('display', 'none');
        $('.daterangepicker').css('display', 'none');
        if ($('.js-sidebar-right').hasClass('active-position')) {
            $('.sub-filter--checkn').addClass('position-custom');
        } else {
            $('.sub-filter--checkn').removeClass('position-custom');
        }
    });


    $('.minus').click(function () {
        var $input = $(this).parent().find('.js-display-number');
        var count = parseInt($input.text()) - 1;
        count = count < 1 ? 1 : count;
        $input.text(count);
        $input.change();
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('.js-display-number');
        $input.text(parseInt($input.text()) + 1);
        $input.change();
        return false;
    });

    $('.js-queti-zoom .minus').click(function () {
        var $value = $(this).parents('.items').find('.js-check-input .input-zoom');
        var countval = parseInt($value.val()) - 1;
        countval = countval < 1 ? 1 : countval;
        $value.val(countval);
        $value.change();

        var $input = $(this).parents('.items').find('.js-content-bookzoom .js-zoom');
        var count = parseInt($input.text()) - 1;
        count = count < 1 ? 1 : count;
        $input.text(count);
        $input.change();

        return false;
    });

    $('.js-queti-zoom .plus').click(function () {
        var $value = $(this).parents('.items').find('.js-check-input .input-zoom');
        $value.val(parseInt($value.val()) + 1);
        $value.change();

        var $input = $(this).parents('.items').find('.js-content-bookzoom .js-zoom');
        $input.text(parseInt($input.text()) + 1);
        $input.change();
        return false;
        return false;
    });

    $('.js-queti-peo .minus').click(function () {
        var $value = $(this).parents('.items').find('.js-check-input .input-peo');
        var countval = parseInt($value.val()) - 1;
        countval = countval < 1 ? 1 : countval;
        $value.val(countval);
        $value.change();

        var $input = $(this).parents('.items').find('.js-content-bookzoom .js-peo');
        var count = parseInt($input.text()) - 1;
        count = count < 1 ? 1 : count;
        $input.text(count);
        $('.js-khach').text(count);
        $input.change();
        return false;

    });

    $('.js-queti-peo .plus').click(function () {
        var $value = $(this).parents('.items').find('.js-check-input .input-peo');
        $value.val(parseInt($value.val()) + 1);
        $value.change();
        var $input = $(this).parents('.items').find('.js-content-bookzoom .js-peo');
        $input.text(parseInt($input.text()) + 1);
        $('.js-khach').text(parseInt($input.text()));
        $input.change();
        return false;

    });

    $('.js-queti-tre .minus').click(function () {
        var $value = $(this).parents('.items').find('.js-check-input .input-tre');
        var countval = parseInt($value.val()) - 1;
        countval = countval < 1 ? 1 : countval;
        $value.val(countval);
        $value.change();
        var $input = $(this).parents('.items').find('.js-content-bookzoom .js-tre');
        var count = parseInt($input.text()) - 1;
        count = count < 1 ? 1 : count;
        $input.text(count);
        $input.change();
        return false;
    });

    $('.js-queti-tre .plus').click(function () {
        var $value = $(this).parents('.items').find('.js-check-input .input-tre');
        $value.val(parseInt($value.val()) + 1);
        $value.change();
        var $input = $(this).parents('.items').find('.js-content-bookzoom .js-tre');
        $input.text(parseInt($input.text()) + 1);
        $input.change();
        return false;
    });



    $('.js-check-table').click(function () {
        $('.js-sidebar-right').show();
        $('.js-sidebar-right').addClass('removePosition');
        $('.js-none-tr').show();
        $('.note-check').hide();

    });

    $('.js-check-active').click(function () {
        $('.js-check-active').removeClass('active');
        $(this).addClass('active');
        if ($('.js-sidebar-right').hasClass('removePosition')) {
            $('.js-sub-custom').addClass('position-custom2');
        }
    });

    $('.js-check-ng').click(function () {
        $('.sub-filter--checkn').addClass('position-custom');
        $('.js-sidebar-right').hide();
        $('.js-sidebar-right').removeClass('removePosition');
        var text = $(this).find('.content-ng .js-number1').text();
        $(this).parents('.items').find('.js-content-bookzoom .js-zoom').text(text);
        $(this).parents('.items').find('.js-check-input .input-zoom').val(text);
        $(this).parents('.items').find('.js-queti-zoom .js-display-number').text(text);

        var text2 = $(this).find('.content-ng .js-number2').text();
        $(this).parents('.items').find('.js-content-bookzoom .js-peo').text(text2);
        $('.js-khach').text(text2);
        $(this).parents('.items').find('.js-check-input .input-peo').val(text2);
        $(this).parents('.items').find('.js-queti-peo .js-display-number').text(text2);
        $('.js-sub-custom').removeClass('position-custom2');

    });


    $('.js-check-table-2').click(function () {
        $('.note-check').show();
    });

    $('.js-check-table-3').click(function () {
        $('.note-check').hide();
        $('.js-none-tr').hide();
    });

    // $('.js-display-s').click(function(event) {
    //   $('.js-list-start').show();
    // });

    $('.js-sub-s').click(function (event) {
        var text = $(this).data('value');
        $('.js-display-s span').text(text);
        $('input#number-star').val(text);
        $('.js-list-start').css('display', 'none');
    });

    $('button#book-room').click(function () {
        let startDate = $('input#startDate').val();
        let endDate = $('input#endDate').val();
        if (startDate == '' || endDate == '') {
            $('.daterangepicker').css('display', 'block');
        }
    });

    $('.items--flex--select--option').click(function () {
        $('.js-sub-custom').hide();
        $('.sub-filter--checkn').removeClass('show-sub');
        $('.sub-filter--checkn').css('display', 'none');
        $('.daterangepicker').css('display', 'none');
        $("sub-filter").css('display', 'none');
        $(this).find('.js-list-start').show();
    });

    $('.js-close-filter').click(function (e) {
        e.stopPropagation();
        $('.js-sub-custom').hide();
        $('.sub-filter--checkn').removeClass('show-sub');
        $('.sub-filter--checkn').css('display', 'none');
        $('.daterangepicker').css('display', 'none');
        $(".sub-filter").css('display', 'none');
        $(".js-show-address").css('display', 'block');
        $(this).find('.js-list-start').show();
    });

    $('.js-checkout, .js-chekin').click(function (e) {
        $('.sub-filter--checkn').removeClass('show-sub');
        $('.sub-filter--checkn').css('display', 'none');
        $('.js-list-start').css('display', 'none');
        $('.sub-filter').fadeOut(0);
    });


    $('.js-img-pp').click(function () {
        var img = $(this).find('img').attr('src');
        $(this).parents('.tab-pane--album').find('.js-add-url').attr('src', img);
    });

    $('.js-confirm').click(function () {
        $('.confirm_checkbox').find('label').toggleClass('active-lb');
    });


    $('.filter-section').each(function () {
        var leng = $(this).find('.check-custom').length;
        if (leng > 5 && $(this).find('p.js-xt').length === 0) {
            $(this).append('<p class="js-xt">Xem thêm</p>');
        }

    });

    $('.js-xt').click(function () {
        $(this).parents('.filter-menu').find('.check-custom').toggleClass('d-block');
        if ($(this).text() == "Xem thêm") {
            $(this).text('Rút gọn');
        } else {
            $(this).text("Xem thêm");
        }
    });

    $('.show-more').click(function () {
        if ($(this).text() == "Xem thêm") {
            $(this).text('Rút gọn');
            $('.hidden-class').css('display', 'block');
        } else {
            $(this).text("Xem thêm");
            $('.hidden-class').css('display', 'none');
        }
    });

    $('.show-more-bed-room').click(function () {
        if ($(this).text() == "Xem thêm") {
            $(this).text('Rút gọn');
            $('.hidden-class-bed-room').css('display', 'block');
        } else {
            $(this).text("Xem thêm");
            $('.hidden-class-bed-room').css('display', 'none');
        }
    });

    $('.filter-nav li').click(function () {
        $('.filter-nav li').removeClass('active');
        $(this).addClass('active');
    });

    $(document).ready(function () {
        let isScrolled = false;

        $(window).scroll(function () {
            const scroll = $(window).scrollTop();
            const stickyPosition = 100; // Vị trí mà ta muốn thêm class
            const isMobile = window.matchMedia("(max-width: 767px)").matches;

            if (scroll >= stickyPosition) {
                if (!isScrolled) { // Chỉ thêm class khi chưa scroll qua
                    if (!isMobile) {
                        $(".sticky-filter").addClass("active-scroll");
                    }
                    $('.js-scroll-filter').addClass('sticky-top-im');
                    $('#diadiemnoibat').addClass('sticky-top-margin');
                    $('.js-scroll-filter').find('.filter__content').addClass('filter__content__mobile__custom');
                    $('.js-scroll-filter').find('.container').addClass('add-div-filter');
                    // $('#search-hotel').css('display', 'none');
                    // $('#search-location').css('display', 'block');

                    isScrolled = true;
                }
            } else {
                if (isScrolled) { // Chỉ xóa class khi đã scroll qua
                    $(".sticky-filter").removeClass("active-scroll");
                    $('.js-scroll-filter').removeClass('sticky-top-im');
                    $('#diadiemnoibat').removeClass('sticky-top-margin');
                    $('.js-scroll-filter').find('.filter__content').removeClass('filter__content__mobile__custom');
                    $('.js-scroll-filter').find('.container').removeClass('add-div-filter');
                    // $('#search-hotel').css('display', 'block');
                    // $('#search-location').css('display', 'none');
                    isScrolled = false;
                }
            }
        });
    });


    $(document).click(function (event) {
        // Check if the clicked target is inside the .select-filter-model or .select-sx--title
        if (!$(event.target).closest('.select-filter-model, .select-sx--title').length) {
            // If it's outside, remove the 'active-model' class
            $('.select-filter-model').removeClass('active-model');
        }
    });

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

});

window.addEventListener('load', function() {
    $('.slick-slider-banner').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
});
$(document).on('input change', '.min-val', function () {
    var number = $(this).val();
    var number2 = $('.max-val').val();
    var width = number2 - number;
    var tt = number * 100000;
    const config = {style: 'currency', currency: 'VND', maximumFractionDigits: 9};
    const formated = new Intl.NumberFormat('vi-VN', config).format(tt);
    $('.min-input').html(formated);
    var track = parseInt(number);
    $('.slider-track2').css('width', width + '%');
    $('.slider-track2').css('left', track + '%');
    $('.js-input-only').addClass('d-block');
});

$(document).on('input change', '.max-val', function () {
    var number = $(this).val();
    var numberMin = $('.min-val').val();
    var width = number - numberMin;
    var tt = number * 100000;
    const config = {style: 'currency', currency: 'VND', maximumFractionDigits: 9};
    const formated = new Intl.NumberFormat('vi-VN', config).format(tt);
    $('.max-input').html(formated);
    var hi = $('.slider-track2').css('width', width + '%');
    $('.js-input-only').addClass('d-block');
});

if ($('.js-start').hasClass('active-s')) {
    $('.js-start-add').addClass('d-flex');
} else {
    $('.js-start-add').removeClass('d-flex');
}

$('.js-start').click(function () {
    var number = $(this).find('span').text();
    if ($(this).hasClass('active-s')) {
        $(this).removeClass('active-s');
        $(this).closest('.site-search').find('.js-start-add').attr('class', `js-dl-only d-flex js-start-add remove-star filter-label js-start-add-${number}`);
    } else {
        $(this).closest('.site-search').find('.js-start-add').attr('class', `js-dl-only d-flex js-start-add remove-star filter-label js-start-add-${number}`);
        $('.js-start').removeClass('active-s')
        $(this).addClass('active-s');
    }
});

$('.js-start-room').click(function () {
    var number = $(this).find('span').text();
    if ($(this).hasClass('active-s')) {
        $(this).removeClass('active-s');
        $(this).closest('.site-search').find('.js-start-room-add').attr('class', `js-dl-only d-flex js-start-add remove-star filter-label js-start-add-${number}`);
    } else {
        $(this).closest('.site-search').find('.js-start-room-add').attr('class', `js-dl-only d-flex js-start-add remove-star filter-label js-start-add-${number}`);
        $('.js-start').removeClass('active-s');
        $(this).addClass('active-s');
    }
});

$('.js-delete').click(function () {
    $('.js-start').removeClass('active-s');
    $('.js-start-add').removeClass('d-flex');
});

$('.js-show-filter').click(function () {
    $('.sidebar-search').toggle();
});

$('.show-maps').click(function (){
    $('.sidebar-search').toggle();
});

$(document).ready(function () {
    $(document).on("scroll", onScroll);
});

function onScroll(event) {
    var scrollPos = $(document).scrollTop();
    $('.nav-scroll a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.nav-scroll a').removeClass("active");
            currLink.addClass("active");
        } else {
            currLink.removeClass("active");
        }
    });
}

$('.js-hover').hover(function () {
    $(this).parents('.items-zoom').find('.js-show-hover').show();
}, function () {
    $('.js-show-hover').hide();
});


$('.view-u').hover(function () {
    $(this).parents('.images-content').find('.modal-view-u').show();

}, function () {
    $(this).parents('.images-content').find('.modal-view-u').hide();
});


$(document).ready(function () {
    if ($(window).width() <= 768) {
        $('#search-location').attr('readonly', true);

    }
});
$('.owl-ttp-modal').owlCarousel({
    items: 1,  // Display one image at a time
    loop: true,  // Enable infinite looping
    margin: 10,  // Space between slides
    nav: true,  // Show navigation arrows
    dots: true,  // Show dots for navigation
    autoplay: true,  // Enable automatic sliding
    autoplayTimeout: 3000,  // 3 seconds for each slide
    autoplayHoverPause: true  // Pause when hovered
});

$(document).ready(function() {
    $('input').attr('autocomplete', 'off');
    $('.data-picker').on('focus', function(event) {
      $(this).blur(); // Ngăn không cho input nhận focus
    });

    $('.js-addivfilter').click(function(){
        $('.js-filter-fixed').addClass('active-fixed');
        $(this).parents('.sticky-top-custom').hide();
    });

    $('.js-close-filter-vila').click(function(){
        $('.sticky-top-custom').show();
        $('.js-filter-fixed').removeClass('active-fixed');
    });

    $('.js-show-arrange').click(function() {
        $('#filter-nav').slideToggle();
    });

    $(".js-coppy-vocher").click(function(){
      var $temp = $("<textarea>");
      $("body").append($temp);
      $temp.val($(this).parents('.items--content').find(".js-code").text()).select();
      document.execCommand("copy");
      $temp.remove();
      $("#alertMessage").show();
      setTimeout(function(){
          $("#alertMessage").fadeOut();
      }, 1000);
    });

    $('.js-dropdown').click(function(){
        if($(this).hasClass('active-dropdown')){
            $(this).removeClass('active-dropdown');
            $(this).parents('ul li').find('.sub-menu').slideUp();
        }else{
            $('.sub-menu').slideUp();
            $(this).parents('ul li').find('.sub-menu').slideDown();
            $('.js-dropdown').removeClass('active-dropdown');
            $(this).addClass('active-dropdown');
        }
    });

});



$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll > 50) {
        $(".details-nav-top").addClass("details-nav-top-active");
    }
    else {
        $(".details-nav-top").removeClass("details-nav-top-active");
    }
});


$(document).ready(function() {

    if ($('.tocContent').length) {
        $("#toc").toc({content: "div.tocContent", headings: "h1,h2,h3,h4,h5"});
    }

    $(document).on('click', '.toc__title', function (e) {
        e.preventDefault();
        $(this).toggleClass('show');
        $('.toc__list').slideToggle(150);
    });

  // Hàm chuyển đổi tiếng Việt có dấu thành tiếng Việt không dấu
  function removeVietnameseTones(str) {
    return str.normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu
      .replace(/đ/g, 'd').replace(/Đ/g, 'D') // Chuyển đổi ký tự đ
      .replace(/[^a-zA-Z0-9\s]/g, '') // Loại bỏ các ký tự đặc biệt
      .replace(/\s+/g, '-') // Chuyển khoảng trắng thành dấu gạch ngang
      .toLowerCase();
  }

  // Bắt sự kiện click cho các phần tử có data-href
  $('span[data-href]').click(function() {
    // Lấy giá trị data-href và chuyển thành tiếng Việt không dấu
    var originalHref = $(this).attr('data-href');
    var target = removeVietnameseTones(originalHref);
    console.log(target);
    var positiontop = 150;
    // Kiểm tra và di chuyển đến phần tử có id tương ứng
    if ($('#' + target).length) {
      $('html, body').animate({
        scrollTop: $('#' + target).offset().top - positiontop
      }, 300); // Di chuyển mượt mà
    } else {
      console.error('Không tìm thấy id: ' + target);
    }
  });
});
