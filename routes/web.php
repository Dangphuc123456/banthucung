<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InputinvoiController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PetsController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutsController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrdersController;
use App\Http\Controllers\User\ReservationController;
use App\Http\Controllers\User\ServicesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//////////////////////////Người dùng//////////////////////////////////
Route::get('/', [HomeController::class, 'index'])->name('User.home');
Route::get('contact', [HomeController::class, 'contact'])->name('User.contact');
Route::post('contact/store', [HomeController::class, 'store'])->name('User.store');  
Route::get('introduction', [HomeController::class, 'introduction'])->name('User.introduction');
Route::get('/category/{category}', [HomeController::class, 'category'])->name('User.category');
Route::get('detail/{pet_id}', [HomeController::class, 'detail'])->name('User.detail');
// Route::get('/user-detail/{encodedPetId}', [HomeController::class, 'detail'])->name('User.detail');
Route::get('products', [HomeController::class, 'products'])->name('User.products');
Route::get('accessory', [HomeController::class, 'accessory'])->name('User.accessory');
Route::get('service', [HomeController::class, 'service'])->name('User.service');
Route::get('search', [HomeController::class, 'search'])->name('User.search');
Route::get('/orders/historical', [OrdersController::class, 'historical'])->name('User.orders.historical');
Route::get('/orders/bookings', [OrdersController::class, 'bookings'])->name('User.orders.bookings');
Route::get('guarantee.', [HomeController::class, 'guarantee'])->name('User.orders.guarantee');
///đăng nhập đăng ký
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('User.userslogin');
Route::post('/login', [AuthController::class, 'login'])->name('User.userslogin.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('User.logout');
// Route::post('/switch-account/{newUserId}', [AuthController::class, 'switchAccount'])->name('User.switchAccount');
// Route cho đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('User.usersregister');
Route::post('/register', [AuthController::class, 'register'])->name('User.usersregister.submit');
//giỏ hàng 
Route::get('cart', [CartController::class, 'cart'])->name('User.cart');
Route::post('/add-to-cart/{pet_id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::delete('/remove-from-cart/{pet_id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/update-cart/{pet_id}', [CartController::class, 'updateCart'])->name('updateCart');
//thanh toán
Route::middleware(['auth:customer'])->group(function () {
    Route::get('checkouts', [CheckoutsController::class, 'checkouts'])->name('User.checkouts');
    Route::post('checkouts/store', [CheckoutsController::class, 'storecheckouts'])->name('User.checkouts.store');
});

Route::get('/booking', [ReservationController::class, 'showForm'])->name('User.booking');
Route::post('/booking', [ReservationController::class, 'store'])->name('User.booking.submit');
Route::get('/appointment', [ServicesController::class, 'showservice'])->name('User.appointment');
Route::post('/appointment', [ServicesController::class, 'storeAppointment'])->name('User.appointments.submit');
Route::get('/information/{order_id}', [CheckoutsController::class, 'show'])->name('User.information');



Route::get('admin', [AdminController::class, 'index'])->name('Admin.admin');
Route::get('/admin/index', [AdminController::class, 'index'])->name('Admin.index');
Route::get('/admin/notifications/new-orders', [AdminController::class, 'fetchNewOrders'])
    ->name('admin.notifications.newOrders');
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search.index');

/////// pets//////
Route::prefix('admin')->group(function () {
    Route::get('/pets', [PetsController::class, 'index'])->name('admin.pets.index');
    Route::get('/pets/create', [PetsController::class, 'create'])->name('admin.pets.create');
    Route::post('pets/store', [PetsController::class, 'store'])->name('admin.pets.store');
    Route::get('/pets/destroy/{pet_id}', [PetsController::class, 'destroy'])->name('pets.destroy');
    Route::get('/pets/show/{pet_id}', [PetsController::class, 'show'])->name('admin.pets.detail');
    Route::get('/pets/edit/{pet_id}', [PetsController::class, 'edit'])->name('admin.pets.edit');
    Route::put('/pets/update/{pet_id}', [PetsController::class, 'update'])->name('admin.pets.update');
    Route::get('/petss/search', [PetsController::class, 'search'])->name('pets.search');
});
/////// categoris//////
Route::prefix('admin')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/destroy/{category_id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/show/{category_id}', [CategoryController::class, 'show'])->name('admin.category.detail');
    Route::get('/category/edit/{category_id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/update/{category_id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/categorys/search', [CategoryController::class, 'search'])->name('category.search');
});
/////// order//////
Route::prefix('admin')->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::post('/order/confirm/{order_id}', [OrderController::class, 'confirm'])->name('admin.order.confirm');
    Route::delete('/order/{order_id}/cancel', [OrderController::class, 'cancel'])->name('admin.order.cancel');
    Route::get('/order/detail/{order_id}', [OrderController::class, 'detail'])->name('admin.order.detail');
    Route::post('/order/delivered/{order_id}', [OrderController::class, 'delivered'])->name('admin.order.delivered');
    Route::post('/order/delivery/{order_id}', [OrderController::class, 'delivery'])->name('admin.order.delivery');
    Route::get('/admin/order/search', [OrderController::class, 'search'])->name('admin.order.search');
    Route::get('/order/destroy/{order_id}', [OrderController::class, 'destroy'])->name('order.destroy');
});

/////// Suppliers//////
Route::prefix('admin')->group(function () {
    Route::get('/suppliers', [SuppliersController::class, 'index'])->name('admin.suppliers.index');
    Route::get('/suppliers/create', [SuppliersController::class, 'create'])->name('admin.suppliers.create');
    Route::post('suppliers/store', [SuppliersController::class, 'store'])->name('admin.suppliers.store');
    Route::get('/suppliers/destroy/{supplier_id}', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');
    Route::get('/suppliers/show/{supplier_id}', [SuppliersController::class, 'show'])->name('admin.suppliers.detail');
    Route::get('/suppliers/edit/{supplier_id}', [SuppliersController::class, 'edit'])->name('admin.suppliers.edit');
    Route::put('/suppliers/update/{supplier_id}', [SuppliersController::class, 'update'])->name('admin.suppliers.update');
    Route::get('/supplierss/search', [SuppliersController::class, 'search'])->name('suppliers.search');
});

/////// Hóa đơn nhập//////
Route::prefix('admin')->group(function () {
    Route::get('/inputinvoi', [InputinvoiController::class, 'index'])->name('admin.inputinvoi.index');
    Route::get('/inputinvoi/create', [InputinvoiController::class, 'create'])->name('admin.inputinvoi.create');
    Route::post('inputinvoi/store', [InputinvoiController::class, 'store'])->name('admin.inputinvoi.store');
    Route::get('/inputinvoi/destroy/{purchase_order_id}', [InputinvoiController::class, 'destroy'])->name('inputinvoi.destroy');
    Route::get('/inputinvoi/show/{purchase_order_id}', [InputinvoiController::class, 'show'])->name('admin.inputinvoi.detail');
    Route::get('/inputinvoi/edit/{purchase_order_id}', [InputinvoiController::class, 'edit'])->name('admin.inputinvoi.edit');
    Route::put('/inputinvoi/update/{purchase_order_id}', [InputinvoiController::class, 'update'])->name('admin.inputinvoi.update');
    Route::get('/inputinvois/search', [InputinvoiController::class, 'search'])->name('inputinvoi.search');
});

/////// Suppliers//////
Route::prefix('admin')->group(function () {
    Route::get('/servicee', [ServiceController::class, 'index'])->name('admin.servicee.index');
    Route::get('/servicee/create', [ServiceController::class, 'create'])->name('admin.servicee.create');
    Route::post('servicee/store', [ServiceController::class, 'store'])->name('admin.servicee.store');
    Route::get('/servicee/destroy/{service_id}', [ServiceController::class, 'destroy'])->name('servicee.destroy');
    Route::get('/servicee/show/{service_id}', [ServiceController::class, 'show'])->name('admin.servicee.detail');
    Route::get('/servicee/edit/{service_id}', [ServiceController::class, 'edit'])->name('admin.servicee.edit');
    Route::put('/servicee/update/{service_id}', [ServiceController::class, 'update'])->name('admin.servicee.update');
});
/////phòng////
Route::prefix('admin')->group(function () {
    Route::get('/room', [RoomController::class, 'index'])->name('admin.room.index');
    Route::get('/room/destroy/{RoomID}', [RoomController::class, 'destroy'])->name('room.destroy');
    Route::get('/room/show/{RoomID}', [RoomController::class, 'show'])->name('admin.room.detail');
    Route::post('/room/available/{RoomID}', [RoomController::class, 'available'])->name('admin.room.available');
    Route::post('/room/occupied/{RoomID}', [RoomController::class, 'occupied'])->name('admin.room.occupied');
    Route::post('/room/maintenance/{RoomID}', [RoomController::class, 'maintenance'])->name('admin.room.maintenance');
});
Route::prefix('admin')->group(function () {
    Route::get('/statistical/selling', [StatisticsController::class, 'selling'])->name('admin.statistical.selling');
    Route::get('/statistical/detail/{period?}', [StatisticsController::class, 'detail'])->name('admin.statistical.detail');  
    Route::get('/statistical/export', [StatisticsController::class, 'exportStatistics'])->name('statistical.export');
    Route::get('/statistical', [StatisticsController::class, 'import'])->name('admin.statistical.import');
});
////Auth//
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
});
