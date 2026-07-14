<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id',
        'title', 'slug', 'excerpt', 'content',
        'cover_image', 'status', 'view_count',
        'meta_title', 'meta_description', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // === Relations ===
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function viewsDaily()
    {
        return $this->hasMany(PostView::class);
    }

    // === Scopes ===
    public function scopePublished($q)
    {
        return $q->where('status', 'published');
    }
}
