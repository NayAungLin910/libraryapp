<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Home extends Component
{
    public $latestBooks;

    public $popularBooks;

    public function mount()
    {
        $this->latestBooks = Book::latest()->with('tags:id,name', 'author:id,name')->get()->take(9);

        $this->popularBooks = Book::orderBy('download_count', 'DESC')->with('tags:id,name', 'author:id,name')->get()->take(9);
    }

    public function render()
    {
        return view('livewire.home');
    }
}
