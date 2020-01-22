@isset($pagination)
@if ($pagination->lastPage() > 1)
<nav class="d-pagination" aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        @for ($i = 1; $i <= $pagination->lastPage(); $i++)
        <li class="page-item {{ ($pagination->currentPage() == $i) ? ' active' : '' }}"><a class="page-link" href="{{ $pagination->url($i) }}">{{ $i }}</a></li>
        @endfor
    </ul>
</nav>
@endif
    @endisset