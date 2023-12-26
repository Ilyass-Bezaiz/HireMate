<?php

namespace App\Livewire;

use Livewire\Component;

class Comments extends Component
{
    public $postId;
    public $newComment;

    protected $rules = [
        'newComment' => 'required|min:3',
    ];

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function render()
    {
        $post = Post::findOrFail($this->postId);
        $comments = $post->comments()->withCount('likes')->latest()->get();

        return view('livewire.comments', compact('post', 'comments'));
    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'body' => $this->newComment,
            'user_id' => auth()->id(),
            'post_id' => $this->postId,
        ]);

        $this->newComment = '';

        $this->emit('commentAdded');
    }
}
