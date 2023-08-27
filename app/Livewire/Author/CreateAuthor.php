<?php

namespace App\Livewire\Author;

use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAuthor extends Component
{
    use WithFileUploads;

    #[Rule('required|unique:users,name')]
    public $name;

    #[Rule('required')]
    public $description;

    #[Rule('required|image')]
    public $image;

    public $iteration;

    public function submit()
    {
        $this->validate();

        $path = '/' . $this->image->store('images');

        $author = Author::create([
            'name' => $this->name,
            'user_id' => Auth::user()->id,
            'description' => $this->description,
            'image' => $path,
        ]);

        if ($author) {
            $this->dispatch('success', message: 'A new author has been created!');
        }

        $this->reset();

        $this->iteration++;
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.author.create-author');
    }
}
