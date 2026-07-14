<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'url', 'location', 'display_order', 'visible', 'parent_id',
    ];

    // === Scopes ===
    public function scopeHeader($q)
    {
        return $q->where('location', 'header')->where('visible', 1)->orderBy('display_order');
    }

    public function scopeFooter($q)
    {
        return $q->where('location', 'footer')->where('visible', 1)->orderBy('display_order');
    }
}
