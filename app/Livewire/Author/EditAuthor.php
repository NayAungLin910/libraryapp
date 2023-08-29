<?php

namespace App\Livewire\Author;

use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAuthor extends Component
{
    use WithFileUploads;

    public Author $author;

    public $name;

    public $description;

    #[Rule('nullable|image')]
    public $image;

    public $iteration;

    public function mount($id)
    {
        $this->author = Author::where('id', $id)->first();

        $this->name = $this->author->name;
        $this->description = $this->author->description;
    }

    public function submit()
    {
        $this->validate([
            'name' => "required|unique:authors,name," . $this->author->id,
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        $path = $this->author->image;

        if ($this->image) {
            // if a new profile is uploaded, deletes the old profile if one exists
            if (Storage::exists($this->author->image)) {
                Storage::delete($this->author->image);
            }

            $path = '/' . $this->image->store('images');

            $this->reset('image');

            $this->iteration++; // causes the image input to reset value
        }

        $this->author->name = $this->name;
        $this->author->description = $this->description;
        $this->author->image = $path;
        $this->author->save();

        $this->dispatch('success', message: 'The author information has beeen updated!');
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        return view('livewire.author.edit-author');
    }
}
