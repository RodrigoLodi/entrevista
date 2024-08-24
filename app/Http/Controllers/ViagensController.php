<?php

namespace App\Http\Controllers;

use App\Models\Viagens;
use App\Models\Motoristas;
use App\Models\Veiculos;
use Illuminate\Http\Request;
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
		$validated = $request->validate([
			'km_inicial' => 'required|integer|min:0',
			'km_final' => 'required|integer|gt:km_inicial',
			'veiculo_id' => 'required|integer|exists:veiculos,id',
			'motorista_id' => 'required|integer|exists:motoristas,id',
		]);

		Viagens::create($validated);

		return redirect()->route('viagens.index')->with('success', 'Viagem cadastrada com sucesso!');
	}


	/**
	 * Display the specified resource.
	 */
	public function show($id)
	{
		$viagem = Viagens::findOrFail($id);
		return view('viagens.show', compact('viagem'));
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$viagens = Viagens::findOrFail($id);
		$veiculos = Veiculos::all();
		$motoristas = Motoristas::all();
		return view('viagens.edit', compact('viagens', 'veiculos','motoristas'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$viagens = Viagens::findOrFail($id);
		
		$validated = $request->validate([
			'km_inicial' => 'required|integer|min:0',
			'km_final' => 'required|integer|gt:km_inicial',
			'veiculo_id' => 'required|integer|exists:veiculos,id',
			'motorista_id' => 'required|integer|exists:motoristas,id',
		]);

		$viagens = Viagens::findOrFail($id);

		$viagens->update($validated);

		return redirect()->route('viagens.index')->with('success', 'Viagem atualizado com sucesso!');
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
