<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;

class HomeController extends Controller
{
    public function index()
    {
        $lastblogposts = Blogpost::where('published_at','<', now())
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('pages.home', [
            'title' => 'Titre toto',
            "lastBlogposts" => $lastblogposts,
        ]);
    }
}
