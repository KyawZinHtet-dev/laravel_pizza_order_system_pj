<?php

use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Models\OrderList;
use Illuminate\Foundation\Console\RouteClearCommand;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;

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

// route for login and register page

Route::middleware(['loginLogout',])->group(function () {

    // route for redirect to login page
    Route::redirect('/', 'loginPage');

    // route for show login page
    Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');

    // route for show register page
    Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


Route::middleware([
    'auth'
])->group(function () {

    // checkRole
    Route::get('roleCheck', [AuthController::class, 'checkRole'])->name('auth#checkRole');

    // route for admin pages
    Route::group(['prefix' => 'category', 'middleware' => 'adminAuth'], function () {

        // route for category create page
        Route::get('create', [CategoryController::class, 'showCategoryCreatePage'])->name('category#createPage');

        //route for store new category
        Route::post('create', [CategoryController::class, 'storeCategory'])->name('category#store');

        // route for show category list
        Route::get('list', [CategoryController::class, 'showCategoryList'])->name('category#list');

        // route for delete category list
        Route::get('delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category#delete');

        // route for category edit page
        Route::get('edit/{id}', [CategoryController::class, 'showEditPage'])->name('category#edit');

        // route for category name update
        Route::post('edit/{id}', [CategoryController::class, 'updateCategory'])->name('category#update');
    });


    // route for admin account and pass
    Route::group(['middleware' => 'adminAuth', 'prefix' => 'admin/account'], function () {

        // route for pass change page
        Route::get('passChangePage', [AdminAccountController::class, 'showPassChangePage'])->name('adminAccount#passChange');

        // route for change pass
        Route::post('passChangePage', [AdminAccountController::class, 'changePass'])->name('adminAccount#passChange');

        // route for account detail page
        Route::get('detail', [AdminAccountController::class, 'showDetailPage'])->name('adminAccount#detail');

        // route for account edit page
        Route::get('edit', [AdminAccountController::class, 'showEditPage'])->name('adminAccount#editPage');

        // route for edit account
        Route::post('edit', [AdminAccountController::class, 'editAccount'])->name('adminAccount#edit');

        // route for profile photo edit page
        Route::get('profilePic', [AdminAccountController::class, 'showEditProfilePic'])->name('adminAccount#profilePic');

        // route for profile photo edit
        Route::post('profilePic/edit', [AdminAccountController::class, 'editProfilePic'])->name('adminAccount#profilePicEdit');

        // route for profile photo delete
        Route::get('profilePic/delete', [AdminAccountController::class, 'deleteProfilePic'])->name('adminAccount#profilePicDelete');

        // route for account list
        Route::get('list', [AdminAccountController::class, 'showAccountList'])->name('admin#showAccountList');

        // route for account delete
        Route::get('delete', [AdminAccountController::class, 'deleteAccount'])->name('admin#deleteAccount');

        // route for change account role
        Route::post('role/change', [AdminAccountController::class, 'changeAccountRole'])->name('admin#changeAccountRole');
    });

    // route for products
    Route::group(['prefix' => 'product', 'middleware' => 'adminAuth'], function () {
        //route for product list page
        Route::get('/list', [ProductController::class, 'showProductPage'])->name('admin#home');

        // route for show  product create page
        Route::get('/create', [ProductController::class, 'showCreatepage'])->name('product#create');

        // route for create product
        Route::post('/create', [ProductController::class, 'createProduct'])->name('product#create');

        // route for show page
        Route::get('about/{id}', [ProductController::class, 'showAboutProduct'])->name('product#about');

        // route for edit page
        Route::get('/edit/{id}', [ProductController::class, 'showEditPage'])->name('product#edit');

        // route for store edit data
        Route::post('/edit/{id}', [ProductController::class, 'storeEditData'])->name('product#edit');

        // route for product image change page
        Route::get('/edit/image/{id}', [ProductController::class, 'showImageChange'])->name('product#imageChange');

        // route for change product image
        Route::post('/edit/image/{id}', [ProductController::class, 'changeImage'])->name('product#changeImage');

        // route for delete product
        Route::get('delete/{id}', [ProductController::class, 'deleteProduct'])->name('product#delete');

        // route for product order list
        Route::get('order/list',[OrderController::class,'showOrderListPage'])->name('order#showOrderListPage');

        // route for order list sorting
        Route::get('order/list/sort',[OrderController::class,'sortOrderList'])->name('order#sortOrderList');

        // route for order status change
        Route::get('order/status/change',[OrderController::class,'changeOrderStatus'])->name('order#changeOrderStatus');

        // route for show ordering items
        Route::get('ordered/items/{orderCode}',[OrderController::class,'showOrderingItemsPage'])->name('order#showOrderingItemsPage');

    });


    // route for user panel
    Route::group(['prefix' => 'user', 'middleware' => 'userAuth'], function () {
        // route for user home page
        Route::get('home', [UserController::class, 'showUserHomePage'])->name('user#home');

        // route group for user account
        Route::group(['prefix' => 'account'],function(){

             // route for account detail page
            Route::get('/detail', [UserController::class, 'showAccountDetailPage'])->name('user#showAccountDetailPage');

            // route for edit account page
            Route::get('/edit', [UserController::class, 'showAccountEditPage'])->name('user#showAccountEditPage');

            // rout for edit account
            Route::post('/edit', [UserController::class, 'editAccount'])->name('user#editAccount');

            // route for profile pic change page
            Route::get('/profilePic/change', [UserController::class, 'showProfilePicChangePage'])->name('user#showProfilePicChangePage');

            // route for change profile pic
            Route::post('/profilePic/change', [UserController::class, 'changeProfilePic'])->name('user#changeProfilePic');

            // route for profile pic delete
            Route::get('/profilePic/delete', [UserController::class, 'deleteProfilePic'])->name('user#deleteProfilePic');

            // route for pass change page
            Route::get('/change/password', [UserController::class, 'showPassChangePage'])->name('user#showPassChangePage');

            // route for pass change
            Route::post('/change/password', [UserController::class, 'changePass'])->name('user#changePass');

            // route for delete account
            Route::get('/delete', [UserController::class, 'deleteAccount'])->name('user#deleteAccount');

        });


        // route for filter by category
        Route::get('filter/category/{category_id}',[UserController::class,'filterByCategory'])->name('user#filterByCategory');

        // route for product detail
        Route::get('product/detail/{id}',[UserController::class,'showProductDetailPage'])->name('user#showProductDetailPage');


        // ajax route group
        Route::group(['prefix' => 'ajax'], function(){
            // route reponse product list using ajax
            Route::get('/product/list',[AjaxController::class,'getProductList'])->name('ajax#getProductList');

            // route add cart data
            Route::get('cart',[AjaxController::class,'storeCartData'])->name('ajax#storeCartData');

            // route to store order list
            Route::get('order',[AjaxController::class, 'storeOrderData'])->name('ajax#storeOrderData');

            // route to delete cart item
            Route::get('cart/remove',[AjaxController::class,'deleteCartItem'])->name('ajax#deleteCartItem');

            // route to clear cart
            Route::get('cart/clear',[AjaxController::class,'clearCart'])->name('ajax#clearCart');

            // route to add cart
            Route::get('cart/add',[AjaxController::class,'addCart'])->name('ajax#addCart');

            // route for view_count
            Route::get('viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });

        // route for user cart
        Route::group(['prefix' => 'cart'],function(){
            Route::get('list',[CartController::class,'showCartListPage'])->name('care#showCartListPage');
        });

        // route for order history
        Route::group(['prefix' => 'order'],function(){
            Route::get('history',[OrderController::class,'showOrderHistoryPage'])->name('order#showOrderHistoryPage');

            // route for ordered items list
            Route::get('items/list/',[OrderController::class,'showOrderedItemsPage'])->name('order#showOrderedItemsPage');
        });

    });


});
