<?php

namespace App\Livewire\Public\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
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

    public function mount($tagId = "default-tag", $authorId = "default-author")
    {

        $this->authors = Author::orderBy('name')->select('id', 'name')->get();

        $this->tags = Tag::orderBy('name')->select('id', 'name')->get();

        $this->authorId = $authorId;

        $this->tagId = $tagId;
    }

    public function favourite($id)
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($user->favBooks()->where('books.id', $id)->exists()) {
            $user->favBooks()->detach($id);

            $message = "A book has been removed from favourite list!";
        } else {
            $user->favBooks()->attach($id);

            $message = "A book has been added to favourite list!";
        }

        $this->dispatch('success', message: $message);
    }

    public function resetFilter()
    {
        $this->resetExcept(['authors', 'tags']);

        $this->resetPage();
    }

    public function download($id)
    {
        $book = Book::where('id', $id)->first();

        if ($book) {
            $book->download_count++;
            $book->save();

            return Storage::download($book->file);
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $books = Book::query();

        if ($this->search) {
            $books = $books->where('name', 'like', "%$this->search%");
        }

        if ($this->authorId !== 'default-author') {
            $books = $books->where('author_id', $this->authorId);
        }

        if ($this->tagId !== 'default-tag') {
            $books = $books->whereHas('tags', function (Builder $query) {
                $query->where('tags.id', $this->tagId);
            });
        }

        $books = $this->sort === 'latest' ? $books->latest() : $books->oldest();

        $books = $books->with('tags:id,name')->with("author:id,name")->paginate(10);

        return view('livewire.public.book.view-book', compact('books'));
    }
}
