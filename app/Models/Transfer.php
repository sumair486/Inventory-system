<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transfer extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'commission_agent_id', 'border_warehouse_id', 'warehouse_id', 'date','product_id',
        'demage_quantity', 'loss_quantity', 'fine_quantity', 'status','invoice_no','image'
    ];


    public function commissions()
    {
        return $this->belongsTo(Commission::class,'commission_agent_id','id');
    }

    public function warehouseborder()
    {
        return $this->belongsTo(BorderWarehouse::class,'border_warehouse_id','id');
    }

   

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    

    // public static function boot()
    // {
    //     parent::boot();

    //     // Listen to the saving event
    //     static::saving(function ($transfer) {
    //         // Get the associated transaction
    //         $transaction = Transaction::find($transfer->transaction_id);

    //         // Check if demage_quantity, loss_quantity, and v are valid
    //         if (
    //             $transfer->demage_quantity + $transfer->loss_quantity + $transfer->fine_quantity > $transaction->quantity
    //         ) {
    //             // Validation failed, prevent the transfer from being saved
    //             return false;
    //         }

    //         // Decrease the quantity in the Transaction table
    //         $newQuantity = $transaction->quantity - ($transfer->demage_quantity + $transfer->loss_quantity + $transfer->fine_quantity);
            
    //         // Update the quantity in the Transaction table
    //         DB::table('transactions')
    //             ->where('id', $transaction->id)
    //             ->update(['quantity' => $newQuantity]);

    //         return true;
    //     });
    // }
}
