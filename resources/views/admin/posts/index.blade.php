@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.leftbar')
    </div>
    <div class="col">
        <div class="float-end mb-3">
            <form action="{{route('admin.posts.search')}}" method="GET">
              <input type="text" name="search" class="form-control" placeholder="Search for posts">
            </form>
        </div>
        <table class="table table-hover align-middle bg-white border text-secondary">
            <thead class="table-primary small text-secondary">
                <tr>
                    <td></td>
                    <td></td>
                    <td>CATEGORY</td>
                    <td>OWNER</td>
                    <td>CREATED AT</td>
                    <td>STATUS</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_posts as $posts)
                <tr>
                    <td>{{$posts->id}}</td>
                    <td><img src="{{$posts->image}}" alt="" class="img-fluid" style="width:90px"></td>
                    <td>
                        @foreach($posts ->category_post as $categoryPost)
                        <div class="badge bg-secondary bg-opacity-50">
                           {{$categoryPost->category->name}}
                        </div>
                        @endforeach
                    </td>
                    <td>{{$posts->user->name}}</td>
                    <td>{{$posts->created_at}}</td>
                    <td>
                         @if ($posts->trashed())
                        {{-- ソフトデリート(論理削除)されたものは赤く表示される。 --}}
                        <i class="fa-solid fa-circle-minus text-secondary"></i> Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> Visible
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                        @if ($posts->trashed())
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-post-{{$posts->id}}">
                                    <i class="fa-solid fa-eye"></i> Unhide Post {{$posts->id}}
                                </button>
                            </div>
                        @else
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-post-{{$posts->id}}">
                                    <i class="fa-solid fa-eye-slash"></i> Hide Post {{$posts->id}}
                                </button>
                            </div>
                        @endif
                        </div>
                        @include('admin.posts.modal.status')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            {{$all_posts->links()}}
        </div>
    </div>
</div>



@endsection
