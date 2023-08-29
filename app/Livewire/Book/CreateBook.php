<?php

namespace App\Livewire\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBook extends Component
{
    use WithFileUploads;

    public $authors;

    public $tags;

    #[Rule('required')]
    public $authorId;

    #[Rule('required')]
    public $tagIds = [];

    #[Rule('required|unique:books,name')]
    public $name;

    #[Rule('required')]
    public $description;

    #[Rule('required|image')]
    public $image;

    public $iteration;

    #[Rule('required')]
    public $file;

    public function mount()
    {
        $this->authors = Author::orderBy('name')->select('id', 'name')->get();

        $this->authorId = $this->authors->first()->id;

        $this->tags = Tag::orderBy('name')->select('id', 'name')->get();

        $this->tagIds[] = $this->tags->first()->id;
    }

    public function submit()
    {
        $this->validate();

        $imagePath = '/' . $this->image->store('images');

        $filePath = '/' . $this->file->store('files');

        $book = Book::create([
            'user_id' => Auth::user()->id,
            'author_id' => $this->authorId,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
            'file' => $filePath
        ]);

        if ($book) {

            $book->tags()->sync($this->tagIds);

            $this->resetExcept(['authors', 'tags']);

            $this->iteration++;

            $this->dispatch('success', message: 'A new book has been created!');
        }
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.book.create-book');
    }
}
