<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Categories;
use App\Models\Category;
use App\Models\Comforts;
use App\Models\Contents;
use App\Models\Filters;
use App\Models\Hotels;
use App\Models\Locations;
use App\Models\PageInfo;
use App\Models\Vouchers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {
            $minutes = 60;

//            $hotel_categories = Locations::where('status', 1)
//                ->whereHas('hotels', function($query) {
//                    $query->where('type', Comforts::KS)->where('status', 1);
//                })
//                ->orderBy('region', 'asc')
//                ->orderBy('sort', 'asc')
//                ->get()
//                ->groupBy('region')
//                ->map(function($region) {
//                    return $region->sortBy('sort');
//                });
//            View::share('hotel_categories', $hotel_categories);
//            Cache::put('hotel_categories', $hotel_categories, $minutes);
//
//            $villa_categories = Locations::where('status', 1)
//                ->whereHas('hotels', function($query) {
//                    $query->where('type', Comforts::TO)->where('status', 1);
//                })
//                ->orderBy('region', 'asc')
//                ->orderBy('sort', 'asc')
//                ->get()
//                ->groupBy('region')
//                ->map(function($region) {
//                    return $region->sortBy('sort');
//                });
//            View::share('villa_categories', $villa_categories);
//            Cache::put('villa_categories', $villa_categories, $minutes);
//
//            $homestay_categories = Locations::where('status', 1)
//                ->whereHas('hotels', function($query) {
//                    $query->where('type', Comforts::HS)->where('status', 1);
//                })
//                ->orderBy('region', 'asc')
//                ->orderBy('sort', 'asc')
//                ->get()
//                ->groupBy('region')
//                ->map(function($region) {
//                    return $region->sortBy('sort');
//                });
//            View::share('homestay_categories', $homestay_categories);
//            Cache::put('homestay_categories', $homestay_categories, $minutes);
//
//            $resort_categories = Locations::where('status', 1)
//                ->whereHas('hotels', function($query) {
//                    $query->where('type', Comforts::RS)->where('status', 1);
//                })
//                ->orderBy('region', 'asc')
//                ->orderBy('sort', 'asc')
//                ->get()
//                ->groupBy('region')
//                ->map(function($region) {
//                    return $region->sortBy('sort');
//                });
//            View::share('resort_categories', $resort_categories);
//            Cache::put('resort_categories', $resort_categories, $minutes);
//
//            $yacht_categories = Locations::where('status', 1)
//                ->whereHas('hotels', function($query) {
//                    $query->where('type', Comforts::DT)->where('status', 1);
//                })
//                ->orderBy('sort', 'asc')
//                ->get();
//            View::share('yacht_categories', $yacht_categories);
//            Cache::put('yacht_categories', $yacht_categories, $minutes);
//
//            $hotelCategories = Hotels::where('status', 1)->where('type', Comforts::KS)->orderBy('created_at', 'desc')->get();
//            View::share('hotelCategories', $hotelCategories);
//            Cache::put('hotelCategories', $hotelCategories, $minutes);
//
//            $villaCategories = Hotels::where('status', 1)->where('type', Comforts::TO)->orderBy('created_at', 'desc')->get();
//            View::share('villaCategories', $villaCategories);
//            Cache::put('villaCategories', $villaCategories, $minutes);
//
//            $homestayCategories = Hotels::where('status', 1)->where('type', Comforts::HS)->orderBy('created_at', 'desc')->get();
//            View::share('homestayCategories', $homestayCategories);
//            Cache::put('homestayCategories', $homestayCategories, $minutes);
//
//            $resortCategories = Hotels::where('status', 1)->where('type', Comforts::RS)->orderBy('created_at', 'desc')->get();
//            View::share('resortCategories', $resortCategories);
//            Cache::put('resortCategories', $resortCategories, $minutes);
//
//            $yachtCategories = Hotels::where('status', 1)->where('type', Comforts::DT)->orderBy('created_at', 'desc')->get();
//            View::share('yachtCategories', $yachtCategories);
//            Cache::put('yachtCategories', $yachtCategories, $minutes);
//
//            $locations = Locations::where('status', 1)->orderBy('sort', 'asc')->get();
//            View::share('locations', $locations);
//            Cache::put('locations', $locations, $minutes);
//
//            $locationSearch = Locations::select('name', 'image', 'slug')->where('status', 1)->where('check', 1)->orderBy('sort', 'asc')->get();
//            View::share('locationSearch', $locationSearch);
//            Cache::put('locationSearch', $locationSearch, $minutes);
//
//            $locationFooter = Locations::select('name', 'slug')->where('status', 1)->orderBy('sort', 'asc')->get();
//            View::share('locationFooter', $locationFooter);
//            Cache::put('locationFooter', $locationFooter, $minutes);
//
//            $vouchers = Vouchers::where('status', 1)->orderBy('created_at', 'desc')->get();
//            View::share('vouchers', $vouchers);
//            Cache::put('vouchers', $vouchers, $minutes);
//
//            $comforts = Comforts::where('status', 1)->orderBy('parent_id', 'asc')->get();
//            View::share('comforts', $comforts);
//            Cache::put('comforts', $comforts, $minutes);
//
//            $listComfort = Comforts::where('status', 1)->whereNotNull('parent_id')->orderBy('parent_id', 'asc')->where('type', Comforts::TO)->get();
//            View::share('listComfort', $listComfort);
//            Cache::put('listComfort', $listComfort, $minutes);
//
            $banners = Banner::where('status', Banner::IS_ACTIVE)->where('type', '=', Banner::TYPE_BANNER)->orderBy('sort', 'asc')->get();
            View::share('banners', $banners);
            Cache::put('banners', $banners, $minutes);

            $terms = Contents::where('status', 1)->where('type', Contents::CHINH_SACH)->orderBy('sort')->orderByDesc('created_at')->get();
            View::share('terms', $terms);
            Cache::put('terms', $terms, $minutes);
//
            $pageInfo = PageInfo::first();
            View::share('pageInfo', $pageInfo);
            Cache::put('pageInfo', $pageInfo, $minutes);

            $customerAuth = Auth()->guard('customer')->user();
            View::share('customerAuth', $customerAuth);
            Cache::put('customerAuth', $customerAuth, $minutes);
//
//            $listFilter = Filters::orderBy('sort')->where('status', 1)->get();
//            View::share('listFilter', $listFilter);
//            Cache::put('listFilter', $listFilter, $minutes);

            $agent = new \Jenssegers\Agent\Agent();
            View::share('agent', $agent);
            Cache::put('agent', $agent, $minutes);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return voidQuản
     */
    public function boot()
    {
        if(env('APP_ENV') != 'local'){
            $this->app['request']->server->set('HTTP','on');
        }
    }
}
