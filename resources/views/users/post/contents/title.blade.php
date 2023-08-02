<div class="card-header">
    <div class="row align-items-center">
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
            <a href="{{route('profile.show',['profile' => $post->user->id])}}" class="text-dark text-decoration-none">
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
                      @if ($post->user->isFollowed())
                      <form action="{{route('follow.destroy',$post->user->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button tuype="submit" class="dropdown-item text-danger">
                            Unfollow
                        </button>
                    </form>
                      @else
                        <form action="{{route('follow.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="following_id" value="{{$post->user->id}}">
                            <button type="submit" class="dropdown-item text-danger">
                                Follow
                            </button>
                        </form>
                      @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

