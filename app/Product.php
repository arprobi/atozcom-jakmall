<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\Payment;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['transaction_code', 'product_name', 'shipping_address', 'price', 'shipping_code', 'user_id'];

    /**
     * Model relationship.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Boot action to handle model.
     */
    public static function boot()
    {
        parent::boot();

        Product::saved(function ($product) {
            $payment = Payment::create([
                'user_id'           => Auth::user()->id,
                'transaction_type'  => 2,
                'transaction_code'  => $product->transaction_code,
                'description'       => $product->product_name.' that cost '.format_IDR(($product->price + 10000)),
                'total'             => $product->price + 10000,
                'status'            => 0,
            ]);
        });


        Product::deleting(function ($product) {
            $payment = Payment::where('transaction_code', $product->transaction_code)->delete();
        });
    }
}
