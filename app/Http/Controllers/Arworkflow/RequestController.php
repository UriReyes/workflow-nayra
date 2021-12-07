<?php

namespace App\Http\Controllers\Arworkflow;

use App\Http\Controllers\Controller;
use App\Models\Arworkflow\Request as ArworkflowRequest;
use App\Models\Arworkflow\Screen;
use App\Models\Arworkflow\Task;
use Illuminate\Http\Request;
use ProcessMaker\Laravel\Facades\Nayra;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = ArworkflowRequest::select('id', 'status', 'tokens')->where('status', '!=', 'COMPLETED')->orderByDesc('id')->paginate(5);
        return view('Arworkflow.Requests.index', compact('requests'));
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
    public function show(ArworkflowRequest $request)
    {
        // $tasks = Nayra::tasks($request->instance->getId());
        // dd($tasks);
        return view('Arworkflow.Requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    public function complete(Request $request, $arwokflowrequest, $token)
    {
        // Save the Task in DB
        // $tasks = Nayra::tasks($request->instance->getId());
        // $taskController = new TaskController;
        // $taskController->store($tasks);
        $data = $request->all();
        foreach ($data as $index => $value) {
            if ($value == 'on') {
                $data[$index] = true;
            } elseif ($value == 'off') {
                $data[$index] = false;
            }
        }
        // Complete Task

        $arwokflowrequestObject = Nayra::completeTask($arwokflowrequest, $token, $data);

        $tasks = Nayra::tasks($arwokflowrequestObject->getId());
        foreach ($tasks as $task) {
            $element = $task->getOwnerElement();
            $formScreen = $element->getProperty('screenRef');
            $screen = Screen::find($formScreen);
            Task::create([
                'task_nayra_id' => $task->getId(),
                'status' => $task->getStatus(),
                'name' => $element->getName(),
                'config' => $screen ? $screen : '',
            ]);
        }
        return redirect()->route('requests.show', $arwokflowrequestObject->getId());
    }
}
