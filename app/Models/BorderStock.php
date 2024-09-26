<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorderStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'border_transaction_id', 'border_warehouse_id','date', 'category_id', 'product_id', 'quantity'
    ];

    

    public function border()
    {
        return $this->belongsTo(Border::class,'border_id','id');
    }

    public function warehouseborder()
    {
        return $this->belongsTo(BorderWarehouse::class,'border_warehouse_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
