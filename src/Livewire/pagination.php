<?php

namespace MrShaneBarron\Pagination\Livewire;

use Livewire\Component;

class Pagination extends Component
{
    public int $currentPage = 1;
    public int $totalPages = 1;
    public int $perPage = 10;
    public int $total = 0;
    public int $onEachSide = 2;
    public bool $showInfo = true;

    public function mount(int $currentPage = 1, int $totalPages = 1, int $perPage = 10, int $total = 0, int $onEachSide = 2, bool $showInfo = true): void
    {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->perPage = $perPage;
        $this->total = $total;
        $this->onEachSide = $onEachSide;
        $this->showInfo = $showInfo;
    }

    public function goToPage(int $page): void
    {
        if ($page >= 1 && $page <= $this->totalPages) {
            $this->currentPage = $page;
            $this->dispatch('page-changed', page: $page);
        }
    }

    public function getPages(): array
    {
        $pages = [];
        $start = max(1, $this->currentPage - $this->onEachSide);
        $end = min($this->totalPages, $this->currentPage + $this->onEachSide);

        if ($start > 1) { $pages[] = 1; if ($start > 2) $pages[] = '...'; }
        for ($i = $start; $i <= $end; $i++) $pages[] = $i;
        if ($end < $this->totalPages) { if ($end < $this->totalPages - 1) $pages[] = '...'; $pages[] = $this->totalPages; }

        return $pages;
    }

    public function render()
    {
        return view('ld-pagination::livewire.pagination');
    }
}
