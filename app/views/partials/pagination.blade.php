
@if ($paginator->getLastPage() > 1)
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}"><a href="{{ $paginator->getUrl(1) }}" class="page-link">Previous</a></li>
            @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
                <li class="page-item {{($paginator->getCurrentPage() == $i) ? ' active' : '' }}"><a href="{{ $paginator->getUrl($i) }}" class="page-link" href="#">{{ $i }}</a></li>
            @endfor
            <li class="page-item {{($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}"><a class="page-link" href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}">Next</a></li>
        </ul>
    </nav>

@endif