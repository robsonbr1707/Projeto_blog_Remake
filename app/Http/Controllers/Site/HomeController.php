<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('users')->orderBy('id', 'desc')->take(4)->get();
        $notices = Notice::with('users','comments')->orderBy('id', 'desc')->paginate(6);
            return Inertia::render('Welcome', compact('posts', 'notices'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $posts = Post::where('title', 'LIKE', '%'.$search.'%')->orderBy('id', 'desc')->get();
        $notices = Notice::where('title', 'LIKE', '%'.$search.'%')->orderBy('id', 'desc')->get();
            return Inertia::render('Search', compact('search', 'posts', 'notices'));
    }

}
