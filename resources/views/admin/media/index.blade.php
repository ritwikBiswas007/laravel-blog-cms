<!-- Page Heading -->
@extends('layouts.admin')

@section('title')
Media Manager
@endsection


@section('media-manager')
active
@endsection

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- Styles --}}
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
@endsection

@section('body')
<style>
    .level-right .level-item:nth-child(4) {
        padding-top: 15px !important;
    }

    .sidebar {
        min-height: 0vh !important;
    }

    .progress {
        display: none !important;
    }
</style>

<section id="app" v-cloak>
    {{-- notifications --}}
    <div class="notif-container">
        <my-notification></my-notification>
    </div>

    <div class="container is-fluid">
        <div class="columns">
            {{-- media manager --}}
            <div class="column">
                @include('MediaManager::_manager')
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
{{-- footer --}}
@stack('styles')
@stack('scripts')
<script src="{{ asset("js/app.js") }}"></script>
@endsection