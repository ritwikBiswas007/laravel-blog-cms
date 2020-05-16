@extends('layouts.admin')

@section('title')
Categories
@endsection
@section('categories')
active
@endsection

@section('body')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New Category
        </button>
    </div>
    <!-- Create Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createForm" action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="catName">Category Name</label>
                            <input type="text" class="form-control" name="name" id="catName" placeholder="" autofocus>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="createBtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Total Posts</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Total Posts</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($categories as $cat)
                    <tr>
                        <td>{{ $cat->id }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->posts->count() }}</td>
                        <td>{{ $cat->created_at }}</td>
                        <td>{{ $cat->updated_at }}</td>
                        <td>
                            <div class="text-center">
                                <a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#editModal{{ $cat->id }}"><i
                                        class="fas fa-edit mr-2 text-warning"></i></a>
                                <a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#deleteModal{{ $cat ->id }}"><i
                                        class=" text-danger fas fa-trash ml-2"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $cat->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="myForm{{ $cat->id }}" action="{{ route('categories.update', $cat->id) }}"
                                        method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for=""></label>
                                            <input type="text" value="{{ $cat->name }}" class="form-control" name="name"
                                                id="" aria-describedby="helpId" placeholder="">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id="submitBtn{{ $cat->id }}" class="btn btn-primary">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="deleteModal{{ $cat ->id }}" tabindex="-1" role="dialog"
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
                                    <strong>{{ $cat ->name }}</strong> .</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                    <a class="btn btn-danger" href="javascript:void(0)"
                                        onclick="event.preventDefault();document.getElementById('delete-form{{ $cat->id }}').submit();">
                                        Delete
                                    </a>


                                    <form action="{{ route('categories.destroy',$cat->id ) }}" method="post"
                                        id="delete-form{{ $cat->id }}" style="display: none">
                                        @csrf


                                        <input type="hidden" name="_method" value="DELETE">


                                    </form>




                                </div>
                            </div>
                        </div>
                    </div>
                    <script src={{asset('vendor/jquery/jquery.min.js')}}></script>
                    <script>
                        $(document).ready(function(){
                            $("#submitBtn{{ $cat->id }}").click(function(e){
                            $("#myForm{{ $cat->id }}").submit();
                            })
                            })
                    </script>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="text-center">
            <div style="display: inline-block">{{ $categories->render() }}</div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- BootStrap Nofify --}}
<script src="{{ asset('bootstrap-notify/bootstrap-notify.js') }}"></script>



@if (Session::has('deleted_category'))
<script>
    showNotification("{{ session('deleted_category') }}",'success')
</script>
@endif

@if (Session::has('updated_category'))
<script>
    showNotification("{{ session('updated_category') }}",'success')
</script>
@endif

@if (Session::has('created_category'))
<script>
    showNotification("{{ session('created_category') }}",'success')
</script>
@endif

<script>
    $(document).ready(function(){
        $("#createBtn").click(function(e){
    
            $("#createForm").submit();
        
    })

})

$('.modal').on('shown.bs.modal', function() {
$(this).find('[autofocus]').focus();
});
</script>
@endsection