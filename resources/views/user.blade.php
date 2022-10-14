
@extends('layouts.app')

@section('title', 'Registrar Usuário')

@section('content')

	<form class="form" action="/user-save" method="post">
		@csrf
		
		<div class="row">
			<div class="col">
				<label class="form-label">Nome</label>
				<input class="form-control" type="text" name="name" maxlength="30" placeholder="Digite seu nome" required>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col col-1 offset-9">
				<button class="btn btn-primary">Salvar</button>
			</div>
		</div>
	</form>

@endsection