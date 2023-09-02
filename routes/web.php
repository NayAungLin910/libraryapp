<?php

use App\Livewire\Account\Account;
use App\Livewire\Admin\Statistics;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Profile;
use App\Livewire\Auth\Register;
use App\Livewire\Author\CreateAuthor;
use App\Livewire\Author\EditAuthor;
use App\Livewire\Author\ViewAuthor;
use App\Livewire\Book\CreateBook;
use App\Livewire\Book\EditBook;
use App\Livewire\Book\ViewBook;
use App\Livewire\Home;
use App\Livewire\Public\Book\SingleBook;
use App\Livewire\Public\Book\ViewBook as BookViewBook;
use App\Livewire\Tag\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::prefix('books')->as('books.')->group(function () {
    Route::get('/', BookViewBook::class)->name('view');
    Route::get('/pre-values/{tagId?}/{authorId?}', BookViewBook::class)->name('view-pre');
    Route::get('/author/again/{authorId?}' , BookViewBook::class)->name('view-author');
    Route::get('/view/{id}', SingleBook::class)->name('single');
});

// routes only for unauthenticated users
Route::prefix('auth')->middleware(['notAuth'])->as('auth.')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// routes for authenticated users
Route::prefix('user')->as('user.')->middleware(['userOrAdmin'])->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::post('/logout', function (Request $request) {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')->with('success', 'You have logged out successfully!');
        }
    })->name('logout');
});

// admin only routes
Route::prefix('admin/dashboard')->middleware(['adminOnly'])->as('admin.')->group(function () {
    Route::get('/', Statistics::class)->name('statistics');

    // tags
    Route::get('/tags', Tag::class)->name('tags');

    // authors
    Route::prefix('authors')->as('authors.')->group(function () {
        Route::get('/create', CreateAuthor::class)->name('create'); // create author
        Route::get('/', ViewAuthor::class)->name('view'); // view authors
        Route::get('/edit/{id}', EditAuthor::class)->name('edit'); // edit author
    });

    // books
    Route::prefix('books')->as('books.')->group(function () {
        Route::get('/create', CreateBook::class)->name('create'); // create book
        Route::get('/', ViewBook::class)->name('view'); // view books
        Route::get('/edit/{id}', EditBook::class)->name('edit'); // edit book
    });

    Route::get('/accounts', Account::class)->name('accounts');
});
