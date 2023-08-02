@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.leftbar')
    </div>
    <div class="col">
        <div class="row">
            <div class="col-5 mb-3">
                <form action="{{route('admin.categories.store')}}" method="post" class="form-inline">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="category" class="form-control" aria-describedby="category" placeholder="Add a category...">
                        <button type="submit" class="btn btn-primary px-3" id="category"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-4 mb-3">
                <form action="{{route('admin.categories.search')}}" method="GET">
                  <input type="text" name="search" class="form-control" placeholder="Search">
                </form>
            </div>
        </div>
        <table class="table table-hover align-middle bg-white border text-secondary w-75">
            <thead class="table-warning small text-secondary text-center">
                <tr>
                    <td>#</td>
                    <td>NAME</td>
                    <td>COUNT</td>
                    <td>LAST UPDATED</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($results as $categories)
                <tr>
                    <td>{{$categories->id}}</td>
                    <td>{{$categories->name}}</td>
                    <td>{{$categories->category_post->count()}}</td>
                    <td>{{$categories->updated_at}}</td>
                    <td class="px-0 text-center">
                        <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-{{$categories->id}}">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </td>
                    <td class="px-0 text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-{{$categories->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        @include('admin.categories.modal.status')
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center h4 text-secondary">No categories match your search.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



@endsection
