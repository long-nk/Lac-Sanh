<?php

namespace App\Providers;

use App\Models\Pages;
use App\Models\PageInfo;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $currentUrl = Request::fullUrl();

            $pageInfo = PageInfo::first();

            $normalizedUrl = rtrim($currentUrl, '/');

            $page = Pages::where('link', $normalizedUrl)->first();

            $titleSeo = $page->title_seo ?? '';
            $metaDesc = $page->summary ?? '';
            $imageSeo = asset($page->image ?? $pageInfo->logo);

            $view->with('titleSeo', $titleSeo)
                ->with('metaDesc', $metaDesc)
                ->with('imageSeo', $imageSeo);
        });
    }
}
