<div class="row">
    <div class="col-4">
        @if($user->avatar)
            <img src="{{$user->avatar}}" alt="{{$user->avatar}}" class="rounded-circle float-end avatar-lg d-block">
        @else
            <div class="text-center mb-2">
                <i class="icon-lg fa-solid fa-circle-user text-secondary float-end"></i>
            </div>
        @endif
    </div>
    <div class="col-8">
        <div class="mt-1">
            <h1 class="d-inline">{{$user->name}}</h1>
            @if (Auth::user()->id == $user->id)
                <a href="{{route('profile.edit',Auth::user()->id)}}" class="btn btn-outline-secondary ms-3 mb-3">Edit Profile</a>
            @else
                @if($user->isFollowed())
                    <form action="{{route('follow.destroy',$user->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary ms-3 mb-3">Following</button>
                    </form>
                @else
                    <form action="{{route('follow.store')}}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="following_id" value="{{$user->id}}">
                        <button type="submit" class="btn btn-primary ms-3 mb-3">Follow</button>
                    </form>
                @endif
            @endif
            {{-- follower数など表示 --}}
            <div class="row mb-3">
                <div class="col-auto">
                    <strong>{{$user->post->count()}}</strong> Posts
                </div>
                <div class="col-auto">
                    <a href="{{route('profile.followers',$user->id)}}" class="text-decoration-none text-dark">
                        <strong>{{$user->followers->count()}}</strong> Followers
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{route('profile.following',$user->id)}}" class="text-decoration-none text-dark">
                        <strong>{{$user->following->count()}}</strong> Following
                    </a>
                </div>
            </div>
            <p class="fw-bold">{{( $user->description) ? "$user->description" : "No Description Given" }}</p>
        </div>
    </div>
</div>
