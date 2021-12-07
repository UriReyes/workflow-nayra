<?php

namespace App\Http\Controllers;

use App\Models\Arworkflow\Process;
use App\Models\ContractType;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractTypes = ContractType::all();
        return view('contract-types.index', compact('contractTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contractType = new ContractType();
        $processes = Process::all();
        return view('contract-types.create', compact('processes', 'contractType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'process_id' => 'required|integer|exists:processes,id'
        ]);


        $contractType = ContractType::create($request->all());
        return redirect()->route('contract-type.index')->with('success', 'Tipo de contrato creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContractType  $contractType
     * @return \Illuminate\Http\Response
     */
    public function show(ContractType $contractType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContractType  $contractType
     * @return \Illuminate\Http\Response
     */
    public function edit(ContractType $contractType)
    {
        $processes = Process::all();
        return view('contract-types.edit', compact('processes', 'contractType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContractType  $contractType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContractType $contractType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'process_id' => 'required|integer|exists:processes,id'
        ]);

        $contractType->update($request->all());
        return redirect()->route('contract-type.index')->with('success', 'Tipo de contrato editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContractType  $contractType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContractType $contractType)
    {
        $contractType->delete();
        return response()->json(['Tipo de contrato eliminado con éxito']);
    }
}
