<?php

namespace App\Http\Controllers\Arworkflow;

use App\Http\Controllers\Controller;
use App\Models\Arworkflow\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::select('id', 'name', 'user_id', 'created_at', 'updated_at')->get();
        return view('Arworkflow.Process.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Arworkflow.Process.create');
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
            'description' => 'required|string|max:800',
        ]);

        $request->query->set('slug', Str::slug($request->name));
        $request->validate([
            'slug' => 'unique:processes,slug'
        ]);

        $logged_user = auth()->user();
        $process = Process::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $logged_user->id,
            'slug' => $request->slug,
        ]);
        return redirect()->route('designer.edit', ['designer' => $process->id])->with('success', 'Proceso Creado');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    //API
    public function getXML(Process $process)
    {
        return response()->json(['xml' => $process->config], 200);
    }
}
