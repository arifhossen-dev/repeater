<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::with('contents')->get();

        dd($modules);
        return view('modules.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'modules.*.name' => 'required|string',
            'modules.*.contents.*.name' => 'required|string',
        ]);


        foreach ($data['modules'] as $moduleData) {
            $module = Module::create(['name' => $moduleData['name']]);
            foreach ($moduleData['contents'] as $contentData) {
                $module->contents()->create(['name' => $contentData['name']]);
            }
        }

//        return redirect()->back()->with('success', 'Modules and contents created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
