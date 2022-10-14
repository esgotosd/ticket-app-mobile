@extends('layouts.app')

@section('title', 'Minhas Pinduras')

<?php

function formatDate($date)
{
	$date = explode('-', substr($date, 5, 5));
	
	return "$date[1]/$date[0]";
}

$totalValue = 0;

?>

@section('content')

	@if (isset($message))
	<div class="alert alert-{{ $message['type'] }} user-msg" role="alert">{{ $message['text'] }}</div>
	@endif

	<form class="form" action="/pay" method="post">
		@csrf 
		
		<input type="hidden" value="{{ $userId }}" name="userId">
		<div class="row">
			<div class="col">
				<table class="table">
					<thead>
						<tr>
							<th><input type="checkbox" class="check-all"></th>
							<th>Data</th>
							<th>Produto</th>
							<th>Q</th>
							<th>U</th>
							<th>T</th>
							<th>P</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($data as $item)
						<?php $totalValue+= ($item->quantity * $item->value_unit); ?>
						<tr>
							<td>
								@if (!$item->paid)
									<input type="checkbox" data-value="{{ ($item->quantity * $item->value_unit) }}" value="{{ $item->id }}" name="sales[]">
								@endif
							</td>
							<td>{{ formatDate($item->datetime) }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->quantity }}</td>
							<td>{{ $item->value_unit }}</td>
							<td>{{ ($item->quantity * $item->value_unit) }}</td>
							<td>
								@if ($item->paid)
									<strong class="text-success">S</strong>
								@else
									N
								@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row">
			<div class="col" id="total-text">
			</div>
		</div>
		
		<div class="row d-none" id="error-row">
			<div class="col">
				<div class="alert alert-danger" role="alert">Selecione um item!</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col offset-3">
				<button class="btn btn-primary">Salvar itens selecionados como pagos</button>
			</div>
		</div>
		
		<div class="row">
			<div class="col">
			Legenda:
			<ul>
				<li>Q - Quantidade</li>
				<li>U - Valor Unitário</li>
				<li>T - Valor Total</li>
				<li>P - Pago? (S - Sim, N - Não)</li>
			</ul>
			</div>
		</div>
		
		<input type="hidden" id="user-id" value="{{ $userId }}">
	</form>

@endsection

@section('script')

	<script>
		let totalValue = Number({{ $totalValue }}),
			$checkboxes = $('input[type="checkbox"]:not(.check-all)'),
			$checkAll = $('.check-all');
			
		$checkboxes.on('change', updateValues);
		$checkAll.on('change', updateValues);
		
		function updateValues() 
		{
			let text = `Total: R$ ${totalValue}`,
				$selectedItems = $checkboxes.filter(':checked');
			
			if ($selectedItems.length)
			{
				text+= ' - Total selecionado: R$ ';
				
				let selectedAmount = 0;
				$selectedItems.each((i, e) => 
				{
					selectedAmount+= Number($(e).data('value'));
				});
				
				text+= selectedAmount;
			}
			
			$('#total-text').text(text);
			
			if ($selectedItems.length !== $checkboxes.length)
			{
				$checkAll.prop('checked', false);
			}
			else 
			{
				$checkAll.prop('checked', true);
			}
		}
		
		$('table.table tbody tr').on('tap click', (e) =>
		{
			if (!$(e.target).is('input'))
			{
				let $checkbox = $(e.target).closest('tr').find('input');
				
				$checkbox.prop('checked', !$checkbox.is(':checked')).change();
			}
		});
		
		$('form').on('submit', (e) => 
		{
			if ($checkboxes.filter(':checked').length === 0)
			{
				$('#error-row').removeClass('d-none');
				e.preventDefault();
				return false;
			}
			
			$('#error-row').addClass('d-none');
		});
	</script>
@endsection