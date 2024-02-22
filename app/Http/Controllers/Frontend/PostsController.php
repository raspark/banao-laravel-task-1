<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function posts()
    {
        return view('frontend.pages.posts.index');
    }
    public function add_new_post()
    {
        return view('frontend.pages.posts.add-new');
    }
}
