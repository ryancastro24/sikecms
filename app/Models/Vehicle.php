<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $primaryKey = 'vehicle_id';
    protected $table = 'vehicles';
    protected $fillable = ['vin','model_name','body_type','price','image','brand_id','dealer_id','option_id'];


}
