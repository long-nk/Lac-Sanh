<?php

namespace App\Http\Controllers;

use App\Models\Comforts;
use App\Models\Hotels;
use App\Models\Locations;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function filter(Request $request) {
        if($request->type == 'all') {
            $filters = Locations::where('status', 1)
                ->whereHas('hotels', function($query) {
                    $query->where('type', Comforts::TO)->where('status', 1);
                })
                ->orderBy('sort', 'asc')->get();
        } else {
            $filters = Locations::where('status', 1)
                ->whereHas('hotels', function($query) {
                    $query->where('type', Comforts::TO)->where('status', 1);
                })
                ->orderBy('sort', 'asc')
                ->where('type', $request->type)->get();
        }

        return view('frontend.locations.list-filter', compact('filters'));
    }

    public function searchLocation(Request $request)
    {
        $key = $request->location;
        $location = \Illuminate\Support\Str::slug($key);

        if($location != '') {
            $listLocation = Locations::where('slug', 'like', '%'.$location.'%')->where('status', 1)->limit(25)->get();
            $listHotel = Hotels::where('slug', 'like', '%'.$location.'%')->limit(25)->where('status', 1)->get();

        } else {
            $listLocation = [];
            $listHotel = [];
        }
        return view('frontend.locations.filter', compact('listLocation', 'listHotel', 'key'));


//        if($listLocation->isEmpty()) {
//            $listLocation = collect([]);
//        } else {
//            $recentLocation = session()->get('recent_location', []);
//
//            foreach ($listLocation as $loc) {
//                $exists = collect($recentLocation)->contains(function($item) use ($loc) {
//                    return $item['slug'] === $loc->slug;
//                });
//
//                if (!$exists) {
//                    $recentLocation[] = [
//                        'name' => $loc->name,
//                        'slug' => $loc->slug,
//                        'number' => count(@$loc->hotels),
//                    ];
//                }
//            }
//
//            // Lưu lại session
//            session()->put('recent_location', $recentLocation);
//        }
//
//        if($listHotel->isEmpty()) {
//            $listHotel = collect([]);
//        } else {
//            $recentHotel = session()->get('recent_hotel', []);
//
//            foreach ($listHotel as $hotel) {
//                $exists = collect($recentHotel)->contains(function($item) use ($hotel) {
//                    return $item['slug'] === $hotel->slug;
//                });
//
//                if($hotel->type == Comforts::KS) {
//                    $type = 'Khách sạn';
//                } elseif($hotel->type == Comforts::TO) {
//                    $type = 'Villa';
//                } elseif($hotel->type == Comforts::HS) {
//                    $type = 'Homestay';
//                } elseif($hotel->type == Comforts::RS) {
//                    $type = 'Resort';
//                } elseif($hotel->type == Comforts::DT) {
//                    $type = 'Du thuyền';
//                }
//                if (!$exists) {
//                    $recentHotel[] = [
//                        'name' => $hotel->name,
//                        'slug' => $hotel->slug,
//                        'image' => $hotel->images[0]->name,
//                        'address' => $hotel->address,
//                        'type' => $type,
//                    ];
//                }
//            }
//
//            // Lưu lại session
//            session()->put('recent_hotel', $recentHotel);
//        }


    }
}
