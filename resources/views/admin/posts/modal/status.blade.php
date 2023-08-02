<div class="modal fade" id="deactivate-post-{{$posts->id}}" tabindex="-1" role="dialog" aria-labelledby="hideModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border border-danger">
      <div class="modal-header border border-danger text-danger border-top-0 border-start-0 border-end-0">
        <h5 class="modal-title" id="hideModalLabel">
            <i class="fa-solid fa-eye-slash"></i>Hide Post
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to hide this post?
        <br>
        <img src="{{$posts->image}}" alt="" class="mt-3" style="width:200px">
        <p class="mt-2 text-muted">{{$posts->description}}</p>
      </div>
      <div class="modal-footer border-0">
        <form action="{{route('admin.posts.deactivate',$posts->id)}}" method="post">
            @csrf
            @method('DELETE')

            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Hide</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="activate-post-{{$posts->id}}" tabindex="-1" role="dialog" aria-labelledby="unhideModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content border border-primary">
        <div class="modal-header border border-primary text-primary border-top-0 border-start-0 border-end-0">
          <h5 class="modal-title" id="unhideModalLabel">
            <i class="fa-solid fa-eye"></i> Unhide Post
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to unhide this post?
          <br>
          <img src="{{$posts->image}}" alt="" class="mt-3" style="width:200px">
          <p class="mt-2 text-muted">{{$posts->description}}</p>
        </div>
        <div class="modal-footer border-0">
          <form action="{{route('admin.posts.activate',$posts->id)}}" method="post">
              @csrf
              @method('PATCH')

              <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Unhide</button>
          </form>
        </div>
      </div>
    </div>
  </div>
