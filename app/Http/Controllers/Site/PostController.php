<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Post;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
       $posts = Post::with('users')->orderBy('id', 'desc')->get();
            return Inertia::render('Site/Posts/Index', compact('posts'));
    }

    public function show(Post $post)
    {
        $hasLike = false;
        if(Auth::user()){
            $hasLike = $post->users()->where('id', Auth::user()->id)->wherePivot('like', true)->count();
        }
        $records = Record::where('post_id', $post->id)->paginate(3);
        $notices = Notice::with('users','comments')->orderBy('id', 'desc')->get();
            return Inertia::render('Site/Posts/Show', compact('post', 'hasLike', 'records', 'notices'));
    }

    public function like(Request $request)
    {
        $data = $request->all();
        $user = User::findOrFail(Auth::user()->id);
        $user->posts()->attach($data['post_id'], [
            'like' => true
        ]);
            return Redirect::back()->with('success', 'Você Curtiu este Post :)'); 

    }
}
