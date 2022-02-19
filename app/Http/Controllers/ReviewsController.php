<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use App\Models\Enums\BlogpostType;
use App\Models\User;

class ReviewsController extends Controller
{
    public function show(User $user)
    {
        $blogposts = Blogpost::where('published_at','<', now())
            ->where('type', BlogpostType::REVIEW)
            ->where('user_id', $user->id)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('pages.reviews', [
            "user" => $user,
            "blogposts" => $blogposts,
        ]);
    }
}
