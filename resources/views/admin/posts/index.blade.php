<!-- Page Heading -->
@extends('layouts.admin')

@section('title')
All Posts
@endsection

@section('posts')
active
@endsection

@section('view-posts')
active
@endsection



@section('body')

<style>
    .table>tbody>tr>td {
        vertical-align: middle;
    }
</style>


<h1 class="h3 mb-4 text-gray-800">All Posts Page</h1>

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
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <img src="{{ $post->cover }}" width="150" alt="" srcset="">
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($post->title, 50, $end='...') }}</td>
                        <td>
                            @foreach ($post->categories as $cat)
                            <span class="badge badge-primary">{{ $cat->name }}</span><br>
                            @endforeach
                        </td>
                        <td>{{ date('d-M-y', strtotime($post->created_at)) }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="text-center">
                                <a href="{{ route('posts.edit', $post->id) }}" target="_blank"><i
                                        class="fas fa-edit mr-2 text-warning"></i></a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal{{ $post ->id }}"><i
                                        class=" text-danger fas fa-trash ml-2"></i></a>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteModal{{ $post ->id }}" tabindex="-1" role="dialog"
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
                                    <strong>{{ $post ->title }}</strong> .</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                    <a class="btn btn-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('delete-form{{ $post->id }}').submit();">
                                        Delete
                                    </a>


                                    <form action="{{ route('posts.destroy',$post->id ) }}" method="post"
                                        id="delete-form{{ $post->id }}" style="display: none">
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
            <div style="display: inline-block">{{ $posts->render() }}</div>
        </div>
    </div>

</div>





@endsection

@section('js')
{{-- BootStrap Nofify --}}
<script src="{{ asset('bootstrap-notify/bootstrap-notify.js') }}"></script>
@if (Session::has('deleted_post'))
<script>
    showNotification("{{ session('deleted_post') }}",'danger')
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