<?php

namespace App\Livewire\HomePage;

use App\Models\favSeekerPost;
use App\Models\JobOfferPost;
use App\Models\JobSeekerPost;
use Auth;
use Livewire\Component;

class ActivityOffers extends Component
{
    public $selectedCard = 1;
    public $favOffers = [];
    public $appOffers = [];
    public $allOffers = [];

    public function render()
    {
        return view('livewire.home-page.activity-offers', [
            $this->favOffers = $this->getOffers(),
        ]);
    }

    public function selectCard($cardId) {
        if ($this->selectedCard != $cardId) {
           $this->selectedCard = $cardId;
        }
    }

    public function getOffers() {
        $this->allOffers =  JobOfferPost::all();
        foreach($this->allOffers as $offer) {
            if (favSeekerPost::where("user_id", Auth::user()->id)->where("post_id", $offer->id)->first()) {
                array_push($this->favOffers, $offer);
            }
        }
        return $this->favOffers;
    }
}
