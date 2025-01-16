<?php

namespace App\Http\Controllers;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    protected $fileName;
    public function index(){
        $documents = Documents::query()->orderBy("created_at",'desc')->paginate(10);
        return view('documents.index',compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }


    public function addFile($request)
    {
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');
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

        $document = new Documents();
        $document->title = $request->title;
        $document->description = $request->text;
        $document->file = $this->fileName;
        $document->save();

        return redirect()->route('documents.create', $document->id)->with('success','Documento creato.');
    }
    public function edit(Documents $document)
    {
        $document = Documents::find($document->id);
        return view('Documents.edit',compact('document'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|text',
            'description' => 'required|text',
            'file' => 'required|file',
        ], [
            'title.required' => 'Il titolo è obbligatorio.',
            'description.required' => 'La descrizione è obbligatoria.',
            'file.required' => 'Il file è obbligatorio.',
        ]);

        $document = Documents::find($id);
        $document->update($request->all());

        return redirect()->route('documents.edit', $document->id)->with('success','Documento modificato.');
    }
    public function destroy(Documents $document)
    {
        $document = Documents::find($document->id);
        $document->delete();
        return redirect()->route('documents.index')->with('success','Documento eliminato.');
    }
}
