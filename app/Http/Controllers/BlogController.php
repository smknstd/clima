<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;

class BlogController extends Controller
{
    public function index()
    {
        $blogposts = Blogpost::where('published_at','<', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('pages.blog', [
            "blogposts" => $blogposts,
        ]);
    }

    public function show(Blogpost $blogpost)
    {
        return view('pages.blogpost', [
            "blogpost" => $blogpost,
        ]);
    }
}
