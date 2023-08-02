<div class="modal fade" id="delete-{{$categories->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border border-danger">
      <div class="modal-header border border-danger border-top-0 border-start-0 border-end-0 text-danger">
        <h5 class="modal-title" id="deleteUserModalLabel">
            <i class="fa-solid fa-trash-can"></i> Delete Category

        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
        <p>Are you sure you want to delete <span class="fw-bold">{{$categories->name}}</span> category?</p>
        <p class="text-muted">This Action will affect all the posts under this category.Posts without a category will fall under Uncategorized.</p>
      </div>
      <div class="modal-footer border-0">
        <form action="{{route('admin.categories.destroy',$categories->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-{{$categories->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content border border-warning">
        <div class="modal-header  border border-warning border-top-0 border-start-0 border-end-0">
          <h5 class="modal-title" id="editModalLabel">
            <i class="fa-solid fa-pen-to-square"></i> Edit Category

          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-success">
            <form action="{{route('admin.categories.update',$categories->id)}}" method="post">
                @csrf
                @method('PATCH')
                <input type="text" name="category" class="form-control" value="{{$categories->name}}">
                <button type="submit" class="btn btn-warning float-end mt-3">Update</button>
                <button type="button" class="btn btn-outline-warning float-end mt-3 me-2" data-bs-dismiss="modal">Cancel</button>
            </form>
        </div>
      </div>
    </div>
  </div>
