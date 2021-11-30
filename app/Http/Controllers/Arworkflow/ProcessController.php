<?php

namespace App\Http\Controllers\Arworkflow;

use App\Http\Controllers\Controller;
use App\Models\Arworkflow\Process;
use App\Models\Arworkflow\Screen;
use App\Models\Arworkflow\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ProcessMaker\Laravel\Facades\Nayra;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::select('id', 'name', 'description', 'isValidModel', 'user_id', 'created_at', 'updated_at')->get();
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

    public function start(Process $process)
    {
        if ($process->isValidModel) {
            $bpmn = $process->bpmn_path;
            // dd(file_get_contents($bpmn));
            $request = Nayra::startProcess($bpmn, "node_1", ['contrato_archivo' => 'contrato.pdf']);
            $tasks = Nayra::tasks($request->getId());
            foreach ($tasks as $task) {
                $element = $task->getOwnerElement();
                $formScreen = $element->getProperty('screenRef');
                $screen = Screen::find($formScreen);
                Task::create([
                    'task_nayra_id' => $task->getId(),
                    'status' => $task->getStatus(),
                    'name' => $element->getName(),
                    'config' => $screen,
                ]);
            }
            return response()->json(['message' => 'Proceso iniciado'], 200);
        } else {
            return response()->json(['message' => 'No se puede iniciar este proceso'], 404);
        }
    }

    //API
    public function getXML(Process $process)
    {
        return response()->json(['xml' => $process->config], 200);
    }
}
