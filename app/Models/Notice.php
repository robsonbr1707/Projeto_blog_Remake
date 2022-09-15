<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Notice extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'image', 'category_id'];
    
    protected $casts = [
        'created_at'  => 'date:d-m-Y'
    ];

    protected static function booted()
    {
        static::creating(function ($notice) {
            $notice->slug = Str::slug($notice->title);
        });

        static::updating(function ($notice) {
            $notice->slug = Str::slug($notice->title);
        });
    }

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments() :HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function users() :BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot(['user_id','like']);
    }

}
