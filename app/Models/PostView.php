<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostView extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'view_date', 'views'];

    protected $casts = [
        'view_date' => 'date',
    ];

    // === Relations ===
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
