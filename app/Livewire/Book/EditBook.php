<?php

namespace App\Livewire\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBook extends Component
{
    use WithFileUploads;

    public Book $book;

    public $authors;

    public $tags;

    public $authorId;

    public $tagIds = [];

    public $name;

    public $description;

    #[Rule('nullable|image')]
    public $image;

    public $iteration;

    public $file;

    public function mount($id)
    {
        $this->book = Book::where('id', $id)->first();
        $this->tags = Tag::orderBy('name')->select('id', 'name')->get();
        $this->authors = Author::orderBy('name')->select('id', 'name')->get();

        $this->authorId = $this->book->author_id;
        $this->name = $this->book->name;
        $this->description = $this->book->description;

        $book_id = $this->book->id;

        $this->tagIds = Tag::whereHas('books', function (Builder $query) use ($book_id) {
            $query->where('books.id', $book_id);
        })->get()->pluck('id');
    }

    public function download()
    {
        return Storage::download($this->book->file);
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|unique:books,name,' . $this->book->id,
            'description' => 'required',
            'image' => 'nullable|image',
            'tagIds' => 'required',
            'authorId' => 'required'
        ]);

        $imagePath = $this->book->image;

        if ($this->image) {
            // if a new image is uploaded delets the old image
            if (Storage::exists($this->book->image)) {
                Storage::delete($this->book->image);
            }

            $imagePath = '/' . $this->image->store('images');

            $this->reset('image');

            $this->iteration++; // causes the image input to reset value
        }

        $filePath = $this->book->file;

        if ($this->file) {
            // if a new image is uploaded delets the old image
            if (Storage::exists($this->book->file)) {
                Storage::delete($this->book->file);
            }

            $filePath = '/' . $this->file->store('files');

            $this->reset('file');

            $this->iteration++; // causes the file input to reset value
        }

        $this->book->name = $this->name;
        $this->book->author_id = $this->authorId;
        $this->book->description = $this->description;
        $this->book->image = $imagePath;
        $this->book->file = $filePath;
        $this->book->save();

        $this->book->tags()->sync($this->tagIds);

        $this->dispatch('success', message: 'The book information has been saved!');
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.book.edit-book');
    }
}
