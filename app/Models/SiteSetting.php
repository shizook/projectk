<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteSetting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['key', 'value'];

    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $keyType = 'string';

    protected static array $cache = [];

    public static function getValue(string $key, $default = null)
    {
        if (!array_key_exists($key, static::$cache)) {
            static::$cache[$key] = static::query()->where('key', $key)->value('value');
        }

        return static::$cache[$key] ?? $default;
    }
}