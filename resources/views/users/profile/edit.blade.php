@extends('layouts.app')

@section('title','Edit Profile')

@section('content')
<div class="row jutify-content-center">
    <div class="col-2"></div>
    <div class="col-8">
        <form action="{{route('profile.update',['profile'=>Auth::user()->id])}}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-4">
                    @if($user->avatar)
                        <div class="text-secondary">
                            <h4 class="ms-2">Update Profile</h4>
                            <img src="{{$user->avatar}}" alt="{{$user->avatar}}" class="rounded-circle img-fluid">
                        </div>
                    @else
                        <div class="text-center">
                            <h4 class="text-secondary">Update Profile</h4>
                            <i class="icon-lg fa-solid fa-circle-user text-secondary"></i>
                        </div>
                    @endif
                </div>
                <div class="col-8 mt-auto">
                    <input type="file" name="avatar" id="" class="form-control">
                    @error('avatar')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-text">
                        The acceptable formats jpg, jpeg, png and gif only <br>
                        Max file size is 1048kB
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="form-group">
                    <label for="name" class="fw-bold">Name</label>
                    <input type="text" class="form-control mt-2" name="name" id="name" value="{{$user->name}}">
                </div>
                @error('name')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror

                <div class="form-group mt-2">
                    <label for="email" class="fw-bold">Email Address</label>
                    <input type="mail" class="form-control mt-2" name="email" id="email" value="{{$user->email}}">
                </div>
                @error('email')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror

                <div class="form-group mt-2">
                    <label for="introduction" class="fw-bold mb-2">Introduction</label>
                    <textarea name="introduction" id="introduction" cols="30" rows="3" class="form-control">{{$user->description}}</textarea>
                </div>
                @error('introduction')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror

                <div class="form-group mt-2">
                    <label for="email" class="fw-bold">roleid</label>
                    <input type="number" class="form-control mt-2" name="role" id="email" value="{{$user->role_id}}">
                </div>

                <button type="submit" class="btn btn-warning mt-3 w-25 ms-3">Save</button>
            </div>
        </form>
    </div>
    <div class="col-auto"></div>
</div>



@endsection

