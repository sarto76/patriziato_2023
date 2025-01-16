<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertiesController extends Controller
{
    protected $fileName;
    public function index(){
        $properties = Property::query()->orderBy("created_at",'desc')->paginate(10);
        return view('properties.index',compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }


    public function addFile($request)
    {
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $file->storeAs('properties', $fileName, 'public');
        $this->fileName = time() . '_' . $file->getClientOriginalName();
        $request->file = $filePath;
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string',
            'text' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ], [
            'title.required' => 'Il titolo è obbligatorio.',
            'text.required' => 'La descrizione è obbligatoria.',
            'file.required' => 'Il file è obbligatorio.',
        ]);


        if ($request->hasFile('file')) {
            $this->addFile($request);
        }

        $property = new Property();
        $property->title = $request->title;
        $property->description = $request->text;
        $property->file = $this->fileName;
        $property->save();

        return redirect()->route('properties.create', $property->id)->with('success','Proprietà creata.');
    }

    public function destroy($id)
    {
        $property = Property::find($id);


        if (Storage::disk('public')->exists('properties/' . $property->file)) {
            Storage::disk('public')->delete('properties/' . $property->file);
        }

        $property->delete();
        return redirect()->route('properties.index')->with('success','Proprietà eliminata.');
    }
}
