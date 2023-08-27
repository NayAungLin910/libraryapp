<?php

namespace App\Livewire\Author;

use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ViewAuthor extends Component
{
    use WithPagination;

    public $search = '';

    public $sort = 'latest';

    public function resetFilter()
    {
        $this->reset(['search', 'sort']);

        $this->resetPage();
    }

    #[On('author-delete')]
    public function delete($id)
    {
        $author = Author::where('id', $id)->first();

        if ($author) {
            // deletes the profile if exists
            if (Storage::exists($author->image)) {
                Storage::delete($author->image);
            }

            $author->delete();

            $this->dispatch('success', message: 'An author has been deleted!');
        }
    }

    #[Layout('components.layouts.admin.dashboard')]
    public function render()
    {
        $authors = Author::query();

        if ($this->search) {
            $authors = $authors->where('name', 'like', "%$this->search%");
        }

        $authors = $this->sort === 'latest' ? $authors->latest() : $authors->oldest();

        $authors = $authors->withCount('books')->paginate(10);

        return view('livewire.author.view-author', compact('authors'));
    }
}
