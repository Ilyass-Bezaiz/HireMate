<?php

namespace App\Livewire\Partials;

use App\Models\Candidate;
use App\Models\Employer;
use App\Models\favSeekerPost;
use App\Models\User;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CardSlider extends Component
{
    public $title;
    public $posts = [];
    public $users = [];
    public $employers = [];
    public $seekers = [];
    public function render()
    {
        return view('livewire.partials.card-slider', [
            $this->users = User::all(),
            $this->employers = Employer::all(),
            $this->seekers = Candidate::all(),
        ]);
    }

    public function likedPost($postId): bool {
        $liked = false;
        favSeekerPost::where('post_id', $postId)->exists() ? $liked = true : false;
        return $liked;
    }

    public function addFav($postId) {
        // $this->js("alert('$postId')");
        if(!favSeekerPost::where('user_id','=',Auth::user()->id)->where('post_id','=', $postId)->exists()) {
            favSeekerPost::create([
                'user_id' => Auth::user()->id,
                'post_id' => $postId,
            ]);
        } else {
            favSeekerPost::where('user_id','=',Auth::user()->id)->where('post_id','=', $postId)->delete();
        }
        // $this->mount(favSeekerPost::where("user_id", Auth::user()->id)->get()->reverse());
    }

    public function mount($cardContent){
        $this->posts = $cardContent->unique();
    }
}
