<div class="sub-filter--search">
    <div class="title">
        <h3>Địa điểm gợi ý</h3>
{{--        <a class="js-del-history" href="javascript:void(0)">Xóa gợi ý</a>--}}
    </div>
    <div class="js-search-history list">
        @php
            function highlightMatchingChars($c, $key) {
                // Chuyển cả $c và $key về chữ thường
                $lowerC = mb_strtolower($c, 'UTF-8');
                $lowerKey = mb_strtolower($key, 'UTF-8');

                // Chuỗi kết quả
                $result = '';

                // Duyệt từng ký tự trong $c
                for ($i = 0; $i < mb_strlen($c, 'UTF-8'); $i++) {
                    $charC = mb_substr($c, $i, 1, 'UTF-8');
                    $charLowerC = mb_substr($lowerC, $i, 1, 'UTF-8');

                    // Kiểm tra ký tự có trong $key không
                    if (mb_strpos($lowerKey, $charLowerC) !== false) {
                        // Nếu có, tô màu ký tự
                        $result .= '<span style="color:#00375a; font-weight: bold;">' . htmlspecialchars($charC) . '</span>';
                    } else {
                        // Nếu không, giữ nguyên ký tự
                        $result .= htmlspecialchars($charC);
                    }
                }

                return $result;
            }
        @endphp
        @if(count(@$listLocation) > 0)
            @foreach($listLocation as $location)
                @php
                    $highlightedLocation = highlightMatchingChars($location->name, $key);
                @endphp
                <div class="items-sub choose-location" data-value="{{@$location->name}}">
                    <div class="images">
                            <?php echo svg('address3') ?>
                    </div>
                    <div class="text">
                        <h4>{!! $highlightedLocation !!}</h4>
                        <p>Việt nam</p>
                    </div>
                    <span class="ks">{{count($location->hotels)}} <?php echo svg('ks1') ?></span>
                </div>
            @endforeach
        @endif
        @if(count(@$listHotel) > 0)
            @foreach ($listHotel as $s)
                @php
                    $highlightedName = highlightMatchingChars($s->name, $key);
                @endphp
                <div class="items-sub choose-location" data-value="{{@$s->name}}">
                    <div class="images">
                        <img src="{{asset('images/uploads/thumbs/' . @$s->images[0]->name)}}"
                             alt="{{@$s->name}}">
                    </div>
                    <div class="text">
                        <h4>{!! $highlightedName !!}</h4>
                        <p>{{@$s->address}}</p>
                        @if(@$s->type == \App\Models\Comforts::KS)
                            <span class="text--ks">Khách sạn</span>
                        @elseif(@$s->type == \App\Models\Comforts::TO)
                            <span class="text--ks">Villa</span>
                        @elseif(@$s->type == \App\Models\Comforts::HS)
                            <span class="text--ks">Homestay</span>
                        @elseif(@$s->type == \App\Models\Comforts::RS)
                            <span class="text--ks">Resort</span>
                        @elseif(@$s->type == \App\Models\Comforts::DT)
                            <span class="text--ks">Du thuyền</span>
                        @endif
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


