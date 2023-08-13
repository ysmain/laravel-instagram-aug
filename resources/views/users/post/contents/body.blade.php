<div class="container p-0">
    <a href="{{route('posts.show',$post)}}">
        <img src="{{$post->image}}" alt="{{$post->image}}" class="w-100">
    </a>
</div>
<div class="card-body">
    <div class="row align-items-center">
        <div class="col-auto">
            @if($post->isLiked())
                <form action="{{route('like.destroy',$post->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm p-0">
                    <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                </form>
            @else
                <form action="{{route('like.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <button type="submit" class="btn btn-sm p-0">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            @endif
        </div>
        <div class="col-auto px-0">
            <span>{{$post->likes()->count()}}</span>
        </div>

        <div class="col text-end">
            @foreach ($post->category_post as $categoryPost)
                <div class="badge bg-secondary mt-2 bg-opacity-50">{{$categoryPost->category->name}}</div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="{{route('profile.show',$post->user->id)}}" class="fw-bold text-dark text-decoration-none">{{$post->user->name}}</a>
            <span class="ms-2">{{$post->description}}</span>
            <p class="text-muted small">{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>
        {{-- comment --}}
    @if($post->comment->isNotEmpty())
    <div class="list-group">
        @foreach($post->comment->sortBy('created_at')->take(3) as $comment)
            <div class="list-group-item border-0 p-0">
                <a href="{{route('profile.show',$comment->user->id)}}" class="text-decoration-none text-dark fw-bold">{{$comment->user->name}}</a>
                &nbsp;
                <p class="fw-light d-inline">{{$comment->comment}}</p>
            </div>

            <form action="{{route('comments.destroy',$comment)}}" method="post">
                @csrf
                @method('DELETE')
                    <span class="text-muted small">{{$comment->created_at->diffForHumans()}}</span>
                @if($comment->user_id == Auth::user()->id)
                    <button type="submit" class="btn text-danger btn-sm">Delete</button>
                @endif
            </form>
        @endforeach
        @if ($post->comment->count() > 3)
            <div class="list-group-item border-0 p-0 mb-2">
                <a href="{{route('posts.show',$post)}}">View all {{$post->comment->count()}} comments</a>
            </div>
        @endif
    </div>
    @endif

    <form action="{{route('comments.store')}}" method="post" class="form-inline">
        @csrf
        <div class="input-group">
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="text" name="comment" class="form-control" placeholder="Add a comment..." aria-describedby="button">
            <button type="submit" id="button" class="btn btn-outline-secondary">Post</button>
        </div>
    </form>
</div>
