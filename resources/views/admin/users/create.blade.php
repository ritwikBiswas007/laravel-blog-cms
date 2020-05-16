<!-- Page Heading -->
@extends('layouts.admin')

@section('title')
Create User
@endsection

@section('users')
active
@endsection

@section('create-users')
active
@endsection

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- Styles --}}
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">

@endsection

@section('body')
<style>
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

    .alert {
        margin-bottom: 1px;
        height: 35px;
        line-height: 30px;
        padding: 0px 15px;
    }

    img {}
</style>

<h1 class="h3 mb-4 text-gray-800">Create User</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create</h6>
    </div>
    <div class="card-body">

        <section id="app" v-cloak>
            {{-- notifications --}}
            <div class="notif-container">
                <my-notification></my-notification>
            </div>

            <example-comp inline-template>
                <div>
                    {{-- manager --}}
                    <div v-if="inputName">@include('MediaManager::extras.modal',['restrict' => [
                        'path' => "/users",
                        'uploadTypes' => ['image/*']
                        ]])</div>

                    {{-- items selector --}}
                    <media-modal item="cover" :name="inputName"></media-modal>

                    {{-- for editor --}}
                    @include('MediaManager::extras.editor')

                    {{-- form --}}


                    <div class="row">
                        <div class="col-2">
                            <div id="profile_pic"></div><img class="img-thumbnail" :src="cover" width="200">
                        </div>
                        <div class="col-10">
                            {!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store',
                            'files'=>'true']) !!}
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

                                {!! Form::label('role_id','Select User Role') !!}
                                {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}

                            </div>

                            <div class="form-group">

                                {!! Form::label('is_active','Status') !!}
                                {!! Form::select('is_active', ['1' => 'Active', '0' => 'Inactive', ],
                                null,['class'=>'form-control']) !!}

                            </div>

                            {{-- cover --}}
                            <section>

                                <input type="hidden" id="cover" name="cover" :value="cover" />
                                <button type="button" class="btn btn-block btn-outline-info" id="modalcover"
                                    @click="toggleModalFor('cover')">select
                                    Profile
                                    Pic</button>
                            </section>

                            {{-- <div class="form-group">
                                                            {!! Form::label('photo_id','Profile Pic') !!}
                                                            {!! Form::file('photo_id') !!}
                                                        </div> --}}


                            <div class="form-group">

                                {!! Form::label('password','Password') !!}
                                {!! Form::password('password',['class'=>"form-control",
                                'autocomplete'=>'false'])
                                !!}



                            </div>

                            {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </example-comp>
        </section>
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
{{-- BootStrap Nofify --}}
<script src="{{ asset('bootstrap-notify/bootstrap-notify.js') }}"></script>
@if (count($errors) > 0)

@foreach ($errors->all() as $item)
<script>
    $.notify(
    {
    // options
    message: "{{ $item }}",
    },
    {
    // settings
    element: "body",
    position: null,
    type: "danger",
    allow_dismiss: true,
    newest_on_top: true,
    showProgressbar: true,
    placement: {
    from: "top",
    align: "right",
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 5000,
    timer: 50,
    url_target: "_blank",
    animate: {
    enter: "animated fadeInDown",
    exit: "animated fadeOutUp",
    },
    template:
    '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" style="height: 1px;" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            "</div>" +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        "</div>",
    }
    );
</script>


@endforeach

@endif

@endsection