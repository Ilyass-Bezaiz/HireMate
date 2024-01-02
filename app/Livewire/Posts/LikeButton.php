<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class LikeButton extends Component
{

    #[Reactive]
    public Post $post;

    public function toggleLikePost()
    {
        $user = auth()->user();

        if($user->hasLiked($this->post))
        {
            $user->likes()->detach($this->post);
            return;
        }
        $user->likes()->attach($this->post);
    }

    public function render()
    {
        return view('livewire.posts.like-button');
    }
}
