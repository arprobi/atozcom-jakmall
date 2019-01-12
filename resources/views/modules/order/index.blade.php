@extends('layouts.main')

@section('content')
<div class="col-12">
	<div class="card">
		<div class="card-body">
			
			<h5 class="card-title">Table Order</h5>
			
			<form method="POST" action="{{ route('order.search') }}">
				{{ csrf_field() }}
				<div class="input-group mb-3">
					<input name="keyword" type="text" class="form-control" placeholder="Search" aria-describedby="button-addon2" value="{{ $keyword }}">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
					</div>
				</div>
			</form>
			
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Order Number</th>
						<th scope="col">Description</th>
						<th scope="col">Total</th>
						<th scope="col">Information</th>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
					<tr>
						<th scope="row">{{ $order->transaction_code }}</th>
						<td>{{ $order->description }}</td>
						<td>{{ format_IDR($order->total) }}</td>
						<td>{!! $order->status_name !!}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			{{ $orders->links() }}
		
		</div>
	</div>
</div>
@endsection