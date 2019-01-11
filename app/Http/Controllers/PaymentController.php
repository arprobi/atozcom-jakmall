<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;
use App\Product;
use App\Payment;

class PaymentController extends Controller
{
    public function index()
    {
    	$payments = Payment::all();
    	return view('modules.payment.index', compact('payments'));
    }

    public function detail($transaction_code)
    {
    	$payment = Payment::where('transaction_code', $transaction_code)->first();
    	return view('modules.payment.detail', compact('payment'));
    }
}
