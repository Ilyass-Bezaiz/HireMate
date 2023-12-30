<?php

namespace App\Livewire\Partials;

use App\Models\favSeekerPost;
use App\Models\User;
use Livewire\Component;

class CardSlider extends Component
{
    public $posts = [];
    public $users = [];
    public function render()
    {
        return view('livewire.partials.card-slider', [
            $this->users = User::all(),
        ]);
    }

    public function likedPost($postId): bool {
        $liked = false;
        favSeekerPost::where('post_id', $postId)->exists() ? $liked = true : false;
        return $liked;
    }

    public function mount($cardContent){
        $this->posts = array_unique($cardContent);
    }
}
