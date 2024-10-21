@if ($paginator->hasPages())
				<a class="pagination-btn prev" href="{{ $paginator->previousPageUrl() }}"
								@if ($paginator->onFirstPage()) disabled @endif>
								<i class="fa fa-chevron-left" aria-hidden="true"></i>
				</a>
				@for ($i = 1; $i <= $paginator->lastPage(); $i++)
								<a href="{{ $paginator->url($i) }}" class="pagination-btn @if ($i == $paginator->currentPage()) active @endif">
												{{ $i }}
								</a>
				@endfor

				<a class="pagination-btn next" href="{{ $paginator->nextPageUrl() }}"
								@if (!$paginator->hasMorePages()) disabled @endif>
								<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</a>
@endif
