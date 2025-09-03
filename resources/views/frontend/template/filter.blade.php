@php $dataSearch = session('formData') ?? []; @endphp


<div
    class="filter__content {{Route::is('hotels.list_location') || Route::is('hotels.search') ? 'filter__content__mobile__custom' :''}} ">
    <ul class="nav-filter nav">
        <?php $title = array('', 'Khách sạn', 'Villa', 'Homestay', 'Resort', 'Du thuyền') ?>
        <?php $svg = array('', 'ks', 'villa', 'homestay', 'resort_new', 'duthuyen') ?>
        <?php $value = array('', \App\Models\Comforts::KS, \App\Models\Comforts::TO, \App\Models\Comforts::HS,
            \App\Models\Comforts::RS, \App\Models\Comforts::DT) ?>
        <?php for ($i = 1;
                   $i < 6;
                   $i++){ ?>

        <li class="nav-item">
            <a class="nav-link type-hotel {{$value[$i] == intval(@$dataSearch['type']) ? 'active' : ''}}"
               href="javascript:void(0)" data-bs-toggle="tab" data-type="{{$value[$i]}}"
               title="<?php echo $title[$i] ?>"><?php echo svg($svg[$i]) ?> <span><?php echo $title[$i] ?></span>
            </a>
        </li>
        <?php } ?>
        <span class="khac d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-khac">
			<?php echo svg('dot') ?>
			Khác
		</span>

    </ul>

    <div class="tab-content">
        <div class="tab-pane fade active show">
            <form class="form-filter" id="form-search-hotel" action="{{route('hotels.search')}}" method="GET">
                <input type="text" class="type-hotel" name="type_hotel" id="type-hotel-value"
                       value="{{!empty(@$dataSearch) ? intval(@$dataSearch['type']) : ''}}" hidden="false">
                <ul>
                    <li class="items js-ganeral">
                        <span class="items--title">Điểm đến</span>
                        <input class="items--search js-show-address" type="text" name="location" id="search-location"
                               value="{{@$dataSearch['location']}}" placeholder="Thành phố, khách sạn, địa điểm">
                        @if(Route::is('home') && $agent->isMobile())
                            <button type="button" class="btn-mobile-search" id="search-hotel">Gửi</button>
                        @endif
                        <div class="sub-filter js-sub-custom">
                            <div class="input-location" style="display: none">
                                <div class="input-name">
                                    <input class="items--search js-show-address" type="text" name="location-mobile"
                                           id="search-location-mobile"
                                           value="{{@$dataSearch['location']}}"
                                           placeholder="Thành phố, khách sạn, địa điểm">
                                </div>
                                <div class="js-close-filter">
                                    <?php echo svg('close') ?></div>
                            </div>


                            <div class="row">
                                <div class="col-md-4" id="list-location-search">
                                    <div class="sub-filter--search">
                                        <div class="title">
                                            <h3>Tìm kiếm gần đây</h3>
                                            <a class="js-del-history" href="javascript:;">Xóa lịch sử tìm kiếm</a>
                                        </div>
                                        <div class="js-search-history list">
                                            @php $listLocation = session('recent_location') ?? []; $listHotel = session('recent_hotel') ?? [];   @endphp
                                            @if(count(@$listLocation) > 0)
                                                @foreach ($listLocation as $location)
                                                    <div class="items-sub choose-location"
                                                         data-value="{{@$location['name']}}">
                                                        <div class="images">
                                                                <?php echo svg('address3') ?>
                                                        </div>
                                                        <div class="text">
                                                            <h4>{{@$location['name']}}</h4>
                                                            <p>Việt nam</p>
                                                        </div>
                                                        <span
                                                            class="ks">{{$location['number'] ?? 0}} <?php echo svg('ks1') ?></span>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if(count(@$listHotel) > 0)
                                                @foreach ($listHotel as $s)
                                                    <div class="items-sub choose-location" data-value="{{@$s['name']}}">
                                                        <div class="images">
                                                            <img
                                                                src="{{asset('images/uploads/thumbs/' . @$s['image'])}}"
                                                                alt="{{@$s['name']}}">
                                                        </div>
                                                        <div class="text">
                                                            <h4>{{@$s['name']}}</h4>
                                                            <p>{{@$s['address']}}</p>
                                                            <span class="text--ks">Khách sạn</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if(count($listLocation) == 0 && count($listHotel) == 0)
                                                <div class="items-sub" style="width: 100%;">
                                                    <h3 class="information" style="text-align: center">Không có địa đểm
                                                        nào!</h3>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="sub-filter--content">
                                        <h4 class="title">Địa điểm nổi bật</h4>
                                        <div class="row row-custom">
                                            @foreach($locationSearch as $location)
                                                <div class="col-xl-2 col-lg-3 col-md-4 col-4 col-custom">
                                                    <div class="images choose-location"
                                                         data-value="{{$location->name}}">
                                                        <div class="ratio">
                                                            <img class="w-100 d-block"
                                                                 src="{{asset('' . $location->image)}}" loading="lazy">
                                                        </div>
                                                        <span class="location-name">{{$location->name}}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="jss120 jss121"></span>
                    </li>
                    <li class="items js-ganeral js-checkout">
                        <div class="items--flex">
                            <div class="items--flex--check ">
                                <span class="items--title">Nhận phòng</span>
                                <p class="items--flex--check__content"
                                   id="t-startdate">{{@$dataSearch['startDate'] ? $dataSearch['startDate'] : 'Chọn ngày đi'}}</p>
                            </div>
                            <div class="jss139">
                                <span id="dayCount"
                                      style="margin-top: 2px">{{@$dataSearch['day'] ? @$dataSearch['day'] : 1}}</span>
                                <input type="text" value="{{@$dataSearch['day'] ? @$dataSearch['day'] : 1}}"
                                       name="day_count" class="day-count" hidden="true">
                                <?php echo svg('ngay') ?>
                            </div>
                            <div class="items--flex--check">
                                <span class="items--title">Trả phòng</span>
                                <p class="items--flex--check__content"
                                   id="t-enddate">{{@$dataSearch['endDate'] ? @$dataSearch['endDate'] : 'Chọn ngày về'}}</p>
                            </div>
                            <div class="input-select-date">
                                <input class="data-picker" type="text" name="startDate" aria-label="Start date"
                                       value="{{@$dataSearch['startDate']}}" id="startDate"/>
                                <input class="data-picker" type="text" name="endDate" aria-label="End date"
                                       value="{{@$dataSearch['endDate']}}" id="endDate"/>
                            </div>
                            @if(Route::is('hotels.list_location') || Route::is('hotels.search'))
                                <span class="khach">, <small class="js-khach">2</small> Khách</span>
                            @endif
                        </div>
                        <span class="jss120 jss122"></span>
                    </li>
                    <li class="items js-ganeral js-show-bookzoom">
                        <span class="items--title">Số phòng, số khách</span>
                        <p class="items--content js-content-bookzoom"><span
                                class="js-zoom">{{@$dataSearch['room'] ? @$dataSearch['room'] : 1}}</span> phòng, <span
                                class="js-peo">{{@$dataSearch['people'] ? @$dataSearch['people'] : 1}}</span> người lớn,
                            <span class="js-tre">{{@$dataSearch['child'] ? @$dataSearch['child'] : 0}}</span> trẻ em</p>
                        <div class="js-check-input">
                            <input class="input-zoom" type="number"
                                   value="{{@$dataSearch['room'] ? @$dataSearch['room'] : 1}}" min="1" name="room">
                            <input class="input-peo" type="number"
                                   value="{{@$dataSearch['people'] ? @$dataSearch['people'] : 1}}" min="1"
                                   name="people">
                            <input class="input-tre" type="number"
                                   value="{{@$dataSearch['child'] ? @$dataSearch['child'] : 0}}" min="0" name="child">
                        </div>
                        <div class="sub-filter--checkn js-sub-custom">
                            <div class="js-close-filter"><?php echo svg('close') ?></div>
                            <div class="sidebar-left">
                                <ul>
                                    <li class="js-check-active js-check-ng active">
                                        <span>Đi một mình</span>
                                        <p class="content-ng"><span class="js-number1">1</span> Phòng, <span
                                                class="js-number2">1</span> người lớn</p>
                                    </li>
                                    <li class="js-check-active js-check-ng">
                                        <span>Đi cặp đôi/2 người</span>
                                        <p class="content-ng"><span class="js-number1">1</span> Phòng, <span
                                                class="js-number2">2</span> người lớn</p>
                                    </li>
                                    <li class="js-check-active js-check-table">
                                        <span>Đi theo gia đình</span>
                                    </li>
                                    <li class="js-check-active js-check-table js-check-table-2">
                                        <span>Đi theo nhóm</span>
                                    </li>
                                    <li class="js-check-active js-check-table js-check-table-3">
                                        <span>Đi công tác</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidebar-right js-sidebar-right active-position">
                                <div class="form-group">
                                    <p>Phòng</p>
                                    <div class="queti js-queti-zoom">
                                        <span class="icon minus"><?php echo svg('minus') ?></span>
                                        <span class="js-display-number">1</span>
                                        <span class="icon plus"><?php echo svg('plus') ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p>Người lớn</p>
                                    <div class="queti js-queti-peo">
                                        <span class="icon minus"><?php echo svg('minus') ?></span>
                                        <span class="js-display-number">1</span>
                                        <span class="icon plus"><?php echo svg('plus') ?></span>
                                    </div>
                                </div>
                                <div class="form-group js-none-tr">
                                    <p>Trẻ em</p>
                                    <div class="queti js-queti-tre">
                                        <span class="icon minus"><?php echo svg('minus') ?></span>
                                        <span class="js-display-number">0</span>
                                        <span class="icon plus"><?php echo svg('plus') ?></span>
                                    </div>
                                </div>
                                <div class="note-check">
                                    <h4>Bạn cần từ 16 phòng trở lên?</h4>
                                    <p>Chat ngay với VivaTrip để nhận được giá ưu đãi</p>
                                    <a class="btn btn-blue" href="#">Chat ngay</a>
                                </div>
                            </div>
                        </div>
                        <span class="jss120 jss123"></span>
                    </li>
                    <li class="items js-ganeral">
                        <div class="items--flex">
                            <div class="items--flex--select">
                                {{--                                <span class="items--title">Tiêu chuẩn</span>--}}
                                {{--                                <div class="items--flex--select--option">--}}
                                {{--                                    <span class="js-display-s"><span>{{@$star ? $star : 4}}</span> <?php echo svg('start') ?></span>--}}
                                <input hidden="true" type="text" name="star" value="{{@$star ? $star : ''}}"
                                       class="val-star" id="number-star">
                                {{--                                    <div class="list-start js-sub-custom js-list-start">--}}
                                {{--                                        <span class="js-sub-s choose-star" data-value="1">1 <?php echo svg('start') ?></span>--}}
                                {{--                                        <span class="js-sub-s choose-star" data-value="2">2 <?php echo svg('start') ?></span>--}}
                                {{--                                        <span class="js-sub-s choose-star" data-value="3">3 <?php echo svg('start') ?></span>--}}
                                {{--                                        <span class="js-sub-s choose-star" data-value="4">4 <?php echo svg('start') ?></span>--}}
                                {{--                                        <span class="js-sub-s choose-star" data-value="5">5 <?php echo svg('start') ?></span>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                            <button class="btn btn-blue" type="button"
                                    id="search-hotel"><?php echo svg('search') ?></button>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div class="line line1"></div>
                            <div class="line line2"></div>
                            <div class="line line3"></div>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
