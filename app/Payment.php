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
    protected $fillable = ['transaction_type', 'transaction_code', 'description', 'total', 'user_id', 'status'];

    /**
    * The attributes that are addable.
    *
    * @var array
    */
    protected $appends = ['type_name', 'ordered_item', 'status_name'];

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

    public function getStatusNameAttribute()
    {
        if($this->attributes['status'] === 0) {
            return '<a href="'. url('/payment?order_number='.$this->attributes['transaction_code']) .'" class="btn btn-outline-primary"> Pay </a>';
        } else if($this->attributes['status'] === 1) {
            if ($this->attributes['transaction_type'] == 1) {
                return '<span class="badge badge-success">Success</span>';
            } else {
                $product = Product::where('transaction_code', $this->attributes['transaction_code'])->first();
                return 'Shipping Code : '.$product->shipping_code;
            }
        } else if($this->attributes['status'] === 2){
            return '<span class="badge badge-warning">Canceled</span>';
        } else {
            return '<span class="badge badge-danger">Failed</span>';
        }
    }

    /**
     * Scope a query to search order.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $key)
    {
        return $query->where('transaction_code', 'like', '%'.$key.'%')
                    ->orWhere('description', 'like', '%'.$key.'%')
                    ->orWhere('total', 'like', '%'.$key.'%');
    }

}
