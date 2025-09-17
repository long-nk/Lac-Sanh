@if(!empty(@$comments) && count(@$comments) > 0)
    @foreach($comments as $comment)
        <div class="items">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="items--name">
                        <div class="items--name---images">
                            @php
                                $words = explode(' ', $comment->name);
                                    $first_letter_first_word = ucfirst(substr($words[0], 0, 1));
                                    $first_letter_last_word = ucfirst(substr(end($words), 0, 1));
                            @endphp
                            {{$first_letter_first_word}}{{$first_letter_last_word}}
                        </div>
                        <div class="items--name---content">
                            <h4>{{$comment->name}}</h4>
                            <ul>
{{--                                <li>--}}
{{--                                        <?php echo svg('pen') ?>--}}
{{--                                    <span>{{date('d/m/Y', strtotime($comment->created_at))}}</span>--}}
{{--                                </li>--}}
                                <li>
                                        <?php echo svg('room') ?>
                                    <span>{{@$comment->tour->name ?? @$comment->hotel->name ?? ''}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <div class="items--content">
{{--                        <p><strong>{{$comment->title ?? 'Dịch vụ ' . @$type . ' tuyệt vời'}}</strong>--}}
{{--                        </p>--}}
                        <div class="items--content---raiting">
                            <span>{{$comment->rate}}</span>
                            <p>@if(@$comment->rate > 9.5)
                                    Tuyệt vời
                                @elseif(@$comment->rate >= 9)
                                    Xuất sắc
                                @elseif(@$comment->rate >= 8)
                                    Tốt
                                @elseif(@$comment->rate >= 7)
                                    Trung bình
                                @else
                                    Kém
                                @endif</p>
                        </div>
                        <p>{!! $comment->message !!}</p>
                        @if(count(@$comment->images) > 0)
                            <div class="MuiBox-root jss1011 jss944">
                                @foreach($comment->images as $k => $img)
                                    <a href="{{asset('images/uploads/comments/' . $img->name)}}" data-fancybox="images-comment">
                                        <img
                                            src="{{asset('images/uploads/comments/' . $img->name)}}"
                                            alt="Ảnh người dùng đánh giá {{@$comment->hotel->name ?? @$comment->tour->name ?? ''}}"
                                            title="Ảnh người dùng đánh giá {{$comment->hotel->name ?? @$comment->tour->name ?? ''}}"
                                            style="width: 96px; height: 96px; object-fit: cover; border-radius: 8px; margin: 0px 6px; cursor: pointer;">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <h3 class="information">Không có kết quả!</h3>
@endif
