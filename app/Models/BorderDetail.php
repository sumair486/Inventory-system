<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
         'border_transaction_id', 'category_id', 'product_id', 'quantity'
    ];

    public function border()
    {
        return $this->belongsTo(Border::class,'border_id','id');
    }

    public function bordertransaction()
    {
        return $this->belongsTo(BorderTransaction::class,'border_transaction_id','id');
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
