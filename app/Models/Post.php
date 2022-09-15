<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'resume', 'image'];

    protected $casts = [
        'created_at'  => 'date:d-m-Y'
    ];

    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function records() :HasMany
    {
        return $this->hasMany(Record::class);
    }

    public function users() :BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot(['user_id','like']);
    }


}
