<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Record extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'image', 'post_id'];

    protected $casts = [
        'created_at'  => 'date:d-m-Y'
    ];

    protected static function booted()
    {
        static::creating(function ($record) {
            $record->slug = Str::slug($record->title);
        });

        static::updating(function ($record) {
            $record->slug = Str::slug($record->title);
        });
    }

    public function post() :BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
