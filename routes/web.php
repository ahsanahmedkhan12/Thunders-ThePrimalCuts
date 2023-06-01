<?php

use Illuminate\Support\Facades\Route;
//frontend route
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\UserController;

//backend route
use App\Http\Controllers\backend\BackendIndexController;
use App\Http\Controllers\backend\BackendBranchesController;
use App\Http\Controllers\backend\BackendCategoriesController;
use App\Http\Controllers\backend\BackendMenuController;
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

Route::get('/clear', function() {
Artisan::call('cache:clear');
Artisan::call('config:cache');
Artisan::call('route:clear');
return "Cleared!";

});
Route::group(['middleware' => 'throttle:60,1',
              'namespace' => 'frontend'], function(){ 
    Route::get('/', [IndexController::class, 'index'])->name('index'); 
    Route::get('/branches', [IndexController::class, 'branch'])->name('branch'); 
    Route::get('/branch/{slug}', [IndexController::class, 'branchdetail'])->name('branchdetail');
    Route::get('/checkout', [IndexController::class, 'checkout'])->name('checkout')->middleware(['preventbackbutton', 'auth']); 
    Route::post('/checkout-card/{time}/{instruction}', [IndexController::class, 'checkoutcard'])->name('checkout-card')->middleware(['preventbackbutton', 'auth'])->where(['time'=>'(0?[1-9]|1[0-2]):([0-5][0-9]) (am|pm|AM|PM) - (0?[1-9]|1[0-2]):([0-5][0-9]) (am|pm|AM|PM)' , 'instruction'=>'[a-zA-Z0-9\s\-\,\.\&\(\#\)]{1,250}+']); 
    Route::get('/success', [IndexController::class, 'checkoutsuccess'])->name('checkout.success')->middleware(['preventbackbutton', 'auth']); 
    Route::get('/cancel', [IndexController::class, 'checkoutcancel'])->name('checkout.cancel')->middleware(['preventbackbutton', 'auth']); 
});

Route::group([
    'middleware' => 'throttle:60,1',
    'prefix' => 'user',
    'as' => 'user.',
    'name'=>'user',
    'middleware' => ['can:isUser', 'preventbackbutton', 'auth']
], function () {
 
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/order-history', [UserController::class, 'orderhistory'])->name('order-history');
    Route::get('/change-password', [UserController::class, 'changepassword'])->name('change-password');
    Route::get('/personal-detail', [UserController::class, 'personaldetail'])->name('personal-detail');
});


Route::group([
    'middleware' => 'throttle:60,1',
    'prefix' => 'control-area',
    'as' => 'control-area.',
    'name'=>'control-area',
    'middleware' => ['can:isAllowAdminManager', 'preventbackbutton', 'auth']
], function () {
    Route::get('/dashboard', [BackendIndexController::class, 'index'])->name('dashboard');
    Route::get('/branches', [BackendBranchesController::class, 'index'])->name('branches');
    Route::get('/categories', [BackendCategoriesController::class, 'index'])->name('categories');
    Route::get('/menus', [BackendMenuController::class, 'index'])->name('menus');

});

Route::group([
    'middleware' => 'throttle:60,1',
    'prefix' => 'control-area',
    'as' => 'control-area.',
    'name'=>'control-area',
    'middleware' => ['can:isAdmin', 'preventbackbutton', 'auth']
], function () {
    //branch route
    Route::get('/add-branch', [BackendBranchesController::class, 'addeditbranch'])->name('addbranch');
    Route::get('/edit-branch/{id}', [BackendBranchesController::class, 'addeditbranch'])->name('editbranch');

    //category route
    Route::get('/add-category', [BackendCategoriesController::class, 'addeditcategory'])->name('addcategory');
    Route::get('/edit-category/{id}', [BackendCategoriesController::class, 'addeditcategory'])->name('editcategory');

    //menu route
    Route::get('/add-menu', [BackendMenuController::class, 'addeditmenu'])->name('addmenu');
    Route::get('/edit-menu/{id}', [BackendMenuController::class, 'addeditmenu'])->name('editmenu');
   
});

Auth::routes(['verify' => true]);

