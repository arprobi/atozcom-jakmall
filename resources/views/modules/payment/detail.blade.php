@extends('layouts.main')

@section('content')
<div class="col-12">
	<div class="card text-center">
		<div class="card-body">
			<h5 class="card-title">Your Order Number</h5>
			<p class="card-text"><b>{{ $payment->transaction_code }}</b></p>
			
			<br>
			
			<h5 class="card-title">Total</h5>
			<p class="card-text">{{ format_IDR($payment->total) }}</p>
			
			<br>

			@if($payment->transaction_type == 2)
				<p class="card-text">{{ $payment->description }} will be shipped to {{ $payment->ordered_item->shipping_address }} after you pay</p>
			@else
				<p class="card-text">{{ $payment->description }} will be topped up for {{ $payment->ordered_item->value }}</p>
			@endif
			
			<a href="{{ url('payment?order_number='.$payment->transaction_code) }}" class="btn btn-primary">Pay Here</a>
		</div>
	</div>
</div>
@endsection