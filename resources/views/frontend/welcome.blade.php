@extends('layouts.frontend')
@section('title')
Home
@endsection
@section('body')

<style>
    #post_cover_img {
        background-size: cover;
        min-width: 320px;
        min-height: 180px;
    }
</style>


<!-- ========================= featured ========================= -->

<section class="s-featured">
    <div class="row">
        <div class="col-full">

            <div class="featured-slider featured" data-aos="zoom-in">

                @foreach ($featured as $post)

                <div class="featured__slide">
                    <div class="entry">

                        <div class="entry__background" style="background-image:url('{{ $post->cover }}');"></div>

                        <div class="entry__content">
                            <span class="entry__category"><a href="#0">

                                    @foreach ($post->categories as $cat)
                                    {{ $cat->name }}

                                    @if (!$loop->last)
                                    ,
                                    @endif

                                    @endforeach

                                </a></span>

                            <h1><a href="#0"
                                    title="">{{ \Illuminate\Support\Str::limit($post->title, 50, $end=' ...') }}</a>
                            </h1>

                            <div class="entry__info">
                                <a href="#0" class="entry__profile-pic">
                                    <img class="avatar" src="{{ $post->user->cover }}" alt="">
                                </a>
                                <ul class="entry__meta">
                                    <li><a href="#0">{{ $post->user->name }}</a></li>
                                    <li>{{ date('F d, Y', strtotime($post->created_at)) }}</li>
                                </ul>
                            </div>
                        </div> <!-- end entry__content -->

                    </div> <!-- end entry -->
                </div> <!-- end featured__slide -->

                @endforeach

            </div> <!-- end featured -->

        </div> <!-- end col-full -->
    </div>
</section> <!-- end s-featured -->


<!-- s-content
    ================================================== -->
<section class="s-content">

    <div class="row entries-wrap wide">
        <div class="entries">

            @foreach ($posts as $post)


            <article class="col-block">

                <div class="item-entry" data-aos="zoom-in">
                    <div class="item-entry__thumb">
                        <a href="{{ route('post.slug', $post->slug) }}" class="item-entry__thumb-link">

                            <div id="post_cover_img" style="background-image: url('{{ $post->cover }}');">
                            </div>

                            {{-- <img src="{{ $post->cover }}" alt=""> --}}
                        </a>
                    </div>

                    <div class="item-entry__text">
                        <div class="item-entry__cat">


                            @foreach ($post->categories as $cat)
                            <a href="{{ route('category.slug', $cat->slug) }}">
                                {{ $cat->name }}
                            </a>
                            @if (!$loop->last)
                            ,
                            @endif

                            @endforeach


                        </div>

                        <h1 class="item-entry__title"><a
                                href="{{ route('post.slug', $post->slug) }}">{{ \Illuminate\Support\Str::limit($post->title, 50, $end=' ...') }}</a>
                        </h1>

                        <div class="item-entry__date">
                            <a href="single-standard.html">{{ date('F d, Y', strtotime($post->created_at)) }}</a>
                        </div>
                    </div>
                </div> <!-- item-entry -->

            </article> <!-- end article -->


            @endforeach
        </div> <!-- end entries -->
    </div> <!-- end entries-wrap -->

    {!! $posts->links("pagination::wordsmith") !!}


</section> <!-- end s-content -->



@endsection

@section('js')

<script>
    // $('nav').addClass('pgn');
    // $('ul').removeClass();
    // $('li').removeClass("page-item");
    // $('li').addClass("pgn__num");
</script>

@endsection