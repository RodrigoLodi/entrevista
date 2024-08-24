<?php

namespace App\Http\Controllers;

use App\Models\Veiculos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VeiculosController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$search = $request->input('search');

		$veiculos = Veiculos::query()
						->when($search, function($query, $search) {
							return $query->where('modelo', 'like', "%{$search}%")
										->orWhere('renavam', 'like', "%{$search}%");
						})
						->get();

		return view('veiculos.index', compact('veiculos'));
	}


	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view("veiculos.create");
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$validated = $request->validate([
			'modelo' => 'required|string|max:255',
			'ano' => 'required|integer',
			'data_aquisicao' => [
				'required',
				'date',
			],
			'km_aquisicao' => 'required|integer',
			'renavam' => 'required|string|max:255|unique:veiculos',
		]);

		Veiculos::create($validated);

		return redirect()->route('veiculos.index')->with('success', 'Veiculo cadastrado com sucesso!');
	}

	/**
	 * Display the specified resource.
	 */
	public function show($id)
	{
		$veiculo = Veiculos::findOrFail($id);
		return view('veiculos.show', compact('veiculo'));
	}
	

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$veiculo = Veiculos::findOrFail($id);
		return view('veiculos.edit', compact('veiculo'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$veiculo = Veiculos::findOrFail($id);
		
		$validated = $request->validate([
			'modelo' => 'required|string|max:255',
			'ano' => 'required|integer',
			'data_aquisicao' => [
				'required',
				'date',
			],
			'km_aquisicao' => 'required|integer',
			'renavam' => [
				'required',
				'string',
				'max:255',
				Rule::unique('veiculos')->ignore($veiculo->id),
			],
		]);

		$veiculo = Veiculos::findOrFail($id);

		$veiculo->update($validated);

		return redirect()->route('veiculos.index')->with('success', 'Veiculo atualizado com sucesso!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$veiculo = Veiculos::findOrFail($id);
		$veiculo->delete();

		return redirect()->route('veiculos.index')->with('success', 'Veiculo excluído com sucesso!');
	}
}
