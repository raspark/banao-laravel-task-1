<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function posts()
    {
        return view('backend.pages.posts.index');
    }
    public function add_new_post()
    {
        return view('backend.pages.posts.add-new');
    }
}
