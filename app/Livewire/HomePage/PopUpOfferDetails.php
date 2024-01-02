<?php

namespace App\Livewire\HomePage;

use App\Models\Employer;
use App\Models\favSeekerPost;
use App\Models\JobOfferPost;
use App\Models\User;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class PopUpOfferDetails extends Component
{
    public $postId;
    public $users = [];
    public $offers = [];
    public $employers = [];
    // protected $listeners = ['popup-details' => 'show'];
    public function render()
    {
        return view('livewire.home-page.pop-up-offer-details',[
            $this->users = User::all(),
            $this->offers = JobOfferPost::all(),
            $this->employers = Employer::all(),
        ]);
    }

    public function show($postId) {
        // $this->$postId = $postId;
        // dd($postId);
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
}

