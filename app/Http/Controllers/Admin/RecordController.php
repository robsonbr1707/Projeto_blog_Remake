<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class RecordController extends Controller
{
    protected $post_id;
    public function __construct(Request $request)
    {   
        $this->post_id = $request->post_id;
    }

    public function index()
    {
        $records = Record::where('post_id', $this->post_id)->paginate(6);
            return Inertia::render('Admin/Records/Index', ['records' => $records, 'post_id' => $this->post_id]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Admin/Records/Create', ['post_id' => $request->post_id]);
    }

    protected function imageUpload($img, $title)
    {
        $extension = $img->getClientOriginalExtension();
        $image_name =  Str::slug($title, '-').'.'.$extension;
            return $img ? $img->storeAs('records', $image_name, 'public') : null;
    }

    public function store(RecordRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->imageUpload($request->image, $request->title);

        Record::create($data);
            return Redirect::route('records.index', ['post_id' => $data['post_id']])
            ->with('success', 'Registro Criado com Sucesso!!');
    }

    public function edit(Record $record)
    {
        return Inertia::render('Admin/Records/Edit', compact('record'));
    }

    public function update($id, RecordRequest $request)
    {
        $data = $request->all();
        $record = Record::findOrFail($id);
        
        if($request->hasFile('image')){
            Storage::disk('public')->delete($record->image);
            $record->image = $this->imageUpload($request->image, $request->title);
        }

        $record->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $record->image,
        ]);
            return Redirect::route('records.index', ['post_id' => $record->post_id])
            ->with('success', 'Registro Atualizado com Sucesso!');
    }

    public function destroy($id)
    {
        $record = Record::FindOrFail($id);
        Storage::disk('public')->delete($record->image);
        $record->delete();
            return Redirect::route('records.index', ['post_id' => $record->post_id])
            ->with('success', 'Registro Excluido!');
    }

}
