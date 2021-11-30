<?php

namespace App\Http\Controllers\Arworkflow;

use App\Http\Controllers\Controller;
use App\Models\Arworkflow\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScreenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screens = Screen::get();
        return view('Arworkflow.Screens.index', compact('screens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Arworkflow.Screens.create');
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
            'slug' => 'unique:screens,slug'
        ]);

        $logged_user = auth()->user();
        $screen = Screen::create([
            'title' => $request->name,
            'description' => $request->description,
            'user_id' => $logged_user->id,
            'slug' => $request->slug,
        ]);
        return redirect()->route('screens.builder', ['screen' => $screen->id])->with('success', 'Screen Creado');
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
    public function update(Request $request, Screen $screen)
    {
        $screen->update([
            'config' => $request->savedConfig,
            'computed' => $request->computed,
            'custom_css' => $request->customCSS,
            'watchers' => $request->savedWatchers
        ]);
        return response()->json(['success' => true, 'message' => 'Screen almacenado']);
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

    public function screenBuilder(Screen $screen)
    {
        return view('Arworkflow.Screens.builder', compact('screen'));
    }

    //API Methods
    public function getForm(Screen $screen)
    {
        return response()->json(['screen' => $screen]);
    }
    public function getForms()
    {
        $forms = Screen::select('id', 'title')->where('type', 'FORM')->orderByDesc('id')->get();
        $formsList = [];
        foreach ($forms as $form) {
            array_push($formsList, ['value' => $form->id, 'content' => $form->title]);
        }

        return response()->json(['forms' => $formsList]);
    }
}
