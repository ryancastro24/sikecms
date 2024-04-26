<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $primaryKey = 'sale_id';
    protected $table = 'sales';
    protected $fillable = ['inventory_id','customer_id'];

}
