@if ($paginator->hasPages())

<div class="row pagination-wrap">
    <div class="col-full">
        <nav class="pgn" data-aos="fade-up">
            <ul>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="pgn__prev disabled" href="javascript:void(0)">Prev</a>
                    {{-- <span class="page-link" aria-hidden="true">&lsaquo;</span> --}}
                </li>
                @else
                <li>
                    <a class="pgn__prev" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">Prev</a>
                </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li aria-current="page"><span class="pgn__num current">{{ $page }}</span></li>
                @else
                <li><a class="pgn__num" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li>
                    <a class="pgn__next" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
                @else
                <li aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="pgn__next disabled" href="#0">Next</a>
                    {{-- <span class="page-link" aria-hidden="true">&rsaquo;</span> --}}
                </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endif