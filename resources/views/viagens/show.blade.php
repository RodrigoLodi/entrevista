<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes da Viagem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="container">
                    <div class="form-group mt-4">
                        <label for="veiculo">Veículo</label>
                        <input type="text" name="veiculo" id="veiculo" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ $viagem->veiculo->modelo ?? 'Veículo não disponível' }}" readonly>
                    </div>

                    <div class="form-group mt-4">
                        <label for="motoristas">Motoristas</label>
                        <ul>
                            @foreach($viagem->motoristas as $motorista)
                                <li>{{ $motorista->nome }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="form-group mt-4">
                        <label for="km_inicial">KM Inicial</label>
                        <input type="number" name="km_inicial" id="km_inicial" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ $viagem->km_inicial }}" readonly>
                    </div>

                    <div class="form-group mt-4">
                        <label for="km_final">KM Final</label>
                        <input type="number" name="km_final" id="km_final" class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" value="{{ $viagem->km_final }}" readonly>
                    </div>

                    <a href="{{ route('viagens.index') }}" class="btn btn-padrao mt-3" style="margin-top: 15px">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
