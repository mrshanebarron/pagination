<?php

namespace MrShaneBarron\Pagination\Livewire;

use Livewire\Component;

class Pagination extends Component
{
    public int $currentPage = 1;
    public int $totalPages = 1;
    public int $perPage = 10;
    public int $total = 0;
    public bool $showInfo = true;
    public string $size = 'md';

    public function mount(
        int $currentPage = 1,
        int $totalPages = 1,
        int $perPage = 10,
        int $total = 0,
        bool $showInfo = true,
        string $size = 'md'
    ): void {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->perPage = $perPage;
        $this->total = $total;
        $this->showInfo = $showInfo;
        $this->size = $size;
    }

    public function goToPage(int $page): void
    {
        if ($page >= 1 && $page <= $this->totalPages) {
            $this->currentPage = $page;
            $this->dispatch('page-changed', page: $page);
        }
    }

    public function getVisiblePages(): array
    {
        $pages = [];
        $start = max(1, $this->currentPage - 2);
        $end = min($this->totalPages, $this->currentPage + 2);
        for ($i = $start; $i <= $end; $i++) {
            $pages[] = $i;
        }
        return $pages;
    }

    public function render()
    {
        return view('ld-pagination::livewire.pagination');
    }
}
