@extends('layouts.app')

@section('title', 'Profile')

@section('content')

@include('users.profile.header')

<div class="row">
    @forelse ($user->post as $post)
        <div class="col-4 p-2">
            <a href="{{route('posts.show',$post)}}">
              <img src="{{$post->image}}" alt="" class="w-100">
            </a>
        </div>
    @empty
        <div class="text-center">
            <h2>No post yet</h2>
        </div>
    @endforelse
    <div class="col-4">

    </div>
</div>



@endsection
