@extends('layouts.frontend')
@section('title')
{{ $category->name }}
@endsection
@section('body')
<style>
    #post_cover_img {
        background-size: cover;
        min-width: 320px;
        min-height: 180px;
    }
</style>

<section class="s-content s-content--top-padding">

    <div class="row narrow">
        <div class="col-full s-content__header" data-aos="fade-up">
            <h1 class="display-1 display-1--with-line-sep">Category: {{ $category->name }}</h1>
            <p class="lead">Dolor similique vitae. Exercitationem quidem occaecati iusto. Id non vitae enim quas error
                dolor maiores ut. Exercitationem earum ut repudiandae optio veritatis animi nulla qui dolores.</p>
        </div>
    </div>

    <div class="row entries-wrap add-top-padding wide">
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
                            <a href="{{ route('category.slug', $category->slug) }}">

                                @foreach ($post->categories as $cat)
                                {{ $cat->name }}
                                @if (!$loop->last)
                                ,
                                @endif

                                @endforeach

                            </a>
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