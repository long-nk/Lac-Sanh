<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Categories;
use App\Models\Comforts;
use App\Models\Contents;
use App\Models\Hotels;
use App\Models\Introduces;
use App\Models\Locations;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        session()->forget('formData');
        $listCategory = Categories::where('status', 1)->orderBy('sort')->get();
        $banners = Banner::where('status', Banner::IS_ACTIVE)->where('type', '=', Banner::TYPE_BANNER)->orderBy('sort', 'asc')->get();
        $sliders = Banner::where('status', Banner::IS_ACTIVE)->where('type', '=', Banner::TYPE_KM)->orderBy('sort', 'asc')->get();
        $flashSales = Hotels::where('status', 1)->where('flash_sale', 1)->orWhere('sale', '!=', 0)->orderBy('created_at', 'desc')->limit(12)->get();
        $hotels = Hotels::where('status', 1)->orderBy('type')->orderBy('created_at', 'desc')->limit(9)->get();
        $hotelPopulars = Hotels::where('status', 1)->orderBy('rate', 'desc')->where('type', Comforts::KS)->limit(12)->get();
        $hotelHots = Hotels::where('status', 1)->orderBy('price', 'asc')->where('type', Comforts::KS)->limit(8)->get();
        $yachts =  Hotels::where('status', 1)->orderBy('created_at', 'desc')->where('type', Comforts::DT)->limit(12)->get();
        $hotNews = Contents::where('status', 1)->where('type', Contents::TIN_TUC)->orderBy('created_at', 'desc')->limit(10)->get();
        $popularNews = Contents::where('status', 1)->where('type', Contents::TIN_TUC)->where('check', 1)->orderBy('created_at', 'desc')->limit(5)->get();
        $listCategoryTop = Categories::where('status', 1)->where('check', 1)->orderBy('sort')->get();
        $listCategoryBottom = Categories::where('status', 1)->where('check', 0)->orWhere('check', '')->orderBy('sort')->get();
        $intro = Introduces::first();
        $villas = Locations::where('status', 1)
            ->whereHas('hotels', function($query) {
                $query->where('type', Comforts::TO)->where('status', 1);
            })
            ->orderBy('sort', 'asc')->get();
        $resorts = Locations::where('status', 1)
            ->whereHas('hotels', function($query) {
                $query->where('type', Comforts::RS)->where('status', 1);
            })
            ->orderBy('sort', 'asc')
            ->get();
            $listLocation = Locations::where('status', 1)
            ->whereHas('hotels', function ($query){
                $query->where('type', Comforts::KS)->where('status', 1);
            })
            ->orderBy('sort', 'asc')
            ->get();
        return view('frontend.homepage.index', compact('flashSales', 'hotels', 'hotNews', 'popularNews', 'listLocation',
            'hotelPopulars', 'villas', 'resorts', 'intro', 'hotelHots', 'yachts', 'banners', 'sliders', 'listCategory', 'listCategoryBottom', 'listCategoryTop'));
    }

    public function introduce()
    {
        $introduce = Introduces::where('status', 1)->first();
        return view('frontend.introduces.index', compact('introduce'));
    }
}
