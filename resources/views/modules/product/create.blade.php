@extends('layouts.main')

@section('content')
<div class="col-12">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Buy Product</h5>
			<form action="{{ route('product.store') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
					<div class="col-sm-10">
						<textarea name="product_name" class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" id="product_name"></textarea>
						@if ($errors->has('product_name'))
							<div class="invalid-feedback">{{ $errors->first('product_name') }}</div>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label for="shipping_address" class="col-sm-2 col-form-label">Shipping Address</label>
					<div class="col-sm-10">
						<textarea name="shipping_address" class="form-control {{ $errors->has('shipping_address') ? 'is-invalid' : '' }}" id="shipping_address"></textarea>
						@if ($errors->has('shipping_address'))
							<div class="invalid-feedback">{{ $errors->first('shipping_address') }}</div>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label for="price" class="col-sm-2 col-form-label">Price</label>
					<div class="col-sm-10">
						<input name="price" type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" id="proce">
						@if ($errors->has('price'))
							<div class="invalid-feedback">{{ $errors->first('price') }}</div>
						@endif
					</div>
				</div>
				<button type="submit" class="btn btn-primary float-right">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection