<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $all_posts = Post::withTrashed()->latest()->paginate(3);

        return view('admin.posts.index')
                 ->with('all_posts', $all_posts);
    }

    public function search(Request $request)
    {
        $post = $request->input('search');

        $results = Post::where('description', 'LIKE', "%$post%")->paginate(3);

        return view('admin.posts.result')
               ->with('results',$results);
    }

    public function deactivate($id)
    {
        //
        Post::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function activate($id)
    {
        //
        Post::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();

    }

}
