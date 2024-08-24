<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight" style="display: flex">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
				<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
			</svg>
			<strong class="ml-2">{{ __('Motoristas') }}</strong>
		</h2>
	</x-slot>
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
		<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 bg-white border-b border-gray-200">
				<div class="container table-responsive">

					<form action="{{ route('motoristas.index') }}" method="GET" class="mb-4">
						<div class="d-flex">
							<div class="col-md-6">
								<input type="text" name="search" class="form-control" placeholder="Pesquisar por nome ou CNH" value="{{ request('search') }}">
							</div>
							<div class="col-md-2 ml-5">
								<button type="submit" class="btn btn-padrao">Filtrar</button>
							</div>
						</div>
					</form>

					<a href="{{ route('motoristas.create') }}" class="btn btn-padrao" style="margin-bottom: 15px">Adicionar Motoristas</a>
					<table class="table table-striped table-sm">
						<thead class="text-center">
							<th>#</th>
							<th>Nome</th>
							<th>Data de Nascimento</th>
							<th>Número da CNH</th>
							<th>Ações</th>
						</thead>
						<tbody class="text-center">
							@php $i = 1; @endphp
							@foreach ($motoristas as $motorista)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $motorista['nome'] }}</td>
									@php
										$temp_data_nascimento = explode("-", $motorista['data_nascimento']);
										$data_nascimento = "$temp_data_nascimento[2]/$temp_data_nascimento[1]/$temp_data_nascimento[0]"
									@endphp
									<td>{{ $data_nascimento }}</td>
									<td>{{ $motorista['cnh'] }}</td>
									<td class="d-flex">
										<a href="{{ route('motoristas.show', $motorista) }}" class="btn btn-info d-flex align-items-center">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
												<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
												<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
											</svg>
											<strong class="ml-2">Ver</strong>
										</a>
										<a href="{{ route('motoristas.edit', $motorista) }}" class="btn btn-warning d-flex align-items-center ml-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
												<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
											</svg>
											<strong class="ml-2">Editar</strong>
										</a>
										<form action="{{ route('motoristas.destroy', $motorista->id) }}" method="POST" style="display:inline;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger d-flex align-items-center ml-2" onclick="return confirm('Tem certeza que deseja excluir este motorista?');">
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
