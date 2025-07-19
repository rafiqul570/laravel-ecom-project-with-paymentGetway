<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\SubCategoryController;
use App\Http\Controllers\Product\BrandController;
use App\Http\Controllers\Product\ColorController;
use App\Http\Controllers\product\SizeController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ShippingController;
use App\Http\Controllers\Order\CartController;
use App\Http\Controllers\Order\BillingController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\PaymentController;
use App\Http\Controllers\PaymentGetway\BkashTokenizePaymentController;
use App\Http\Controllers\PaymentGetway\StripePaymentController;
use App\Http\Controllers\PaymentGetway\InvoiceController;
use App\Http\Controllers\ClaintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;


use App\Models\User;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);



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
Route::middleware('auth', 'verified')->group(function () {
    Route::controller(HomeController::class)->group(function(){
        Route::get('/redirects', 'roleControll')->name('redirects');

       
    });
});



//ClaintController without middleware
Route::controller(ClaintController::class)->group(function(){
    Route::get('/front/pages/categoryPage/{id}/{slug}', 'categoryPage')->name('front.pages.categoryPage');
   
    Route::get('/front/pages/subCategoryPage/{id}/{slug}', 'subCategoryPage')->name('front.pages.subCategoryPage');
    
    Route::get('/front/pages/newReleasePage/', 'NewReleasePage')->name('front.pages.newReleasePage');


});





//CartController
Route::middleware('auth')->group(function () {
Route::controller(CartController::class)->group(function(){
    Route::get('/cart', 'index')->name('cart');
    Route::post('/cart/store', 'store')->name('cart.store');
    Route::post('/cart/update', 'updateQuantity')->name('cart.update');
    Route::get('/cart/delete/{id}', 'delete')->name('cart.delete');
    Route::get('/cart/count', 'getCartCount')->name('cart.count');
    
   });

});

//BillingController
Route::middleware('auth')->group(function () {
Route::controller(BillingController::class)->group(function(){
    Route::get('/billing', 'shippingAddress')->name('billing');
    Route::get('/billing/create', 'create')->name('billing.create');
    Route::post('/billing/store', 'store')->name('billing.store');
    
    
   });

});



//OrderController
Route::middleware('auth')->group(function () {
Route::controller(OrderController::class)->group(function(){
    
    Route::get('/admin/order', 'order')->name('admin.order');
    
    Route::get('/admin/pdf/invoice/{id}', 'print_pdf')->name('admin.pdf.invoice');
    
    Route::get('/admin/send_email/{id}', 'send_email')->name('admin.send_email');
    
    Route::post('/admin/send_user_email/{id}', 'send_user_email')->name('admin.send_user_email');

  
    Route::post('/order/store', 'store')->name('order.store');
    
    Route::get('/order/delivered/{id}', 'delivered')->name('order.delivered');
    
    Route::get('/pendingOrders', 'pendingOrders')->name('pendingOrders');

    Route::get('/orders/thankyou', 'orders_confurm')->name('orders.thankyou');
    
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

    });
});


// SubCategory
Route::middleware('auth')->group(function () {
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/subCategory/index', 'index')->name('admin.subCategory.index');
        Route::get('/admin/subCategory/create', 'create')->name('admin.subCategory.create');
        Route::post('/admin/subCategory/store', 'store')->name('admin.subCategory.store');
        Route::get('/admin/categsubCategoryory/edit/{id}', 'edit')->name('admin.subCategory.edit');
        Route::post('/admin/subCategory/update', 'update')->name('admin.subCategory.update');
        Route::get('/admin/subCategory/delete/{id}', 'delete')->name('admin.subCategory.delete');

    });
});


// Brand
Route::middleware('auth')->group(function () {
    Route::controller(BrandController::class)->group(function(){
        Route::get('/admin/brand/index', 'index')->name('admin.brand.index');
        Route::get('/admin/brand/create', 'create')->name('admin.brand.create');
        Route::post('/admin/brand/store', 'store')->name('admin.brand.store');
        Route::get('/admin/brand/edit/{id}', 'edit')->name('admin.brand.edit');
        Route::post('/admin/brand/update', 'update')->name('admin.brand.update');
        Route::get('/admin/brand/delete/{id}', 'delete')->name('admin.brand.delete');

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
    Route::controller(ShippingController::class)->group(function(){
        
        Route::get('/admin/shippingcost/index', 'index')->name('admin.shippingcost.index');
        Route::get('/admin/shippingcost/create', 'create')->name('admin.shippingcost.create');
        Route::post('/admin/shippingcost/store', 'store')->name('admin.shippingcost.store');
        Route::get('/admin/shippingcost/delete/{id}', 'delete')->name('admin.shippingcost.delete');


        Route::get('/shipping', 'shippingInfo')->name('shipping');
    

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



// ProductController without middleware

    Route::controller(ProductController::class)->group(function(){

       Route::get('/products/{id}/{slug}', 'RelatedProducts')->name('products');//Related Product
      
       Route::get('/product/shop', 'shop')->name('product.shop'); // Initial view
       
       Route::get('/filter-products', 'filter')->name('filter-products'); // AJAX endpoint


    });



//Payment Options
Route::middleware(['auth'])->group(function () {
//OrderController
     Route::get('/payment-options/{order_id}', [OrderController::class, 'showPaymentOptions'])->name('payment.options');//payment method page load
    
    Route::post('/checkout/initiate', [OrderController::class, 'checkout'])->name('checkout.initiate'); 
    
    Route::post('/process-payment-selection/{order_id}', [OrderController::class, 'processSelection'])->name('payment.process.selection');
    

//InvoiceController
    Route::get('/invoce/success/{order_id}', [InvoiceController::class, 'orderSuccess'])->name('order.success');

    Route::get('/order/{order_id}', [InvoiceController::class, 'show'])->name('order.show');
    
    Route::get('/invoice/download/{order_id}', [InvoiceController::class, 'downloadPDF'])->name('order.download');

    
    // =====================================================================
    //  পেমেন্ট গেটওয়ে রাউট (Payment Gateway Routes)
    // =====================================================================
    
    // --- BKASH PAYMENT FLOW ---

    Route::get('/paymentGetway/bkash/payment/{order_id}', [BkashTokenizePaymentController::class, 'index'])->name('paymentGetway.bkash.payment');
    
    Route::post('/bkash/create-payment', [BkashTokenizePaymentController::class, 'createPayment'])->name('bkash.create-payment');
    
    Route::get('/bkash/callback', [BkashTokenizePaymentController::class, 'callBack'])->name('bkash.callback');

    // অন্যান্য বিকাশ রাউট...





    // --- STRIPE (CARD) PAYMENT FLOW ---
    
    Route::get('/stripe-payment/{order_id}', [StripePaymentController::class, 'showPaymentForm'])->name('stripe.payment.form');
    
    Route::post('/stripe-payment', [StripePaymentController::class, 'processPayment'])->name('stripe.payment.process');





});








require __DIR__.'/auth.php';
