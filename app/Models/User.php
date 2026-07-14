<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
        'email_verified_at',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAuthor(): bool
    {
        return $this->role === 'author' || $this->role === 'admin';
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if (!$this->profile_photo_path) {
            $initial = strtoupper(mb_substr($this->name ?? 'U', 0, 1));
            return 'https://api.dicebear.com/7.x/initials/svg?seed=' . urlencode($initial);
        }

        return asset('storage/' . $this->profile_photo_path);
    }
}