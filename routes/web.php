<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ClaintController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingcostController;
use App\Http\Controllers\BkashController;
use Illuminate\Support\Facades\Route;
use App\Models\User;





Route::get('/front/dashboard', function () {
    return view('front.dashboard');
})->middleware(['auth', 'verified'])->name('front.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//HomeController without middleware
Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'home')->name('home');
         
});


//HomeController with middleware
Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function(){
        Route::get('/redirects', 'roleControll')->name('redirects');

       
    });
});



//ClaintController without middleware
Route::controller(ClaintController::class)->group(function(){
    Route::get('/front/pages/categoryPage/{id}/{slug}', 'CategoryPage')->name('front.pages.categoryPage');
    Route::get('/front/pages/singleProduct/{id}/{slug}', 'SingleProduct')->name('front.pages.singleProduct');
    Route::get('/front/pages/newReleasePage/', 'NewReleasePage')->name('front.pages.newReleasePage');
    
});


//ClaintController with middleware
Route::middleware('auth')->group(function () {
Route::controller(ClaintController::class)->group(function(){
    Route::get('/front/pages/todaysDeal', 'TodaysDeal')->name('front.pages.todaysDeal');
    Route::get('/front/pages/customService', 'CustomService')->name('front.pages.customService');
    Route::get('/front/pages/payment', 'payment')->name('front.pages.payment');
    Route::get('/front/pages/pendingOrders', 'pendingOrders')->name('front.pages.pendingOrders');
    Route::get('/front/pages/history', 'history')->name('front.pages.history');
    
   });

});


//CartController
Route::middleware('auth')->group(function () {
Route::controller(CartController::class)->group(function(){
    Route::get('/front/cart/index', 'index')->name('front.cart.index');
    Route::post('/front/cart/store', 'store')->name('front.cart.store');
    Route::post('/front/cart/update', 'updateQuantity')->name('front.cart.update');
    Route::get('/front/cart/delete/{id}', 'delete')->name('front.cart.delete');
    Route::get('/front/cart/count', 'getCartCount')->name('front.cart.count');
    
   });

});

//CheckoutController
Route::middleware('auth')->group(function () {
Route::controller(CheckoutController::class)->group(function(){
    Route::get('/front/checkout/index', 'index')->name('front.checkout.index');
    Route::get('/front/checkout/create', 'create')->name('front.checkout.create');
    Route::post('/front/checkout/store', 'store')->name('front.checkout.store');
    
    
   });

});


//OrderController
Route::middleware('auth')->group(function () {
Route::controller(OrderController::class)->group(function(){
    Route::get('/admin/order/index', 'index')->name('admin.order.index');
    Route::post('/front/order/store', 'store')->name('front.order.store');
    Route::get('/front/order/delivered/{id}', 'delivered')->name('front.order.delivered');
    Route::get('/admin/pdf/invoice/{id}', 'print_pdf')->name('admin.pdf.invoice');
    
   });

});




//Bkashcontroller-2

Route::middleware('auth')->group(function () {
    Route::controller(BkashTokenizePaymentController::class)->group(function(){
    // Payment Routes for bKash
    Route::get('/bkash/payment', 'index')->name('bkashT::bkash-payment');
    Route::get('/bkash/create-payment', 'createPayment')->name('bkash-create-payment');
    Route::get('/bkash/callback', 'callBack')->name('bkash.callBack');

    //search payment
    Route::get('/bkash/search/{trxID}', 'searchTnx')->name('bkash-serach');

    //refund payment routes
    Route::get('/bkash/refund', 'refund')->name('bkash-refund');
    Route::get('/bkash/refund/status','refundStatus')->name('bkash-refund-status');

});

});


//UserProfile
Route::middleware('auth')->group(function () {
Route::controller(ClaintController::class)->group(function(){
    Route::get('/front/userProfile/dashboard', 'UserProfile')->name('front.userProfile.dashboard');
    Route::get('/front/userProfile/history', 'History')->name('front.userProfile.history');
    Route::get('/front/userProfile/pendingOrders', 'PendingOrders')->name('front.userProfile.pendingOrders');
    
   });

});


// Category
Route::middleware('auth')->group(function () {
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/category/index', 'index')->name('admin.category.index');
        Route::get('/admin/category/create', 'create')->name('admin.category.create');
        Route::post('/admin/category/store', 'store')->name('admin.category.store');
        Route::get('/admin/category/edit/{id}', 'edit')->name('admin.category.edit');
        Route::post('/admin/category/update', 'update')->name('admin.category.update');
        Route::get('/admin/category/delete/{id}', 'delete')->name('admin.category.delete');
        // Route::get('category/{category_name}',  'redirectCategory')->name('category.redirect');

    });
});


// Color
Route::middleware('auth')->group(function () {
    Route::controller(ColorController::class)->group(function(){
        Route::get('/admin/color/index', 'index')->name('admin.color.index');
        Route::get('/admin/color/create', 'create')->name('admin.color.create');
        Route::post('/admin/color/store', 'store')->name('admin.color.store');
        Route::get('/admin/color/edit/{id}', 'edit')->name('admin.color.edit');
        Route::post('/admin/color/update', 'update')->name('admin.color.update');
        Route::get('/admin/color/delete/{id}', 'delete')->name('admin.color.delete');

    });
});


// Size
Route::middleware('auth')->group(function () {
    Route::controller(SizeController::class)->group(function(){
        Route::get('/admin/size/index', 'index')->name('admin.size.index');
        Route::get('/admin/size/create', 'create')->name('admin.size.create');
        Route::post('/admin/size/store', 'store')->name('admin.size.store');
        Route::get('/admin/size/edit/{id}', 'edit')->name('admin.size.edit');
        Route::post('/admin/size/update', 'update')->name('admin.size.update');
        Route::get('/admin/size/delete/{id}', 'delete')->name('admin.size.delete');

    });
});


// ShippingCost
Route::middleware('auth')->group(function () {
    Route::controller(ShippingcostController::class)->group(function(){
        Route::get('/admin/shippingcost/index', 'index')->name('admin.shippingcost.index');
        Route::get('/admin/shippingcost/create', 'create')->name('admin.shippingcost.create');
        Route::post('/admin/shippingcost/store', 'store')->name('admin.shippingcost.store');
        Route::get('/admin/shippingcost/delete/{id}', 'delete')->name('admin.shippingcost.delete');

    });
});




// Product
Route::middleware('auth')->group(function () {
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/product/index', 'index')->name('admin.product.index');
        Route::get('/admin/product/create', 'create')->name('admin.product.create');
        Route::post('/admin/product/store', 'store')->name('admin.product.store');
        Route::get('/admin/product/edit/{id}', 'edit')->name('admin.product.edit');
        Route::post('/admin/product/update/', 'update')->name('admin.product.update');
        Route::get('/admin/product/editImage/{id}', 'editImage')->name('admin.product.editImage');
        Route::post('/admin/product/updateImage/', 'updateImage')->name('admin.product.updateImage');
        Route::get('/admin/product/delete/{id}', 'delete')->name('admin.product.delete');

    });
});

 




require __DIR__.'/auth.php';
