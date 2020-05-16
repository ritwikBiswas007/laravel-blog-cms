@extends('layouts.admin')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- Styles --}}
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
@endsection

@section('head')
<link rel="preload" href="{{ asset('demo28.html') }}" as="document">
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
        z-index: 999999;
    }

    .alert {
        margin-bottom: 1px;
        height: 35px;
        line-height: 30px;
        padding: 0px 15px;
    }

    .center-cropped {
        width: 100px;
        height: 100px;
        background-position: center center;
        background-repeat: no-repeat;
        overflow: hidden;
    }

    /* Set the image to fill its parent and make transparent */
    .center-cropped img {
        min-height: 100%;
        min-width: 100%;
        /* IE 8 */
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        /* IE 5-7 */
        filter: alpha(opacity=0);
        /* modern browsers */
        opacity: 0;
    }
</style>


<h1 class="h3 mb-4 text-gray-800">Create Post</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create</h6>
    </div>
    <section id="app" v-cloak>
        {{-- notifications --}}
        <div class="notif-container">
            <my-notification></my-notification>
        </div>

        <example-comp inline-template>
            <div>
                {{-- manager --}}
                <div v-if="inputName">@include('MediaManager::extras.modal',['restrict' => [
                    'path' => "/posts",
                    'uploadTypes' => ['image/*']
                    ]])</div>

                {{-- items selector --}}
                <media-modal item="cover" :name="inputName"></media-modal>

                {{-- for editor --}}
                @include('MediaManager::extras.editor')

                {{-- form --}}
                <div class="card-body">
                    {!! Form::open(['method'=>'POST','action'=>'AdminPostsController@store',
                    'files'=>'true']) !!}
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                {!! Form::text('title', null, ['class'=>'form-control','placeholder'=>'Post Title']) !!}
                            </div>
                            {!! Form::textarea('content', null, ['id'=>'tinyMce']) !!}
                        </div>
                        <div class="col-3">

                            <h5>Categories</h5>
                            <hr>

                            <div id="catId" class="p-3"
                                style="height:300px;border-radius:5px; border: 2px solid rgba(0,0,0,0.1) ; overflow-y:scroll; overflow-x:hidden">

                                {{-- <div class="form-group">
            {!! Form::select('categories_id',$categories , null, ['class'=>
            'form-control','multiple'=> 'multiple', 'style'=>'height:300px', 'id'=>'cat_id']) !!}
        </div> --}}


                                @foreach ($categories as $cat)
                                <div class="custom-control custom-checkbox {{ $loop->first ? null : 'mt-3' }}
                                {{ $loop->last ? null : 'mb-3' }}">
                                    {!! Form::checkbox('categories_id[]' , $cat->id, false,
                                    ['class'=>'custom-control-input','id'=> 'customCheck'. $cat->id]) !!}
                                    <label class="custom-control-label"
                                        for="customCheck{{ $cat->id }}">{{ $cat->name }}</label>
                                </div>
                                @endforeach
                            </div>

                            <h5 class="mt-4">Feature Image</h5>
                            <hr>

                            <section>
                                <input type="hidden" id="cover" name="cover" :value="cover" />
                                <a href="javascript:void(0);" @click="toggleModalFor('cover')">
                                    <div id="pic"
                                        style="background-image: url('https://dummyimage.com/274x200/f5f5f5/000.jpg&text=Click+Here+To+Choose+Feature+Image+');">
                                        <img :src="cover" style="min-height: 200px !important; width:100% !important">
                                    </div>
                                </a>
                            </section>
                            {!! Form::submit('Create Post',['class'=>'btn btn-primary btn-block mt-3']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>



            </div>
        </example-comp>
    </section>
</div>

@endsection

@section('js')

@stack('styles')
@stack('scripts')

<script src="{{ asset("js/app.js") }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.5.2/smooth-scrollbar.js"></script>
<script src="https://cdn.tiny.cloud/1/sgrj9whrb0pa2vbbbrcbijjm1mysdkyz0n63w5syryce7jr5/tinymce/4/tinymce.min.js"
    referrerpolicy="origin"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '#tinyMce',
        image_caption: true,
        file_browser_callback(field_name, url, type, win) {
        let field = win.document.getElementById(field_name)
        $('.__Inmodal-editor').click()

        EventHub.listen('file_selected', (path) => {
        if (field) field.value = path
        })
        },
        plugins: ["image","wordcount","code","fullscreen", "textcolor", "colorpicker", "hr", "visualchars"],  
        toolbar: "undo redo | styleselect | bold italic underline | alignleft"
        + "aligncenter alignright alignjustify aligncenter alignleft | "
        + "bullist numlist outdent indent | link image | fullscreen | forecolor backcolor | hr visualchars",
        branding: false,
        height : "535",
        mobile: {
        theme: 'mobile',
        }
    });

    document.addEventListener('DOMSubtreeModified', () => {
    let modal = document.getElementById('mce-modal-block')
    
    if (modal) {
    Array.from(document.querySelectorAll('.modal-manager__Inmodal')).length > 0
    ? modal.style.zIndex = '0'
    : modal.style.zIndex = '10'
    }})

    Scrollbar.init(document.querySelector('#catId'),{'damping': 0.09,'continuousScrolling':false});
</script>
@endsection