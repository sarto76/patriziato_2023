<?php

namespace App\Http\Controllers;
use App\Models\Component;
use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    public function index(){
        $components = Component::query()->paginate(10);
        return view('component.index',compact('components'));
    }

    public function edit(Component $component)
    {
        $component = Component::find($component->id);
        return view('component.edit',compact('component'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'role' => 'required|max:255',
        ]);

        $component = Component::find($id);
        $component->update($request->all());

        return redirect()->route('component.edit', $component->id)->with('success','Membro ufficio modificato.');
    }

}
