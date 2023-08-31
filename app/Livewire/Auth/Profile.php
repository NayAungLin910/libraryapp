<?php

namespace App\Livewire\Auth;

use App\Models\Book;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Profile extends Component
{
    use WithPagination;
    use WithFileUploads;

    #[Rule('required')]
    public $name;

    #[Rule('required|email')]
    public $email;

    #[Rule('nullable|image')]
    public $image = null;

    public $iteration; // for reseting the image input in client side

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function submit()
    {
        $this->validate();

        $path = Auth::user()->image;

        if ($this->image) {
            // if user uploaded a new profile, deletes the old profile if one exists
            if (Storage::exists(Auth::user()->image)) {
                Storage::delete(Auth::user()->image);
            }

            $path = '/' . $this->image->store('images');

            $this->reset('image');

            $this->iteration++; // cause the image input to reset value

            $this->dispatch('new-profile', src: $path);
        }

        User::where('id', Auth::user()->id)
            ->update([
                'name' => $this->name,
                'email' => $this->email,
                'image' => $path,
            ]);

        $this->dispatch('success', message: 'Profile updated!');

        $this->dispatch('success')->to(ChangePassword::class);
    }

    #[On('book-download')]
    public function download($id)
    {
        $book = Book::where('id', $id)->first();
        $book->download_count++;
        $book->save();

        return Storage::download($book->file);
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

    #[Layout('components.layouts.app')]
    public function render()
    {
        $books = Book::whereHas('users', function (Builder $query) {
            $query->where('users.id', Auth::user()->id);
        })->latest()->paginate(10);

        return view('livewire.auth.profile', compact('books'));
    }
}
