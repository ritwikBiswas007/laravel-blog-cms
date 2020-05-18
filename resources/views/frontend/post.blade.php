@extends('layouts.frontend')


@section('head')
<script type='text/javascript'
    src='https://platform-api.sharethis.com/js/sharethis.js#property=5ec2a22134ee1a00128dc6e4&product=sticky-share-buttons&cms=sop'
    async='async'></script>
@endsection
@section('body')

<style>
    .comments-wrap {
        margin-top: 0px !important;
        padding-top: 0px !important;
    }

    .s-content__entry-nav {
        margin-top: 0px !important;
    }

    .reaction-button {
        margin: 25px 0px;
    }
</style>

<!-- s-content
    ================================================== -->
<section class="s-content s-content--top-padding s-content--narrow">

    <article class="row entry format-standard">

        <div class="entry__media col-full">
            <div class="entry__post-thumb">
                <img src="{{ $post->cover }}" alt="">
            </div>
        </div>

        <div class="entry__header col-full">
            <h1 class="entry__header-title display-1">
                {{ $post->title }}
            </h1><br>
            <ul class="entry__header-meta">
                <li class="date">{{ date('F d, Y', strtotime($post->created_at)) }}</li>
                <li class="byline">
                    By
                    <a href="#0">{{ $post->user->name }}</a>
                </li>
            </ul>
        </div>

        <div class="col-full entry__main">

            {!! $post->content !!}

            <div class="entry__taxonomies">
                <div class="entry__cat">
                    <h5>Posted In: </h5>
                    <span class="entry__tax-list">

                        @foreach ($post->categories as $cat)
                        <a href="javascript:void(0)"> {{ $cat->name }}</a>

                        @if (!$loop->last)
                        ,
                        @endif

                        @endforeach
                    </span>
                </div> <!-- end entry__cat -->

                <div class="entry__tags">
                    <h5>Tags: </h5>
                    <span class="entry__tax-list entry__tax-list--pill">
                        <a href="#0">orci</a>
                        <a href="#0">lectus</a>
                        <a href="#0">varius</a>
                        <a href="#0">turpis</a>
                    </span>
                </div> <!-- end entry__tags -->
            </div> <!-- end s-content__taxonomies -->

            <div class="entry__author">
                <img src="{{ $post->user->cover }}" alt="">

                <div class="entry__author-about">
                    <h5 class="entry__author-name">
                        <span>Posted by</span>
                        <a href="#0">{{ $post->user->name }}</a>
                    </h5>

                    <div class="entry__author-desc">
                        <p>
                            Alias aperiam at debitis deserunt dignissimos dolorem doloribus, fuga fugiat
                            impedit laudantium magni maxime nihil nisi quidem quisquam sed ullam voluptas
                            voluptatum. Lorem ipsum dolor sit.
                        </p>
                    </div>
                </div>
            </div>

        </div> <!-- s-entry__main -->

    </article> <!-- end entry/article -->
    <div class="reaction-button">
        <div class="sharethis-inline-reaction-buttons"></div>
    </div>
    <div class="s-content__entry-nav">
        <div class="row s-content__nav">
            <div class="col-six s-content__prev">
                @if ($previous != null || $previous !="")
                <a href="{{ route('post.slug', $previous->slug)}}" rel="prev">
                    <span>Previous Post</span>
                    {{ \Illuminate\Support\Str::limit($previous->title, 50, $end=' ...') }}
                </a>
                @else
                <a href="javascript:void(0)" rel="prev">
                    <span>Previous Post</span>
                    No Posts Available
                </a>
                @endif
            </div>
            <div class="col-six s-content__next">

                @if ($next != null || $next !="")
                <a href="{{ route('post.slug', $next->slug) }}" rel="next">
                    <span>Next Post</span>
                    {{ \Illuminate\Support\Str::limit($next->title, 50, $end=' ...') }}
                </a>
                @else
                <a href="javascript:void(0)" rel="prev">
                    <span>Next Post</span>
                    No Posts Available
                </a>
                @endif


            </div>
        </div>
    </div> <!-- end s-content__pagenav -->

    {{-- @comments(['model' => $Post]) --}}

    <div class="comments-wrap">

        <div class="row comment-respond">

            <!-- START respond -->
            <div id="respond" class="col-full">




                @comments(['model' => $post])


            </div>
            <!-- END respond-->

        </div> <!-- end comment-respond -->

    </div> <!-- end comments-wrap -->

</section> <!-- end s-content -->


@endsection