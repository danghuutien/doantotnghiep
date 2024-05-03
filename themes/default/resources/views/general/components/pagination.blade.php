@if ($paginator->lastPage() > 1)
<div class="pagination__numbers">
    @if(!$paginator->onFirstPage())
        <span class="page-link" data-href="{{ $paginator->url(1) }}"><svg xmlns="http://www.w3.org/2000/svg" height="12" viewBox="0 0 512 512"><path d="M109.3 288L480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 73.4-73.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288z"/></svg></span>
    @endif

    @if($paginator->currentPage() > 3)
        <span class="page-link" data-href="{{ $paginator->url(1) }}">1</span>
    @endif

    @if($paginator->currentPage() > 4)
        <span>...</span>
    @endif

    @foreach(range(1, $paginator->lastPage()) as $i)
        @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
            @if ($i == $paginator->currentPage())
                <span class="active">{{ $i }}</span>
            @else
                <span class="page-link" data-href="{{ $paginator->url($i) }}">{{ $i }}</span>
            @endif
        @endif
    @endforeach

    @if($paginator->currentPage() < $paginator->lastPage() - 3)
        <span>...</span>
    @endif

    @if($paginator->currentPage() < $paginator->lastPage() - 2)
        <span class="page-link" data-href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</span>
    @endif

    @if ($paginator->hasMorePages())
        <span class="page-link next-page" data-href="{{ $paginator->url($paginator->currentPage()+1) }}"><svg xmlns="http://www.w3.org/2000/svg"  height="12"viewBox="0 0 512 512"><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg></span>
    @endif
</div>
@endif
