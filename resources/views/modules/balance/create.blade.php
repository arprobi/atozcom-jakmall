@extends('layouts.main')

@section('content')
<div class="col-12">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Prepaid Balance</h5>
			<form action="{{ route('balance.store') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
					<div class="col-sm-10">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">081</div>
							</div>
							<input name="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" id="phone_number" placeholder="Your phone number">
							@if ($errors->has('phone_number'))
								<div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
							@endif
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="value" class="col-sm-2 col-form-label">Value</label>
					<div class="col-sm-10">
						<select name="value" class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" placeholder="Value" id="value">
							<option value="10000">10.000</option>
							<option value="50000">50.000</option>
							<option value="100000">100.000</option>
						</select>
						@if ($errors->has('value'))
							<div class="invalid-feedback">{{ $errors->first('value') }}</div>
						@endif
					</div>
				</div>
				<button type="submit" class="btn btn-primary float-right">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection