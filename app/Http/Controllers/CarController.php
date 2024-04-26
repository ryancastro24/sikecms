<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Sale;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CarController extends Controller
{
 
    public function storeCar(Request $request){

        
        // Para maka store kag image
                if ($request->hasFile('image')) {
                    // Upload image
                    $image = $request->file('image');
                    $imageName = time().'.'.$image->extension();
                    $image->storeAs('carscontainer', $imageName, 'public'); // Adjust the storage path as needed
                }
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'model_name' => 'required',
                'body_type' => 'required',
                'price' => 'required',
                'brand_id' => 'required',
                'option_id' => 'required',
                'dealer_id' => 'required',
                'brand_id' => 'required',
            ]);

    
            // Generate a VIN (Vehicle Identification Number)
            $vin = $this->generateVin(); // Assuming generateVin() is a method to generate a unique VIN
           
        
           
            $createdCar = Vehicle::create([
                'vin' => $vin,
                'model_name' => $request->model_name,
                'body_type' => $request->body_type,
                'price' => $request->price,
                'brand_id' => $request->brand_id,
                'option_id' => $request->option_id,
                'dealer_id' => $request->dealer_id,
                'price' => $request->price,
                'image' => $imageName, // Store the image file name instead of the file object
            ]);
        
            Inventory::create([
                "vehicle_id" => $createdCar->vehicle_id
            ]);
        
            return redirect()->route('home');
            }
        

            private function generateVin() {
                // Generate a random string (assuming VIN format and length)
                return Str::random(17); // Adjust the length as needed based on VIN format
            }
        


            public function carpurchase(Request $request){
                    
                $validator = Validator::make($request->all(), [
                    'inventory_id' => 'required',
                    'user_id' => 'required',
                ]);


                Sale::create([
                    'inventory_id'=> $request->inventory_id,
                    'customer_id' => $request->user_id
                 ]);



                 return redirect()->route('home');
                

            }
            
}
