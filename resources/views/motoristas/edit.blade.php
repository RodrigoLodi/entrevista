<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight" style="display: flex">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
				<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
			</svg>
			<strong class="ml-2">{{ __('Editar Motorista') }}</strong>
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

					<form action="{{ route('motoristas.update', $motorista->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-group mt-4">
							<label for="nome">Nome do Motorista</label>
							<input type="text" name="nome" id="nome" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('nome', $motorista->nome) }}">
							@error('nome')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mt-4">
							<label for="data_nascimento">Data de Nascimento</label>
							<input type="date" name="data_nascimento" id="data_nascimento" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('data_nascimento', $motorista->data_nascimento) }}">
							@error('data_nascimento')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mt-4">
							<label for="cnh">Número da CNH</label>
							<input type="text" name="cnh" id="cnh" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ old('cnh', $motorista->cnh) }}">
							@error('cnh')
								<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<button type="submit" class="btn btn-padrao mt-3" style="margin-top: 15px">Atualizar Motorista</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
