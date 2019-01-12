@extends('layouts.main')

@section('content')
<div class="col-12">
	<div class="card">
		<div class="card-body">
			@if (session('success'))
			<div class="alert alert-success" role="alert">
				{{ session('success') }}
			</div>
			@endif
			@if (session('failed'))
			<div class="alert alert-danger" role="alert">
				{{ session('failed') }}
			</div>
			@endif
			<h5 class="card-title">Payment</h5>
			<form action="{{ route('payment.pay') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="transaction_code" class="col-sm-2 col-form-label">Order Number</label>
					<div class="col-sm-10">
				      <input name="transaction_code" type="text" class="form-control" id="transaction_code" placeholder="Password" value="{{ $transaction_code }}">
					</div>
				</div>
				<button type="submit" class="btn btn-primary float-right">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection