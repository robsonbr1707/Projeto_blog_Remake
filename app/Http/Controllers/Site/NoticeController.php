<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class NoticeController extends Controller
{
    public function index()
    {
        $categories = Category::with('notices')->paginate(6);
            return Inertia::render('Site/Notices/Index', compact('categories'));
    }

    public function show(Notice $notice)
    {
        $hasLike = false;
        if(Auth::user()){
            $hasLike = $notice->users()->where('id', Auth::user()->id)->wherePivot('like', true)->count();
        }
        $comments = Comment::with('user')->where('notice_id', $notice->id)->get();
        $notices = Notice::with('users','comments')->orderBy('id', 'desc')->limit(6)->get();
            return Inertia::render('Site/Notices/Show', compact('hasLike', 'notice', 'notices', 'comments'));
    }

    public function like(Request $request)
    {
        $data = $request->all();
        $user = User::findOrFail(Auth::user()->id);
        $user->notices()->attach($data['notice_id'], [
            'like' => true
        ]);
            return Redirect::back()->with('success', 'Você Curtiu esta Notícia :)'); 
    }

    public function comment(Request $request)
    {
        $data = $request->all();
        Validator::make($data, [
            'comment' => ['required','max:500'],
            'notice_id' => ['required']
        ])->validate();

        Comment::create([
            'comment' => $data['comment'],
            'user_id' => Auth::user()->id,
            'notice_id' => $data['notice_id']
        ]);
            return Redirect::back()->with('success', 'Você fez um comentario nesta Notícia!');
    }
}
