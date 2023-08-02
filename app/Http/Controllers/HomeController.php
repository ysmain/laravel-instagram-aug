<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_posts = $this->getUserPosts();
        $suggested_users = $this->getSuggestedUsers();

        return view('users.home')
              ->with('all_post', $all_posts)
              ->with('suggested_users', $suggested_users);
    }

    public function getUserPosts()
    {
        $all_posts = Post::latest()->get();
        $home_posts = [];

        foreach($all_posts as $post){
          if($post->user->isFollowed() || $post->user->id === Auth::user()->id){ //check if I follow this user
             $home_posts[] = $post;        // if true, get his post.Put it inside home post
          }
        }
        return $home_posts;
    }

    public function getSuggestedUsers(){
        $all_users = User::all()->except(Auth::user()->id);
        $suggested_users = [];
        foreach($all_users as $user){
            if(!$user->isFollowed()){
              $suggested_users[] = $user;
            }
        }
        //if(!)!を置くことでifの逆条件を指定できる。この場合はフォロワーに自分が含まれてないものをarrayに入れることができる。
        return $suggested_users;
    }

    public function suggested()
    {
        $suggested_users = $this->getSuggestedUsers();

        return view('users.suggested')
              ->with('suggested_users', $suggested_users);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        // Perform your search logic here
        // where(column_name, operator, value)
        // % ~~ wildcard or anything before or after 2文字以上置ける　ワイルドカード
        $results = User::where('name', 'LIKE', "%$search%")->get();

        return view('users.result')
               ->with('results',$results)
               ->with('search',$search);
    }

}
