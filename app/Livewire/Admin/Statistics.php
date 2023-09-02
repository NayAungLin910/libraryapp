<?php

namespace App\Livewire\Admin;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Statistics extends Component
{
    public $mostPopularAuthors;

    public $mostDownloadedBooks;

    public $mostCommonTags;

    public function mount()
    {
        $top5DownloadedBooks = Book::orderBy('download_count', 'DESC')->select('id', 'name', 'download_count')->get()->take(5);

        $this->mostDownloadedBooks[] = $top5DownloadedBooks->pluck('name');
        $this->mostDownloadedBooks[] = $top5DownloadedBooks->pluck('download_count');

        $authors = Author::has('books')->with('books:id,author_id,name,download_count')->select('id', 'name')->get();

        $authors = $authors->pluck('total_download', 'name')->sortDesc()->take(5);

        $this->mostPopularAuthors[] = $authors->keys();

        $this->mostPopularAuthors[] = $authors->values();

        $commonTags = Tag::withCount('books')->orderBy('books_count', 'DESC')->get()->take(5);

        $this->mostCommonTags[] = $commonTags->pluck('name');
        $this->mostCommonTags[] = $commonTags->pluck('books_count');
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.admin.statistics');
    }
}
