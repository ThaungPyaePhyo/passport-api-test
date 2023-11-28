<?php

namespace App\Services;

use App\Models\Blog;

class BlogService
{
    public function getAll()
    {
        return Blog::all();
    }
}
