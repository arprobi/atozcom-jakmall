<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Balance;

class BalanceController extends Controller
{
    public function index()
    {
    	return view('modules.balance.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
			'phone_number'       => 'required|min:7|max:9',
			'value'              => 'required'
		]);

    	$data = Balance::create([
            'transaction_code'   => mt_rand(1000000000, 9999999999),
			'phone_number'       => $request->phone_number,
			'value'              => $request->value,
            'user_id'            => Auth::user()->id
		]);

		return redirect()->route('payment.detail', ['transaction_code' => $data->transaction_code]);
    }
}
