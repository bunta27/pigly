@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&lt;</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a></li>
            @endif

            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();

                $start = max($current - 1, 1);
                $end = min($start + 2, $last);

                if ($end - $start < 2) {
                    $start = max($end - 2, 1);
                }
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endfor

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a></li>
            @else
                <li class="disabled"><span>&gt;</span></li>
            @endif
        </ul>
    </nav>
@endif
