<?php

namespace App\Livewire\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ViewBook extends Component
{
    use WithPagination;

    public $authors;

    public $authorId = "default-author";

    public $tagId = "default-tag";

    public $tags;

    public $search = '';

    public $sort = 'latest';

    public function mount()
    {
        $this->authors = Author::orderBy('name')->select('id', 'name')->get();

        $this->tags = Tag::orderBy('name')->select('id', 'name')->get();
    }

    #[On('book-delete')]
    public function delete($id)
    {
        $book = Book::where('id', $id)->first();

        if ($book) {
            if (Storage::exists($book->image)) {
                Storage::delete($book->image);
            }

            if (Storage::exists($book->file)) {
                Storage::delete($book->file);
            }
        }

        $book->tags()->sync([]);

        $book->delete();

        $this->dispatch('success', message: 'A book has been deleted!');
    }

    public function resetFilter()
    {
        $this->resetExcept(['authors', 'tags']);

        $this->resetPage();
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        $books = Book::query();

        if ($this->search) {
            $books = $books->where('name', 'like', "%$this->search%");
        }

        if ($this->authorId !== 'default-author') {
            $book = $books->where('author_id', $this->authorId);
        }

        if($this->tagId !== 'default-tag') {
            $books = $books->whereHas('tags', function (Builder $query) {
                $query->where('tags.id', $this->tagId);
            });
        }

        $books = $this->sort === 'latest' ? $books->latest() : $books->oldest();

        $books = $books->with("author:id,name")->paginate(10);

        return view('livewire.book.view-book', compact('books'));
    }
}
