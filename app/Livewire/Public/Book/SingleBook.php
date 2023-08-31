<?php

namespace App\Livewire\Public\Book;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class SingleBook extends Component
{
    public $book;

    public function mount($id)
    {
        $this->book = Book::where('id', $id)->with('author')->first();
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

    #[On('book-download')]
    public function download()
    {
        $this->book->download_count++;
        $this->book->save();

        return Storage::download($this->book->file);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.book.single-book');
    }
}
