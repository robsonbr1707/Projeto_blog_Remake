<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('records')->paginate(6);
            return Inertia::render('Admin/Posts/Index', compact('posts'));
    }

    public function create()
    {
        return Inertia::render('Admin/Posts/Create');
    }

    protected function imageUpload($img, $title)
    {
        $extension = $img->extension();
        $image_name = Str::slug($title, '-').'.'.$extension;
            return $img ? $img->storeAs('posts', $image_name, 'public') : null;
    }

    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->imageUpload($request->image, $request->title);

        Post::create($data);
            return Redirect::route('posts.index')->with('success', 'Post Criado com Sucesso!');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Edit', compact('post'));
    }

    public function update($id, PostRequest $request)
    {
        $data = $request->all();
        $post = Post::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($post->image);
            $post->image = $this->imageUpload($request->image, $request->title);
        }

        $post->update([
            'title' => $data['title'],
            'resume' => $data['resume'],
            'image' => $post->image,
        ]);
            return Redirect::route('posts.index')->with('success', 'Post Atualizado!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Storage::disk('public')->delete($post->image);
        $post->delete();
            return Redirect::route('posts.index')->with('success', 'Post Excluido!');
    }
}
