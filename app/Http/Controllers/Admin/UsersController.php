<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function index()
    {
        //
        $all_users = User::withTrashed()->get()->except(Auth::user()->id);
        // withtrashed() 論理削除済みのものも含んでgetする。
        // get all trash and not trash, but except for my ID
        // get the trash and not trash but do not get my ID but still get it
        return view('admin.users.index')
                 ->with('all_users', $all_users);
    }

    public function search(Request $request)
    {
        $user = $request->input('search');

        // Perform your search logic here
        $results = User::where('name', 'LIKE', "%$user%")->get();

        return view('admin.users.result')
               ->with('results',$results);
    }

    public function deactivate($id)
    {
        //
        USER::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function activate($id)
    {
        //
        User::onlyTrashed()->findOrFail($id)->restore();
        // onlyTrashed() 論理削除（ソフトデリート）されたもののみ取得する。
        // restore() 論理削除されたものを復活させる。

        return redirect()->back();

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
        //

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //

    }
}
