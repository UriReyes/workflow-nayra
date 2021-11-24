<?php

namespace App\Http\Controllers\Arworkflow;

use App\Http\Controllers\Controller;
use App\Models\Arworkflow\Process;
use Illuminate\Http\Request;

class DesignerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $designer)
    {
        //TODO: Leer archivo bpmn y enviar el contenido  
        return view('Arworkflow.Designer.edit', compact('designer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Process $designer)
    {
        //TODO: guardar el archivo de bpmn y almacenar solo la ruta
        //TODO: guardar el archivo svg y almacenar solo la ruta
        $designer->update([
            'bpmn' => $request->bpmn,
            'svg' => $request->svg
        ]);
        return response()->json(['success' => 'Diseño almacenado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
