<?php

namespace App\Http\Controllers\Arworkflow;

use App\Http\Controllers\Controller;
use App\Models\Arworkflow\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $processName = $designer->slug;
        $bpmnFile = "{$processName}.bpmn";
        $svgFile = "{$processName}.svg";
        $BASE_PATH_PROCESS = "/workflow/process";
        $BASE_PATH_SVG = "/workflow/svg";
        //Crear el directorio si no existe
        Storage::disk('public')->makeDirectory("{$BASE_PATH_PROCESS}/{$processName}");
        Storage::disk('public')->makeDirectory("{$BASE_PATH_SVG}/{$processName}");

        //Guardar el archivo modelado del proceso
        Storage::disk('public')->put("{$BASE_PATH_PROCESS}/{$processName}/{$bpmnFile}", $request->bpmn);
        //TODO: guardar el archivo svg y almacenar solo la ruta
        Storage::disk('public')->put("{$BASE_PATH_SVG}/{$processName}/{$svgFile}", $request->svg);

        $isValidModel =  $request->existErrors ? false : true;
        $designer->update([
            'bpmn' => $bpmnFile,
            'svg' => $svgFile,
            'isValidModel' => $isValidModel
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
