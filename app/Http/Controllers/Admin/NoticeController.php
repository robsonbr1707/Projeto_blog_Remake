<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoticeRequest;
use App\Models\Category;
use App\Models\Notice;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::with('category')->paginate(6);
            return Inertia::render('Admin/Notices/Index', compact('notices'));
    }

    protected function imageUpload($img, $title)
    {
        $extension = $img->extension();
        $image_name = Str::slug($title, '-').'.'.$extension;
            return $img ? $img->storeAs('notices', $image_name, 'public') : null;
    }

    public function create()
    {
        $categories = Category::all();
            return Inertia::render('Admin/Notices/Create', compact('categories'));
    }

    public function store(NoticeRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->imageUpload($request->image, $request->title);

        Notice::create($data);
            return Redirect::route('notices.index')
            ->with('success', 'Notícia Criada com Sucesso !!');
    }

    public function edit(Notice $notice)
    {
        $categories = Category::all();
            return Inertia::render('Admin/Notices/Edit', compact('notice', 'categories'));
    }

    public function update($id, NoticeRequest $request)
    {
        $data = $request->all();
        $notice = Notice::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($notice->image);
            $notice->image = $this->imageUpload($request->image, $request->title);
        }
        
        $notice->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $notice->image,
            'category_id' => $data['category_id']
        ]);
            return Redirect::route('notices.index')
            ->with('success', 'Notícia Atualizada !!');
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        Storage::disk('public')->delete($notice->image);
        $notice->delete();
            return Redirect::route('notices.index')->with('success', 'Notícia Excluida !!');
    }
}
