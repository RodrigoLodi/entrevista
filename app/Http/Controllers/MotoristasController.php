<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motoristas;

class MotoristasController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$search = $request->input('search');
		
		$motoristas = Motoristas::query()
						->when($search, function($query, $search) {
							return $query->where('nome', 'like', "%{$search}%")
										->orWhere('cnh', 'like', "%{$search}%");
						})
						->get();
		
		return view('motoristas.index', compact('motoristas'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view("motoristas.create");
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$validated = $request->validate([
			'nome' => 'required|string|max:255',
			'data_nascimento' => [
				'required',
				'date',
				function ($attribute, $value, $fail) {
					$birthdate = new \DateTime($value);
					$today = new \DateTime('today');
					$age = $birthdate->diff($today)->y;

					if ($age < 18) {
						$fail('O motorista deve ter pelo menos 18 anos.');
					}
				},
			],
			'cnh' => 'required|string|max:20',
		]);

		Motoristas::create($validated);

		return redirect()->route('motoristas.index')->with('success', 'Motorista cadastrado com sucesso!');
	}


	/**
	 * Display the specified resource.
	 */
	public function show($id)
	{
		$motorista = Motoristas::findOrFail($id);
		return view('motoristas.show', compact('motorista'));
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$motorista = Motoristas::findOrFail($id);
		return view('motoristas.edit', compact('motorista'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$validated = $request->validate([
			'nome' => 'required|string|max:255',
			'data_nascimento' => [
				'required',
				'date',
				function ($attribute, $value, $fail) {
					$birthdate = new \DateTime($value);
					$today = new \DateTime('today');
					$age = $birthdate->diff($today)->y;

					if ($age < 18) {
						$fail('O motorista deve ter pelo menos 18 anos.');
					}
				},
			],
			'cnh' => 'required|string|max:20',
		]);

		$motorista = Motoristas::findOrFail($id);

		$motorista->update($validated);

		return redirect()->route('motoristas.index')->with('success', 'Motorista atualizado com sucesso!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$motorista = Motoristas::findOrFail($id);
		$motorista->delete();

		return redirect()->route('motoristas.index')->with('success', 'Motorista excluído com sucesso!');
	}
}
