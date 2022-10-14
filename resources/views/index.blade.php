
@extends('layouts.app')

@section('title', 'Registrar Pindura')

@section('content')

	@if (isset($message))
	<div class="alert alert-{{ $message['type'] }} user-msg" role="alert">{{ $message['text'] }}</div>
	@endif

	<form class="form" action="/save" method="post">
		@csrf 
		
		<div class="row">
			<div class="col">
				<label class="form-label">Produto</label>
				<select class="form-control" name="product_id" required>
				@foreach ($products as $product)
					<option value="{{ $product->id }}">{{ $product->name }}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<label class="form-label">Quantidade</label>
				<input class="form-control" name="qty" type="number" min="1" value="1" required>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col col-1 offset-9">
				<button class="btn btn-primary">Salvar</button>
			</div>
		</div>
		
		@if (isset($userId))
			<input type="hidden" id="user-id" value="{{ $userId }}">
		@else 
			<input type="hidden" id="user-id">
		@endif
	</form>

@endsection