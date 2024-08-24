<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight" style="display: flex">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
				<path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
			</svg>
			<strong class="ml-2">{{ __('Editar Viagem') }}</strong>
		</h2>
	</x-slot>
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
		<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 bg-white border-b border-gray-200">
				<div class="container">

					@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif

					<form action="{{ route('viagens.update', $viagens->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-group mt-4">
							<label for="km_inicial">KM Inicial da Viagem</label>
							<input type="number" name="km_inicial" id="km_inicial" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('km_inicial', $viagens->km_inicial) }}">
							@error('km_inicial')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mt-4">
							<label for="km_final">KM Final da Viagem</label>
							<input type="number" name="km_final" id="km_final" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('km_final', $viagens->km_final) }}">
							@error('km_final')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mt-4">
							<label for="veiculo_id">Veículo</label>
							<select name="veiculo_id" id="veiculo_id" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
								<option value="">Selecione um veículo</option>
								@foreach($veiculos as $veiculo)
									<option value="{{ $veiculo->id }}" {{ old('veiculo_id', $viagens->veiculo_id) == $veiculo->id ? 'selected' : '' }}>
										{{ $veiculo->modelo }} - {{ $veiculo->ano }}
									</option>
								@endforeach
							</select>
							@error('veiculo_id')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group mt-4">
							<label for="motorista_id">Motorista</label>
							<select name="motorista_id" id="motorista_id" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
								<option value="">Selecione um motorista</option>
								@foreach($motoristas as $motorista)
									<option value="{{ $motorista->id }}" {{ old('motorista_id', $viagens->motorista_id) == $motorista->id ? 'selected' : '' }}>
										{{ $motorista->nome }}
									</option>
								@endforeach
							</select>
							@error('motorista_id')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<button type="submit" class="btn btn-padrao mt-3" style="margin-top: 15px">Atualizar Viagem</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
