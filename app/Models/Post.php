<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'content' => 'string',
            'user_id' => 'integer',
        ];
    }

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
