<?php

namespace App\Http\Controllers;

use App\Models\Arworkflow\Screen;
use App\Models\Arworkflow\Task;
use App\Models\Contract;
use App\Models\ContractType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProcessMaker\Laravel\Facades\Nayra;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::all();
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contract = new Contract();
        $contractTypes = ContractType::all();
        return view('contracts.create', compact('contract', 'contractTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->query->set('status', 'WAITING_FOR_APPROVAL');
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file' => "required",
            'status' => "required|string|max:50",
            'contract_type_id' => 'required|integer',
        ]);
        $request->query->set('slug', Str::slug($request->name));
        $request->query->set('user_id', auth()->user()->id);

        $request->validate([
            'slug' => "required|unique:contracts,slug",
            'user_id' => 'required|integer|exists:users,id'
        ]);

        if ($request->hasFile('file')) {
            Storage::makeDirectory("public/contratos/");
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/contratos/', $fileNameToStore);
        }
        $contrato = Contract::create($request->all());
        $contrato->update(['file' => $fileNameToStore]);

        //Start Process
        $type_contract = $contrato->type;
        $process = $type_contract->process;
        $this->startProcess($process, $contrato);
        return redirect()->route('contract.index')->with('success', 'Contrato creado');
    }

    public function startProcess($process, $contrato)
    {
        if ($process->isValidModel) {
            $bpmn = $process->bpmn_path;
            // dd(file_get_contents($bpmn));
            $request = Nayra::startProcess($bpmn, "node_1", ['archivo' => $contrato->path_contract]);
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
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        $contractTypes = ContractType::all();
        return view('contracts.edit', compact('contract', 'contractTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file' => "required|file|mimetypes:application/pdf",
            'status' => "required|string|max:50",
            'contract_type_id' => 'required|integer|exists:contract_types,id',
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $request->query->set('slug', Str::slug($request->name));
        $request->validate([
            'slug' => "required|unique:contracts,slug,{$contract->id}",
        ]);

        $contract->update($request->all());

        return redirect()->route('contract.index')->with('success', 'Contrato editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
        return response()->json(['message' => 'Contrato eliminado']);
    }
}
