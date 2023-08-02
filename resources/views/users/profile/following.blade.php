@extends('layouts.app')

@section('title','following')

@section('content')

@include('users.profile.header')

@if ($user->following->isNotEmpty())
    <div class="row justify-content-center">
        <div class="col-4">
            <h3 class="text-muted text-center">
                Following
            </h3>
            @foreach ($user->following as $following)
              <div class="row jutify-content-center">
                <div class="col-auto">
                    @if ($following->following->avatar)
                        <img src="{{$following->following->avatar}}" alt="" class="rounded-circle avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                </div>
                <div class="col ps-0 text-truncate">
                    <a href="{{route('profile.show',$following->following->id)}}" class="text-decoration-none text-dark">
                        {{$following->following->name}}
                    </a>
                </div>
                <div class="col-auto text-end">
                    @if ($following->following->isFollowed())
                        <form action="{{route('follow.destroy',$following->following->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn text-danger">Following</button>
                        </form>
                    @else
                        <form action="{{route('follow.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="following_id" value="{{$following->following->id}}">
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
    No following Yet!
</h3>
@endif

@endsection
