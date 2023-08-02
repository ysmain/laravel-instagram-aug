@extends('layouts.app')

@section('title','Followers')

@section('content')

@include('users.profile.header')

@if ($user->followers->isNotEmpty())
    <div class="row justify-content-center">
        <div class="col-4">
            <h3 class="text-muted text-center">
                Followers
            </h3>
            @foreach ($user->followers as $follower)
              <div class="row jutify-content-center">
                <div class="col-auto">
                    @if ($follower->follower->avatar)
                        <img src="{{$follower->follower->avatar}}" alt="" class="rounded-circle avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                </div>
                <div class="col ps-0 text-truncate">
                    <a href="{{route('profile.show',$follower->follower->id)}}" class="text-decoration-none text-dark">
                        {{$follower->follower->name}}
                    </a>
                </div>
                <div class="col-auto text-end">
                    @if ($follower->follower->isFollowed())
                        <form action="{{route('follow.destroy',$follower->follower->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn text-danger">Following</button>
                        </form>
                    @else
                        <form action="{{route('follow.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="following_id" value="{{$follower->follower->id}}">
                            <button type="submit" class="btn text-primary">Follow</button>
                        </form>
                    @endif
                </div>
              </div>
            @endforeach
        </div>
    </div>
@else
    <h3 class="text-center text-muted">
        No Followers Yet!
    </h3>
@endif

@endsection
