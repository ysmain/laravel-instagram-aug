<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{
    private $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->comment->comment = $request->comment;
        $this->comment->post_id = $request->post_id;
        $this->comment->user_id = Auth::user()->id;
        $this->comment->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comment $comment)
    {
        $this->comment->findOrFail($comment->id)->delete();

        return redirect()->back();
    }
}
