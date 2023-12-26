<?php

namespace App\Livewire;

use Livewire\Component;

class PostDetails extends Component
{
    public $postId;

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function render()
    {
        $post = Post::with('likes', 'comments.user')->findOrFail($this->postId);

        return view('livewire.post-details', compact('post'));
    }
}
