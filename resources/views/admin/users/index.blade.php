<!-- Page Heading -->
@extends('layouts.admin')

@section('title')
All Users
@endsection

@section('users')
active
@endsection

@section('view-users')
active
@endsection



@section('body')

<style>
    .avatar {
        background-position: center;
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;

    }

    .table>tbody>tr>td {
        vertical-align: middle;
    }
</style>


<h1 class="h3 mb-4 text-gray-800">All Users Page</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Profile Pic</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Profile Pic</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="avatar" style="background-image: url('{{ $user->cover }}')">
                            </div>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>

                            @foreach ($user -> roles as $item)
                            {{ $item->name }}
                            @endforeach

                        </td>
                        <td class="{{ $user->is_active == 1 ? 'text-success' : 'text-danger' }}">
                            <i class="{{ $user->is_active == 1 ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                            {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ date('d-M-y', strtotime($user->created_at)) }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="text-center">
                                <a href="{{ route('user.edit', $user->id) }}" target="_blank"><i
                                        class="fas fa-edit mr-2 text-warning"></i></a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal{{ $user ->id }}"><i
                                        class=" text-danger fas fa-trash ml-2"></i></a>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteModal{{ $user ->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Select "Delete" below if you are ready to delete
                                    <strong>{{ $user ->name }}</strong> .</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                    <a class="btn btn-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('delete-form{{ $user->id }}').submit();">
                                        Delete
                                    </a>


                                    <form action="{{ route('user.destroy',$user->id ) }}" method="post"
                                        id="delete-form{{ $user->id }}" style="display: none">
                                        @csrf


                                        <input type="hidden" name="_method" value="DELETE">


                                    </form>




                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="text-center">
            <div style="display: inline-block">{{ $users->render() }}</div>
        </div>
    </div>
</div>





@endsection

@section('js')
{{-- BootStrap Nofify --}}
<script src="{{ asset('bootstrap-notify/bootstrap-notify.js') }}"></script>
@if (Session::has('deleted_user'))
<script>
    showNotification("{{ session('deleted_user') }}",'danger')
</script>
@endif

@if (Session::has('updated_user'))
<script>
    showNotification("{{ session('updated_user') }}",'success')
</script>
@endif


@if (Session::has('created_user'))
<script>
    showNotification("{{ session('created_user') }}",'success')
</script>
@endif
@endsection