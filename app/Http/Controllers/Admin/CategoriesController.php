<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(){
        $posts=Post::all();
        $count=0;

        foreach($posts as $post){
        if($post->category_post()->count() == 0){
            $count++;
        }
        }

        $nocategory_count = $count;

        $all_categories = Category::all();

        return view('admin.categories.index')
                ->with('all_categories', $all_categories)
                ->with('nocategory_count', $nocategory_count);

    }

    public function store(Request $request)
    {
        //
        $this->category->name = $request->category;
        $this->category->save();

        return redirect()->back();


    }

    public function update(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->name = $request->category;
        $category->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        //
        $this->category->findOrFail($id)->delete();

        return redirect()->back();

    }

    public function search(Request $request)
    {
        $category = $request->input('search');

        $results = Category::where('name', 'LIKE', "%$category%")->get();

        return view('admin.categories.result')
               ->with('results',$results);
    }

}

