@php $dataSearch = session('formData') ?? []; @endphp
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="title-main d-flex align-items-center justify-content-between">
                <div>
                    <div class="bread">
                        <span>{{ucfirst($title)}}</span>
                        <?php echo svg('right') ?>
                        <span>{{@$dataSearch['location']}}</span>
                    </div>
                    {{--                    <h2 class="heading">{{@$dataSearch['location'] ?? ''}}</h2>--}}
                    @if(@$hotel)
                        <p class="text-result">{{count($hotels) ?? 1}} {{strtolower($title) ?? 'khách sạn'}} {{@$dataSearch['location'] ? ' tại ' . $dataSearch['location'] : ''}}</p>
                    @else
                        <p class="text-result">{{count(@$location->listhotel($location->id, @$type))}} {{strtolower($title) ?? 'khách sạn'}} {{@$dataSearch['location'] ? ' tại ' . $dataSearch['location'] : ''}}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="sidebar-search">
                {{--                <div class="js-show-filter sidebar-search--js-btn"><span class="btn btn-blue">Xác nhận</span></div>--}}
                <input type="text" class="hotel-type" id="hotel-type" hidden="true" value="{{@$type}}">
                <input type="text" class="location-id" id="location-id" hidden="true"
                       value="{{@$location->id}}">
                <div class="d-flex align-items-center justify-content-between" style="margin-bottom: 10px;">
                    <div class="js-show-filter"><?php echo svg('close') ?>
                    </div>
                    <span class="js-delete">Xóa tất cả</span>
                </div>
                <div class="maps mb-30" data-bs-toggle="modal" data-bs-target="#modal-maps">
                    <img class="w-100 d-block" src="{{asset('assets/images/maps.png')}}" alt="">
                    <span class="btn btn-blue show-maps" data-bs-toggle="modal"
                          data-bs-target="#modal-show-maps">Xem bản đồ</span>
                </div>
                {{--                            <div class="confirm mb-30">--}}
                {{--                                <span><?php echo svg('set') ?> Xác nhận ngay</span>--}}
                {{--                                <div class="confirm_checkbox">--}}
                {{--                                    <label>--}}
                {{--                                        <span class="js-confirm"></span>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                    </label>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                @if(@$type != \App\Models\Comforts::TO)
                    <div class="price mb-30">
                        <h3 class="tl">Giá</h3>
                        <div class="double-slider-box">
                            <h3 class="range-title">Giá mỗi đêm</h3>
                            <div class="range-slider">
                                <span class="slider-track"></span>
                                <span class="slider-track2"></span>
                                <input type="range" name="min_val" class="min-val" min="0" max="100" step="1"
                                       value="0">
                                <input type="range" name="max_val" class="max-val" min="0" max="100" step="1"
                                       value="100">
                            </div>
                            <div class="input-box">
                                <div class="min-box">
                                    <div class="input-wrap">
                                        <span class="input-addon">Thấp nhất</span>
                                        <span class="text-input min-input">0</span>
                                    </div>
                                </div>
                                <span>-</span>
                                <div class="min-box">
                                    <div class="input-wrap">
                                        <span class="input-addon">Cao nhất</span>
                                        <span class="text-input max-input">Không giới hạn</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($location))
                    <div class="filter-menu mb-30">
                        <h3 class="tl">Địa điểm</h3>
                        {{--                        <div class="wpc-filter-search-wrapper wpc-filter-search-wrapper-453">--}}
                        {{--                            <input class="wpc-filter-search-field" type="search" value="" placeholder="Search">--}}
                        {{--                            <button class="wpc-search-clear" type="button" title="Clear search"><span--}}
                        {{--                                    class="wpc-search-clear-icon">×</span></button>--}}
                        {{--                        </div>--}}
                        <div class="filter-section">
                            {{--                            @foreach(@$listComfort as $c)--}}
                            <label class="check-custom js-checkbox-s">{{$location->name}}
                                <input type="checkbox" class="filter-by-location" data-location="{{$location->name}}"
                                       data-type="{{@$type ?? 1}}"
                                       value="location">
                                <span class="checkmark"></span>
                                <span class="wpc-term-count" style="float: right">(<span
                                        class="wpc-term-count-value">{{count(@$location->listhotel($location->id, @$type ?? 1))}}</span>)</span>
                            </label>
                            {{--                            @endforeach--}}
                        </div>
                    </div>
                @endif
                @if(!empty(@$location) && count(@$location->areas) > 0)
                    <div class="filter-menu mb-30">
                        <h3 class="tl">Khu vực</h3>
                        <div class="filter-section">
                            @php $check = 0; @endphp
                            @foreach(@$location->areas as $area)
                                @if(count(@$area->listhotel(@$type, @$location->id)) > 0)
                                    <label class="check-custom js-checkbox-s">{{$area->name}}
                                        <input type="checkbox" class="filter-area" value="{{$area->id}}"
                                               data-area="{{$area->name}}">
                                        <span class="checkmark"></span>
                                        <span class="wpc-term-count" style="float: right">(<span
                                                class="wpc-term-count-value">{{count(@$area->listhotel(@$type, @$location->id))}}</span>)</span>
                                    </label>
                                    @php $check = 1; @endphp
                                @endif
                            @endforeach
                            @if($check == 0)
                                <label class="check-custom js-checkbox-s">Đang cập nhật!</label>
                            @endif

                        </div>
                    </div>
                @endif
                @if(!empty(@$listComfortSpecial) && count(@$listComfortSpecial) > 0 && $type == \App\Models\Comforts::TO)
                    <div class="filter-menu mb-30">
                        <h3 class="tl">Yêu cầu đặc biệt</h3>
                        {{--                        <div class="wpc-filter-search-wrapper wpc-filter-search-wrapper-453">--}}
                        {{--                            <input class="wpc-filter-search-field" id="search-comfort" type="search" value="" placeholder="Search">--}}
                        {{--                            <button class="wpc-search-clear" type="button" title="Clear search"><span--}}
                        {{--                                    class="wpc-search-clear-icon">×</span></button>--}}
                        {{--                        </div>--}}
                        <div class="filter-section" id="list-comfort-filter">
                            @foreach(@$listComfortSpecial as $c)
                                <label class="check-custom js-checkbox-s">{{$c->name}}
                                    <input type="checkbox" class="filter-comfort-special" data-type="{{$c->name}}"
                                           value="{{$c->id}}">
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <style>
                        .wpc-filters-main-wrap input.wpc-filter-search-field {
                            box-shadow: none;
                            border-radius: 30px;
                        }

                        .wpc-filters-main-wrap input.wpc-filter-search-field {
                            padding-right: 30px;
                            width: 100%;
                            margin: 0;
                        }

                        input[type=search] {
                            box-shadow: none;
                            border-radius: 6px;
                        }

                        input[type=search] {
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            appearance: none;
                        }

                        .select-resize-ghost, .select2-container .select2-choice, .select2-container .select2-selection, input[type=search] {
                            background-color: #fff;
                            border: 1px solid #ddd;
                            border-radius: 0;
                            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
                            box-sizing: border-box;
                            color: #333;
                            font-size: .97em;
                            height: 2.5em;
                            max-width: 100%;
                            padding: 0 .75em;
                            transition: color .3s, border .3s, background .3s, opacity .3s;
                            vertical-align: middle;
                            width: 100%;
                        }

                        input.wpc-filter-search-field {
                            border-radius: 30px;
                        }

                        span.wpc-search-clear-icon {
                            display: none;
                        }

                        button.wpc-search-clear {
                            display: none;
                        }
                    </style>
                @endif
                @if(@$listFilter)
                    <div class="filter-menu mb-30">
                        <h3 class="tl">Bộ lọc phổ biến</h3>
                        <div class="filter-section">
                            @foreach($listFilter as $filter)
                                <label class="check-custom js-checkbox-s">{{$filter->title}}
                                    <input type="checkbox" class="filter-checkbox" value="{{$filter->value}}">
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(@$type == \App\Models\Comforts::TO)
                    <div class="checkbox-star mb-30">
                        <h3 class="tl">Phòng ngủ</h3>
                        <div class="star star-room filter-section">
                            <div class="js-start-room filter-bed-room" data-number="1">
                                <span>1 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room" data-number="2">
                                <span>2 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room" data-number="3">
                                <span>3 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room" data-number="4">
                                <span>4 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room" data-number="5">
                                <span>5 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room" data-number="6">
                                <span>6 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room" data-number="7">
                                <span>7 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room" data-number="8">
                                <span>8 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room" data-number="9">
                                <span>9 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="10">
                                <span>10 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="11">
                                <span>11 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="12">
                                <span>12 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="13">
                                <span>13 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="14">
                                <span>14 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="18">
                                <span>18 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="19">
                                <span>19 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="20">
                                <span>20 phòng</span>
                            </div>
                            <div class="js-start-room filter-bed-room hidden-class-bed-room" data-number="21">
                                <span>21 phòng</span>
                            </div>
                        </div>
                        <p class="show-more-bed-room">Xem thêm</p>
                    </div>
                    <div class="checkbox-star mb-30">
                        <h3 class="tl">Số lượng khách</h3>
                        <div class="star star-room filter-section">
                            <div class="js-start-room filter-people" data-number="2">
                                <span>2 người</span>
                            </div>
                            <div class="js-start-room filter-people" data-number="4">
                                <span>4 người</span>
                            </div>
                            <div class="js-start-room filter-people" data-number="5">
                                <span>5 người</span>
                            </div>
                            <div class="js-start-room filter-people" data-number="6">
                                <span>6 người</span>
                            </div>
                            <div class="js-start-room filter-people" data-number="7">
                                <span>7 người</span>
                            </div>
                            <div class="js-start-room filter-people" data-number="8">
                                <span>8 người</span>
                            </div>
                            <div class="js-start-room filter-people" data-number="10">
                                <span>10 người</span>
                            </div>
                            <div class="js-start-room filter-people" data-number="12">
                                <span>12 người</span>
                            </div>
                            <div class="js-start-room filter-people" data-number="13">
                                <span>13 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="14">
                                <span>14 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="15">
                                <span>15 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="16">
                                <span>16 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="18">
                                <span>18 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="19">
                                <span>19 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="20">
                                <span>20 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="21">
                                <span>21 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="22">
                                <span>22 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="23">
                                <span>23 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="24">
                                <span>24 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="25">
                                <span>25 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="26">
                                <span>26 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="27">
                                <span>27 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="28">
                                <span>28 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="30">
                                <span>30 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="33">
                                <span>33 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="36">
                                <span>36 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="38">
                                <span>38 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="40">
                                <span>40 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="42">
                                <span>42 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="45">
                                <span>45 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="50">
                                <span>50 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="55">
                                <span>55 người</span>
                            </div>
                            <div class="js-start-room filter-people hidden-class" data-number="60">
                                <span>60 người</span>
                            </div>
                        </div>
                        <p class="show-more">Xem thêm</p>
                    </div>
                @endif
                <div class="checkbox-star mb-30">
                    <h3 class="tl">Hạng dịch vụ <span class="js-delete">Xóa</span></h3>
                    <div class="star">
                        <div class="js-start list-star filter-star" data-star="two">
                            <span>2</span>
                            <?php echo svg('start') ?>
                        </div>
                        <div class="js-start list-star filter-star" data-star="three">
                            <span>3</span>
                            <?php echo svg('start') ?>
                        </div>
                        <div class="js-start list-star filter-star" data-star="four">
                            <span>4</span>
                            <?php echo svg('start') ?>
                        </div>
                        <div class="js-start list-star filter-star" data-star="five">
                            <span>5</span>
                            <?php echo svg('start') ?>
                        </div>
                    </div>
                </div>
                {{--                <div class="filter-menu mb-30">--}}
                {{--                    <h3 class="tl">Dịch vụ đi kèm</h3>--}}
                {{--                    <div class="filter-section">--}}
                {{--                        <label class="check-custom js-checkbox-s">Ăn sáng miễn phí--}}
                {{--                            <input type="checkbox" class="filter-checkbox" value="breakfast">--}}
                {{--                            <span class="checkmark"></span>--}}
                {{--                        </label>--}}
                {{--                        <label class="check-custom js-checkbox-s">Hủy linh hoạt--}}
                {{--                            <input type="checkbox" class="filter-checkbox" value="cancel">--}}
                {{--                            <span class="checkmark"></span>--}}
                {{--                        </label>--}}
                {{--                        <label class="check-custom js-checkbox-s">Khuyến mãi - Giảm giá--}}
                {{--                            <input type="checkbox" class="filter-checkbox" value="sale">--}}
                {{--                            <span class="checkmark"></span>--}}
                {{--                        </label>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                @if($type == \App\Models\Comforts::KS)--}}
                <div class="filter-menu mb-30">
                    <h3 class="tl">Loại khách sạn</h3>
                    <div class="filter-section">
                        <label class="check-custom js-checkbox-s">Khách sạn
                            <input type="checkbox" class="filter-type" value="hotel"
                                   data-type="{{\App\Models\Comforts::KS}}">
                            <span class="checkmark"></span>
                        </label>
                        <label class="check-custom js-checkbox-s">Villa
                            <input type="checkbox" class="filter-type" value="villa"
                                   data-type="{{\App\Models\Comforts::TO}}">
                            <span class="checkmark"></span>
                        </label>
                        <label class="check-custom js-checkbox-s">Homestay
                            <input type="checkbox" class="filter-type" value="homestay"
                                   data-type="{{\App\Models\Comforts::HS}}">
                            <span class="checkmark"></span>
                        </label>
                        <label class="check-custom js-checkbox-s">Resort
                            <input type="checkbox" class="filter-type" value="resort"
                                   data-type="{{\App\Models\Comforts::RS}}">
                            <span class="checkmark"></span>
                        </label>
                        <label class="check-custom js-checkbox-s">Du thuyền
                            <input type="checkbox" class="filter-type" value="yacht"
                                   data-type="{{\App\Models\Comforts::DT}}">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                {{--                @endif--}}
                {{--                <div class="filter-menu mb-30">--}}
                {{--                    <h3 class="tl">Đánh giá của khách</h3>--}}
                {{--                    <div class="filter-section">--}}
                {{--                        <label class="check-custom js-checkbox-s">Tuyệt vời (9.0+)--}}
                {{--                            <input type="checkbox" class="filter-comment" value="great">--}}
                {{--                            <span class="checkmark"></span>--}}
                {{--                        </label>--}}
                {{--                        <label class="check-custom js-checkbox-s">Rất tốt (8.0+)--}}
                {{--                            <input type="checkbox" class="filter-comment" value="very_good">--}}
                {{--                            <span class="checkmark"></span>--}}
                {{--                        </label>--}}
                {{--                        <label class="check-custom js-checkbox-s">Tốt (7.0+)--}}
                {{--                            <input type="checkbox" class="filter-comment" value="good">--}}
                {{--                            <span class="checkmark"></span>--}}
                {{--                        </label>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                @if(count(@$listComfort) > 0 && $type == \App\Models\Comforts::TO)
                    <div class="filter-menu mb-30">
                        <h3 class="tl">Tiện nghi chỗ nghỉ</h3>
                        {{--                        <div class="wpc-filter-search-wrapper wpc-filter-search-wrapper-453">--}}
                        {{--                            <input class="wpc-filter-search-field" id="search-comfort" type="search" value="" placeholder="Search">--}}
                        {{--                            <button class="wpc-search-clear" type="button" title="Clear search"><span--}}
                        {{--                                    class="wpc-search-clear-icon">×</span></button>--}}
                        {{--                        </div>--}}
                        <div class="filter-section" id="list-comfort-filter">
                            @foreach(@$listComfort as $c)
                                <label class="check-custom js-checkbox-s">{{$c->name}}
                                    <input type="checkbox" class="filter-comfort" data-type="{{$c->name}}"
                                           value="{{$c->id}}">
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <style>
                        .wpc-filters-main-wrap input.wpc-filter-search-field {
                            box-shadow: none;
                            border-radius: 30px;
                        }

                        .wpc-filters-main-wrap input.wpc-filter-search-field {
                            padding-right: 30px;
                            width: 100%;
                            margin: 0;
                        }

                        input[type=search] {
                            box-shadow: none;
                            border-radius: 6px;
                        }

                        input[type=search] {
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            appearance: none;
                        }

                        .select-resize-ghost, .select2-container .select2-choice, .select2-container .select2-selection, input[type=search] {
                            background-color: #fff;
                            border: 1px solid #ddd;
                            border-radius: 0;
                            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
                            box-sizing: border-box;
                            color: #333;
                            font-size: .97em;
                            height: 2.5em;
                            max-width: 100%;
                            padding: 0 .75em;
                            transition: color .3s, border .3s, background .3s, opacity .3s;
                            vertical-align: middle;
                            width: 100%;
                        }

                        input.wpc-filter-search-field {
                            border-radius: 30px;
                        }

                        span.wpc-search-clear-icon {
                            display: none;
                        }

                        button.wpc-search-clear {
                            display: none;
                        }
                    </style>
                @elseif(!empty(@$listComfortHotel) && count(@$listComfortHotel) > 0)
                    <div class="filter-menu mb-30">
                        <h3 class="tl">Tiện nghi</h3>
                        <div class="filter-section" id="list-comfort-filter">
                            @foreach(@$listComfortHotel as $c)
                                <label class="check-custom js-checkbox-s">{{$c->name}}
                                    <input type="checkbox" class="filter-comfort" data-type="{{$c->name}}"
                                           value="{{$c->id}}">
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <style>
                        .wpc-filters-main-wrap input.wpc-filter-search-field {
                            box-shadow: none;
                            border-radius: 30px;
                        }

                        .wpc-filters-main-wrap input.wpc-filter-search-field {
                            padding-right: 30px;
                            width: 100%;
                            margin: 0;
                        }

                        input[type=search] {
                            box-shadow: none;
                            border-radius: 6px;
                        }

                        input[type=search] {
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            appearance: none;
                        }

                        .select-resize-ghost, .select2-container .select2-choice, .select2-container .select2-selection, input[type=search] {
                            background-color: #fff;
                            border: 1px solid #ddd;
                            border-radius: 0;
                            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
                            box-sizing: border-box;
                            color: #333;
                            font-size: .97em;
                            height: 2.5em;
                            max-width: 100%;
                            padding: 0 .75em;
                            transition: color .3s, border .3s, background .3s, opacity .3s;
                            vertical-align: middle;
                            width: 100%;
                        }

                        input.wpc-filter-search-field {
                            border-radius: 30px;
                        }

                        span.wpc-search-clear-icon {
                            display: none;
                        }

                        button.wpc-search-clear {
                            display: none;
                        }
                    </style>
                @endif
                {{--                            <div class="filter-menu mb-30">--}}
                {{--                                <h3 class="tl">Thương hiệu</h3>--}}
                {{--                                <div class="filter-section">--}}
                {{--                                    <label class="check-custom js-checkbox-s">Accor <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Ascott <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Fusion <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Hyatt <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">InterContinental Hotels Group--}}
                {{--                                        <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Hyatt <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">InterContinental Hotels Group--}}
                {{--                                        <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-menu mb-30">--}}
                {{--                                <h3 class="tl">Địa điểm</h3>--}}
                {{--                                <div class="filter-section">--}}
                {{--                                    <label class="check-custom js-checkbox-s">Quận 1 <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Quận Tân Bình <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Quận 7 <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Địa điểm khác <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Quận 3 <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Hyatt <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Quận 7 <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Địa điểm khác <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Quận 3 <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Hyatt <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-menu mb-30">--}}
                {{--                                <h3 class="tl">Tag</h3>--}}
                {{--                                <div class="filter-section">--}}
                {{--                                    <label class="check-custom js-checkbox-s">Best of the Best <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Travellers' Choice <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Miễn phí phụ thu trẻ em <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Miễn phí nâng hạng phòng--}}
                {{--                                        <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Giá độc quyền <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Best of the Best <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Travellers' Choice <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Miễn phí phụ thu trẻ em <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Miễn phí nâng hạng phòng--}}
                {{--                                        <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                    <label class="check-custom js-checkbox-s">Giá độc quyền <small>(3)</small>--}}
                {{--                                        <input type="checkbox">--}}
                {{--                                        <span class="checkmark"></span>--}}
                {{--                                    </label>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                <div class="js-show-filter sidebar-search--js-btn position-relative"><span
                        class="btn btn-blue">Xác nhận</span></div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="search-content">

                <div class="addfilter-js">
                    <span class="js-delete">Xóa tất cả</span>
                    <div class="js-dl-only js-input-only range-price remove-filter-label"
                         style="margin-right: 10px;">
                        <span class="min-input">0</span>
                        <span>-</span>
                        <span class="max-input">Không giới hạn</span>
                        <span>
                                    <svg class="icon-remove" width="24" height="24" fill="none"><path
                                            fill-rule="evenodd" fill="white" clip-rule="evenodd"
                                            d="M12 20a8 8 0 100-16.001A8 8 0 0012 20zM10.707 9.293a1 1 0 00-1.414 1.414L10.586 12l-1.293 1.293a1 1 0 101.414 1.414L12 13.414l1.293 1.293a1 1 0 001.414-1.414L13.414 12l1.293-1.293a1 1 0 00-1.414-1.414L12 10.586l-1.293-1.293z"
                                            fill="#F36"></path></svg>
                                    </span>
                    </div>
                    <span class="js-dl-only d-flex js-start-add">
                                    <?php echo svg('start') ?>
                                    <?php echo svg('start') ?>
                                    <?php echo svg('start') ?>
                                    <?php echo svg('start') ?>
                                    <?php echo svg('start') ?>
                                    <svg class="icon-remove" width="24" height="24" fill="none"><path
                                            fill-rule="evenodd" fill="white" clip-rule="evenodd"
                                            d="M12 20a8 8 0 100-16.001A8 8 0 0012 20zM10.707 9.293a1 1 0 00-1.414 1.414L10.586 12l-1.293 1.293a1 1 0 101.414 1.414L12 13.414l1.293 1.293a1 1 0 001.414-1.414L13.414 12l1.293-1.293a1 1 0 00-1.414-1.414L12 10.586l-1.293-1.293z"
                                            fill="#F36"></path></svg>

                                </span>


                </div>
                <div class="filter-nav" id="filter-nav">
                    <ul>
                        <span>Sắp xếp:</span>
                        <li class="active sort-hotel" data-type="{{@$hotel->type ?? @$dataSearch['type']}}"
                            data-location="{{$location->id ?? @$dataSearch['id']}}">Phù
                            hợp nhất
                        </li>
                        <li class="sort-hotel" data-type="{{@$hotel->type ?? @$dataSearch['type']}}"
                            data-location="{{$location->id ?? @$dataSearch['id']}}" data-filter="min">Rẻ
                            nhất <?php echo svg('renhat') ?></li>
                        <li class="sort-hotel" data-type="{{@$hotel->type ?? @$dataSearch['type']}}"
                            data-location="{{$location->id ?? @$dataSearch['id']}}" data-filter="max">Đắt
                            nhất <?php echo svg('renhat') ?></li>
                        <li class="sort-hotel" data-type="{{@$hotel->type ?? @$dataSearch['type']}}"
                            data-location="{{$location->id ?? @$dataSearch['id']}}" data-filter="rank">Xếp cao
                            nhất
                        </li>
                        <li class="sort-hotel" data-type="{{@$hotel->type ?? @$dataSearch['type']}}"
                            data-location="{{$location->id ?? @$dataSearch['id']}}" data-filter="comment">Đánh
                            giá cao nhất
                        </li>
                    </ul>
                </div>

                @if (!empty($location->banners(@$hotel->type ?? @$dataSearch['type'])) && $location->banners(@$hotel->type ?? @$dataSearch['type'])->count() > 0)
                    <div class="villa-banner-slider">
                        @foreach ($location->banners(@$hotel->type ?? @$dataSearch['type'])->get() as $k => $banner)
                            @php
                                $link = $banner->link;
                                $isPhone = false;
                                if (empty($link)) {
                                    $href = 'javascript:;';
                                } else {
                                    $isPhone = preg_match('/^(\+?\d{1,3}[-.\s]?)?(\(?\d{2,4}\)?[-.\s]?)?[\d\-.\s]{6,}$/', $link);
                                    $href = $isPhone ? 'tel:' . preg_replace('/\D+/', '', $link) : $link;
                                }
                                $imageSrc = $agent->isMobile() ? @$banner->image_mobile : @$banner->image_desktop;
                            @endphp

                            <div class="banner-qc">
                                <a href="{{ $href }}" title="{{ $banner->name ?? 'Banner villa ' . ($k + 1) }}"
                                   @if (!$isPhone && $href !== 'javascript:;') target="_blank" @endif>
                                    <img class="w-100 d-block" style="border-radius: 10px"
                                         src="{{ asset($imageSrc) }}"
                                         alt="{{ $banner->name ?? 'Banner villa ' . ($k + 1) }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div id="list-hotel-filter-by-name">
                    @if(count(@$hotels) > 0)
                        <div class="list-room">
                            @foreach($hotels as $hotel)
                                <div class="items-zoom"
                                     data-url="{{ route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id]) }}">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="images-content">
                                                <div class="gallery-top">
                                                    <div class="owl-carousel owl-carousel-image">
                                                        @foreach($hotel->images as $k =>  $image)
                                                            @if($k > 5)
                                                                @break
                                                            @endif
                                                            <div class="ratio gallery-top--img">
                                                                <a href="{{ route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id]) }}"
                                                                   rel="nofollow">
                                                                    <img
                                                                        src="{{asset('images/uploads/thumbs/' . $image->name)}}"
                                                                        alt="Ảnh {{$hotel->name}}" {{$k > 0 ? 'loading="lazy"' : ''}}>,
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="items-zoom--content">
                                                <div class="title">
                                                    <div class="title--left">
                                                        <h2><a class="items-tour--content__title"
                                                               {{--                                                               href="{{($hotel->room > $hotel->booked_room || $hotel->type == \App\Models\Comforts::TO || $hotel->type == \App\Models\Comforts::RS) ? route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id]) : 'javascript:;'}}"--}}
                                                               href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                               title="">{{$hotel->name}}</a></h2>
                                                    </div>
                                                </div>
                                                <div class="js-option-custom">
                                                    <div class="option-custom">
                                                        <div class="row m-0">
                                                            <div class="col-md-6 p-0">
                                                                <div class="option-custom--content">
                                                                    @if($hotel->type != \App\Models\Comforts::TO)
                                                                        <div class="star">
                                                                            @for($i = 0; $i < intval(@$hotel->rate); $i++)
                                                                                    <?php echo svg('start') ?>
                                                                            @endfor
                                                                        </div>
                                                                    @endif
                                                                    <ul>
                                                                        @php $max = $G1 = $G2 = $G3 = $G4 = $G5 = $location = $price = $staff = $wc = $comfort = 0; $maxRate = 0; $images = [] @endphp
                                                                        @if(count(@$hotel->comments) > 0)
                                                                            @foreach(@$hotel->comments as $i => $comment)
                                                                                @if($comment->images)
                                                                                    @php
                                                                                        $list = $comment->images->toArray();
                                                                                        $images = array_merge($images, $list);
                                                                                    @endphp
                                                                                @endif
                                                                                @if($maxRate < $comment->rate)
                                                                                    @php
                                                                                        $maxRate = $comment->rate;
                                                                                        $max = $i;
                                                                                    @endphp
                                                                                @endif
                                                                                @if(@$comment->rate > 9.5)
                                                                                    @php $G1 += 1; @endphp
                                                                                @elseif(@$comment->rate >= 9)
                                                                                    @php $G2 += 1; @endphp
                                                                                @elseif(@$comment->rate >= 8)
                                                                                    @php $G3 += 1; @endphp
                                                                                @elseif(@$comment->rate >= 7)
                                                                                    @php $G4 += 1; @endphp
                                                                                @else
                                                                                    @php $G5 += 1; @endphp
                                                                                @endif
                                                                                @php
                                                                                    $location += $comment->location;
                                                                                    $price += $comment->price;
                                                                                    $staff += $comment->staff;
                                                                                    $wc += $comment->wc;
                                                                                    $comfort += $comment->comfort;
                                                                                @endphp
                                                                            @endforeach
                                                                            @php
                                                                                $location = number_format($location / count($hotel->comments), 1);
                                                                                $price = number_format($price / count($hotel->comments), 1);
                                                                                $staff = number_format($staff / count($hotel->comments), 1);
                                                                                $wc = number_format($wc / count($hotel->comments), 1);
                                                                                $comfort = number_format($comfort / count($hotel->comments), 1);
                                                                            @endphp
                                                                            <div class="jss2153"><span
                                                                                    class="jss2154"><svg
                                                                                        width="21"
                                                                                        height="16"
                                                                                        fill="none"
                                                                                        style="margin-right: 3px;"><path
                                                                                            fill-rule="evenodd"
                                                                                            clip-rule="evenodd"
                                                                                            d="M5.825 8.157c.044-.13.084-.264.136-.394.31-.783.666-1.548 1.118-2.264.3-.475.606-.95.949-1.398.474-.616 1.005-1.19 1.635-1.665.27-.202.55-.393.827-.59.019-.015.034-.033.038-.08-.036.015-.078.025-.111.045-.506.349-1.024.68-1.51 1.052A15.241 15.241 0 006.627 4.98c-.408.47-.78.97-1.144 1.474-.182.249-.31.534-.474.818-1.096-1.015-2.385-1.199-3.844-.77.853-2.19 2.291-3.862 4.356-5.011 3.317-1.843 7.495-1.754 10.764.544 2.904 2.041 4.31 5.497 4.026 8.465-1.162-.748-2.38-.902-3.68-.314.05-.92-.099-1.798-.3-2.67a14.842 14.842 0 00-.834-2.567 16.416 16.416 0 00-1.225-2.345l-.054.028c.103.193.21.383.309.58.402.81.642 1.67.8 2.553.152.86.25 1.724.287 2.595.027.648.003 1.294-.094 1.936-.01.066-.018.133-.027.219-1.223-1.305-2.68-2.203-4.446-2.617a9.031 9.031 0 00-5.19.29l-.033-.03z"
                                                                                            fill="#F36"></path><path
                                                                                            fill-rule="evenodd"
                                                                                            clip-rule="evenodd"
                                                                                            d="M10 12.92h-.003c.31-1.315.623-2.627.93-3.943.011-.052-.015-.145-.052-.176a1.039 1.039 0 00-.815-.247c-.082.01-.124.046-.142.135-.044.216-.088.433-.138.646-.285 1.207-.57 2.413-.859 3.62l.006.001c-.31 1.314-.623 2.626-.93 3.942-.011.052.016.145.052.177.238.196.51.285.815.247.082-.01.125-.047.142-.134.044-.215.088-.433.138-.648.282-1.208.567-2.414.857-3.62z"
                                                                                            fill="#F36"></path><path
                                                                                            fill-rule="evenodd"
                                                                                            clip-rule="evenodd"
                                                                                            d="M15.983 19.203s-8.091-6.063-17.978-.467c0 0-.273.228.122.241 0 0 8.429-4.107 17.739.458-.002 0 .282.034.117-.232z"
                                                                                            fill="#F36"></path></svg>{{$maxRate}}</span><span
                                                                                    class="jss2155">Rất tốt</span><span
                                                                                    class="jss2156">({{count(@$hotel->comments)}} đánh giá)</span>
                                                                            </div>
                                                                        @endif
                                                                        <div class="jss2184">
                                                                            <div class="jss2157"
                                                                                 style="margin-bottom: 0px;display: flex">
                                                                                            <span
                                                                                                style="width: 16px; height: 16px;"><svg
                                                                                                    width="16"
                                                                                                    height="16"
                                                                                                    fill="none"><path
                                                                                                        d="M8.467 3.8V2a1 1 0 00-1-1h-.8a1 1 0 00-1 1v1.8"
                                                                                                        stroke="currentColor"
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"></path><path
                                                                                                        d="M1 7.467a1 1 0 001 1h9.838a1 1 0 00.64-.232l1.6-1.333a1 1 0 000-1.537l-1.6-1.333a1 1 0 00-.64-.232H2a1 1 0 00-1 1v2.667zM5.667 10.333V14a1 1 0 001 1h.8a1 1 0 001-1v-3.667"
                                                                                                        stroke="currentColor"
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"></path></svg></span>
                                                                                <h4 class="jss2158"
                                                                                    style="margin: 3px 0px 0px 6px; font-weight: initial;">
                                                                                    {{@$hotel->address}}</h4>
                                                                            </div>
                                                                        </div>
                                                                        @if(@$hotel->type_room)
                                                                            <div
                                                                                class="MuiBox-root jss3256 jss3051">
                                                                                            <span
                                                                                                class="MuiBox-root jss3257"
                                                                                                style="width: 16px; height: 16px;"><svg
                                                                                                    width="16"
                                                                                                    height="16"
                                                                                                    fill="none"><path
                                                                                                        d="M2.667 7.556V6.222a.889.889 0 01.888-.889h3.556a.889.889 0 01.889.89v1.333"
                                                                                                        stroke="#4A5568"
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"></path><path
                                                                                                        d="M8 7.556V6.222a.889.889 0 01.889-.889h3.555a.889.889 0 01.89.89v1.333"
                                                                                                        stroke="#4A5568"
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"></path><path
                                                                                                        d="M2.518 7.556h10.963a1.185 1.185 0 011.186 1.185v2.815H1.333V8.74a1.185 1.185 0 011.185-1.185v0zM1.333 11.556v1.777M14.666 11.556v1.777"
                                                                                                        stroke="#4A5568"
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"></path><path
                                                                                                        d="M13.333 7.556v-4a.889.889 0 00-.889-.89H3.555a.889.889 0 00-.889.89v4"
                                                                                                        stroke="#4A5568"
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"></path></svg></span><span
                                                                                    class="MuiBox-root jss3258 jss3052">{{ucfirst(@$hotel->type_room)}}</span>
                                                                            </div>
                                                                        @endif
                                                                        @if($hotel->breakfast)
                                                                            <li><?php echo svg('mn') ?> Giá đã
                                                                                bao gồm bữa
                                                                                sáng
                                                                            </li>
                                                                        @endif
                                                                        @if($hotel->cancel != 0)
                                                                            <div
                                                                                class="MuiBox-root jss4378 jss3972">
                                                                                <svg width="16" height="16"
                                                                                     fill="none"
                                                                                     style="margin-right: 6px;">
                                                                                    <path
                                                                                        d="M3.333 8l3.334 3.333 6.666-6.666"
                                                                                        stroke="#48BB78"
                                                                                        stroke-width="1.5"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"></path>
                                                                                </svg>
                                                                                {{$hotel->cancel == 1 ? 'Hủy phòng miễn phí' : 'Hoàn hủy một phần'}}
                                                                            </div>
                                                                        @endif
                                                                        @if($hotel->surcharge == 0 && $hotel->type != \App\Models\Comforts::TO)
                                                                            <div
                                                                                class="MuiBox-root jss4378 jss3972">
                                                                                <svg width="16" height="16"
                                                                                     fill="none"
                                                                                     style="margin-right: 6px;">
                                                                                    <path
                                                                                        d="M3.333 8l3.334 3.333 6.666-6.666"
                                                                                        stroke="#48BB78"
                                                                                        stroke-width="1.5"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"></path>
                                                                                </svg>
                                                                                Miễn phí phụ thu trẻ em
                                                                            </div>
                                                                        @endif
                                                                        {{--                                                                        @if(count(@$hotel->comments) > 0)--}}
                                                                        {{--                                                                            <div class="jss2198"--}}
                                                                        {{--                                                                                 style="display: flex; margin-top: 10px">--}}
                                                                        {{--                                                                                " {!! $hotel->comments[$max]->message !!}--}}
                                                                        {{--                                                                                "--}}
                                                                        {{--                                                                            </div>--}}
                                                                        {{--                                                                        @endif--}}

                                                                    </ul>
                                                                    @if(@$hotel->type == \App\Models\Comforts::TO)
                                                                        @if(@$hotel->people)
                                                                            <div
                                                                                class="items-tour--content__address items-tour--content__address2">
                                                                                    <?php echo svg('user') ?>
                                                                                <span>Từ {{@$hotel->people_min ?? 1}}-{{@$hotel->people}} khách</span>
                                                                            </div>
                                                                        @endif
                                                                        <div class="details--them2">
                                                                            @if(@$hotel->bedroom)
                                                                                <p>
                                                                                        <?php echo svg('zoom') ?>
                                                                                    <span>{{@$hotel->bedroom}} Phòng ngủ</span>
                                                                                </p>
                                                                            @endif
                                                                            @if(@$hotel->bed)
                                                                                <p>
                                                                                        <?php echo svg('giuong-ngu') ?>
                                                                                    <span>{{@$hotel->bed}} Giường</span>{{$hotel->mattress ? ', ' . $hotel->mattress . ' nệm ngủ' : ''}}</span>
                                                                                </p>
                                                                            @endif
                                                                            @if(@$hotel->bedroom)
                                                                                <p>
                                                                                        <?php echo svg('tam') ?>
                                                                                    <span>{{@$hotel->bathroom}} Phòng tắm</span>
                                                                                </p>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 p-0">
                                                                <div
                                                                    class="option-custom--content option-custom--content---last">
                                                                    @if($hotel->type == \App\Models\Comforts::TO || $hotel->price == 0)
                                                                        <p class="bil">Liên hệ</p>
                                                                    @elseif($hotel->sale)
                                                                        <div class="sale">{{$hotel->sale}}%
                                                                        </div>

                                                                        <div class="price">
                                                                            <div class="price--del">
                                                                                {{number_format($hotel->price)}}
                                                                                <up>₫</up>
                                                                            </div>
                                                                            <div class="price--ins">
                                                                                {{ number_format((100 - $hotel->sale) / 100 * $hotel->price) }}
                                                                                <up>₫</up>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="price">
                                                                            <div class="price--ins">
                                                                                {{number_format($hotel->price)}}
                                                                                <up>₫</up>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <p class="zoom">/ phòng / đêm</p>
                                                                    @if(count($hotel->vouchers) > 0)
                                                                        <div class="vocher">
                                                                            <div class="vocher--code">Nhập mã:
                                                                                @php $percent = 0 @endphp
                                                                                @foreach($hotel->vouchers as $voucher)
                                                                                    @php $percent += $voucher->percent @endphp
                                                                                    <strong>{{$voucher->code}}</strong>
                                                                                    <span>-{{$voucher->percent}}%</span>
                                                                                    <p></p>
                                                                                @endforeach
                                                                            </div>
                                                                            <div
                                                                                class="vocher--price">{{ number_format((100 - ($hotel->sale + $percent)) / 100 * $hotel->price) }}
                                                                                <up>₫</up>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    {{--                                                                    @if($hotel->room > $hotel->booked_room || $hotel->type == \App\Models\Comforts::TO || $hotel->type == \App\Models\Comforts::RS)--}}
                                                                    <button class="btn btn-blue"
                                                                            id="book-room" type="button">
                                                                        <a style="color: white"
                                                                           href="{{route('hotels.detail', ['slug' => $hotel->slug, 'id' => $hotel->id])}}"
                                                                           title="{{$hotel->name}}">Đặt
                                                                            phòng</a>
                                                                    </button>
                                                                    {{--                                                                    @else--}}
                                                                    {{--                                                                        <button class="btn btn-blue" disabled--}}
                                                                    {{--                                                                                type="button">--}}
                                                                    {{--                                                                            <a style="color: white"--}}
                                                                    {{--                                                                               href="javascript:;"--}}
                                                                    {{--                                                                               title="{{$hotel->name}}">Hết phòng</a>--}}
                                                                    {{--                                                                        </button>--}}
                                                                    {{--                                                                    @endif--}}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{--                                                        <div class="paginate">--}}
                        {!! $hotels->appends(request()->input())->links() !!}
                        {{--                                                        </div>--}}
                    @else
                        <h3 class="information">Không có kết quả nào!</h3>
                    @endif
                </div>
            </div>
        </div>

        @if(!empty(@$location->name) || count(@$hotels) > 0)
            <div class="modal fade" id="modal-show-maps" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLongTitle"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header sticky-top">
                            <div class="title-left">
                                <h5 class="modal-title" id="exampleModalLongTitle">Địa điểm du lịch</h5>
                                <span>{{@$location->name ?? @$hotels[0]->location->name}}</span>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                {!! svg('close') !!}
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="map" style="width: 100%;height: 100%">
                                <iframe
                                    width="100%"
                                    height="100%"
                                    style="border:0"
                                    loading="lazy"
                                    allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade"
                                    src="https://www.google.com/maps/embed/v1/place?key={{config('services.google_maps.key')}}&q={{ urlencode(@$location->name ?? @$hotels[0]->location->name) }}">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
