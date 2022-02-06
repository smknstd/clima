<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Blogpost as Post;

class Blogpost extends Component
{

    /**
     * @var Post
     */
    public $blogpost;

    /**
     * Create the component instance.
     *
     * @param Post $blogpost
     */
    public function __construct(Post $blogpost)
    {
        $this->blogpost = $blogpost;
    }

    public function render()
    {
        return view('components.blogpost');
    }
}
