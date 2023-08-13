<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function show($id)
    {

        $user = $this->user->findOrFail($id);
        return view('users.profile.show')
              ->with('user', $user);

    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.edit')
             ->with('user', $user);


    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'email'  => 'required|min:1|max:100',
            'introduction'  => 'required|min:1|max:100',
            'avatar' => 'mimes:jpg,jpeg,png,gif|max:1048'
           ]);

        $user = $this->user->findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->avatar){
        $user->avatar = 'data:image/'.$request->avatar->extension().';base64,'.base64_encode(file_get_contents($request->avatar));
        }
        $user->description = $request->introduction;
        $user->role_id = $request->role;
        $user->save();

        return redirect()->route('profile.show', $id);
    }

    public function followers($id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.followers')
             ->with('user', $user);
    }

    public function following($id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.following')
             ->with('user', $user);
    }
}
