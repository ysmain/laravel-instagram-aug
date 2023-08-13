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
        $all_users = User::withTrashed()->where('role_id', '!=', 1)->get();

        return view('admin.users.index')
                 ->with('all_users', $all_users);
    }

    public function search(Request $request)
    {
        $user = $request->input('search');

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
