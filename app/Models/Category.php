<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    protected $casts = [
        'created_at'  => 'date:d-m-Y'
    ];

    public function notices() :HasMany
    {
        return $this->hasMany(Notice::class);
    }
}
