<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorderTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
         'border_warehouse_id','date','invoice_no','image'
    ];

    public function border()
    {
        return $this->belongsTo(Border::class,'border_id','id');
    }
    public function borderDetails()
    {
        return $this->hasMany(BorderDetail::class);
    }
    public function borderStocks()
    {
        return $this->hasMany(BorderStock::class);
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
