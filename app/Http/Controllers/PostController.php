<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Psy\Util\Json;


class PostController extends Controller
{
    public function index()
    {
        //get all posts

        return Json::encode();
    }
}
