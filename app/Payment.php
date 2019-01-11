<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
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
    protected $fillable = ['transaction_type', 'transaction_code', 'description', 'total', 'status'];

    /**
    * The attributes that are addable.
    *
    * @var array
    */
    protected $appends = ['type_name', 'ordered_item'];

    /**
     * Getter attributes.
     */
    public function getTypeNameAttribute()
    {
        return $this->attributes['transaction_type'] == 2 ? 'Product' : 'Prepaid Balance';
    }

    public function getOrderedItemAttribute()
    {
        if ($this->attributes['transaction_type'] == 2) {
            $product = Product::where('transaction_code', $this->attributes['transaction_code'])->first();
            return $product;
        } else {
            $data = Balance::where('transaction_code', $this->attributes['transaction_code'])->first();
            return $data;
        }
    }

}
