@extends('layouts.app')

@section('title','Home')

@section('content')

    <div class="row justify-content-center">
        <div class="col-4">
           <div class="h3 text-secondary fw-bold text-center mb-3">Suggested</div>
           @foreach ($suggested_users as $user)
               <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        @if($user->avatar)
                          <img src="{{$user->avatar}}" alt="" class="rounded-circle avatar-sm">
                        @else
                          <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                        @endif
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{route('profile.show',$user->id)}}" class="text-decoration-none text-dark">
                        {{$user->name}}
                        </a>
                    </div>
                    <div class="col-auto">
                        <form action="{{route('follow.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="following_id" value="{{$user->id}}">
                            <button type="submit" class="btn text-primary">Follow</button>
                        </form>
                    </div>
               </div>
           @endforeach
        </div>
    </div>
@endsection
