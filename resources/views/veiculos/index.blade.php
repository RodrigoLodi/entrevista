<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight" style="display: flex">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
				<path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>
				<path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/>
			</svg>
			<strong class="ml-2">{{ __('Veiculos') }}</strong>
		</h2>
	</x-slot>
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
		<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 bg-white border-b border-gray-200">
				<div class="container table-responsive">

					<form action="{{ route('veiculos.index') }}" method="GET" class="mb-4">
						<div class="d-flex">
							<div class="col-md-6">
								<input type="text" name="search" class="form-control" placeholder="Pesquisar por modelo ou Renavam" value="{{ request('search') }}">
							</div>
							<div class="col-md-2 ml-5">
								<button type="submit" class="btn btn-padrao">Filtrar</button>
							</div>
						</div>
					</form>

					<a href="{{ route('veiculos.create') }}" class="btn btn-padrao" style="margin-bottom: 15px">Adicionar Veiculo</a>
					<table class="table table-striped table-sm">
						<thead class="text-center">
							<th>#</th>
							<th>Modelo</th>
							<th>Ano</th>
							<th>Data de Aquisição</th>
							<th>KM de Aquisição</th>
							<th>Renavam</th>
							<th>Ações</th>
						</thead>
						<tbody class="text-center">
							@php $i = 1; @endphp
							@foreach ($veiculos as $veiculo)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $veiculo['modelo'] }}</td>
									<td>{{ $veiculo['ano'] }}</td>
									@php
										$temp_data_aquisicao = explode("-", $veiculo['data_aquisicao']);
										$data_aquisicao = "$temp_data_aquisicao[2]/$temp_data_aquisicao[1]/$temp_data_aquisicao[0]"
									@endphp
									<td>{{ $data_aquisicao }}</td>
									<td>{{ $veiculo['km_aquisicao'] }}</td>
									<td>{{ $veiculo['renavam'] }}</td>
									<td class="d-flex">
										<a href="{{ route('veiculos.show', $veiculo) }}" class="btn btn-info d-flex align-items-center">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
												<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
												<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
											</svg>
											<strong class="ml-2">Ver</strong>
										</a>
										<a href="{{ route('veiculos.edit', $veiculo) }}" class="btn btn-warning d-flex align-items-center ml-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
												<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
											</svg>
											<strong class="ml-2">Editar</strong>
										</a>
										<form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" style="display:inline;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger d-flex align-items-center ml-2" onclick="return confirm('Tem certeza que deseja excluir este veiculo?');">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
													<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
													<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
												</svg>
												<strong class="ml-2">Excluir</strong>
											</button>
										</form>
									</td>
									@php $i++; @endphp
								</tr>
							@endforeach						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
