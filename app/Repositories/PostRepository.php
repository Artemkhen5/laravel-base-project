<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository
{
    protected string|Model $model = Post::class;
}
