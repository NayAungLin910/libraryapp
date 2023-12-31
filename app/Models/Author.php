<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
    ];

    protected $appends = [
        'total_download',
    ];

    /**
     * Get the admin who created the author
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the books the user created
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Total Books Download Count
     */
    public function getTotalDownloadAttribute()
    {
        return $this->books->sum('download_count');
    }
}
