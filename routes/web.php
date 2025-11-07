<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\BlogListController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\DashboardController as FrontendDashboardController;

use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\MmberController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\RegisterController as FrontendRegisterController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('admin.logout');

Route::group([
    'middleware' => ['check']
], function () {

    Route::get('/member/register', [FrontendUserController::class, 'GetRegister'])->name('register');
    Route::post('/member/register', [FrontendUserController::class, 'PostRegister'])->name('register');
    Route::get('/member/login', [FrontendUserController::class, 'GetMemberLogin'])->name('memberlogin');
    Route::post('/member/login', [FrontendUserController::class, 'PostMemberLogin'])->name('memberlogin');
    Route::get('/forgot', [FrontendUserController::class, 'GetForgot'])->name('forgot');
    Route::post('/forgot', [FrontendUserController::class, 'PostForgot'])->name('forgot');
    Route::get('/changePassword', [FrontendUserController::class, 'GetchangePassword'])->name('changePassword');
    Route::post('/changePassword', [FrontendUserController::class, 'PostchangePassword'])->name('changePassword');
});
Route::group([
    'middleware' => ['admin']
], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/country', [CountryController::class, 'list'])->name('country');
    Route::get('/admin/country/add', [CountryController::class, 'GetAdd']);
    Route::post('/admin/country/add', [CountryController::class, 'PostAdd']);
    Route::get('/admin/country/edit/{id}', [CountryController::class, 'GetEdit']);
    Route::post('/admin/country/edit/{id}', [CountryController::class, 'PostEdit']);
    Route::get('/admin/country/delete/{id}', [CountryController::class, 'Delete']);


    Route::get('/admin/category', [CategoryController::class, 'list'])->name('category');
    Route::get('/admin/category/add', [CategoryController::class, 'GetAdd']);
    Route::post('/admin/category/add', [CategoryController::class, 'PostAdd']);
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'GetEdit']);
    Route::post('/admin/category/edit/{id}', [CategoryController::class, 'PostEdit']);
    Route::get('/admin/category/delete/{id}', [CategoryController::class, 'Delete']);

    Route::get('/admin/brand', [BrandController::class, 'list'])->name('brand');
    Route::get('/admin/brand/add', [BrandController::class, 'GetAdd']);
    Route::post('/admin/brand/add', [BrandController::class, 'PostAdd']);
    Route::get('/admin/brand/edit/{id}', [BrandController::class, 'GetEdit']);
    Route::post('/admin/brand/edit/{id}', [BrandController::class, 'PostEdit']);
    Route::get('/admin/brand/delete/{id}', [BrandController::class, 'Delete']);

    Route::get('/admin/blog', [BlogController::class, 'list'])->name('blog');
    Route::get('/admin/blog/add', [BlogController::class, 'GetAdd']);
    Route::post('/admin/blog/add', [BlogController::class, 'PostAdd']);
    Route::get('/admin/blog/edit/{id}', [BlogController::class, 'GetEdit']);
    Route::post('/admin/blog/edit/{id}', [BlogController::class, 'PostEdit']);
    Route::get('/admin/blog/delete/{id}', [BlogController::class, 'Delete']);

    Route::get('/admin/profile', [UserController::class, 'GetProfile'])->name('profile');
    Route::post('/admin/profile', [UserController::class, 'PostProfile'])->name('profile');

    Route::get('/admin/user', [UserController::class, 'GetUser'])->name('user');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'GetEdit']);
    Route::post('/admin/user/edit/{id}', [UserController::class, 'PostEdit']);
    Route::get('/admin/user/delete/{id}', [UserController::class, 'Delete']);

    Route::get('/admin/product', [AdminProductController::class, 'GetProduct'])->name('product');
    Route::get('/admin/product/edit/{id}', [AdminProductController::class, 'GetEdit']);
    Route::post('/admin/product/edit/{id}', [AdminProductController::class, 'PostEdit']);
    Route::get('/admin/product/delete/{id}', [AdminProductController::class, 'Delete']);

    Route::get('/admin/order', [OrderController::class, 'GetOrder'])->name('product');
});

Route::get('/member/dashboard', [FrontendDashboardController::class, 'index'])->name('member.dashboard');
// Route::post('/member/dashboard', [FrontendDashboardController::class, 'index'])->name('member.dashboard');

Route::group([
    'middleware' => ['member']
], function () {



    Route::get('/member/bloglist', [BlogListController::class, 'bloglist'])->name('bloglist');
    Route::get('/member/blogdetail/{id}', [BlogListController::class, 'blogdetail'])->name('blogdetail');
    Route::post('/member/blogdetail/{id}', [BlogListController::class, 'blogdetail'])->name('blogdetail');
    Route::post('/member/blog/rate/ajax', [BlogListController::class, 'rate'])->name('blograte');
    // Route::post('/member/blogdetail/cmt/{id}', [BlogListController::class, 'cmt'])->name('blogcmt');

    Route::post('/member/blog/cmt/ajax', [BlogListController::class, 'cmt'])->name('blogcmt');
    // Route::post('/logout', function () {
    //     Auth::logout();
    //     return redirect('/member/login'); // hoặc về trang login
    // })->name('logout');
    Route::get('/member/logout', [FrontendUserController::class, 'logout']);
    Route::post('/member/blog/reply/ajax', [BlogListController::class, 'reply'])->name('blogreply');
    Route::get('/member/update', [AccountController::class, 'GetAccount'])->name('account.update');
    Route::post('/member/update', [AccountController::class, 'PostAccount'])->name('account.update');
    Route::get('/member/myproduct', [AccountController::class, 'myproduct'])->name('account.myproduct');
    Route::get('/member/addproduct', [AccountController::class, 'GetProduct'])->name('account.addproduct');
    Route::post('/member/addproduct', [AccountController::class, 'PostProduct'])->name('account.addproduct');
    Route::get('/member/editproduct/{id}', [AccountController::class, 'GetEdit'])->name('account.editproduct');
    Route::post('/member/editproduct/{id}', [AccountController::class, 'PostEdit'])->name('account.editproduct');
    Route::get('/member/deleteproduct/{id}', [AccountController::class, 'GetDelete'])->name('account.deleteproduct');
    Route::get('/member/product/detail/{id}', [ProductController::class, 'ProductDetail'])->name('productdetail');

    Route::post('/member/dashboard/ajax', [FrontendDashboardController::class, 'cartajax'])->name('cart');
    Route::post('/member/dashboard/ajaxdown', [FrontendDashboardController::class, 'cartajaxdown'])->name('cart');
    Route::post('/member/dashboard/ajaxdel', [FrontendDashboardController::class, 'cartajaxdel'])->name('cart');


    Route::get('/member/cart', [CartController::class, 'cart'])->name('cart');
    Route::get('/member/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/member/checkout', [CartController::class, 'Postcheckout'])->name('checkoutcart');
    // Route::post('/member/cart/ajax', [CartController::class, 'cart'])->name('cart');
    // Route::get("send-mail", [MailController::class, 'index']);
    Route::post('/member/search', [FrontendDashboardController::class, 'Search'])->name('member.search');
    Route::get('/member/searchadvance', [FrontendDashboardController::class, 'GetSearch'])->name('member.searchadvance');
    Route::post('/member/searchadvance', [FrontendDashboardController::class, 'SearchAdvance'])->name('member.searchadvance');
    Route::post('/member/slide_search/ajax', [FrontendDashboardController::class, 'slidesearchajax'])->name('slidesearchajax');
});

// Route::post('/member/search/ajax', [FrontendDashboardController::class, 'searchajax'])->name('search');


// use Image;

// Route::get('/test-image', function () {
//     $img = Image::make(public_path('images/test.jpg'))->resize(300, 200);
//     $img->save(public_path('images/test_resized.jpg'));
//     return 'Đã xử lý xong ảnh!';
// });