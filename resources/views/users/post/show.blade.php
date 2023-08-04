@extends('layouts.app')

@section('title','Show post')

@section('content')
<div class="row border shadow">
    <div class="col-8 p-0 border-end">
        <img src="{{$post->image}}" alt="#" class="w-100">
    </div>
    <div class="col-4 px-2">
        <div class="card-header">
            <div class="row mt-3 align-items-center">
                <div class="col-auto">
                    {{-- avatar or icon --}}
                    @if ($post->user->avatar)
                        <img src="{{$post->user->avatar}}" alt="#" class="rounded-circle avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                </div>
                <div class="col ps-0">
                    {{-- name --}}
                    <a href="{{route('profile.show',$post->user->id)}}" class="text-dark text-decoration-none">
                        {{ $post->user->name }}
                    </a>
                </div>
                <div class="col text-end">
                    {{-- actions --}}
                    <div class="dropdown">
                        <button class="btn-sm btn" data-bs-toggle="dropdown" type="button">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>

                        @if($post->user->id == Auth::user()->id)
                            <div class="dropdown-menu">
                                <a href="{{route('posts.edit',$post)}}" class="dropdown-item">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit Post
                                </a>
                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->id}}">
                                    <i class="fa-regular fa-trash-can"></i> Delete Post
                                </button>
                            </div>
                            {{-- add model code here --}}
                            <div class="modal fade" id="delete-post-{{$post->id}}" tabindex="-1" aria-labelledby="delete-post-label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-danger">
                                            <h5 class="modal-title text-danger" id="delete-post-label"><i class="fa-solid fa-circle-exclamation"></i> Delete Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <p>Are you sure you want to delete this post?</p>
                                            <img src="{{$post->image}}" alt="{{$post->image}}" class="w-25">
                                            <p>{{$post->description}}</p>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="dropdown-menu">
                                <form action="" method="post">
                                    @csrf

                                    <button tuype="submit" class="dropdown-item text-danger">Unfollow</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    <hr>
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
                        <div class="badge bg-secondary mt-2">{{$categoryPost->category->name}}</div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col mb-2">
                    <a href="{{route('profile.show',$post->user->id)}}" class="fw-bold text-dark text-decoration-none ms-1">{{$post->user->name}}</a>
                    <span class="ms-2">{{$post->description}}</span>
                    <p class="text-muted small ms-1">{{ $post->created_at->diffForHumans() }}</p>

                    @if($post->comment->isNotEmpty())
                    <div class="list-group">
                        @foreach($post->comment as $comment)
                            <div class="list-group-item border-0 p-0">
                                <a href="{{route('profile.show',$comment->user->id)}}" class="text-decoration-none text-dark fw-bold ms-1">{{$comment->user->name}}</a>
                                &nbsp;
                                <p class="fw-light d-inline">{{$comment->comment}}</p>
                            </div>

                            <form action="{{route('comments.destroy',$comment)}}" method="post">
                                @csrf
                                @method('DELETE')
                                    <span class="text-muted small ms-1">{{$comment->created_at->diffForHumans()}}</span>
                                @if($comment->user_id == Auth::user()->id)
                                    <button type="submit" class="btn text-danger btn-sm">Delete</button>
                                @endif
                            </form>
                        @endforeach
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
            </div>
        </div>
    </div>
</div>

@endsection
