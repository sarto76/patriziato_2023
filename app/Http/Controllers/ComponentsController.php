<?php

namespace App\Http\Controllers;
use App\Models\Component;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentsController extends Controller
{
    public function index(){
        $components = Component::query()->paginate(10);
        return view('component.index',compact('components'));
    }

    public function create()
    {
        return view('component.create');
    }

    public function edit(Component $component)
    {
        $component = Component::find($component->id);
        return view('component.edit',compact('component'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'role' => 'required|max:255',
            'picture' => 'nullable|image|max:2048|dimensions:min_width=300,min_height=300,ratio=1/1',
        ]);



        $component = new Component();
        $component->firstname = $request->firstname;
        $component->lastname = $request->lastname;
        $component->role = $request->role;
        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('components', 'public');
            $component->picture = $imagePath;
        }

        $component->save();

        return redirect()->route('component.create', $component->id)->with('success','Membro ufficio aggiunto.');
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'role' => 'required|max:255',
            'picture' => 'nullable|image|max:2048|dimensions:min_width=300,min_height=300,ratio=1/1',
        ]);

        $component = Component::find($id);

        $component->fill($request->except('picture'));

        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('components', 'public');
            $component->picture = $imagePath;
        }

        $component->save();

        return redirect()->route('component.edit', $component->id)->with('success','Membro ufficio modificato.');
    }

    public function destroy($id)
    {
        $document = Component::find($id);


        if (Storage::disk('public')->exists('components/' . $document->file)) {
            Storage::disk('public')->delete('components/' . $document->file);
        }

        $document->delete();
        return redirect()->route('component.index')->with('success','Membro eliminato.');
    }

}
