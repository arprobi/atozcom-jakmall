<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
    	return view('modules.product.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
			'product_name' 		=> 'required|min:10|max:150',
			'shipping_address' 	=> 'required|min:10|max:150',
			'price' => 'required',
		]);

		$data = Product::create([
			'transaction_code' 	=> mt_rand(1000000000, 9999999999),
			'product_name' 		=> $request->product_name,
			'shipping_address' 	=> $request->shipping_address,
			'price' 			=> $request->price,
			'user_id'			=> Auth::user()->id
		]);

		return redirect()->route('payment.detail', ['transaction_code' => $data->transaction_code]);
    }
}
