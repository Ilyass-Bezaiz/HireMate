<?php

namespace App\Livewire\HomePage;

use App\Models\favSeekerPost;
use App\Models\JobOfferPost;
use App\Models\JobSeekerPost;
use App\Models\recentSeekerPost;
use Auth;
use Livewire\Component;

class ActivityOffers extends Component
{
    public $selectedCard = 1;
    public $favOffers = [];
    public $appOffers = [];
    public $recentOffers = [];
    public $allOffers = [];

    public function render()
    {
        return view('livewire.home-page.activity-offers', [
            $this->favOffers = favSeekerPost::where("user_id", Auth::user()->id)->get()->reverse(),
            $this->recentOffers = recentSeekerPost::where("user_id", Auth::user()->id)->get()->reverse(),
        ]);
    }

    public function selectCard($cardId) {
        if ($this->selectedCard != $cardId) {
           $this->selectedCard = $cardId;
        }
    }

}
