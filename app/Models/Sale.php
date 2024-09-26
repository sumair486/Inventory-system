<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id', 'product_id', 'customer_name','sale_quantity','date'
    ];

    public function warehousestock()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    
    
}
