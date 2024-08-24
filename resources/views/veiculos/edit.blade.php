<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight" style="display: flex">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
				<path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>
				<path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/>
			</svg>
			<strong class="ml-2">{{ __('Editar Veiculo') }}</strong>
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

					<form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-group mt-4">
							<label for="nome">Modelo do Veiculo</label>
							<input type="text" name="modelo" id="modelo" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('modelo', $veiculo->modelo) }}">
							@error('modelo')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mt-4">
							<label for="ano">Ano do Veiculo</label>
							<input type="number" name="ano" id="ano" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" min="1900" max="{{ date('Y') }}" step="1" value="{{ old('ano', $veiculo->ano) }}">
							@error('ano')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mt-4">
							<label for="data_aquisicao">Data da Aquisição</label>
							<input type="date" name="data_aquisicao" id="data_aquisicao" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('data_aquisicao', $veiculo->data_aquisicao) }}">
							@error('data_aquisicao')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mt-4">
							<label for="km_aquisicao">KM da Aquisição</label>
							<input type="number" name="km_aquisicao" id="km_aquisicao" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('km_aquisicao', $veiculo->km_aquisicao) }}">
							@error('km_aquisicao')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mt-4">
							<label for="renavam">Renavam</label>
							<input type="number" name="renavam" id="renavam" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('renavam', $veiculo->renavam) }}">
							@error('renavam')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<button type="submit" class="btn btn-padrao mt-3" style="margin-top: 15px">Atualizar Veiculo</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
