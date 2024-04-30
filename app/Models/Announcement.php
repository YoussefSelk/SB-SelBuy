<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the announcement.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
