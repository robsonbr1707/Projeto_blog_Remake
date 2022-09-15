<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'user_id', 'notice_id'];

    protected $casts = [
        'created_at'  => 'date:d-m-Y'
    ];

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notice() :BelongsTo
    {
        return $this->belongsTo(Notice::class);
    }
}
