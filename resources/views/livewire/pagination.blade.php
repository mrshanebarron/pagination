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
        <button wire:click="goToPage({{ $currentPage - 1 }})" @if($currentPage <= 1) disabled @endif class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </button>

        @foreach($this->getPages() as $page)
            @if($page === '...')
                <span class="px-3 py-2 text-sm text-gray-500">...</span>
            @else
                <button wire:click="goToPage({{ $page }})" class="px-3 py-2 text-sm font-medium rounded-lg {{ $page === $currentPage ? 'bg-blue-600 text-white' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-50' }}">
                    {{ $page }}
                </button>
            @endif
        @endforeach

        <button wire:click="goToPage({{ $currentPage + 1 }})" @if($currentPage >= $totalPages) disabled @endif class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>
    </nav>
</div>
