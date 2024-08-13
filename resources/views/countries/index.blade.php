@extends('layouts.index')

@section('title', 'Países')

@section('category', 'Países')

@section('action-button')
	<button class="btn btn-info mt-4">Agregar</button>
@endsection

@section('content')
<table class="table table-hover">
	<thead class="table-info">
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Continente</th>
			<th>Población</th>
			<th>Idioma</th>
			<th>Moneda</th>
			<th>Capital</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($countries as $country)
			<tr>
				<td>{{ $loop->index +1 }}</td>
				<td>{{ $country->name }}</td>
				<td>{{ $country->continent }}</td>
				<td>{{ $country->population }}</td>
				<td>{{ $country->language }}</td>
				<td>{{ $country->currency }}</td>
				<td></td>
				<td class="text-center">
					<a href="{{ route('countries.item', $country->id) }}" class="btn btn-sm btn-primary">
						<i class="fa fa-eye"></i>
					</a>
					<button class="btn btn-sm btn-warning">
						<i class="fa fa-edit"></i>
					</button>
					<button class="btn btn-sm btn-danger">
						<i class="fa fa-remove mx-1"></i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<div class="row mt-3">
	<div class="col text-center"> 
		{!! $countries->withQueryString()->links('pagination::bootstrap-5') !!}
	</div>
</div>

@endsection