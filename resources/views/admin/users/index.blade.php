@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.leftbar')
    </div>
    <div class="col">
        <div class="float-end mb-3">
            <form action="{{route('admin.users.search')}}" method="GET">
              <input type="text" name="search" class="form-control" placeholder="Search for names">
            </form>
        </div>
        <table class="table table-hover align-middle bg-white border text-secondary">
            <thead class="table-success small text-secondary">
                <tr>
                    <td></td>
                    <td>NAME</td>
                    <td>EMAIL</td>
                    <td>CREATED AT</td>
                    <td>STATUS</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_users as $user)
                <tr>
                    <td></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>
                        @if ($user->trashed())
                        {{-- ソフトデリート(論理削除)されたものは赤く表示される。 --}}
                            <i class="fa-solid fa-circle text-danger"></i>
                        @else
                            <i class="fa-solid fa-circle text-success"></i>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                        @if ($user->trashed())
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#activate-user-{{$user->id}}">
                                    <i class="fa-solid fa-user-check"></i> Activate user {{$user->name}}
                                </button>
                            </div>
                        @else
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{$user->id}}">
                                    <i class="fa-solid fa-user-slash"></i> Deactivate user {{$user->name}}
                                </button>
                            </div>
                        @endif
                        </div>
                        @include('admin.users.modal.status')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
