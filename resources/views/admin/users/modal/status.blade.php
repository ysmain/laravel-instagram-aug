<div class="modal fade" id="deactivate-user-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border border-danger">
      <div class="modal-header bg-danger text-white border-bottom-0">
        <h5 class="modal-title" id="deleteUserModalLabel">
            <i class="fa-solid fa-user-slash"></i>Delete User

        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-danger">
        Are you sure you want to delete user {{$user->name}}?
      </div>
      <div class="modal-footer">
        <form action="{{route('admin.users.deactivate',$user->id)}}" method="post">
            @csrf
            @method('DELETE')

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="activate-user-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content border border-success">
        <div class="modal-header bg-success text-white border-bottom-0">
          <h5 class="modal-title" id="deleteUserModalLabel">
              <i class="fa-solid fa-user-check"></i>Activate User

          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-success">
          Are you sure you want to activate user {{$user->name}}?
        </div>
        <div class="modal-footer">
          <form action="{{route('admin.users.activate',$user->id)}}" method="post">
              @csrf
              @method('PATCH')

              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Activate</button>
          </form>
        </div>
      </div>
    </div>
  </div>
