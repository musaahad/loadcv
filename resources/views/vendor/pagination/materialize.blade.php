@if ($paginator->hasPages())
    
        <ul class="pagination center">
        {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <i class="material-icons">chevron_left</i>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="material-icons">chevron_left</i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true">{{ $element }}</li>
                 @endif

              
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><a href="#">
                                {{ $page }}</a>
                            </li>
                        @else
                            <li>
                                <li class="waves-effect">
                                <a href="{{ $url }}">{{ $page }}</a></i>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

           
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                   <span aria-hidden="true"> 
                    <i class="material-icons">chevron_right</i>
                    </span>
                </li>
            @endif
        </ul>
    
@endif


    
