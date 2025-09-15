<?php

namespace App\Http\Controllers;

use App\Mail\MailBookRoom;
use App\Mail\SendMailNewOrder;
use App\Models\Banner;
use App\Models\Comforts;
use App\Models\CommentImages;
use App\Models\Comments;
use App\Models\Hotels;
use App\Models\HotelVouchers;
use App\Models\Locations;
use App\Models\Orders;
use App\Models\PageInfo;
use App\Models\Rooms;
use App\Models\Vouchers;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HotelsController extends Controller
{
    public function index()
    {
        try {
            $banners = Banner::where('status', Banner::IS_ACTIVE)->where('type', '=', Banner::TYPE_BANNER)->orderBy('sort', 'asc')->get();
            $vouchers = Vouchers::where('status', 1)->get();
            $locations = Locations::where('region', Locations::REGION_IN)->where('status', 1)->limit(4)->get();
            $locationHots = Locations::where('region', Locations::REGION_IN)->where('status', 1)->where('check', 1)->limit(4)->get();
            $hotels = Hotels::where('status', 1)->orderBy('created_at', 'desc')->limit(9)->get();
            $hotelPopulars = Hotels::where('status', 1)->orderBy('rate', 'desc')->where('type', Comforts::KS)->limit(12)->get();
            $hotelHots = Hotels::where('status', 1)->orderBy('price', 'asc')->where('type', Comforts::KS)->limit(8)->get();
            return view('frontend.hotels.index', compact('banners', 'vouchers', 'locations', 'locationHots'));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', 'Chức năng hiện không khả dụng, vui lòng thử lại sau!');
        }
    }

    public function search(Request $request)
    {
        try {
            $type = $request->type_hotel;

            $title = 'Khách sạn';
            if ($type == Comforts::KS) {
                $title = 'Khách sạn';
            } elseif ($type == Comforts::TO) {
                $title = 'Villa';
            } elseif ($type == Comforts::HS) {
                $title = 'Homestay';
            } elseif ($type == Comforts::RS) {
                $title = 'Resort';
            } else {
                $title = 'Du thuyền';
            }

            if ($type === null) {
                $title = 'Dịch vụ';
            }

            $slug = Str::slug($request->location);
            $people = $request->people;
            $room = $request->room;
            $child = $request->child;
            $star = $request->star;
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $day = $request->day_count;
            $location = Locations::where('slug', $slug)->where('status', 1)->first();
            if (!empty($location)) {
                if ($star) {
                    $hotels = Hotels::where('location_id', $location->id)->where('rate', $star)->where('type', $type)
                        ->where('status', 1)->orderBy('sort')->orderBy('created_at')->paginate(10);
                } else {
                    $hotels = Hotels::where('location_id', $location->id)->where('type', $type)
                        ->where('status', 1)->orderBy('sort')->orderBy('created_at')->paginate(10);
                }
                if (count(@$hotels) == 0 && $type === null) {
                    $hotels = Hotels::where('location_id', $location->id)
                        ->where('status', 1)->orderBy('sort')->orderBy('created_at')->paginate(10);
                }

                $recentLocation = session()->get('recent_location', []);

                $exists = collect($recentLocation)->contains(function ($item) use ($location) {
                    return @$item['slug'] === @$location->slug;
                });
                if (!$exists) {
                    $recentLocation[] = [
                        'name' => $location->name,
                        'slug' => $location->slug,
                        'number' => count(@$location->hotels),
                    ];
                }

                // Lưu lại session
                session()->put('recent_location', $recentLocation);
                $hotel = '';
            } else {
                $hotels = Hotels::where('slug', 'like', '%' . $slug . '%')->where('status', 1)->orderBy('sort')->orderBy('created_at')->paginate(10);
                $hotel = Hotels::where('slug', $slug)->where('status', 1)->first();
                $type = $hotel->type;
                $location = Locations::find($hotel->location_id);
                $recentHotel = session()->get('recent_hotel', []);
                if (!empty($hotel)) {
                    $exists = collect($recentHotel)->contains(function ($item) use ($hotel) {
                        return $item['slug'] === $hotel->slug;
                    });

                    if ($hotel->type == Comforts::KS) {
                        $title = 'Khách sạn';
                    } elseif ($hotel->type == Comforts::TO) {
                        $title = 'Villa';
                    } elseif ($hotel->type == Comforts::HS) {
                        $title = 'Homestay';
                    } elseif ($hotel->type == Comforts::RS) {
                        $title = 'Resort';
                    } elseif ($hotel->type == Comforts::DT) {
                        $title = 'Du thuyền';
                    }
                    if (!$exists) {
                        $recentHotel[] = [
                            'name' => $hotel->name,
                            'slug' => $hotel->slug,
                            'image' => @$hotel->images[0]->name,
                            'address' => $hotel->address,
                            'type' => $title,
                        ];
                    }

                    // Lưu lại session
                    session()->put('recent_hotel', $recentHotel);
                }
            }

            $listComfortHotel = Comforts::where('status', 1)->where('special', '!=', 1)->whereNotNull('parent_id')->orderBy('parent_id', 'asc')->where('type', $type)->get();
            $listComfortSpecial = Comforts::where('special', 1)->whereNotNull('parent_id')->where('status', 1)->get();
            if (count(@$hotels) == 0) {
                $hotels = Hotels::where('slug', $slug)->where('type', $type)->where('room', '>', $room)->where('status', 1)
                    ->orderBy('created_at')->get();
            }
            Carbon::setLocale('vi');
            $days = [
                1 => 'T2', // Monday
                2 => 'T3', // Tuesday
                3 => 'T4', // Wednesday
                4 => 'T5', // Thursday
                5 => 'T6', // Friday
                6 => 'T7', // Saturday
                0 => 'CN'  // Sunday
            ];

            if (empty($startDate)) {
                $now = Carbon::now()->addDay();
                $dayNumber = $now->dayOfWeek;
                $dayName = $days[$dayNumber];
                $dayOfMonth = $now->format('d');
                $month = $now->format('m'); // Zero-padded month
                $startDate = "{$dayName}, {$dayOfMonth} tháng {$month}";
            }

            if (empty($endDate)) {
                $tomorrow = Carbon::now()->addDay(2);
                $dayNumber = $tomorrow->dayOfWeek;
                $dayName = $days[$dayNumber];
                $dayOfMonth = $tomorrow->format('d');
                $month = $tomorrow->format('m'); // Zero-padded month
                $endDate = "{$dayName}, {$dayOfMonth} tháng {$month}";
            }

            $start = convertDateString($startDate);
            $end = convertDateString($endDate);

            session(['formData' => [
                'id' => @$location->id ?? '',
                'location' => $request->location,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'day' => $day,
                'room' => $request->room,
                'people' => $request->people,
                'child' => $request->child,
                'type' => $type,
                'start' => $start,
                'end' => $end,
            ]]);
            $queryParams = $request->query();

            return view('frontend.hotels.list', compact('hotels', 'hotel', 'location', 'title', 'type',
                'title', 'room', 'startDate', 'people', 'child', 'endDate', 'day', 'listComfortHotel', 'listComfortSpecial'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('message-error', 'Không tìm thấy điểm đến nào!');
        }
    }

    public function list()
    {
        try {
            $vouchers = Vouchers::where('status', 1)->where('hotel', 1)->get();
            $hotelPopulars = Hotels::where('status', 1)->orderBy('rate', 'desc')->limit(16)->get();
            $hotelHots = Hotels::where('status', 1)->orderBy('sort')->orderByRaw('CAST(price AS UNSIGNED) ASC')->limit(8)->get();
            $locationHots = Locations::where('status', 1)
                ->whereHas('hotels', function ($query) {
                    $query->where('status', 1);
                })
                ->where('check', 1)
                ->orderBy('sort', 'asc')
                ->get();
            $listLocation = Locations::where('status', 1)
                ->whereHas('hotels', function ($query) {
                    $query->where('status', 1);
                })
                ->orderBy('sort', 'asc')
                ->get();
            $banners = Banner::where('status', Banner::IS_ACTIVE)->where('type', '=', Banner::TYPE_BANNER)->orderBy('sort')->get();

            return view('frontend.hotels.index', compact('vouchers',
                'listLocation', 'hotelHots', 'hotelPopulars', 'banners', 'locationHots'));

        } catch (\Exception $e) {
            dd($e);
            \Log::error($e->getMessage());
            return redirect()->back()->with('message-error', 'Chức năng hiện không khả dụng, vui lòng thử lại sau!');
        }

    }

    public function viewMore(Request $request)
    {
        $type = $request->type;
        $title = '';
        if ($type == 'khach-san') {
            $title = 'Khách sạn';
            $t = Comforts::KS;
        } elseif ($type == 'villa') {
            $title = 'Villa';
            $t = Comforts::TO;
        } elseif ($type == 'homestay') {
            $title = 'Homestay';
            $t = Comforts::HS;
        } elseif ($type == 'resort') {
            $title = 'Resort';
            $t = Comforts::RS;
        } elseif ($type == 'du-thuyen') {
            $title = 'Du thuyền';
            $t = Comforts::DT;
        }

        $listComfortHotel = Comforts::where('type', $t)->where('status', 1)->get();

        $hotels = Hotels::where('status', 1)->orderBy('type', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.hotels.list', compact('hotels', 'type', 'title', 'listComfortHotel'));
    }

    public function detail(Request $request)
    {
        try {
            $hotel = Hotels::with(['images', 'comments.commentImages'])->find($request->id);
            $listVoucher = [];
            $currentDateTime = Carbon::now();

            $listVoucher = Vouchers::where('status', 1)
                ->where('hotel', 1)
                ->whereDate('start_date', '<=', $currentDateTime)
                ->whereDate('end_date', '>=', $currentDateTime)
                ->get();

            $rooms = Rooms::where('hotel_id', $hotel->id)->where('status', 1)->orderBy('created_at', 'desc')->get();
            $hotels = Hotels::where('status', 1)->where('id', '!=', $hotel->id)->where('location_id', $hotel->location_id)->orderBy('sort')->orderBy('created_at', 'desc')->limit(15)->get();
            $comments = Comments::where('hotel_id', $hotel->id)->where('status', 1)->limit(3)->get();
            $allImages = $hotel->images->merge($hotel->comments->pluck('commentImages')->flatten());
            $commentImages = $hotel->comments->pluck('commentImages')->flatten();
            $listComforts = [];
            if (@$hotel->comforts) {
                $listComforts = @$hotel->comforts->groupBy('parent_id');
            }
            $listComforts = $listComforts->filter(function ($value, $key) {
                return !empty($key);
            });

            $totalComforts = $listComforts->sum(function ($comforts) {
                return $comforts->count();
            });

            $compareList = session('compareList', []);
            $listCompare = Hotels::whereIn('id', $compareList)->get();

            $newHotel = [
                'id' => $hotel->id,
                'image' => @$hotel->images[0]->name, // Đường dẫn hình ảnh
                'name' => $hotel->name,
                'slug' => $hotel->slug,// Tên khách sạn
                'stars' => $hotel->rate, // Số sao
                'address' => $hotel->address, // Địa chỉ
                'type' => $hotel->type
            ];

            // Lấy danh sách khách sạn hiện tại từ session, nếu không có thì tạo một mảng trống
            $hotelList = session('hotelList', []);

            // Kiểm tra xem khách sạn đã tồn tại trong danh sách chưa
            $exists = collect($hotelList)->contains(function ($hotel) use ($newHotel) {
                return $hotel['id'] === $newHotel['id'];
            });

            if (!$exists) {
                // Nếu khách sạn chưa tồn tại, thêm vào danh sách
                $hotelList[] = $newHotel;
                // Lưu danh sách khách sạn vào session
                session(['hotelList' => $hotelList]);
            }
            Carbon::setLocale('vi');
            $now = Carbon::now()->addDay();

            $days = [
                1 => 'T2', // Monday
                2 => 'T3', // Tuesday
                3 => 'T4', // Wednesday
                4 => 'T5', // Thursday
                5 => 'T6', // Friday
                6 => 'T7', // Saturday
                0 => 'CN'  // Sunday
            ];
            $dayNumber = $now->dayOfWeek;
            $dayName = $days[$dayNumber];
            $dayOfMonth = $now->format('d');
            $month = $now->format('m'); // Zero-padded month
            $start = "{$dayName}, {$dayOfMonth} tháng {$month}";

            $tomorrow = Carbon::now()->addDay(2);
            $dayNumber = $tomorrow->dayOfWeek;
            $dayName = $days[$dayNumber];
            $dayOfMonth = $tomorrow->format('d');
            $month = $tomorrow->format('m'); // Zero-padded month
            $end = "{$dayName}, {$dayOfMonth} tháng {$month}";

            if (!session()->has('formData')) {

                session(['formData' => [
                    'id' => @$hotel->id ?? '',
                    'location' => @$hotel->name,
                    'startDate' => $start,
                    'endDate' => $end,
                    'day' => 1,
                    'room' => 1,
                    'people' => 1,
                    'child' => 0,
                    'type' => $hotel->type,
                    'start' => $now->format('d/m/Y'),
                    'end' => $tomorrow->format('d/m/Y'),
                ]]);
            } else {
                $formData = Session::get('formData', []);
                $formData['id'] = @$hotel->id;
                $formData['location'] = @$hotel->name;

                // Save updated data back to session
                Session::put('formData', $formData);
            }

            return view('frontend.hotels.detail', compact( 'hotel', 'hotels', 'rooms', 'comments', 'allImages',
                'commentImages', 'listComforts', 'listCompare', 'totalComforts', 'listVoucher'));
        } catch (\Exception $e) {
            return redirect()->route('home')->with('message-error', 'Không tìm thấy thông tin phù hợp, vui lòng thử lại sau.');
        }

    }

    public function listLocation(Request $request)
    {
        $type = $request->type;

        $location = Locations::where('slug', $request->location)->where('status', 1)->first();

        Carbon::setLocale('vi');
        $now = Carbon::now()->addDay();

        $days = [
            1 => 'T2', // Monday
            2 => 'T3', // Tuesday
            3 => 'T4', // Wednesday
            4 => 'T5', // Thursday
            5 => 'T6', // Friday
            6 => 'T7', // Saturday
            0 => 'CN'  // Sunday
        ];
        $dayNumber = $now->dayOfWeek;
        $dayName = $days[$dayNumber];
        $dayOfMonth = $now->format('d');
        $month = $now->format('m'); // Zero-padded month
        $start = "{$dayName}, {$dayOfMonth} tháng {$month}";

        $tomorrow = Carbon::now()->addDay(2);
        $dayNumber = $tomorrow->dayOfWeek;
        $dayName = $days[$dayNumber];
        $dayOfMonth = $tomorrow->format('d');
        $month = $tomorrow->format('m'); // Zero-padded month
        $end = "{$dayName}, {$dayOfMonth} tháng {$month}";

        if ($type == 'khach-san') {
            $title = 'khách sạn';
            $t = Comforts::KS;
            $hotels = Hotels::where('status', 1)->where('location_id', $location->id)->orderBy('sort')
                ->orderBy('created_at', 'desc')->paginate(10);
        } else if ($type == 'villa') {
            $title = 'villa';
            $t = Comforts::TO;
            $hotels = Hotels::where('status', 1)->where('location_id', $location->id)->orderBy('sort')
                ->orderBy('created_at', 'desc')->paginate(10);
        } else if ($type == 'homestay') {
            $title = 'homestay';
            $t = Comforts::HS;
            $hotels = Hotels::where('status', 1)->where('location_id', $location->id)->orderBy('sort')
                ->orderBy('created_at', 'desc')->paginate(10);
        } else if ($type == 'resort') {
            $title = 'resort';
            $t = Comforts::RS;
            $hotels = Hotels::where('status', 1)->where('location_id', $location->id)->orderBy('sort')
                ->orderBy('created_at', 'desc')->paginate(10);
        } else if ($type == 'du-thuyen') {
            $title = 'du thuyền';
            $t = Comforts::DT;
            $hotels = Hotels::where('status', 1)->where('location_id', $location->id)->orderBy('sort')
                ->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $title = 'dịch vụ';
            $t = '';
            $hotels = Hotels::where('status', 1)->where('location_id', $location->id)->orderBy('sort')->orderBy('created_at', 'desc')->paginate(10);
        }

        $type = $t;

        if (!session()->has('formData')) {
            session(['formData' => [
                'id' => @$location->id ?? '',
                'location' => @$location->name,
                'startDate' => $start,
                'endDate' => $end,
                'day' => 1,
                'room' => 1,
                'people' => 1,
                'child' => 0,
                'type' => $type,
                'start' => $now->format('d/m/Y'),
                'end' => $tomorrow->format('d/m/Y'),
            ]]);
        } else {
            $formData = Session::get('formData', []);
            $formData['id'] = $location->id;
            $formData['location'] = $location->name;
            $formData['type'] = $type;

            // Save updated data back to session
            Session::put('formData', $formData);
        }
        $listComfortHotel = Comforts::where('type', $type)->whereNotNull('parent_id')->where('status', 1)->get();
        $listComfortSpecial = Comforts::where('special', 1)->whereNotNull('parent_id')->where('status', 1)->get();

        return view('frontend.hotels.list', compact('hotels', 'title', 'location', 'type', 'listComfortHotel', 'listComfortSpecial'));
    }

    public function filterHotels(Request $request)
    {
        $type = $request->type;
        $filter = $request->filter;
        $locationId = $request->location_id;

        $hotelsQuery = Hotels::where('status', 1)->where('location_id', $locationId);

        if ($type !== null) {
            $hotelsQuery->where('type', $type);
        }


        if ($filter == 'min') {
            $hotels = $hotelsQuery->orderByRaw('CAST(price AS UNSIGNED) ASC')->paginate(10);
        } elseif ($filter == 'max') {
            $hotels = $hotelsQuery->orderByRaw('CAST(price AS UNSIGNED) DESC')->paginate(10);
        } elseif ($filter == 'rank') {
            $hotels = $hotelsQuery->orderBy('rate', 'desc')->paginate(10);
        } elseif ($filter == 'comment') {
            $hotels = $hotelsQuery->with(['comments' => function ($query) {
                $query->orderBy('rate', 'desc');
            }])->paginate(10);
        } else {
            $hotels = $hotelsQuery->orderBy('sort')->orderBy('created_at', 'desc')->paginate(10);
        }
        $queryParams = $request->query();
//        if ($request->ajax()) {
        return view('frontend.hotels.list-filter-by', compact('hotels', 'queryParams'))->render();
//        }
    }

    public function filterList(Request $request)
    {
        $filters = $request->filters;
        $type = $request->type;
        $location_id = $request->location_id;
        // Apply the filters to your query
        if ($type != '') {
            $hotelsQuery = Hotels::where('status', 1)->where('type', $type)->where('location_id', $location_id);
        } else {
            $hotelsQuery = Hotels::where('status', 1)->where('location_id', $location_id);
        }
        if (!empty($filters['hotel'])) {
            $type = Comforts::KS;
            $hotelsQuery->where('type', $type)->orWhere('type', Comforts::KS)->where('location_id', $location_id);
        }
        if (!empty($filters['villa'])) {
            $type = Comforts::TO;
            $hotelsQuery->where('type', $type)->orWhere('type', Comforts::TO)->where('location_id', $location_id);
        }
        if (!empty($filters['homestay'])) {
            $type = Comforts::HS;
            $hotelsQuery->where('type', $type)->orWhere('type', Comforts::HS)->where('location_id', $location_id);
        }
        if (!empty($filters['resort'])) {
            $type = Comforts::RS;
            $hotelsQuery->where('type', $type)->orWhere('type', Comforts::RS)->where('location_id', $location_id);
        }
        if (!empty($filters['yacht'])) {
            $type = Comforts::DT;
            $hotelsQuery->where('type', $type)->orWhere('type', Comforts::DT)->where('location_id', $location_id);
        }
        if (!empty($filters['breakfast'])) {
            $hotelsQuery->where('breakfast', 1)->where('location_id', $location_id);
        }
        if (!empty($filters['cancel'])) {
            $hotelsQuery->where('cancel', 1)->where('location_id', $location_id);
        }
        if (!empty($filters['surcharge'])) {
            $hotelsQuery->where('surcharge', 0)->where('location_id', $location_id);
        }
        if (!empty($filters['room'])) {
            $hotelsQuery->whereIn('bedroom', $filters['room'])->where('location_id', $location_id);
        }
        if (!empty($filters['people'])) {
            $hotelsQuery->whereIn('people', $filters['people'])->where('location_id', $location_id);
        }
        if (!empty($filters['location'])) {
            $hotelsQuery->where('type', $type)->where('location_id', $location_id);
        }

        if (!empty($filters['area'])) {
            $hotelsQuery->whereHas('areas', function ($query) use ($filters) {
                $query->whereIn('name', $filters['area']);
            });
        }

        if (!empty($filters['comfort'])) {
            $hotelsQuery->whereHas('comforts', function ($query) use ($filters) {
                $query->whereIn('name', $filters['comfort']);
            });
        }

        if (!empty($filters['comfort_special'])) {
            $hotelsQuery->whereHas('comforts', function ($query) use ($filters) {
                $query->whereIn('name', $filters['comfort_special']);
            });
        }

//
//        if (@$filters['great'] == true) {
//            $hotelsQuery->with(['comments' => function ($query) use ($location_id) {
//                $query->where('rate', '>=', 9);
//            }])->where('location_id', $location_id);
//        }
//        if (@$filters['very_good'] == true) {
//            $hotelsQuery->with(['comments' => function ($query) use ($location_id) {
//                $query->where('rate', '>=', 8);
//            }])->where('location_id', $location_id);
//        }
//        if (@$filters['good'] == true) {
//            $hotelsQuery->with(['comments' => function ($query) use ($location_id) {
//                $query->where('rate', '>=', 7);
//            }])->where('location_id', $location_id);
//        }
        if (!empty($filters['star']) && $filters['star'] == 'two') {
            $hotelsQuery->where('rate', 2)->where('location_id', $location_id);
        }
        if (!empty($filters['star']) && $filters['star'] == 'three') {
            $hotelsQuery->where('rate', 3)->where('location_id', $location_id);
        }
        if (!empty($filters['star']) && $filters['star'] == 'four') {
            $hotelsQuery->where('rate', 4)->where('location_id', $location_id);
        }
        if (!empty($filters['star']) && $filters['star'] == 'five') {
            $hotelsQuery->where('rate', 5)->where('location_id', $location_id);
        }

        // Add more conditions based on filters
        if (!empty($filters['price_min']) && !empty($filters['price_max'])) {
            $min = intval($filters['price_min']) * 100000;
            $max = intval($filters['price_max']) * 100000;
            $hotelsQuery->whereBetween('price', [$min, $max]);
        }
        $hotels = $hotelsQuery->orderBy('sort')->orderBy('created_at', 'desc')->paginate(10);
        // Return a partial view with the filtered results
        return view('frontend.hotels.list-filter-by', compact('hotels'));

    }

    public function filter(Request $request)
    {
        $type = $request->type;
        if ($type == 'khach-san') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::KS)
                ->orderBy('rate', 'desc')->limit(9)->get();
        } else if ($type == 'villa') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::TO)
                ->orderBy('created_at', 'desc')->limit(9)->get();
        } else if ($type == 'homestay') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::HS)
                ->orderBy('rate', 'desc')->limit(9)->get();
        } else if ($type == 'resort') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::RS)
                ->orderBy('rate', 'desc')->limit(9)->get();
        } else if ($type == 'du-thuyen') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::DT)
                ->orderBy('rate', 'desc')->limit(9)->get();
        } else {
            $type = 'khach-san';
            $hotels = Hotels::where('status', 1)->orderBy('sort')->orderBy('created_at', 'desc')->limit(9)->get();
        }
        $sliders = Banner::where('status', Banner::IS_ACTIVE)->where('type', '=', Banner::TYPE_KM)->orderBy('sort', 'asc')->get();
        return view('frontend.hotels.list-filter', compact('hotels', 'type', 'sliders'));
    }

    public function filterPriceHots(Request $request)
    {
        $type = $request->type;
        if ($type == 'khach-san') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::KS)->orderByRaw('CAST(price AS UNSIGNED) ASC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else if ($type == 'villa') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::TO)->orderByRaw('CAST(price AS UNSIGNED) ASC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else if ($type == 'homestay') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::HS)->orderByRaw('CAST(price AS UNSIGNED) ASC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else if ($type == 'resort') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::RS)->orderByRaw('CAST(price AS UNSIGNED) ASC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else if ($type == 'du-thuyen') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::DT)->orderByRaw('CAST(price AS UNSIGNED) ASC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else {
            $type = 'khach-san';
            $hotels = Hotels::where('status', 1)->orderBy('sort')->orderBy('created_at', 'desc')->limit(12)->get();
        }
        return view('frontend.hotels.list-filter-by-price', compact('hotels', 'type'));
    }

    public function filterPopular(Request $request)
    {
        $type = $request->type;
        if ($type == 'khach-san') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::KS)->orderByRaw('CAST(price AS UNSIGNED) DESC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else if ($type == 'villa') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::TO)->orderByRaw('CAST(price AS UNSIGNED) DESC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else if ($type == 'homestay') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::HS)->orderByRaw('CAST(price AS UNSIGNED) DESC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else if ($type == 'resort') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::RS)->orderByRaw('CAST(price AS UNSIGNED) DESC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else if ($type == 'du-thuyen') {
            $hotels = Hotels::where('status', 1)->where('type', Comforts::DT)->orderByRaw('CAST(price AS UNSIGNED) DESC')
                ->orderBy('created_at', 'desc')->limit(12)->get();
        } else {
            $type = 'khach-san';
            $hotels = Hotels::where('status', 1)->orderBy('sort')->orderBy('created_at', 'desc')->limit(12)->get();
        }
        return view('frontend.hotels.list-filter-slide', compact('hotels', 'type'));
    }

    public function filterLocation(Request $request)
    {
        $type = $request->type;
        if ($type == 'khach-san') {
            $title = 'Khách sạn';
            $t = Comforts::KS;
        } elseif ($type == 'villa') {
            $title = 'Villa';
            $t = Comforts::TO;
        } elseif ($type == 'homestay') {
            $title = 'Homestay';
            $t = Comforts::HS;
        } elseif ($type == 'resort') {
            $title = 'Resort';
            $t = Comforts::RS;
        } elseif ($type == 'du-thuyen') {
            $title = 'Du thuyền';
            $t = Comforts::DT;
        }

        $location = Locations::where('slug', $request->location)->where('status', 1)->first();
        if (empty($location)) {
            $hotels = Hotels::where('status', 1)->orderBy('sort')->orderBy('created_at', 'desc')
                ->limit(12)->get();
        } else {
            $hotels = Hotels::where('status', 1)->where('location_id', $location->id)->orderBy('sort')->orderBy('created_at', 'desc')
                ->limit(12)->get();
        }

        return view('frontend.hotels.list-filter-location', compact('hotels', 'type', 'location'));
    }

    public function listFlashSale(Request $request)
    {
        $hotels = Hotels::where('status', 1)->where('flash_sale', 1)->orderBy('sort')->orderBy('created_at', 'desc')
            ->limit(12)->get();
        $sliders = Banner::where('status', 1)->where('type', Banner::TYPE_SALE)->get();
        $listVoucher = Vouchers::where('status', 1)->get();
        $listLocation = Locations::where('status', 1)
            ->orderBy('sort', 'asc')
            ->get();

        return view('frontend.hotels.list-flash-sale', compact('hotels', 'listVoucher', 'listLocation', 'sliders'));
    }

    public function listHotelLove()
    {
        $user = \auth()->guard('customer')->user();
        $favoristList = session('favoristList', []);
        $favoristList = Hotels::whereIn('id', $favoristList)->get();
        return view('frontend.hotels.list-hotel-love', compact('user', 'favoristList'));
    }

    public function filterFlashSale(Request $request)
    {
        if ($request->location == 'all') {
            $hotels = Hotels::where('status', 1)->where('flash_sale', 1)->orderBy('sort')->orderBy('created_at', 'desc')
                ->limit(12)->get();
        } else {
            $hotels = Hotels::where('location_id', $request->location)->where('status', 1)->where('flash_sale', 1)
                ->orderBy('created_at', 'desc')->limit(12)->get();
        }

        return view('frontend.hotels.list-filter-flash-sale', compact('hotels'));
    }

    public function addFavoristList(Request $request)
    {
        $hotel = Hotels::find($request->id);
        $favorites = Session::get('favoristList', []);
        if (!in_array($hotel->id, $favorites)) {
            // Add to favorites if not already in the list
            $favorites[] = $hotel->id;
            Session::put('favoristList', $favorites);
            $response = [
                $status = 1,
                $message = 'Đã thêm vào danh sách yêu thích!'
            ];

        } else {
            // Remove from favorites if already in the list
            $index = array_search($hotel->id, $favorites);
            if ($index !== false) {
                unset($favorites[$index]);
                Session::put('favoristList', array_values($favorites)); // Reindex the array
                $response = [
                    $status = 0,
                    $message = 'Đã xóa khỏi danh sách yêu thích!'
                ];
            }
        }
        return response()->json($response);
    }

    public function addCompareList(Request $request)
    {
        // Find the room based on the given ID
        $room = Rooms::find($request->id);

        // Get the current compare list from the session or initialize it as an empty array
        $compares = Session::get('compareList', []);

        if ($room) {
            // Check if the room is not already in the compare list
            if (!in_array($room->id, $compares)) {
                // Check if the list exceeds the maximum allowed size (4)
                if (count($compares) >= 4) {
                    // Remove the oldest record (first element)
                    array_shift($compares);
                }

                // Add the new room ID to the compare list
                $compares[] = $room->id;
                Session::put('compareList', $compares);
            } else {
                // Find the index of the room ID in the compare list
                $index = array_search($room->id, $compares);
                if ($index !== false) {
                    // Remove the room ID from the compare list
                    unset($compares[$index]);
                    // Reindex the array and update the session
                    Session::put('compareList', array_values($compares));
                }
            }

            // Fetch the list of rooms based on the IDs in the compare list
            $listCompare = Rooms::whereIn('id', $compares)->get();

            // Return the updated comparison list view
            return view('frontend.hotels.list-compare', compact('listCompare'));
        }

        // Handle the case where the room was not found
        return response()->json(['error' => 'Room not found'], 404);
    }

    public function removeCompareList(Request $request)
    {
        $room = Rooms::find($request->id);
        if ($room) {
            $compares = Session::get('compareList', []);
            $index = array_search($room->id, $compares);
            if ($index !== false) {
                // Remove the room ID from the compare list
                unset($compares[$index]);
                // Reindex the array and update the session
                Session::put('compareList', array_values($compares));
            }
            $listCompare = Rooms::whereIn('id', $compares)->get();
            return view('frontend.hotels.list-compare', compact('listCompare'));
        }
        return response()->json(['error' => 'Room not found'], 404);
    }

    public function filterRoom(Request $request)
    {
        $filters = $request->filters;
        $hotel_id = $request->hotel_id;
        // Apply the filters to your query
        $roomsQuery = Rooms::where('status', 1)->where('hotel_id', $hotel_id);

        if (!empty($filters['cancel'])) {
            $roomsQuery->where('cancel', '!=', 0);
        }
        if (!empty($filters['breakfast'])) {
            $roomsQuery->where('breakfast', 1);
        }
        if (!empty($filters['surcharge'])) {
            $roomsQuery->where('surcharge', 0);
        }
        if (!empty($filters['bed_single'])) {
            $roomsQuery->whereIn('bed', [Rooms::ONE_SINGLE_BED, Rooms::TWO_SINGLE_BED,
                Rooms::THREE_SINGLE_BED, Rooms::ONE_SINGLE_ONE_DOUBLE, Rooms::ONE_DOUBLE_TWO_SINGLE]);
        }
        if (!empty($filters['bed_double'])) {
            $roomsQuery->whereIn('bed', [Rooms::ONE_DOUBLE_BED, Rooms::TWO_DOUBLE_BED,
                Rooms::THREE_DOUBLE_BED, Rooms::ONE_SINGLE_ONE_DOUBLE, Rooms::ONE_DOUBLE_TWO_SINGLE]);
        }
        $rooms = $roomsQuery->orderBy('created_at', 'desc')->get();

        return view('frontend.rooms.list-filter', compact('rooms'));
    }

    public function book(Request $request)
    {
        try {
            $date = \DateTime::createFromFormat('d/m/Y', $request->check_in);
            $start = $date->format('Y-m-d 14:00:00');
            $date = \DateTime::createFromFormat('d/m/Y', $request->check_out);
            $end = $date->format('Y-m-d 12:00:00');
            $total = $request->price * (1 - $request->sale / 100) * (1 - $request->voucher / 100) * @$request->day * @$request->number + $request->surcharge + @$hotel->vat;

            DB::beginTransaction();
            $data = [
                'room_id' => $request->room_id,
                'price' => $request->price,
                'sale' => $request->sale,
                'total' => $total,
                'surcharge' => $request->surcharge,
                'voucher' => $request->voucher,
                'payment' => $request->payment,
                'vat' => $request->vat,
                'username' => $request->username,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'check_in' => $start,
                'check_out' => $end,
                'people' => $request->people,
                'child' => $request->child,
                'number' => $request->number,
                'note' => $request->note,
                'status' => Orders::CHO_DUYET
            ];

            $pageInfo = PageInfo::first();

            $order = Orders::create($data);
            if ($order) {
                try {
                    Mail::to($order->email)->send(new MailBookRoom($order));
                    Mail::to($pageInfo->email2)->send(new SendMailNewOrder($order));
                    DB::commit();
                    return redirect()->back()->withInput()->with('message-success', 'Đặt phòng thành công, vui lòng kiểm tra email về thông tin phòng đã đặt.');

                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->withInput()->with('message-error', 'Đặt phòng không thành công. Xin vui lòng thử lại!');
                }

            } else {
                DB::rollBack();
                return redirect()->back()->withInput()->with('message-error', 'Đặt phòng không thành công. Xin vui lòng thử lại!');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('message-error', 'Đặt phòng không thành công. Xin vui lòng thử lại!');
        }
    }

    public function bookVilla(Request $request)
    {
        try {
            $date = \DateTime::createFromFormat('d/m/Y', $request->check_in);
            $start = $date->format('Y-m-d 14:00:00');
            $date = \DateTime::createFromFormat('d/m/Y', $request->check_out);
            $end = $date->format('Y-m-d 12:00:00');
//            $total = $request->price * (1 - $request->sale / 100) * (1 - $request->voucher / 100) * @$request->day * @$request->number + $request->surcharge + @$hotel->vat;

            DB::beginTransaction();
            $data = [
                'hotel_id' => $request->hotel_id,
//                'price' => $request->price,
//                'sale' => $request->sale,
//                'total' => $total,
//                'surcharge' => $request->surcharge,
//                'voucher' => $request->voucher,
//                'payment' => $request->payment,
//                'vat' => $request->vat,
                'username' => $request->username,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'check_in' => $start,
                'check_out' => $end,
                'people' => $request->people,
                'child' => $request->child,
//                'number' => $request->number,
//                'note' => $request->note,
                'status' => Orders::CHO_DUYET
            ];

            $pageInfo = PageInfo::first();

            $order = Orders::create($data);

            if ($order) {
                try {
                    Mail::to($order->email)->send(new MailBookRoom($order));
                    Mail::to($pageInfo->email2)->send(new SendMailNewOrder($order));
                    DB::commit();
                    return redirect()->back()->withInput()->with('message-success', 'Đặt phòng thành công, vui lòng kiểm tra email về thông tin phòng đã đặt.');

                } catch (\Exception $e) {
                    dd($e);
                    DB::rollBack();
                    return redirect()->back()->withInput()->with('message-error', 'Đặt phòng không thành công. Xin vui lòng thử lại!');
                }

            } else {
                DB::rollBack();
                return redirect()->back()->withInput()->with('message-error', 'Đặt phòng không thành công. Xin vui lòng thử lại!');
            }
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->withInput()->with('message-error', 'Đặt phòng không thành công. Xin vui lòng thử lại!');
        }
    }

    public function searchComfort(Request $request)
    {
        $keyword = $request->input('keyword');
        $listComfortFilter = Comforts::select('name')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->where('special', '!=', 1)
            ->groupBy('name')
            ->get();
//        $listComfort = Comforts::whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$keyword])->get();


        return view('frontend.hotels.list-comfort', compact('listComfortFilter'));
    }
}
