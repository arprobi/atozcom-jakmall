<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Payment;

class Balance extends Model
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
    protected $fillable = ['transaction_code', 'phone_number', 'value', 'user_id'];

    /**
     * Setter attributes.
     */
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = '081'.$value;
    }

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

        Balance::saving(function ($balance) {
            $payment = Payment::create([
                'transaction_type'  => 1,
                'transaction_code'  => $balance->transaction_code,
                'description'       => $balance->value.' For '.$balance->phone_number,
                'total'             => $balance->value + (0.05 * $balance->value),
                'status'            => 0,
            ]);
        });


        Balance::deleting(function ($balance) {
            $payment = Payment::where('transaction_code', $balance->transaction_code)->delete();
        });
    }
}
