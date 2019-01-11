<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class OrderController extends Controller
{
    public function index()
    {
    	$order = Payment::all();
    	dd($order);
    }
}
