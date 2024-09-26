<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'category_id','border_id', 'commission_agent_id', 'delivered_quantity', 'transection_date','	balance'
    ];

    public function commissions()
    {
        return $this->belongsTo(Commission::class,'commission_agent_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function border()
    {
        return $this->belongsTo(Border::class,'border_id','id');
    }



}
