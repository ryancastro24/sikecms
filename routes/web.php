<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {

    $cars = DB::table('inventories')
    ->join('vehicles', 'inventories.vehicle_id', '=', 'vehicles.vehicle_id')
    ->join('users', 'vehicles.dealer_id', '=', 'users.id')
    ->join('brands', 'vehicles.brand_id', '=', 'brands.brand_id')
    ->join('options', 'vehicles.option_id', '=', 'options.option_id')
    ->select(
        "inventories.inventory_id",
        'brands.name as brand_name',
        'vehicles.body_type',
        'vehicles.model_name',
        'users.name as dealer_name',
        'vehicles.price',
        'vehicles.image',
        'options.color',
        'options.transmission',
        'options.engine',
        DB::raw('brands.name as brand_name'),

    )
    ->get();


    $topDealerSales = DB::table('sales')
    ->join('inventories', 'sales.inventory_id', '=', 'inventories.inventory_id')
    ->join('vehicles', 'inventories.vehicle_id', '=', 'vehicles.vehicle_id')
    ->join('brands', 'vehicles.brand_id', '=', 'brands.brand_id')
    ->join('users', 'vehicles.dealer_id', '=', 'users.id')
    ->where('users.role', '=', 'dealer') // Filter users by role
    ->select(
        "users.id",
        "users.name",
        "users.email",
        "users.image",
        DB::raw('COUNT(*) as total_sales') // Count the total number of sales for each dealer
    )
    ->groupBy('users.id', 'users.name', 'users.email') // Group by dealer ID, name, and email
    ->orderByDesc('total_sales') // Order by total sales in descending order
    ->take(4) // Limit the results to the top 3 dealers
    ->get();



    return view('welcome',compact('cars','topDealerSales'));
})->name('home');


Route::get("/login",function (){


    return  view("pages.login");

})->name('login');


Route::get("/register",function (){


    return  view("pages.register");

})->name('register');



Route::controller(AuthController::class)->group(function() {
    Route::post('register', 'registerSave')->name('register');
    Route::post('logout', 'logout')->name("logout");
    Route::post('loginAction', 'loginAction')->name("loginAction");
    
});



Route::controller(CarController::class)->group(function() {
    Route::post('addnewcar', 'storeCar')->name('addnewcar');
    Route::post('carpurchase', 'carpurchase')->name('carpurchase');
   
    
});



Route::controller(PagesController::class)->group(function() {

    Route::get('addcars', 'addCars')->name("addcars");
    Route::get('purchase/{id}', 'purchase')->name("purchase");
    Route::get('dealers', 'dealers')->name("dealers");
    
});

