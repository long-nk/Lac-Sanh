<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Categories;
use App\Models\Comforts;
use App\Models\Contents;
use App\Models\Feedbacks;
use App\Models\Vouchers;
use App\Models\Hotels;
use App\Models\Tours;
use App\Models\Introduces;
use App\Models\Locations;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        session()->forget('formData');
        $locationHots = Locations::where('status', 1)->where('check', 1)->limit(4)->get();
        if (empty($locationHots)) {
            $locationHots = Locations::where('status', 1)->orderBy('sort')->orderByDesc('created_at')->limit(4)->get();
        }
        $vouchers = Vouchers::where('status', 1)->get();
        $hotels = Hotels::where('status', 1)->where('hot', 1)->orderBy('sort')->orderByDesc('created_at')->limit(8)->get();
        if(empty($hotels)) {
            $hotels = Hotels::where('status', 1)->orderBy('sort')->orderByDesc('created_at')->limit(8)->get();
        }
        $tours = Tours::where('status', 1)->where('hot', 1)->orderBy('sort')->orderByDesc('created_at')->limit(10)->get();
        if(empty($tours)) {
            $tours = Tours::where('status', 1)->orderBy('sort')->orderByDesc('created_at')->limit(10)->get();
        }
        $feedbacks = Feedbacks::where('status', 1)->orderBy('sort')->orderByDesc('created_at')->limit(12)->get();
        $newsHots = Contents::where('status', 1)->where('check', 1)->orderBy('sort')->orderByDesc('created_at')->limit(3)->get();
        return view('frontend.homepage.index', compact( 'locationHots', 'vouchers', 'hotels', 'tours', 'feedbacks', 'newsHots'));
    }

    public function introduce()
    {
        $contents = Introduces::whereNull('parent_id')->where('status', 1)->orderBy('sort')->get();
        $feedbacks = Feedbacks::where('status', 1)->orderBy('sort')->orderByDesc('created_at')->limit(12)->get();
        return view('frontend.introduces.index', compact('contents', 'feedbacks'));
    }
}
