<!-- Page Heading -->
@extends('layouts.admin')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- Styles --}}
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
@endsection
@section('body')

<style>
    .row .col-3 .avatar {
        background-position: center;
        background-size: cover;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        display: inline-block;

    }

    .__stack-container {
        max-height: 40vh !important;
        min-height: 40vh !important;
    }


    .modal-content {
        height: auto !important;
    }

    .level-right .level-item:nth-child(3) {
        padding-top: 15px !important;
    }

    .modal {
        position: fixed !important;
    }
</style>

<h1 class="h3 mb-4 text-gray-800">Edit User</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
    </div>
    <div class="card-body">

        @if (count($errors) > 0)

        @foreach ($errors->all() as $item)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Error!</strong> {{ $item}}
        </div>
        @endforeach

        @endif



        <div class="row">
            <div class="col-3 text-center">
                <media-modal old="" item="cover"></media-modal>
                <div class="avatar" style="background-image: url('{{ old('cover', $user->cover) }}')">
                </div>

                <h3 class="m-0 font-weight-bold text-primary">{{ $user->name }}</h6>
                    <h6 class="m-0 text-muted">{{ $user->email }}</h6>
            </div>
            <div class="col-9" id="app">
                <example-comp inline-template>
                    <div>
                        {{-- manager --}}
                        <div v-if="inputName">@include('MediaManager::extras.modal',['restrict' => [
                            'path' => "/users",
                            'uploadTypes' => ['image/*']
                            ]])</div>

                        {{-- items selector --}}
                        <media-modal old="{{ old('cover', $user->cover) }}" item="cover" :name="inputName">
                        </media-modal>


                        {{-- for editor --}}
                        @include('MediaManager::extras.editor')


                        {!! Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],
                        'files'=>'true'])
                        !!}
                        {{ csrf_field() }}

                        <div class="form-group">

                            {!! Form::label('name','Full Name') !!}
                            {!! Form::text('name',null,['class'=>'form-control']) !!}

                        </div>
                        <div class="form-group">

                            {!! Form::label('email','Email') !!}
                            {!! Form::email('email',null,['class'=>'form-control']) !!}

                        </div>
                        <div class="form-group">

                            <div class="form-group">
                                <label for="role_id">Select User Role</label>
                                <select class="form-control" name="role_id" id="role_id">

                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @if (count($user->
                                        roles->where('name',$role->name)))
                                        selected
                                        @endif

                                        >{{ $role->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- {!! Form::label('role_id','Select User Role') !!}
                            {!! Form::select('role_id', $roles, null , ['class'=>'form-control']) !!} --}}

                        </div>

                        <div class="form-group">
                            {!! Form::label('is_active','Status') !!}
                            {!! Form::select('is_active', ['1' => 'Active', '0' => 'Inactive', ],
                            null,['class'=>'form-control']) !!}
                        </div>

                        <div id="pro-pic"></div>

                        {{-- <div style="background-image: url('{{ src="cover" }}')">
                    </div> --}}
                    {{-- cover --}}
                    <section>
                        <img :src="cover" id="img_cover">
                        <input type="hidden" id="cover" name="cover" :value="cover" />
                        <button type="button" class="btn btn-block btn-outline-info" id="modalcover"
                            @click="toggleModalFor('cover')">select
                            Profile
                            Pic</button>
                    </section>


                    <div class="form-group">

                        {!! Form::label('password','Password') !!}
                        {!! Form::password('password',['class'=>"form-control",
                        'autocomplete'=>'false'])
                        !!}



                    </div>

                    {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}

                    {!! Form::close() !!}

            </div>
            </example-comp>
        </div>
    </div>
</div>
</div>


@endsection


@section('js')

@stack('styles')
@stack('scripts')
<script src="{{ asset("js/app.js") }}"></script>
<script>
    document.getElementById("modalcover").addEventListener("click",function (e) {
        e.preventDefault();
        
        })
     
</script>

@endsection