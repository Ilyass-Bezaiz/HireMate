<?php

namespace App\Livewire;

use Livewire\Component;

class Posts extends Component
{
    public function render()
    {
        $posts = Post::withCount('likes', 'comments')->latest()->get();

        return view('livewire.posts', compact('posts'));
    }
}
