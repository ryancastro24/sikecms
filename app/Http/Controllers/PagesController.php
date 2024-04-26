<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Option;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Complexity\ComplexityCalculatingVisitor;

class PagesController extends Controller
{
    
    public function loginPage(){
        return view("pages.login");
    }

    public function userLogin(){
        return  view("pages.userlogin");
    }

    public function addCars(){

        $brands = Brand::all();
        $colors = Option::all();
        $dealers = User::where("role", "=", "dealer")->get();
        return  view("pages.addCars",compact('brands','colors','dealers'));
    }

    public function history(){

        $userId = Auth::id();

        $customers = DB::table('sales')
        ->join('inventories', 'sales.inventory_id', '=', 'inventories.inventory_id')
        ->join('vehicles', 'inventories.vehicle_id', '=', 'vehicles.vehicle_id')
        ->join('brands', 'vehicles.brand_id', '=', 'brands.brand_id')
        ->join('users', 'sales.customer_id', '=', 'users.id')
        ->select(
            "sales.sale_id",
            "vehicles.model_name",
            "vehicles.body_type",
            "vehicles.price",
            "brands.name as brand_name",
            "vehicles.created_at",
        )
        ->get();


        return view("pages.history",compact('customers'));
    }

    public function purchase($id) {

        $car = DB::table('inventories')
    ->join('vehicles', 'inventories.vehicle_id', '=', 'vehicles.vehicle_id')
    ->join('options', 'vehicles.option_id', '=', 'options.option_id')
    ->join('brands', 'vehicles.brand_id', '=', 'brands.brand_id')
    ->select(
        "inventories.inventory_id",
        'vehicles.model_name',
        'vehicles.body_type',
        'vehicles.price',
        'vehicles.image',
        'vehicles.vin',
        'options.color',
        'options.transmission',
        'options.engine',
        'brands.brand_id',
        DB::raw('brands.name as brand_name')
    )
    ->where('inventories.inventory_id', $id)
    ->first(); // Use first() instead of get() if you expect only one result

         
        return view("pages.purchase", compact('car'));
    }




    public function dealers(){

        $dealers = User::where('role' , '=' , 'dealer')->get();
    
         

        return view('pages.dealers',compact('dealers'));
    }
}
