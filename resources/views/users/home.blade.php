@extends('layouts.app')

@section('title','Home')

@section('content')

    <div class="row">
        <div class="col-8">
            {{-- post display --}}
            @forelse ($all_post as $post)
                <div class="card mb-4">
                    {{-- header --}}
                    @include('users.post.contents.title')
                    {{-- body --}}
                    @include('users.post.contents.body')
                </div>

            @empty
                <div class="mt-5">
                    <h2 class="text-muted text-center">
                        No posts found, <br> Follow someone or <a href="{{route('posts.create')}}" class="text-decoration-none">create a post</a>
                    </h2>
                </div>
            @endforelse
        </div>
        {{-- suggestions --}}
        <div class="col-4">
           <div class="row mb-2">
              <div class="col-9 text-secondary fw-bold">Suggestions for you</div>
              <div class="col-3">
                 <a href="{{route('suggested')}}" class="text-decoration-none">See all</a>
              </div>
           </div>
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
