<div class="flex items-center justify-between">
    @if($showInfo && $total > 0)
        <p class="text-sm text-gray-700">
            Showing <span class="font-medium">{{ ($currentPage - 1) * $perPage + 1 }}</span>
            to <span class="font-medium">{{ min($currentPage * $perPage, $total) }}</span>
            of <span class="font-medium">{{ $total }}</span> results
        </p>
    @else
        <div></div>
    @endif

    <nav class="flex items-center gap-1">
        {{-- Previous --}}
        <button wire:click="goToPage({{ $currentPage - 1 }})" @if($currentPage <= 1) disabled @endif class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </button>

        @foreach($this->getPages() as $page)
            @if($page === '...')
                <span class="inline-flex items-center justify-center w-10 h-10 text-sm text-gray-500">...</span>
            @else
                <button wire:click="goToPage({{ $page }})" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium rounded-md {{ $page === $currentPage ? 'bg-indigo-600 text-white' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50' }}">
                    {{ $page }}
                </button>
            @endif
        @endforeach

        {{-- Next --}}
        <button wire:click="goToPage({{ $currentPage + 1 }})" @if($currentPage >= $totalPages) disabled @endif class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>
    </nav>
</div>
