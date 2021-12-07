<?php

use App\Http\Controllers\Arworkflow\DesignerController;
use App\Http\Controllers\Arworkflow\ProcessController;
use App\Http\Controllers\Arworkflow\RequestController;
use App\Http\Controllers\Arworkflow\ScreenController;
use App\Http\Controllers\Arworkflow\TaskController;
use App\Http\Controllers\Arworkflow\UserController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractTypeController;
use App\Models\Arworkflow\Screen;
use App\Models\Arworkflow\Task;
use Illuminate\Support\Facades\Route;
use ProcessMaker\Laravel\Facades\Nayra;
use ProcessMaker\Laravel\Models\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    // API Routes
    Route::get('process/{process}/xml', [ProcessController::class, 'getXML'])->name('process.getXML');
    Route::get('screens/{screen}/get-form', [ScreenController::class, 'getForm'])->name('screens.getForm');
    Route::get('screens/get-forms', [ScreenController::class, 'getForms'])->name('screens.getForms');
    Route::get('users/get', [UserController::class, 'getUsers'])->name('users.get');

    // Routes Workflow
    Route::post('requests/complete/{request}/{token}', [RequestController::class, 'complete'])->name('requests.complete');
    Route::resource('requests', RequestController::class);
    Route::get('tasks/{task}/{requestId}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::resource('tasks', TaskController::class)->except(['edit']);
    Route::post('process/{process}/start', [ProcessController::class, 'start'])->name('process.start');
    Route::resource('process', ProcessController::class);
    Route::resource('designer', DesignerController::class);
    Route::get('screens/builder/{screen}', [ScreenController::class, 'screenBuilder'])->name('screens.builder');
    Route::resource('screens', ScreenController::class);

    // Independent System
    Route::resource('contract', ContractController::class);
    Route::resource('contract-type', ContractTypeController::class);
});

Route::get('/start', function () {
    $request = Nayra::startProcess(base_path('public/bpmn/example2.xml'), 'node_2');
    $tasks = Nayra::tasks($request->getId());
    foreach ($tasks as $task) {
        $element = $task->getOwnerElement();
        $formScreen = $element->getProperty('screenRef');
        $screen = Screen::find($formScreen);
        Task::create([
            'task_nayra_id' => $task->getId(),
            'name' => $element->getName(),
            'config' => $screen
        ]);
    }
    return redirect('/status/' . $request->getId());
});

Route::get('/status/{requestId}', function ($requestId) {
    $instance = Nayra::getInstanceById($requestId);
    $request = Request::find($requestId);
    // foreach ($instance->getTokens() as $token) {
    //     dd($token->getOwnerElement()->getProperty('screenRef'));
    // }
    return view('request', compact('request', 'instance'));
});

Route::get('/complete/{requestId}/{tokenId}', function ($requestId, $tokenId) {

    $request = Nayra::completeTask($requestId, $tokenId, ['aprobado' => true]);
    return redirect('/status/' . $request->getId());
});

require __DIR__ . '/auth.php';
