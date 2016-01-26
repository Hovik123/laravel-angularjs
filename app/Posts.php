<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    /**
     * get all posts
     * @return mixed
     */
    public function getAll()
    {
        return Posts::getAll();
    }
}
