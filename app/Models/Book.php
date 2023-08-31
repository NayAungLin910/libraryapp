<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'author_id',
        'name',
        'description',
        'image',
        'file',
        'download_count',
    ];

    protected $appends = [
        'is_fav',
    ];

    /**
     * Get the user who created the book
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the author who wrote the book
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the tags related with the book
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the users who saved the book as one of their favourites
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get whether the book is one of the favourite books or not
     */
    public function getIsFavAttribute()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $favBooks = $user->favBooks()->get()->pluck('id');

        return $favBooks->contains($this->id);
    }
}
