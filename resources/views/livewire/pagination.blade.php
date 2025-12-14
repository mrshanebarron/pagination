<div class="flex items-center justify-between">
    @if($showInfo)
        <p class="text-sm text-gray-700">
            Showing <span class="font-medium">{{ ($currentPage - 1) * $perPage + 1 }}</span>
            to <span class="font-medium">{{ min($currentPage * $perPage, $total) }}</span>
            of <span class="font-medium">{{ $total }}</span> results
        </p>
    @endif
    <nav class="flex items-center space-x-1">
        <button
            wire:click="goToPage({{ $currentPage - 1 }})"
            @disabled($currentPage === 1)
            @class([
                'px-3 py-2 rounded-lg border transition-colors',
                'text-gray-400 cursor-not-allowed' => $currentPage === 1,
                'text-gray-700 hover:bg-gray-100' => $currentPage !== 1,
            ])
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>

        @foreach($this->getVisiblePages() as $page)
            <button
                wire:click="goToPage({{ $page }})"
                @class([
                    'px-4 py-2 rounded-lg border transition-colors',
                    'bg-blue-500 text-white border-blue-500' => $page === $currentPage,
                    'text-gray-700 hover:bg-gray-100' => $page !== $currentPage,
                ])
            >
                {{ $page }}
            </button>
        @endforeach

        <button
            wire:click="goToPage({{ $currentPage + 1 }})"
            @disabled($currentPage === $totalPages)
            @class([
                'px-3 py-2 rounded-lg border transition-colors',
                'text-gray-400 cursor-not-allowed' => $currentPage === $totalPages,
                'text-gray-700 hover:bg-gray-100' => $currentPage !== $totalPages,
            ])
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </nav>
</div>
