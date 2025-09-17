<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\IntroducesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageInfoController;
use App\Http\Controllers\Admin\LocactionsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\HotelsController;
use App\Http\Controllers\Admin\VouchersController;
use App\Http\Controllers\Admin\ComfortsController;
use App\Http\Controllers\Admin\ComfortChildsController;
use App\Http\Controllers\Admin\ComfortSpecialsController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\HotelVouchersController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\VillaBannersController;
use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\FiltersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ToursController;
use App\Http\Controllers\Admin\SchedulesController;
use App\Http\Controllers\Admin\TourHotelsController;
use App\Http\Controllers\Admin\FeedbacksController;
use App\Http\Controllers\Admin\RedirectsController;
use App\Http\Controllers\Admin\CtasController;
use App\Http\Controllers\Admin\SitemapsController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\HomeController;


//---------Backend--------

Route::get('/admin', function () {
    return redirect('/dashboard');
})->name('dashboard');
Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth');

//----------Login--------
Route::get('login', [LoginController::class, 'getLogin'])->name('login');
Route::group(array('prefix' => 'admin/'), function () {
    Route::post('postLogin', [LoginController::class, 'postLogin']);
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('forgotPassword', [LoginController::class, 'forgotPassword']);
    Route::post('postForgotPassword', [AdminController::class, 'forgotPassword'])->name('admin.post_forgotpassword');

});

Route::group(array('prefix' => 'admin/', 'middleware' => 'auth'), function () {
    Route::middleware(['checkRole:admin'])->group(function () {
        //Users
        Route::post('changeStatusUser/{id}', [UsersController::class, 'changeStatusUser'])->name('users.changeStatus');
        Route::post('changePassword', [UsersController::class, 'changePassword'])->name('admin.changePassword');
        Route::get('profile', [UsersController::class, 'profile']);
        Route::post('updateProfile', [UsersController::class, 'updateProfile']);
        Route::post('changeStatusUser/{id}', [UsersController::class, 'changeStatusUser']);
        Route::post('deleteUsers/{id}', [UsersController::class, 'deleteUsers']);
    });

    Route::middleware(['checkRole:admin,staff'])->group(function () {
        Route::resource('banners', BannersController::class);
        Route::resource('villa_banners', VillaBannersController::class);
        Route::resource('categories', CategoriesController::class);
        Route::resource('locations', LocactionsController::class);
        Route::resource('areas', AreasController::class);
        Route::resource('hotels', HotelsController::class);
        Route::resource('tours', ToursController::class);
        Route::resource('tour_hotels', TourHotelsController::class);
        Route::resource('feedbacks', FeedbacksController::class);
        Route::resource('schedules', SchedulesController::class);
        Route::resource('rooms', RoomsController::class);
        Route::resource('comforts', ComfortsController::class);
        Route::resource('comfort_specials', ComfortSpecialsController::class);
        Route::resource('comfort_childs', ComfortChildsController::class);
        Route::resource('contacts', ContactsController::class);
        Route::resource('info', PageInfoController::class);
        Route::resource('introduces', IntroducesController::class);
        Route::resource('contact_page', ContactPageController::class);
        Route::resource('vouchers', VouchersController::class);
        Route::resource('filters', FiltersController::class);
        Route::resource('hotel_vouchers', HotelVouchersController::class);
        Route::resource('comments', CommentsController::class);
        Route::resource('users', UsersController::class);
        Route::resource('redirects', RedirectsController::class);
        Route::resource('ctas', CtasController::class);
        Route::resource('pages', PagesController::class);
        Route::resource('sitemaps', SitemapsController::class);
        Route::get('orders/approve/{order}/{status}', [OrdersController::class, 'approveOrder'])->name('orders.approve');
        Route::post('orders/approve/order/villa', [OrdersController::class, 'approveOrderVilla'])->name('orders.approve_villa');
        Route::get('orders/un-approve/{order}/{status}', [OrdersController::class, 'unApproveOrder'])->name('orders.unapprove');
        Route::get('orders/checkout/{order}/{status}', [OrdersController::class, 'checkout'])->name('orders.checkout');
        Route::resource('orders', OrdersController::class);
        Route::get('room_list/{id}', [RoomsController::class, 'list_all'])->name('rooms.list');
        Route::get('rooms/create/{id}', [RoomsController::class, 'create'])->name('rooms.create_new');
        Route::get('hotel/type/{type}', [HotelsController::class, 'listAll'])->name('hotels.listAll');
        Route::get('hotel/create/{type}', [HotelsController::class, 'create'])->name('hotels.createNew');
        Route::get('hotel_vouchers/create/{id}', [HotelVouchersController::class, 'create'])->name('hotel_vouchers.create_new');
        Route::get('comforts/type/{type}', [ComfortsController::class, 'listAll'])->name('comforts.listAll');
        Route::get('comfort_child/create/{id}', [ComfortChildsController::class, 'createChild'])->name('comfort_childs.create_new');
        Route::get('remove-image-tour', [ToursController::class, 'destroyImage'])->name('tours.destroyImage');
        Route::get('remove-image-hotel', [HotelsController::class, 'destroyImage'])->name('hotels.destroyImage');
        Route::get('remove-image-room', [RoomsController::class, 'destroyImage'])->name('rooms.destroyImage');
        Route::get('remove-image-comment', [CommentsController::class, 'destroyImage'])->name('comments.destroyImage');
        Route::get('get-area-by-location', [LocactionsController::class, 'getAreasByLocation'])->name('locations.list_area');
        Route::get('comfort-villas/{type?}', [ComfortsController::class, 'editComfortVillas'])->name('comfort_villas.edit');
        Route::get('list-comfort/{type?}', [ComfortsController::class, 'listComfort'])->name('comfort_villas.listComfort');
        Route::put('comfort-villas-update', [ComfortsController::class, 'updateComfortVillas'])->name('comfort_villas.update');
        Route::get('list-location/{region?}', [LocactionsController::class, 'listRegion'])->name('locations.region');
        Route::get('set-location', [LocactionsController::class, 'setHidden'])->name('locations.set_hidden');
        Route::post('change-status', [LocactionsController::class, 'changeStatus'])->name('locations.change_status');
    });

    Route::middleware(['checkRole:admin,staff,user'])->group(function () {
        Route::resource('news', NewsController::class);
        Route::post('news/create-news-content', [NewsController::class, 'storeNews'])->name('news.createNews');
        Route::put('update-news-content', [NewsController::class, 'updateNews'])->name('news.updateNews');
    });
    Route::post('ckeditor/image-upload', [AdminController::class, 'upload'])->name('upload');
    Route::get('changeStatusContact/{id}', [ContactsController::class, 'changeStatus'])->name('contacts.changeStatus');

});

//---------Frontend--------

Route::group(array('prefix' => 'tai-khoan'), function () {
    Route::get('thong-tin-tai-khoan', [\App\Http\Controllers\CustomersController::class, 'index'])->name('customers.index');
    Route::post('cap-nhat-thong-tin', [\App\Http\Controllers\CustomersController::class, 'postUpdateProfile'])->name('customers.update');
    Route::post('huy-don-dat-phong', [\App\Http\Controllers\CustomersController::class, 'cancelOrder'])->name('customers.cancel_order');
    Route::get('dang-ky', [\App\Http\Controllers\CustomersController::class, 'register'])->name('customers.register');
    Route::post('gui-dang-ky', [\App\Http\Controllers\CustomersController::class, 'postRegister'])->name('customers.post_register');
    Route::get('dang-nhap', [\App\Http\Controllers\CustomersController::class, 'login'])->name('customers.login');
    Route::post('gui-dang-nhap', [\App\Http\Controllers\CustomersController::class, 'postLogin'])->name('customers.post_login');
    Route::post('doi-mat-khau', [\App\Http\Controllers\CustomersController::class, 'changePassword'])->name('customers.change_password');
    Route::post('cap-lai-mat-khau', [\App\Http\Controllers\CustomersController::class, 'resetPassword'])->name('customers.reset_password');
    Route::get('dang-xuat', [\App\Http\Controllers\CustomersController::class, 'logout'])->name('customers.logout');
    Route::get('kich-hoat-tai-khoan/{email?}', [\App\Http\Controllers\CustomersController::class, 'activeAccount'])->name('customers.activeAccount');
    Route::post('gui-danh-gia', [\App\Http\Controllers\CustomersController::class, 'sendComment'])->name('customers.comment');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('gioi-thieu', [HomeController::class, 'introduce'])->name('about.index');
Route::get('tin-tuc', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.list');
Route::get('lien-he', [\App\Http\Controllers\ContactsController::class, 'index'])->name('contact.index');
Route::get('tim-kiem/{type?}', [\App\Http\Controllers\HotelsController::class, 'search'])->name('hotels.search');
Route::get('danh-sach-flash-sale', [\App\Http\Controllers\HotelsController::class, 'listFlashSale'])->name('hotels.list_flash_sale');
Route::get('danh-sach-yeu-thich', [\App\Http\Controllers\HotelsController::class, 'listHotelLove'])->name('hotels.list_hotel_love');
Route::get('them-vao-danh-sach-yeu-thich/{id?}', [\App\Http\Controllers\HotelsController::class, 'addFavoristList'])->name('hotels.add_favorite_list');
Route::get('them-vao-danh-sach-so-sanh/{id?}', [\App\Http\Controllers\HotelsController::class, 'addCompareList'])->name('hotels.add_compare_list');
Route::get('xoa-khoi-danh-sach-so-sanh/{id?}', [\App\Http\Controllers\HotelsController::class, 'removeCompareList'])->name('hotels.remove_compare_list');
Route::get('loc-danh-gia-theo-sao', [\App\Http\Controllers\CommentsController::class, 'filterComment'])->name('comments.filter_by_star');
Route::get('loc-danh-gia/{filter?}', [\App\Http\Controllers\CommentsController::class, 'filter'])->name('comments.filter');
Route::get('danh-sach-flash-sale', [\App\Http\Controllers\HotelsController::class, 'listFlashSale'])->name('hotels.list_flash_sale');
Route::get('loc-view/{type?}', [\App\Http\Controllers\LocationsController::class, 'filter'])->name('locations.filter');
Route::get('loc-tim-kiem', [\App\Http\Controllers\LocationsController::class, 'searchLocation'])->name('locations.search');
Route::get('loc-phong', [\App\Http\Controllers\HotelsController::class, 'filterRoom'])->name('rooms.filter_room');
Route::get('loc-theo-tieu-chi', [\App\Http\Controllers\HotelsController::class, 'filterHotels'])->name('hotels.filter_by');
Route::get('loc-nhieu-dieu-kien', [\App\Http\Controllers\HotelsController::class, 'filterList'])->name('hotels.filter_list');
Route::get('loc-khach-san-random/{type?}', [\App\Http\Controllers\HotelsController::class, 'filter'])->name('hotels.filter');
Route::get('loc-flash-sale', [\App\Http\Controllers\HotelsController::class, 'filterFlashSale'])->name('hotels.filter_flash_sale');
Route::get('loc-khach-san-theo-gia-soc/{type?}', [\App\Http\Controllers\HotelsController::class, 'filterPriceHots'])->name('hotels.filter_price_hots');
Route::get('loc-khach-san-thinh-hanh/{type?}', [\App\Http\Controllers\HotelsController::class, 'filterPopular'])->name('hotels.filter_popular');
Route::get('loc-dia-diem/{type?}/{location?}', [\App\Http\Controllers\HotelsController::class, 'filterLocation'])->name('hotels.filter_location');
Route::get('tim-kiem-tien-ich', [\App\Http\Controllers\HotelsController::class, 'searchComfort'])->name('search.comfort');
Route::get('danh-sach-{type}/{location}', [\App\Http\Controllers\HotelsController::class, 'listLocation'])->name('hotels.list_location');
Route::post('dat-phong', [\App\Http\Controllers\HotelsController::class, 'book'])->name('hotels.book_room');
Route::post('dat-phong-villa', [\App\Http\Controllers\HotelsController::class, 'bookVilla'])->name('hotels.book_room_villa');
Route::get('tin-tuc/{slug}-{id}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.detail');
Route::get('khach-sạn', [\App\Http\Controllers\HotelsController::class, 'list'])->name('hotels.list');
Route::get('khach-sạn/{slug}-{id}', [\App\Http\Controllers\HotelsController::class, 'detail'])->name('hotels.detail');
Route::get('tours', [\App\Http\Controllers\ToursController::class, 'list'])->name('tours.list');
Route::get('tour/{slug}-{id}', [\App\Http\Controllers\ToursController::class, 'detail'])->name('tours.detail');
Route::get('danh-sach/{type}', [\App\Http\Controllers\HotelsController::class, 'viewMore'])->name('hotels.view_more');

Route::post('gui-lien-he', [\App\Http\Controllers\ContactsController::class, 'store'])->name('contact.send_contact');



