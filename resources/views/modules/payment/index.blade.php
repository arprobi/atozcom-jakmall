@extends('layouts.main')

@section('content')
<div class="col-12">
	<div class="card text-center">
		<div class="card-body">
			<h5 class="card-title">Your Order Number</h5>
			<p class="card-text"><b>{{ $payment->transaction_code }}</b></p>
			
			<br>
			<h5 class="card-title">Total</h5>
			<p class="card-text">{{ $payment->total }}</p>
			
			<br>
			<p class="card-text">{{ $payment->description }} will be shipped to {{ $address }} </p>

			<a href="#" class="btn btn-primary">Pay Here</a>
		</div>
	</div>
</div>
@endsection