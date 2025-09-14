<script type="text/javascript">
    $(document).ready(function () {

        var Toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });

        function toast_show(icon, message) {
            Toast.fire({
                icon: icon,
                title: message
            })
        }

        function success_message(message) {
            toast_show('success', message);
        }

        function error_message(message) {
            toast_show('error', message);
        }

        function infor_message(message) {
            toast_show('information', message);
        }

        @if(Session::has('message-success'))
        success_message("{{ Session::get('message-success') }}")
        @endif

        @if(Session::has('message-error'))
        error_message("{{ Session::get('message-error') }}")
        @endif

        @if(Session::has('message-information'))
        infor_message("{{ Session::get('message-infor') }}")
        @endif
        function initializeSlick() {
            $('.slick-fsale').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                dots: true
            });
        }

        $('#copy-link').click(function () {
            // Lấy giá trị của data-link
            const link = $(this).data('link');

            // Tạo một thẻ input tạm thời để sao chép dữ liệu
            const tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(link).select();

            // Sao chép dữ liệu
            document.execCommand('copy');

            // Xóa thẻ input tạm thời
            tempInput.remove();

            // Hiển thị thông báo
            success_message('Đã sao chép đường dẫn');
        });

        $('.filter__content .nav-link').on('shown.bs.tab', function (e) {
            $('#search-location').attr('placeholder', 'Thành phố,địa điểm');
            $('#filter-villa').css('display', 'none');
            $('#filter-all').css('display', 'block');
            $('.js-check-ng').show();
            $('.js-check-table-3').show();
            $('.sidebar-left').show();
            $('.sub-filter--checkn').removeClass('active-right-custom');
        });

        $('.nav-link[title="Villa"]').on('shown.bs.tab', function (e) {
            $('#search-location').attr('placeholder', 'Bạn sắp đi đâu?');
            $('#filter-villa').css('display', 'block');
            $('#filter-all').css('display', 'none');
            $('.js-check-ng').hide();
            $('.js-check-table-3').hide();
            $('.sidebar-left').hide();
            $('.sub-filter--checkn').addClass('active-right-custom');
        });

        $("body").on('change', "#room-number", function () {
            let number = $(this).val();
            let id = $(this).data('id');
            let vat = $('#vat-room').val();
            let price = $('#money-' + id).val();
            let surcharge = $('#surcharge-value-' + id).val();
            let total = parseInt(price) * parseInt(number) + parseInt(surcharge) + parseInt(vat);
            $('#set-total-' + id).val(total);
            formattedAmount = total.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
            $('span.total-' + id).text(formattedAmount);
        });
        $("body").on('click', '.type-hotel', function () {
            let hotel = $("a.nav-link.type-hotel.active").data('type');
            $("#type-hotel-value").val(hotel);
        });

        $(document).on('click', '.btn-close', function () {
            $(this).closest('.modal').modal('hide');
        });

        $("body").on('click', '.btn-register-now', function () {
            let email = $("#email-register").val();
            $("#email-register-input").val(email);
        });

        $("body").on('click', ".choose-location", function () {
            let location = $(this).data('value');
            $('input.js-show-address').val(location);
            $('.js-sub-custom').css('display', 'none');
            $('#startDate').focus();
        });

        $("body").on('click', "#search-hotel", function () {
            let location = $("#search-location").val();
            let startDate = $("#startDate").val();
            let endDate = $("#t-enddate").val();
            if (location == '') {
                $('.sub-filter').css('display', 'block');
            } else if (endDate == 'Chọn ngày về') {
                $('#startDate').focus();
            } else {
                document.getElementById('form-search-hotel').submit();
            }
        });

        $("body").on('click', ".btn-book-room", function (event) {
            let id = $(this).data('id');
            let location = $("#search-location").val();
            let startDate = $("#t-startdate").text(); // Use .val() if it's an input field
            let endDate = $("#t-enddate").text(); // Use .val() if it's an input field
            if (location == '') {
                alert('Vui lòng chọn điểm đến!');
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth' // Tùy chọn này tạo hiệu ứng cuộn mượt mà
                });
            } else if (startDate == 'Chọn ngày đi' || endDate == 'Chọn ngày về') {
                alert('Vui lòng chọn ngày đến và ngày đi!');
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth' // Tùy chọn này tạo hiệu ứng cuộn mượt mà
                });
            } else {
                $('#modal-bookroom-' + id).modal('show');
            }
        });


        $('#submitBtn').prop('disabled', true);
        $('#btnChangePass').prop('disabled', true);

        $('#confirmPassword').on('input', function () {
            var password = $('#password').val();
            var confirmPassword = $(this).val();

            if (password !== confirmPassword) {
                $('span.text-message-error').css('display', 'block');
                $('#submitBtn').prop('disabled', true); // Disable nút submit
            } else {
                $('span.text-message-error').css('display', 'none');
                $('#submitBtn').prop('disabled', false); // Enable nút submit
            }
        });

        $('#confirmRePassword').on('input', function () {
            var password = $('#change-password').val();
            var confirmPassword = $(this).val();

            if (password !== confirmPassword) {
                $('span.text-message-error').css('display', 'block');
                $('#btnChangePass').prop('disabled', true); // Disable nút submit
            } else {
                $('span.text-message-error').css('display', 'none');
                $('#btnChangePass').prop('disabled', false); // Enable nút submit
            }
        });

        $("body").on('click', ".add-favorist-list", function () {
            let id = $(this).data('id');
            let url = "{{route('hotels.add_favorite_list')}}";
            let $icon = $(this).find('span.hotel');
            $.ajax({
                url: url,
                method: 'GET',
                data: {'id': id},
                success: function (response) {
                    if (response[0]) {
                        // If the hotel was added to the favorist list
                        $('.check-status').text('Bỏ lưu');
                        $('.js-save1').show();
                        $('.js-save2').hide();
                        $icon.removeClass('js-hotel-save2').addClass('js-hotel-save1').html(`<?php echo svg("hear") ?>`);
                        success_message("Đã thêm vào danh sách yêu thích!");
                    } else {
                        // If the hotel was removed from the favorist list
                        $('.check-status').text('Lưu');
                        $('.js-save1').hide();
                        $('.js-save2').show();
                        $icon.removeClass('js-hotel-save1').addClass('js-hotel-save2').html(`<?php echo svg("hear3") ?>`);
                        success_message("Đã xóa khỏi danh sách yêu thích!");
                    }
                },
                error: function (xhr) {
                    alert(xhr);
                }
            });

        });

        $("body").on('keydown', "#search-comfort", function () {
            var keyword = $(this).val();
            $.ajax({
                url: "{{route('search.comfort')}}",
                method: 'GET',
                data: {keyword: keyword},
                success: function (response) {
                    $('#list-comfort-filter').html(response);
                },
                error: function (xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });


        $("body").on('click', ".btn-add-compare", function () {
            let id = $(this).data('id');
            let $this = $(this); // Save the context of $(this)
            let text = $this.text().trim();
            let url = "{{ route('hotels.add_compare_list') }}";

            $.ajax({
                url: url,
                method: 'GET',
                data: {'id': id},
                success: function (response) {
                    // Toggle button text based on current text
                    if (text === '+ Thêm vào so sánh') {
                        $this.text('- Bỏ so sánh');
                    } else {
                        $this.text('+ Thêm vào so sánh');
                    }

                    // Update the compare list and display the modal
                    $('#list-compare-hotel').html(response);
                    $('#modal-sosanh').modal('show');
                },
                error: function (xhr) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });


        $("body").on('click', ".remove-compare", function () {
            let id = $(this).data('id');
            let url = "{{ route('hotels.remove_compare_list') }}";
            if (confirm("Bạn có chắc chắn muốn xóa khỏi danh sách so sánh?")) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {'id': id},
                    success: function (response) {
                        $('#btn-add-compare-' + id).text('+ Thêm vào so sánh')
                        $('#list-compare-hotel').html(response);

                    },
                    error: function (xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            }
        });


        {{--$("body").on('change', 'input[name="cc"]', function () {--}}
        {{--    let filter = $(this).val();--}}
        {{--    console.log(filter);--}}
        {{--    console.log('fejwfbjekwf');--}}
        {{--    let url = "{{route('comments.filter')}}";--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        method: 'GET',--}}
        {{--        data: {'filter': filter},--}}
        {{--        success: function (response) {--}}
        {{--            $("#list-result-filter").html(response);--}}
        {{--        }--}}
        {{--    });--}}

        {{--});--}}

        let typingTimer;
        let doneTypingInterval = 400;

        $("body").on('input', "#search-location, #search-location-mobile", function () {
            clearTimeout(typingTimer);

            let filter = $(this).val();
            $("#search-location").val(filter);

            // Kiểm tra nếu input trống, thực hiện ajax ngay lập tức
            if (filter.trim() === '') {
                $('.sub-filter').css('display', 'block');
                let url = "{{route('locations.search')}}";
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {'location': ''}, // Gửi yêu cầu với chuỗi rỗng
                    success: function (response) {
                        $("#list-location-search").html(response);
                        $('#list-location-search-2').html(response);
                    }
                });
            } else {
                // Nếu ngừng nhập trong 300ms thì sẽ thực hiện Ajax
                typingTimer = setTimeout(function () {
                    $('.sub-filter').css('display', 'block');
                    let url = "{{route('locations.search')}}";
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {'location': filter},
                        success: function (response) {
                            $("#list-location-search").html(response);
                            $('#list-location-search-2').html(response);
                        }
                    });
                }, 300); // Giảm thời gian xuống 300ms
            }
        });

        function convertToSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }

        $("body").on('change', "#filter-select-1", function () {
            let filter = $(this).val();
            let hotel = $(this).data('hotel');
            let type = $(this).data('type');
            let url = "{{route('comments.filter_by_star')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'filter': filter, 'hotel': hotel, 'type': type},
                success: function (response) {
                    $("#filter-comment-by-star").html(response);
                }
            });

        });

        $("body").on('change', '#filter-select-2 input[name="cc"], #filter-select-3 input[name="cc"]', function () {
            let filter = $(this).val();
            let hotel = $(this).data('hotel');
            let type = $(this).data('type');
            console.log(filter);
            console.log(hotel);
            console.log(type);
            let url = "{{route('comments.filter')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'filter': filter, 'hotel': hotel, 'type': type},
                success: function (response) {
                    $("#list-result-filter").html(response);
                    $("#list-result-filter-" + hotel).html(response);
                }
            });
        });

        $("body").on('click', ".filter-model-star", function () {
            $(".filter-model-star").removeClass('active');
            $(this).addClass('active');
            let filter = $(this).data('star');
            let hotel = $(this).data('hotel');
            let type = $(this).data('type');
            let url = "{{route('comments.filter')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'filter': filter, 'hotel': hotel, 'type': type},
                success: function (response) {
                    $("#list-result-filter").html(response);
                    $("#list-result-filter-" + hotel).html(response);
                }
            });

        });

        $("body").on('click', ".filter-comment-by-star", function () {
            $(".filter-comment-by-star").removeClass('active');
            $(this).addClass('active');
            let filter = $(this).data('star');
            let hotel = $(this).data('hotel');
            let type = $(this).data('type');
            let url = "{{route('comments.filter_by_star')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'filter': filter, 'hotel': hotel, 'type': type},
                success: function (response) {
                    $("#filter-comment-by-star").html(response);
                }
            });

        });

        $("body").on('click', ".filter-hotel", function () {
            $(".filter-hotel").removeClass('active');

            $(this).addClass('active');
            let type = $(this).data('type');
            let url = "{{route('hotels.filter')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'type': type},
                success: function (response) {
                    $("#list-hotels-type").html(response);
                }
            });

        });

        $("body").on('click', ".filter-hotel-price-hot", function () {
            $(".filter-hotel-price-hot").removeClass('active');

            $(this).addClass('active');
            let type = $(this).data('type');
            let url = "{{route('hotels.filter_price_hots')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'type': type},
                success: function (response) {
                    $("#list-hotels-filter-price-hot").html(response);
                }
            });

        });

        $("body").on('click', ".filter-hotel-popular", function () {
            $(".filter-hotel-popular").removeClass('active');

            $(this).addClass('active');
            let type = $(this).data('type');
            let url = "{{route('hotels.filter_popular')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'type': type},
                success: function (response) {
                    console.log("Response:", response); // Kiểm tra nội dung phản hồi trong console

                    // Cập nhật nội dung của #list-filter-popular với dữ liệu nhận được
                    $('#list-filter-popular').html(response);
                    $(".owl-carousel-2").owlCarousel({
                        items: 4, // Số lượng items hiển thị
                        loop: true, // Cuộn không giới hạn
                        margin: 10, // Khoảng cách giữa các item
                        nav: true, // Hiển thị các nút điều hướng
                        responsive: {
                            0: {
                                items: 1
                            },
                            300: {
                                items: 2
                            },
                            600: {
                                items: 3
                            },
                            900: {
                                items: 4
                            }
                        }
                    });
                }
            });

        });


        $("body").on('click', ".filter-hotel-location", function () {
            $(".filter-hotel-location").removeClass('active');

            $(this).addClass('active');
            let type = $(this).data('type');
            let name = $(this).data('name');
            let location = $(this).data('location');
            $('.filter-tag').attr('data-location', name);
            $('span.location-name').text(name);
            let url = "{{route('hotels.filter_location')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'type': type, 'location': location},
                success: function (response) {
                    $("#list-filter-location").html(response);
                }
            });

        });

        $("body").on('click', ".filter-tag", function () {
            let location = $(this).data('location');
            let star = $(this).data('star');
            let type = $(this).data('type');
            $('#search-location').val(location).trigger('input');
            $('#number-star').val(star);
            $('#type-hotel-value').val(type);
            document.getElementById('form-search-hotel').submit();

        });

        $("body").on('click', ".filter-view", function () {
            $(".filter-view").removeClass('active');

            $(this).addClass('active');
            let type = $(this).data('type');
            let url = "{{route('locations.filter')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'type': type},
                success: function (response) {
                    $("#list-location-filter").html(response);
                    $(".owl-carousel-location").owlCarousel({
                        items: 6, // Số lượng items hiển thị
                        loop: false, // Cuộn không giới hạn
                        margin: 10, // Khoảng cách giữa các item
                        nav: true, // Hiển thị các nút điều hướng
                        responsive: {
                            0: {
                                items: 3,
                                stagePadding: 30,
                                loop: false,
                            },
                            600: {
                                items: 4
                            },
                            1000: {
                                items: 5
                            }
                        }
                    });
                }
            });

        });

        $("body").on('click', ".sort-hotel", function () {
            $(".sort-hotel").removeClass('active');

            $(this).addClass('active');
            let type = $(this).data('type');
            let location_id = $(this).data('location');
            let filter = $(this).data('filter');
            let url = "{{route('hotels.filter_by')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'type': type, 'location_id': location_id, 'filter': filter},
                success: function (response) {
                    $("#list-hotel-filter-by-name").html(response);
                    $(".owl-carousel-image").owlCarousel({
                        items: 1, // Display one item at a time
                        loop: false, // Infinite loop
                        margin: 10, // Space between items
                        nav: true, // Show navigation
                        dots: true, // Show dots
                        dotClass: 'owl-dot', // Custom class for dots
                        dotsClass: 'owl-dots', // Custom class for dots container
                    });
                }
            });

        });

        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getData(page);
                }
            }
        });

        $(document).ready(function()
        {
            $(document).on('click', 'div.paginate nav.flex span.relative a.relative',function(event)
            {
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var myurl = $(this).attr('href');
                // var myurl=$(this).attr('href').split('page=')[1];
                getData(myurl);
            });
        });
        function getData(myurl){
            $.ajax({
                url: myurl,
                type: "get",
                datatype: "html"
            }).done(function(data){
                // Xóa nội dung cũ và cập nhật nội dung mới
                $("#list-hotel-filter-by-name").empty().html(data);

                // Cuộn trang lên đầu
                $('html, body').animate({ scrollTop: 0 }, 'fast');

            }).fail(function(jqXHR, ajaxOptions, thrownError){
                alert('No response from server');
            });
        }

        $("body").on('click', ".filter-flash-sale", function () {
            $(".filter-flash-sale").removeClass('active');

            $(this).addClass('active');
            let location_id = $(this).data('location');
            let url = "{{route('hotels.filter_flash_sale')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'location': location_id},
                success: function (response) {
                    $("#list-filter-flash-sale").html(response);
                }
            });

        });

        $('.filter-room-checkbox').on('change', function () {
            let filterRoom = {};
            let filterValue = $(this).val();
            let hotelId = $('.hotel_id').val();
            if ($(this).is(':checked')) {
                filterRoom[filterValue] = true;
            } else {
                delete filterRoom[filterValue];
            }
            let url = "{{route('rooms.filter_room')}}";

            $.ajax({
                url: url,
                method: 'GET',
                data: {'filters': filterRoom, 'hotel_id': hotelId},
                success: function (response) {
                    $('#list-room-filter').html(response);
                },
                error: function (xhr) {
                    console.error('An error occurred:', xhr);
                }
            });

        });


        // Capture filter changes


        let filters = {};
        let type = $('#hotel-type').val();
        let location_id = $('#location-id').val();

        $('.filter-checkbox').on('change', function () {
            let filterName = $(this).closest('label').text().trim();
            let filterValue = $(this).val();
            if ($(this).is(':checked')) {
                filters[filterValue] = true;
                addFilterLabel(filterValue, filterName);
            } else {
                delete filters[filterValue];
                removeFilterLabel(filterValue);
            }
            sendAjaxRequest();
        });

        $('.filter-by-location').on('change', function () {
            let filterName = $(this).closest('label').text().trim();
            filterName = filterName.replace(/\(\d+\)/, '').trim();
            let filterValue = $(this).val();
            var type = $(this).data('type');
            if ($(this).is(':checked')) {
                filters[filterValue] = true;
                addFilterLabel(filterValue, filterName);
            } else {
                delete filters[filterValue];
                removeFilterLabel(filterValue);
            }
            sendAjaxRequest(type);
        });

        $('.filter-area').on('change', function () {
            let filterValue = $(this).data('area');
            let filterId = $(this).val();
            let type = 'area';

            if (!filters[type]) {
                filters[type] = [];
            }

            if ($(this).is(':checked')) {
                if (!filters[type].includes(filterValue)) {
                    filters[type].push(filterValue);
                }
                addFilterLabelArea(type + '-' + filterId, filterValue);
            } else {
                filters[type] = filters[type].filter(function (value) {
                    return value !== filterValue;
                });
                removeFilterLabelArea(type + '-' + filterId);
            }

            sendAjaxRequest();
        });

        $('.filter-comfort').on('change', function () {
            let filterValue = $(this).data('type');
            let filterId = $(this).val();
            let type = 'comfort';

            if (!filters[type]) {
                filters[type] = [];
            }

            if ($(this).is(':checked')) {
                if (!filters[type].includes(filterValue)) {
                    filters[type].push(filterValue);
                }
                addFilterLabelComfort(type + '-' + filterId, filterValue);
            } else {
                filters[type] = filters[type].filter(function (value) {
                    return value !== filterValue;
                });
                removeFilterLabelComfort(type + '-' + filterId);
            }

            sendAjaxRequest();
        });

        $('.filter-comfort-special').on('change', function () {
            let filterValue = $(this).data('type');
            let filterId = $(this).val();
            let type = 'comfort_special';

            if (!filters[type]) {
                filters[type] = [];
            }

            if ($(this).is(':checked')) {
                if (!filters[type].includes(filterValue)) {
                    filters[type].push(filterValue);
                }
                addFilterLabelComfortSpecial(type + '-' + filterId, filterValue);
            } else {
                filters[type] = filters[type].filter(function (value) {
                    return value !== filterValue;
                });
                removeFilterLabelComfortSpecial(type + '-' + filterId);
            }

            sendAjaxRequest();
        });

        $('.filter-type').on('change', function () {
            let filterName = $(this).closest('label').text().trim();
            let filterValue = $(this).val();
            if ($(this).is(':checked')) {
                filters[filterValue] = true;
                addFilterLabel(filterValue, filterName);
            } else {
                delete filters[filterValue];
                removeFilterLabel(filterValue);
            }
            sendAjaxRequest();
        });

        $('.filter-comment').on('change', function () {
            let filterName = $(this).val();
            if ($(this).is(':checked')) {
                filters[filterName] = true;
            } else {
                delete filters[filterName];
            }
            sendAjaxRequest();
        });

        $('.filter-star').on('click', function () {
            let starValue = $(this).data('star');
            if (filters['star'] === starValue) {
                delete filters['star'];
                $(this).removeClass('active-s');
                $('span.js-start-add').removeClass('d-flex');
            } else {
                filters['star'] = starValue;
                $('.filter-star').removeClass('active-s');
                $(this).addClass('active-s');
                $('span.js-start-add').addClass('d-flex');

            }
            sendAjaxRequest();
        });

        $('.filter-bed-room').on('click', function () {
            let filterValue = $(this).data('number');
            let type = 'room';

            if (!filters[type]) {
                filters[type] = [];
            }

            if ($(this).hasClass('active-s')) {
                if (!filters[type].includes(filterValue)) {
                    filters[type].push(filterValue);
                }
                addFilterLabelRoom(type + '-' + filterValue, $(this).find('span').text().trim());
            } else {
                filters[type] = filters[type].filter(function (value) {
                    return value !== filterValue;
                });
                removeFilterLabelRoom(type + '-' + filterValue);
            }

            sendAjaxRequest();
        });

        $('.filter-people').on('click', function () {
            let filterValue = $(this).data('number');
            let type = 'people';
            if (!filters[type]) {
                filters[type] = [];
            }

            if ($(this).hasClass('active-s')) {
                if (!filters[type].includes(filterValue)) {
                    filters[type].push(filterValue);
                }
                addFilterLabelRoom(type + '-' + filterValue, $(this).find('span').text().trim());
            } else {
                filters[type] = filters[type].filter(function (value) {
                    return value !== filterValue;
                });
                removeFilterLabelRoom(type + '-' + filterValue);
            }

            sendAjaxRequest();
        });

        $('.min-val, .max-val').on('change', function () {
            filters['price_min'] = $('.min-val').val();
            filters['price_max'] = $('.max-val').val();
            sendAjaxRequest();
        });


        function sendAjaxRequest(t) {
            if(t) {
                type = t;
            }
            let url = "{{route('hotels.filter_list')}}";
            $.ajax({
                url: url,
                method: 'GET',
                data: {'type': type, 'location_id': location_id, 'filters': filters},
                success: function (response) {
                    $('#list-hotel-filter-by-name').html(response);
                    $(".owl-carousel-image").owlCarousel({
                        items: 1, // Display one item at a time
                        loop: false, // Infinite loop
                        margin: 10, // Space between items
                        nav: true, // Show navigation
                        dots: true, // Show dots
                        dotClass: 'owl-dot', // Custom class for dots
                        dotsClass: 'owl-dots', // Custom class for dots container
                    });
                },
                error: function (xhr) {
                    console.error('An error occurred:', xhr);
                }
            });
        }

        function addFilterLabel(key, text) {
            if ($(`.filter-label[data-key="${key}"]`).length === 0) {
                $('.addfilter-js').append(`<div class="js-dl-only js-input-only d-block filter-label" data-key=${key}>
                                    <span class="type-input">${text}</span>
<svg width="24" height="24" fill="none"><path fill-rule="evenodd" fill="white" clip-rule="evenodd" d="M12 20a8 8 0 100-16.001A8 8 0 0012 20zM10.707 9.293a1 1 0 00-1.414 1.414L10.586 12l-1.293 1.293a1 1 0 101.414 1.414L12 13.414l1.293 1.293a1 1 0 001.414-1.414L13.414 12l1.293-1.293a1 1 0 00-1.414-1.414L12 10.586l-1.293-1.293z" fill="#F36"></path></svg>
                                </div>`);
            }
        }

        function removeFilterLabel(key) {
            $(`.js-dl-only[data-key="${key}"]`).remove();
        }

        function addFilterLabelRoom(key, text) {
            if ($(`.filter-label[data-key="${key}"]`).length === 0) {
                $('.addfilter-js').append(`<div class="js-dl-only js-input-only d-block filter-label-room" data-key=${key}>
                                    <span class="min-input">${text}</span>
<svg width="24" height="24" fill="none"><path fill-rule="evenodd" fill="white" clip-rule="evenodd" d="M12 20a8 8 0 100-16.001A8 8 0 0012 20zM10.707 9.293a1 1 0 00-1.414 1.414L10.586 12l-1.293 1.293a1 1 0 101.414 1.414L12 13.414l1.293 1.293a1 1 0 001.414-1.414L13.414 12l1.293-1.293a1 1 0 00-1.414-1.414L12 10.586l-1.293-1.293z" fill="#F36"></path></svg>
                                </div>`);
            }
        }

        function removeFilterLabelRoom(key) {
            $(`.js-dl-only[data-key="${key}"]`).remove();
        }

        function addFilterLabelArea(key, text) {
            if ($(`.filter-label[data-key="${key}"]`).length === 0) {
                $('.addfilter-js').append(`<div class="js-dl-only js-input-only d-block filter-label-area" data-key=${key}>
                                    <span class="min-input">${text}</span>
<svg width="24" height="24" fill="none"><path fill-rule="evenodd" fill="white" clip-rule="evenodd" d="M12 20a8 8 0 100-16.001A8 8 0 0012 20zM10.707 9.293a1 1 0 00-1.414 1.414L10.586 12l-1.293 1.293a1 1 0 101.414 1.414L12 13.414l1.293 1.293a1 1 0 001.414-1.414L13.414 12l1.293-1.293a1 1 0 00-1.414-1.414L12 10.586l-1.293-1.293z" fill="#F36"></path></svg>
                                </div>`);
            }
        }

        function removeFilterLabelArea(key) {
            $(`.js-dl-only[data-key="${key}"]`).remove();
        }

        function addFilterLabelComfort(key, text) {
            if ($(`.filter-label[data-key="${key}"]`).length === 0) {
                $('.addfilter-js').append(`<div class="js-dl-only js-input-only d-block filter-label-comfort" data-key=${key}>
                                    <span class="min-input">${text}</span>
<svg width="24" height="24" fill="none"><path fill-rule="evenodd" fill="white" clip-rule="evenodd" d="M12 20a8 8 0 100-16.001A8 8 0 0012 20zM10.707 9.293a1 1 0 00-1.414 1.414L10.586 12l-1.293 1.293a1 1 0 101.414 1.414L12 13.414l1.293 1.293a1 1 0 001.414-1.414L13.414 12l1.293-1.293a1 1 0 00-1.414-1.414L12 10.586l-1.293-1.293z" fill="#F36"></path></svg>
                                </div>`);
            }
        }

        function removeFilterLabelComfort(key) {
            $(`.js-dl-only[data-key="${key}"]`).remove();
        }

        function addFilterLabelComfortSpecial(key, text) {
            if ($(`.filter-label[data-key="${key}"]`).length === 0) {
                $('.addfilter-js').append(`<div class="js-dl-only js-input-only d-block filter-label-comfort-special" data-key=${key}>
                                    <span class="min-input">${text}</span>
<svg width="24" height="24" fill="none"><path fill-rule="evenodd" fill="white" clip-rule="evenodd" d="M12 20a8 8 0 100-16.001A8 8 0 0012 20zM10.707 9.293a1 1 0 00-1.414 1.414L10.586 12l-1.293 1.293a1 1 0 101.414 1.414L12 13.414l1.293 1.293a1 1 0 001.414-1.414L13.414 12l1.293-1.293a1 1 0 00-1.414-1.414L12 10.586l-1.293-1.293z" fill="#F36"></path></svg>
                                </div>`);
            }
        }

        function removeFilterLabelComfortSpecial(key) {
            $(`.js-dl-only[data-key="${key}"]`).remove();
        }

        $("body").on('click', ".filter-label", function () {
            let key = $(this).data('key');
            delete filters[key];
            removeFilterLabel(key);

            // Uncheck the corresponding checkbox or reset the range slider
            if ($(`input[value="${key}"]`).length > 0) {
                $(`input[value="${key}"]`).prop('checked', false);
            }

            // Reset star rating selection
            if (key === 'star') {
                $('.js-start').removeClass('active-s');
            }

            // Reset range sliders if the price filter is removed
            if (key === 'price') {
                $('.min-val').val(0);
                $('.max-val').val(100);
            }

            sendAjaxRequest();
        });

        $("body").on('click', ".filter-label-room", function () {
            let key = $(this).data('key');
            let parts = key.split('-');
            let type = parts[0]; // "room"
            let filterValue = parts[1];

            // Remove the specific filter value from the filters array
            filters[type] = filters[type].filter(function (value) {
                return value !== parseInt(filterValue);
            });

            // Remove the label
            removeFilterLabelRoom(key);

            // Remove the 'active-s' class from the corresponding .js-start-room element
            $('.js-start-room[data-number="' + filterValue + '"]').removeClass('active-s');

            // Send the updated filters via Ajax
            sendAjaxRequest();
        });

        $("body").on('click', ".filter-label-area", function () {
            let key = 'area';
            let dataKey = $(this).data('key');
            let filterValue = $(this).find('span.min-input').text();
            if (filters[key]) {
                filters[key] = filters[key].filter(function (item) {
                    return item !== filterValue;
                });

                // Nếu sau khi xóa, mảng filters[key] rỗng, bạn có thể xóa luôn key đó
                if (filters[key].length === 0) {
                    delete filters[key];
                }
            }

            // Remove the label
            removeFilterLabelArea(dataKey);

            // Remove the 'active-s' class from the corresponding .js-start-room element
            $('.filter-area[data-area="' + filterValue + '"]').prop('checked', false);

            // Send the updated filters via Ajax
            sendAjaxRequest();
        });

        $("body").on('click', ".filter-label-comfort", function () {
            let key = 'comfort';
            let dataKey = $(this).data('key');
            let filterValue = $(this).find('span.min-input').text();
            if (filters[key]) {
                filters[key] = filters[key].filter(function (item) {
                    return item !== filterValue;
                });

                // Nếu sau khi xóa, mảng filters[key] rỗng, bạn có thể xóa luôn key đó
                if (filters[key].length === 0) {
                    delete filters[key];
                }
            }

            // Remove the label
            removeFilterLabelComfort(dataKey);

            // Remove the 'active-s' class from the corresponding .js-start-room element
            $('.filter-comfort[data-type="' + filterValue + '"]').prop('checked', false);

            // Send the updated filters via Ajax
            sendAjaxRequest();
        });

        $("body").on('click', ".filter-label-comfort-special", function () {
            let key = 'comfort_special';
            let dataKey = $(this).data('key');
            let filterValue = $(this).find('span.min-input').text();
            if (filters[key]) {
                filters[key] = filters[key].filter(function (item) {
                    return item !== filterValue;
                });

                // Nếu sau khi xóa, mảng filters[key] rỗng, bạn có thể xóa luôn key đó
                if (filters[key].length === 0) {
                    delete filters[key];
                }
            }

            // Remove the label
            removeFilterLabelComfort(dataKey);

            // Remove the 'active-s' class from the corresponding .js-start-room element
            $('.filter-comfort-special[data-type="' + filterValue + '"]').prop('checked', false);

            // Send the updated filters via Ajax
            sendAjaxRequest();
        });

        $("body").on('click', ".js-delete", function () {
            filters = {}; // Clear the filters object
            $('.filter-label').remove(); // Remove all filter labels
            $('.filter-label-room').remove(); // Remove all filter labels
            $('.filter-label-location').remove();
            $('.filter-label-area').remove();
            $('.filter-label-comfort').remove();
            $('.filter-label-comfort-special').remove();
            $('.range-price').removeClass('d-block');

            // Uncheck all checkboxes
            $('.filter-checkbox').prop('checked', false);
            $('.filter-type').prop('checked', false);
            $('.filter-comment').prop('checked', false);
            $('.filter-star').prop('checked', false);
            $('.filter-area').prop('checked', false);
            $('.filter-by-location').prop('checked', false);
            $('.filter-comfort').prop('checked', false);
            $('.filter-comfort-special').prop('checked', false);


            // Reset all range sliders
            $('.min-val').val(0);
            var number = 0;
            $('.min-input').html(0);
            var track = parseInt(number);
            $('.slider-track').css('width', track + '%');
            $('.slider-track2').css('left', track + '%');

            var number = 100;
            $('.max-input').html('Không giới hạn');
            $('input.max-val').val(100);
            var track = parseInt(number);
            var lay = $('.slider-track').width();
            var hi = $('.slider-track2').css('width', track + '%');

            // Reset star rating selection
            $('.js-start').removeClass('active-s');
            $('.js-start-room').removeClass('active-s');

            sendAjaxRequest(); // Send AJAX request to update the results
        });

        $("body").on('click', ".remove-filter-label", function () {
            $('.min-val').val(0);
            var number = 0;
            $('.min-input').html(0);
            var track = parseInt(number);
            $('.slider-track').css('width', track + '%');
            $('.slider-track2').css('left', track + '%');

            var number = 100;
            $('.max-input').html('Không giới hạn');
            $('input.max-val').val(100);
            var track = parseInt(number);
            var lay = $('.slider-track').width();
            var hi = $('.slider-track2').css('width', track + '%');
            $('.range-price').removeClass('d-block');
            filters['price_min'] = $('.min-val').val();
            filters['price_max'] = $('.max-val').val();
            sendAjaxRequest();
        });

        $("body").on('click', "span.remove-star", function () {
            $(this).removeClass('d-flex');
            delete filters['star'];
            sendAjaxRequest();
        });


    });

    $(document).ready(function() {
        $('#choose-room-btn').on('click', function(e) {
            e.preventDefault();
            $('#list-room')[0].scrollIntoView({ behavior: 'smooth' });
        });
    });

    $(document).ready(function () {
        // Target each modal separately
        $('[id^=modal-zoom-]').on('shown.bs.modal', function () {
            var roomId = $(this).attr('id').replace('modal-zoom-', ''); // Extract room ID

            var sync1 = $('#sync1_' + roomId);  // Use room-specific IDs for sync1
            var sync2 = $('#sync2_' + roomId);  // Use room-specific IDs for sync2
            var slidesPerPage = 6; // Number of items per page
            var syncedSecondary = true;

            // Initialize sync1 (main image carousel)
            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200
            }).on('changed.owl.carousel', syncPosition);

            // Initialize sync2 (thumbnail carousel)
            sync2.on('initialized.owl.carousel', function () {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
                .owlCarousel({
                    items: slidesPerPage,
                    dots: false,
                    nav: false,
                    smartSpeed: 200,
                    margin: 10,
                    arrows: false,
                    slideSpeed: 500,
                    slideBy: slidesPerPage,
                    responsiveRefreshRate: 100,
                    responsive: {
                        0: {
                            items: 4,
                        }
                    }
                }).on('changed.owl.carousel', syncPosition2);

            // Sync position of main and thumbnail carousels
            function syncPosition(el) {
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }

                sync2
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();

                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            // Sync position when thumbnail carousel changes
            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            // Thumbnail click event to change main image
            sync2.on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
            });
        });

        $(document).on("click", ".items-zoom", function (e) {
            // Nếu click trúng <a> hoặc <button> con thì bỏ qua
            if ($(e.target).closest("a, button").length) return;

            let url = $(this).data("url") || $(this).attr("href");
            if (url) {
                window.location.href = url;
            }
        });

// Xử lý hover => focus
        $(document).on("mouseenter", ".items-zoom", function () {
            $(this).trigger("focus"); // hoặc $(this).addClass("focus")
        });

        $(document).on("mouseleave", ".items-zoom", function () {
            $(this).trigger("blur"); // hoặc $(this).removeClass("focus")
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const heading = document.querySelector("#show-comment");
        const form = document.querySelector(".comment-form");
        const toggleIcon = document.querySelector(".toggle-icon");

        if (heading && form && toggleIcon) {
            heading.addEventListener("click", function() {
                if (form.style.display === "none" || form.style.display === "") {
                    form.style.display = "block";
                    toggleIcon.classList.remove("fa-chevron-down");
                    toggleIcon.classList.add("fa-chevron-up");
                } else {
                    form.style.display = "none";
                    toggleIcon.classList.remove("fa-chevron-up");
                    toggleIcon.classList.add("fa-chevron-down");
                }
            });
        }
    });


</script>
