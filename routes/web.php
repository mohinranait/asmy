<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\pageController;
use App\Http\Controllers\Backend\PrimaryCategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\UpzilaController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\AdminOrderController;

// Frontend Controller
use App\Http\Controllers\Frontend\FrontendPageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Frontend ajax route
Route::get('/user-dashboard/update/{id}' , [FrontendPageController::class , 'userDashboardDistrictFind']);
Route::get('/checkout/district/{id}' , [FrontendPageController::class , 'checkoutDistrict']);
Route::get('/ajax-cat' , [FrontendPageController::class , 'ajaxCat']);

// Frontend Route
Route::get('/' , [FrontendPageController::class , 'home'])->name('home');
Route::get('/products/{slug}' , [FrontendPageController::class , 'products'])->name('products');
Route::get('/shop-one' , [FrontendPageController::class , 'shopOne'])->name('shop.one');
Route::get('/shop-two' , [FrontendPageController::class , 'shopTwo'])->name('shop.two');
Route::get('/category/{slug}' , [FrontendPageController::class , 'categoryWishProduct'])->name('primary.category.wish.product');
Route::get('/sub-category/{slug}' , [FrontendPageController::class , 'subCategoryWishProduct'])->name('sub.category.wish.product');
Route::get('/offer-selling' , [FrontendPageController::class , 'offerSelling'])->name('offer.selling');

Route::post('/cart-store', [CartController::class,'productDetailsAddToCartStore'])->name('cart.store');
Route::get('/cart', [CartController::class,'cart'])->name('cart.page');
Route::get('cart/quintity/update' , [CartController::class , 'cartQuintity'])->name('cart.quintity');
Route::post('cart/quintity/delete/{id}' , [CartController::class , 'cartDelete'])->name('cart.delete');
Route::post("/added-to-cart" , [CartController::class , 'addedToCart'])->name('added.to.cart');

Route::middleware('auth')->group(function () {
    Route::get('/checkout',[FrontendPageController::class , 'checkout'])->name('checkout');
    Route::post('/order-store', [OrderController::class , 'orderStore'])->name('order.store');
    Route::get('/my-account' , [FrontendPageController::class , 'myAccount'] )->name('my.account');
    Route::post('/my-account-update/{id}' , [FrontendPageController::class , 'myAccountUpdate'])->name('myaccount.update');
});
// Route::get('/', [ProductController::class,'show']);
// Route::get('/product/{id}', [ProductController::class,'details'])->name('product.view');

// Backend ajax route
Route::get("/primary/category/find" , [PrimaryCategoryController::class , "primaryCategoryStatus"])->name('primary.category.status');
Route::get("/primary/category/keyup" , [PrimaryCategoryController::class , "primaryCategoryKeyup"])->name('primary/category/keyup');
Route::get("/sub/category/status" , [SubCategoryController::class , "subCategoryStatus"])->name('sub.category.status');
Route::get("/sub/category/keyup" , [SubCategoryController::class , "subCategoryKeyup"])->name('sub.category.keyup');
Route::get("/primary/category/find/with-sub-category/{id}" , [ProductController::class , "primayCategoryFidnWithSubCategory"]);
Route::get('/admin/order/district/{name}' , [AdminOrderController::class , 'orderdistrictUpdate']);
Route::get("/admin-user/update/district/{id}" , [UserController::class , "adminUserUpdateDistrict"]);


// Backend Route
Route::get('/admin-login' , [pageController::class , 'adminLogin'])->name('admin.login');
Route::middleware('auth','role')->group(function () {

    Route::group(['prefix' => "/admin"] , function(){
        Route::get('/dashboard' , [pageController::class , 'dashboard'])->name('admin.dashboard');

        // Product Route Group
        Route::group(['prefix' => "/products"],function(){
            Route::get('/index' , [ProductController::class , 'index'])->name('product.index');
            Route::get('/create' , [ProductController::class , 'create'])->name('product.create');
            Route::post('/store' , [ProductController::class , 'store'])->name('product.store');
            Route::get('/edit/{id}' , [ProductController::class , 'edit'])->name('product.edit');
            Route::post('/update/{id}' , [ProductController::class , 'update'])->name('product.update');
            Route::post('/destroy/{id}' , [ProductController::class , 'destroy'])->name('product.destroy');
            Route::get('/product.status' , [ProductController::class , 'productStatus'])->name('product.status');
            Route::get('/backend/product/keyup', [ProductController::class , 'backendProductKeyup'])->name('backend.product.keyup');
            // Route::match(['get','post'], 'product/attribute/{id}' , [ProductController::class , 'productAttribute'])->name('product.attribute');
            Route::get('/product/attribute/{id}' , [ProductController::class , 'productAtribute'])->name('product.attribute');
            Route::post('/product/store' , [ProductController::class , 'productStore'])->name('product.attribute.store');

            Route::post("/attribute/update" , [ProductController::class , 'attributeUpdate'])->name('attribute.update');
            Route::get("/attribute/delete/{id}" , [ProductController::class , 'attributeDelete'])->name('attribute.delete');
           
           
        });

        // Order Route Group
        Route::group(['prefix' => "/order"],function(){
            Route::get('/index' , [AdminOrderController::class , 'index'])->name('order.index');
            Route::get('/create' , [AdminOrderController::class , 'create'])->name('order.create');
            Route::post('/store' , [AdminOrderController::class , 'store'])->name('admin.order.store');
            Route::get('/show/{id}' , [AdminOrderController::class , 'show'])->name('order.show');
            Route::get('/edit/{id}' , [AdminOrderController::class , 'edit'])->name('order.edit');
            Route::post('/update/{id}' , [AdminOrderController::class , 'update'])->name('order.update');
            Route::get('/destroy/{id}' , [AdminOrderController::class , 'destroy'])->name('order.destroy');
           
        });

        // Slider Route Group
        Route::group(['prefix' => "/sliders"],function(){
            Route::get('/index' , [SliderController::class , 'index'])->name('slider.index');
            Route::get('/create' , [SliderController::class , 'create'])->name('slider.create');
            Route::post('/store' , [SliderController::class , 'store'])->name('slider.store');
            Route::get('/edit/{id}' , [SliderController::class , 'edit'])->name('slider.edit');
            Route::post('/update/{id}' , [SliderController::class , 'update'])->name('slider.update');
            Route::get('/destroy/{id}' , [SliderController::class , 'destroy'])->name('slider.destroy');
            Route::get('/destroy' , [SliderController::class , 'sliderStatus'])->name('slider.status');
        });

        // Category Route Group
        Route::group(['prefix' => "/primary/category"],function(){
            Route::get('/index' , [PrimaryCategoryController::class , 'index'])->name('category.index');
            Route::get('/create' , [PrimaryCategoryController::class , 'create'])->name('category.create');
            Route::post('/store' , [PrimaryCategoryController::class , 'store'])->name('category.store');
            Route::get('/edit/{id}' , [PrimaryCategoryController::class , 'edit'])->name('category.edit');
            Route::post('/update/{id}' , [PrimaryCategoryController::class , 'update'])->name('category.update');
            Route::post('/destroy/{id}' , [PrimaryCategoryController::class , 'destroy'])->name('category.destroy');
        });

        // Sub Category Route Group
        Route::group(['prefix' => "/sub/category"],function(){
            Route::get('/index' , [SubCategoryController::class , 'index'])->name('sub.category.index');
            Route::get('/create' , [SubCategoryController::class , 'create'])->name('sub.category.create');
            Route::post('/store' , [SubCategoryController::class , 'store'])->name('sub.category.store');
            Route::get('/edit/{id}' , [SubCategoryController::class , 'edit'])->name('sub.category.edit');
            Route::post('/update/{id}' , [SubCategoryController::class , 'update'])->name('sub.category.update');
            Route::post('/destroy/{id}' , [SubCategoryController::class , 'destroy'])->name('sub.category.destroy');
        });

        // District Route Group
        Route::group(['prefix' => "/district"],function(){
            Route::get('/index' , [DistrictController::class , 'index'])->name('district.index');
            Route::post('/store' , [DistrictController::class , 'store'])->name('district.store');
            Route::get('/edit/{id}' , [DistrictController::class , 'edit'])->name('district.edit');
            Route::post('/update/{id}' , [DistrictController::class , 'update'])->name('district.update');
            Route::post('/destroy/{id}' , [DistrictController::class , 'destroy'])->name('district.destroy');
            Route::get('/district/status' , [DistrictController::class, 'districtStatus'])->name("district.status");
        });

        // Upzila Route Group
        Route::group(['prefix' => "/upzilas"],function(){
            Route::get('/upzila/keyup' , [UpzilaController::class , "upzilaKeyup"])->name('upzila.keyup');
            Route::get('/index' , [UpzilaController::class , 'index'])->name('upzila.index');
            Route::post('/store' , [UpzilaController::class , 'store'])->name('upzila.store');
            Route::get('/edit/{id}' , [UpzilaController::class , 'edit'])->name('upzila.edit');
            Route::post('/update/{id}' , [UpzilaController::class , 'update'])->name('upzila.update');
            Route::post('/destroy/{id}' , [UpzilaController::class , 'destroy'])->name('upzila.destroy');
            Route::get('/upzila/status' , [UpzilaController::class, 'upzilaStatus'])->name("upzila.status");
        });

        // User Route Group
        Route::group(['prefix' => "/users"],function(){
            Route::get('/index' , [UserController::class , 'index'])->name('user.index');
            Route::post('/store' , [UserController::class , 'store'])->name('user.store');
            Route::get('/edit/{id}' , [UserController::class , 'edit'])->name('user.edit');
            Route::post('/update/{id}' , [UserController::class , 'update'])->name('user.update');
            Route::post('/destroy/{id}' , [UserController::class , 'destroy'])->name('user.destroy');
            Route::get('/user/status' , [UserController::class, 'userStatus'])->name("user.status");
            Route::get('/user/keyup' , [UserController::class , "upzilaKeyup"])->name('user.keyup');
        });

        // User Route Group
        Route::group(['prefix' => "/brands"],function(){
            Route::get('/index' , [BrandController::class , 'index'])->name('brand.index');
            Route::post('/store' , [BrandController::class , 'store'])->name('brand.store');
            Route::get('/edit/{id}' , [BrandController::class , 'edit'])->name('brand.edit');
            Route::post('/update/{id}' , [BrandController::class , 'update'])->name('brand.update');
            Route::post('/destroy/{id}' , [BrandController::class , 'destroy'])->name('brand.destroy');
            Route::get('/brand/status' , [BrandController::class, 'brandStatus'])->name("brand.status");
            Route::get('/brand/keyup' , [BrandController::class , "brandKeyup"])->name('brand.keyup');
        });

        // Color Route Group
        Route::group(['prefix' => "/color"],function(){
            Route::get('/index' , [ColorController::class , 'index'])->name('color.index');
            Route::post('/store' , [ColorController::class , 'store'])->name('color.store');
            Route::get('/edit/{id}' , [ColorController::class , 'edit'])->name('color.edit');
            Route::post('/update/{id}' , [ColorController::class , 'update'])->name('color.update');
            Route::post('/destroy/{id}' , [ColorController::class , 'destroy'])->name('color.destroy');
            Route::get('/color/status' , [ColorController::class, 'colorStatus'])->name("color.status");
            Route::get('/color/keyup' , [ColorController::class , "colorKeyup"])->name('color.keyup');
        });
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
