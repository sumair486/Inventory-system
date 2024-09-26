<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'border_warehouse_id'
    ];


    public function products()

    {
        return $this->belongsTo(Product::class,'product_id','id');
    }


    public function warehouse()

    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }

    // public function warehousestock()

    // {
    //     return $this->belongsTo(WarehouseStock::class,'warehouse_id','id');
    // }
}
