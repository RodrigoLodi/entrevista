<?php

namespace App\Http\Controllers;

use App\Models\Viagens;
use App\Models\Motoristas;
use App\Models\Veiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ViagensController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$search = $request->input('search');

		$viagens = Viagens::query()
						->when($search, function($query, $search) {
							return $query->whereHas('veiculo', function($q) use ($search) {
								$q->where('modelo', 'like', "%{$search}%");
							})
							->orWhereHas('motorista', function($q) use ($search) {
								$q->where('nome', 'like', "%{$search}%");
							});
						})
						->get();

		return view('viagens.index', compact('viagens'));
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$veiculos = Veiculos::all();
		$motoristas = Motoristas::all();
		return view('viagens.create', compact('veiculos', 'motoristas'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$validatedData = $request->validate([
			'km_inicial' => 'required|numeric',
			'km_final' => 'required|numeric|gte:km_inicial',
			'veiculo_id' => 'required|exists:veiculos,id',
			'motoristas' => 'required|array',
			'motoristas.*' => 'exists:motoristas,id',
		]);

		$viagem = Viagens::create([
			'km_inicial' => $validatedData['km_inicial'],
			'km_final' => $validatedData['km_final'],
			'veiculo_id' => $validatedData['veiculo_id'],
		]);

		$viagem->motoristas()->attach($validatedData['motoristas']);

		return redirect()->route('viagens.index')->with('success', 'Viagem criada com sucesso!');
	}




	/**
	 * Display the specified resource.
	 */
	public function show($id)
	{
		$viagem = Viagens::with(['veiculo', 'motoristas'])->find($id);
	
		if (!$viagem) {
			return redirect()->route('viagens.index')->with('error', 'Viagem não encontrada');
		}
	
		return view('viagens.show', compact('viagem'));
	}
	
	

	


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit($id)
	{
		$viagem = Viagens::with(['veiculo', 'motoristas'])->findOrFail($id);
		$veiculos = Veiculos::all();
		$motoristas = Motoristas::all();
		return view('viagens.edit', compact('viagem', 'veiculos', 'motoristas'));
	}
	
	

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, $id)
	{
		$validatedData = $request->validate([
			'km_inicial' => 'required|numeric',
			'km_final' => 'required|numeric|gte:km_inicial',
			'veiculo_id' => 'required|exists:veiculos,id',
			'motoristas' => 'required|array',
			'motoristas.*' => 'exists:motoristas,id',
		]);

		$viagem = Viagens::findOrFail($id);

		DB::transaction(function () use ($viagem, $validatedData) {
			$viagem->update([
				'km_inicial' => $validatedData['km_inicial'],
				'km_final' => $validatedData['km_final'],
				'veiculo_id' => $validatedData['veiculo_id'],
			]);

			$viagem->motoristas()->sync($validatedData['motoristas']);
		});

		return redirect()->route('viagens.index')->with('success', 'Viagem atualizada com sucesso!');
	}
	
	
	

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$viagem = Viagens::findOrFail($id);
		$viagem->delete();

		return redirect()->route('viagens.index')->with('success', 'Viagem excluído com sucesso!');
	}
}
