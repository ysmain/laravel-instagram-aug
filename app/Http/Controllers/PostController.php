<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('users.post.create')
               ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->post->user_id = Auth::user()->id;
        $this->post->description = $request->description;
        $this->post->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));

        $this->post->save();

        foreach($request->categories as $category_id):
            $category_post[] = ['category_id'=>$category_id];
        endforeach;

        $this->post->category_post()->createMany($category_post);

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('users.post.show')
              ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $selected_categories = [];
        foreach($post->category_post as $category_post){
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.post.edit')
               ->with('post', $post)
               ->with('categories', $categories)
               ->with('selected_categories', $selected_categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $post->description = $request->description;
        if($request->image){
        $post->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        }
        $post->save();

        $post->category_post()->delete();

        foreach($request->categories as $category_id):
            $category_post[] = ['category_id'=>$category_id];
        endforeach;

        $post->category_post()->createMany($category_post);

        return redirect()->route('posts.show', $post);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->post->findOrFail($post->id)->delete();

        return redirect()->route('index');


    }
}
