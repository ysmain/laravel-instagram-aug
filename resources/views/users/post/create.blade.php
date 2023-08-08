@extends('layouts.app')

@section('title','Create Post')

@section('content')

<form action="{{route('posts.store')}}" method="post" class="form-inline" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="" class="fw-bold form-label d-block">
            Category<span class="text-muted"> (up to 3)</span>
        </label>
            @foreach($categories as $category)
              <div class="form-check form-check-inline">
                <input type="checkbox"  name="categories[]" class="form-check-input" id="category_{{$category->id}}" value ="{{$category->id}}">
                <label for="category_{{$category->id}}" class="me-2 form-check-label">{{$category->name}}</label>
              </div>
            @endforeach
            @error('categories')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror
    </div>

    <div class="form-group">
        <label for="description" class="form-label fw-bold">Description</label>
        <textarea name="description" id="description" class="form-control" cols="" rows="3" placeholder="What's on your mind"></textarea>
    </div>
    @error('description')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror
    <div class="my-3">
        <label for="image" class="fw-bold form-label">Image</label>
        <input type="file"  name="image" id="image" class="form-control">
        @error('image')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
        <div class="form-text">
            The acceptable formats are jpg, jpeg, png and gif only <br>
            The image size must be less than 1048kB
        </div>
    </div>

    <button type="submit" class="btn btn-primary px-5">Post</button>
</form>



@endsection
