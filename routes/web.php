<?php

use Illuminate\Support\Facades\Route;

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

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


//===================== Admin Routes =====================//

Route::group(['middleware' => ['auth', 'roles'],'roles' => 'admin','prefix'=>'admin'], function () {


    Route::get('/','Admin\AdminController@dashboard');

    Route::get('/dashboard','Admin\AdminController@dashboard');
    
    Route::get('account/settings','Admin\UsersController@getSettings');
    Route::post('account/settings','Admin\UsersController@saveSettings');

    Route::get('project', function () {
        return view('dashboard.index-project');
    });

    Route::get('analytics', function () {
        return view('admin.dashboard.index-analytics');
    });


    Route::get('logo/edit','Admin\AdminController@logoEdit');
    Route::post('logo/upload','Admin\AdminController@logoUpload')->name('logo_upload');
    
    Route::get('favicon/edit','Admin\AdminController@faviconEdit');
    
    Route::post('favicon/upload','Admin\AdminController@faviconUpload')->name('favicon_upload');

    Route::get('config/setting', function () {
        return view('admin.dashboard.index-config');
    });

    Route::get('contact/inquiries','Admin\AdminController@contactSubmissions');
    Route::get('contact/inquiries/{id}','Admin\AdminController@inquiryshow');
    Route::get('newsletter/inquiries','Admin\AdminController@newsletterInquiries');
    
    Route::any('contact/submissions/delete/{id}','Admin\AdminController@contactSubmissionsDelete');
    Route::any('newsletter/inquiries/delete/{id}','Admin\AdminController@newsletterInquiriesDelete'); 
    
    /* Config Setting Form Submit Route */
    Route::post('config/setting','Admin\AdminController@configSettingUpdate')->name('config_settings_update');



    // admin show/hide reviews section
    Route::get('showReview','Admin\TestimonialController@showReview')->name('showReview');
    
    
    
    
    //Product multi image delete
    Route::get('product_image/{id}/delete', ['as' => 'product_image.delete', 'uses' => 'Admin\\ProductController@destroyImage']);

    
    // enable dealers
    Route::get('enableDealer/{id}','Admin\DealerAccountController@enableDealer')->name('enableDealer');



    // get specific type's categories
    Route::post('typeCategory','Admin\ProductController@typeCategory')->name('typeCategory');
	
	
	
	// website_color
    Route::get('website_color','Admin\AdminController@website_color')->name('website_color');
    Route::post('website_color_update','Admin\AdminController@website_color_update')->name('website_color_update');
    Route::get('reset_color','Admin\AdminController@reset_color')->name('reset_color');
	// website_color


//==============================================================//

//==================== Error pages Routes ====================//
    Route::get('403',function (){
        return view('pages.403');
    });

    Route::get('404',function (){
        return view('pages.404');
    });

    Route::get('405',function (){
        return view('pages.405');
    });

    Route::get('500',function (){
        return view('pages.500');
    });
//============================================================//

    #Permission management
    Route::get('permission-management','PermissionController@getIndex');
    Route::get('permission/create','PermissionController@create');
    Route::post('permission/create','PermissionController@save');
    Route::get('permission/delete/{id}','PermissionController@delete');
    Route::get('permission/edit/{id}','PermissionController@edit');
    Route::post('permission/edit/{id}','PermissionController@update');

    #Role management
    Route::get('role-management','RoleController@getIndex');
    Route::get('role/create','RoleController@create');
    Route::post('role/create','RoleController@save');
    Route::get('role/delete/{id}','RoleController@delete');
    Route::get('role/edit/{id}','RoleController@edit');
    Route::post('role/edit/{id}','RoleController@update');

    #CRUD Generator
    Route::get('/crud-generator', ['uses' => 'ProcessController@getGenerator']);
    Route::post('/crud-generator', ['uses' => 'ProcessController@postGenerator']);

    # Activity log
    Route::get('activity-log','LogViewerController@getActivityLog');
    Route::get('activity-log/data', 'LogViewerController@activityLogData')->name('activity-log.data');

    #User Management routes
    Route::get('users','Admin\\UsersController@Index');
    Route::get('user/create','Admin\\UsersController@create');
    Route::post('user/create','Admin\\UsersController@save');
    Route::get('user/edit/{id}','Admin\\UsersController@edit');
    Route::post('user/edit/{id}','Admin\\UsersController@update');
    Route::get('user/delete/{id}','Admin\\UsersController@destroy');
    Route::get('user/deleted/','Admin\\UsersController@getDeletedUsers');
    Route::get('user/restore/{id}','Admin\\UsersController@restoreUser');
    

    Route::resource('product', 'Admin\\ProductController');
    Route::get('product/{id}/delete', ['as' => 'product.delete', 'uses' => 'Admin\\ProductController@destroy']);
    Route::get('order/list', ['as' => 'order.list', 'uses' => 'Admin\\ProductController@orderList']);
    Route::get('order/detail/{id}', ['as' => 'order.list.detail', 'uses' => 'Admin\\ProductController@orderListDetail']);
    
     //Order Status Change Routes//
    Route::get('status/completed/{id}','Admin\\ProductController@updatestatuscompleted')->name('status.completed');
    Route::get('status/pending/{id}','Admin\\ProductController@updatestatusPending')->name('status.pending');


    //review status update
    Route::get('status/active/{id}','Admin\\ReviewController@updatestatusactive')->name('status.active');
    Route::get('status/inactive/{id}','Admin\\ReviewController@updatestatusinactive')->name('status.inactive');





});

//==============================================================//

//Log Viewer
Route::get('log-viewers', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index')->name('log-viewers');
Route::get('log-viewers/logs', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs')->name('log-viewers.logs');
Route::delete('log-viewers/logs/delete', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete')->name('log-viewers.logs.delete');
Route::get('log-viewers/logs/{date}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show')->name('log-viewers.logs.show');
Route::get('log-viewers/logs/{date}/download', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download')->name('log-viewers.logs.download');
Route::get('log-viewers/logs/{date}/{level}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel')->name('log-viewers.logs.filter');
Route::get('log-viewers/logs/{date}/{level}/search', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@search')->name('log-viewers.logs.search');
Route::get('log-viewers/logcheck', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@logCheck')->name('log-viewers.logcheck');


Route::get('auth/{provider}/','Auth\SocialLoginController@redirectToProvider');
Route::get('{provider}/callback','Auth\SocialLoginController@handleProviderCallback');
Route::get('logout','Auth\LoginController@logout');
Auth::routes();


//===================== Account Area Routes =====================//


Route::get('signin','GuestController@signin')->name('signin');
Route::get('signup','GuestController@signup')->name('signup');
Route::get('account','LoggedInController@account')->name('account');
Route::get('orders','LoggedInController@orders')->name('orders');
Route::get('account-detail','LoggedInController@accountDetail')->name('accountDetail');

Route::post('update/account','LoggedInController@updateAccount')->name('update.account');
Route::get('signout', function() {
        Auth::logout();
        
        Session::flash('message', 'You have logged out successfully!'); 
        Session::flash('alert-class', 'alert-success'); 
        
        return redirect('signin');
});

Route::get('logout','Auth\LoginController@logout');
Auth::routes();

Route::get('account/friends','LoggedInController@friends')->name('friends');
Route::get('account/upload','LoggedInController@upload')->name('upload');
Route::get('account/password','LoggedInController@password')->name('password');

Route::get('/success','OrderController@success')->name('success');

Route::post('update/profile','LoggedInController@update_profile')->name('update_profile');
Route::post('update/uploadPicture','LoggedInController@uploadPicture')->name('uploadPicture');

// accountPasswordUpdate
Route::post('accountPasswordUpdate','LoggedInController@accountPasswordUpdate')->name('accountPasswordUpdate');


//===================== Front Routes =====================//

Route::get('/','HomeController@index')->name('home');
Route::get('/home','HomeController@index')->name('home');
Route::get('/about','HomeController@about')->name('about');
Route::get('/useandcare','HomeController@useandcare')->name('useandcare');
Route::get('/warrantyinformation','HomeController@warrantyinformation')->name('warrantyinformation');
Route::get('/motoroption','HomeController@motoroption')->name('motoroption');
Route::get('/contact','HomeController@contact')->name('contact');
Route::get('/customProducts','HomeController@customProducts')->name('customProducts');
Route::get('/gallery','HomeController@gallery')->name('gallery');
Route::get('/galleryCategory/{slug}','HomeController@galleryCategory')->name('galleryCategory');


// galleryModelCategory
Route::get('/galleryModelCategory/{slug}','HomeController@galleryModelCategory')->name('galleryModelCategory');



Route::get('/productDetail','HomeController@productDetail')->name('productDetail');
Route::get('/customProduct/{slug}','HomeController@productDetail2')->name('productDetail2');
Route::get('/productLogin','HomeController@productLogin')->name('productLogin');
// Route::get('/product','HomeController@product')->name('product');
Route::get('/productCategory/{category}','HomeController@productCategory')->name('productCategory');
Route::get('/cartPage','HomeController@cartPage')->name('cartPage');
Route::get('/checkoutPage','HomeController@checkoutPage')->name('checkoutPage');
Route::get('/termsAndConditions','HomeController@termsAndConditions')->name('termsAndConditions');
Route::get('/instructional_information','HomeController@instructional_information')->name('instructional_information');



Route::get('/faq','HomeController@faq')->name('faq');
Route::get('/locateDealer','HomeController@locateDealer')->name('locateDealer');
Route::get('/materials','HomeController@materials')->name('materials');
//Route::get('/parts','HomeController@parts')->name('parts');

Route::get('/customBuild','HomeController@customBuild')->name('customBuild');

// country state
Route::get('get-states/{cname?}','HomeController@getStates')->name('getStates');




Route::post('contact-us-submit','HomeController@contactUsSubmit')->name('contactUsSubmit');
Route::post('newsletter-submit','HomeController@newsletterSubmit')->name('newsletterSubmit');

// product review 
Route::post('reviewSubmit','HomeController@reviewSubmit')->name('reviewSubmit');

Route::post('freeBookSubmit','HomeController@freeBookSubmit')->name('freeBookSubmit');



// TEST FLIP BOOK
Route::get('/testFlipBook','HomeController@testFlipBook')->name('testFlipBook');

// Email Test Route
Route::get('/testEmail','HomeController@testEmail')->name('testEmail');




// google_map_api

// STEP1
Route::get('latitude_longitude', function () {
        return view('latitude_longitude');
    });

// STEP3
Route::get('currentLocation', function(){
    return view('currentLocation');
});

Route::post('submitLatLong','HomeController@submitLatLong')->name('submitLatLong');




// testMap
Route::get('testMap', function(){
    return view('testMap');
});


// google_map_api



//=================================================================//

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

/*
Route::get('/test', function() {
    App::setlocale('arab');
    dd(App::getlocale());
    if(App::setlocale('arab')) {
        
    }
});
*/
/* Form Validation */


//===================== Shop Routes Below ========================//

Route::get('shop','ProductController@shop')->name('shop');
Route::get('parts','ProductController@Part')->name('parts');
Route::get('shopDetail/{slug}','ProductController@shopDetail')->name('shopDetail');
Route::get('category/{slug}','ProductController@categoryDetail')->name('categoryDetail');
Route::get('parts/{slug}','ProductController@partscategoryDetail')->name('partscategoryDetail');
Route::any('/clearCart', 'ProductController@clearCart')->name('clearCart'); 
// payment page
Route::get('orderPayment','OrderController@orderPayment')->name('orderPayment');
Route::post('/paymentComplete','OrderController@paymentComplete')->name('paymentComplete');

// checkEmail
Route::get('checkEmail/{email}','OrderController@checkEmail')->name('checkEmail');

// order success
Route::get('orderComplete','OrderController@orderComplete')->name('orderComplete');


Route::post('/cartAdd', 'ProductController@saveCart')->name('save_cart');
Route::any('/remove-cart/{id}', 'ProductController@removeCart')->name('remove_cart'); 
Route::post('/updateCart', 'ProductController@updateCart')->name('update_cart');
Route::get('/cart', 'ProductController@cart')->name('cart');
Route::get('/payment', 'OrderController@payment')->name('payment');
Route::get('invoice/{id}','LoggedInController@invoice')->name('invoice');
Route::get('/payment', 'OrderController@payment')->name('payment');
Route::any('/checkout', 'OrderController@checkout')->name('checkout');
Route::post('/place-order', 'OrderController@placeOrder')->name('order.place');
Route::post('/new-order', 'OrderController@newOrder')->name('new.place');
Route::post('shipping', 'ProductController@shipping')->name('shipping');

/*wishlist*/
Route::get('/wishlist', 'WishlistController@index')->name('customer.wishlist.list');
Route::any('/wishlist/add/{id?}', 'WishlistController@addwishlist')->name('wishlist.add');
Route::any('/wishlist/add/{id?}', 'WishlistController@addwishlist')->name('wishlist.add');
/*wishlist end*/

Route::post('/language-form', 'ProductController@language')->name('language');


// sorting routes
Route::get('product/{sort}','ProductController@productSort')->name('productSort');
Route::get('category/{category}/{sort}','ProductController@productsCategorySort')->name('productsCategorySort');

// sorting routes for parts
Route::get('parts/{sort}','ProductController@PartSort')->name('partSort');
Route::get('parts_category/{category}/{sort}','ProductController@PartsCategorySort')->name('PartsCategorySort');


//==============================================================//

Route::get('user-ip', 'HomeController@getusersysteminfo');

//===================== New Crud-Generators Routes Will Auto Display Below ========================//


Route::resource('admin/blog', 'Admin\\BlogController');


Route::resource('admin/banner', 'Admin\\BannerController');
Route::get('admin/banner/{id}/delete', ['as' => 'banner.delete', 'uses' => 'Admin\\BannerController@destroy']);
Route::resource('admin/category', 'Admin\\CategoryController');
Route::resource('admin/page', 'Admin\\PageController');
Route::resource('admin/free-book', 'Admin\\FreeBookController');
Route::resource('admin/inner-banner', 'Admin\\InnerBannerController');
Route::resource('admin/testimonial', 'Admin\\TestimonialController');
Route::resource('admin/review', 'Admin\\ReviewController');
Route::resource('admin/partner', 'Admin\\PartnerController');
Route::resource('admin/gallery', 'Admin\\GalleryController');
Route::resource('admin/category', 'Admin\\CategoryController');
Route::resource('admin/video', 'Admin\\VideoController');
Route::resource('admin/attribute', 'Admin\\AttributeController');
Route::resource('admin/attribute-value', 'Admin\\AttributeValueController');
Route::resource('admin/custom-price', 'Admin\\CustomPriceController');

Route::post('admin/customPrice/store', 'Admin\CustomPriceController@store')->name('customPriceStore');
Route::post('admin/customPrice/{id}/update', 'Admin\CustomPriceController@update')->name('customPriceUpdate');

Route::resource('admin/faq', 'Admin\\faqController');
Route::resource('admin/dealer', 'Admin\\DealerController');
Route::resource('admin/service', 'Admin\\ServiceController');
Route::resource('admin/material', 'Admin\\MaterialController');
Route::resource('admin/option', 'Admin\\OptionController');

Route::resource('admin/file-management', 'Admin\\FileManagementController');
Route::resource('admin/representative-location', 'Admin\\RepresentativeLocationController');
Route::resource('admin/gallery-category', 'Admin\\GalleryCategoryController');
Route::resource('admin/motoroption', 'Admin\\MotoroptionController');
Route::resource('admin/size', 'Admin\\SizeController');
Route::resource('admin/dealer-account', 'Admin\\DealerAccountController');