@extends('layouts.app')

@section('title','Edit post')

@section('content')

<form action="{{route('posts.update',$post)}}" method="post" class="form-inline" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="" class="fw-bold form-label d-block">
            Category<span class="text-muted"> (up to 3)</span>
        </label>
            @foreach($categories as $category)
              @if (in_array($category->id,$selected_categories))
                <div class="form-check form-check-inline">
                    <input type="checkbox"  name="categories[]" class="form-check-input" id="category_{{$category->id}}" value ="{{$category->id}}" checked>
                    <label for="category_{{$category->id}}" class="me-2 form-check-label">{{$category->name}}</label>
                </div>
              @else
                <div class="form-check form-check-inline">
                    <input type="checkbox"  name="categories[]" class="form-check-input" id="category_{{$category->id}}" value ="{{$category->id}}">
                    <label for="category_{{$category->id}}" class="me-2 form-check-label">{{$category->name}}</label>
                </div>
              @endif
            @endforeach
    </div>

    <div class="form-group mb-3">
        <label for="description" class="form-label fw-bold">Description</label>
        <textarea name="description" id="description" class="form-control" cols="" rows="3" placeholder="What's on your mind">{{$post->description}}</textarea>
    </div>
    @error('description')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror
    <div class="p-0 border-end w-25">
        <img src="{{$post->image}}" alt="{{$post->image}}" class="w-100">
    </div>
    <div class="my-2 ">
        <input type="file"  name="image" id="image" class="form-control">
        <div class="form-text">
            The acceptable formats are jpg, jpeg, png and gif only <br>
            THe image size must be less than 2MB
        </div>
    </div>
    @error('image')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror
    <button type="submit" class="btn btn-warning px-5">Save</button>
</form>

@endsection
