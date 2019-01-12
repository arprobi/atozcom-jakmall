<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
    	$orders    = Payment::where('user_id', Auth::user()->id)->paginate(20);
        $keyword   = '';
        return view('modules.order.index', compact('orders', 'keyword'));
    }

    public function search(Request $request)
    {
        $orders     = Payment::where('user_id', Auth::user()->id)->search($request->keyword)->paginate(20);
        $keyword    = $request->keyword;
    	return view('modules.order.index', compact('orders', 'keyword'));
    }
}
