<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\PaymentJob;
use Carbon\Carbon;

use App\Balance;
use App\Product;
use App\Payment;

class PaymentController extends Controller
{
    public function index()
    {
    	$payments          = Payment::all();
        $transaction_code  = request()->get('order_number', false);
    	return view('modules.payment.index', compact('payments', 'transaction_code'));
    }

    public function detail($transaction_code)
    {
    	$payment = Payment::where('transaction_code', $transaction_code)->first();
    	return view('modules.payment.detail', compact('payment'));
    }

    public function pay(Request $request)
    {
        $order = Payment::where('transaction_code', $request->transaction_code)->first();
        if (!$order) {
            return back()->with('failed', 'Code not found!');
        }else {
            dispatch(new PaymentJob($order))->delay(Carbon::now()->addSeconds(60));
            return back()->with('success', 'Payment success!');
        }
    }
}
