<?php

namespace App\Livewire\HomePage;

use App\Models\favSeekerPost;
use App\Models\JobApplication;
use App\Models\JobOfferPost;
use App\Models\JobSeekerPost;
use App\Models\recentSeekerPost;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class ActivityOffers extends Component
{
    public $selectedCard = 1;
    public $favOffers = [];
    public $appOffers = [];
    public $recentOffers = [];
    public $allOffers = [];
    public $selectedPostId;
    public $popup = false;

    public function render()
    {
        return view('livewire.home-page.activity-offers', [
            $this->appOffers = JobApplication::where("user_id", Auth::user()->id)->get()->reverse(),
            $this->favOffers = favSeekerPost::where("user_id", Auth::user()->id)->get()->reverse(),
            $this->recentOffers = recentSeekerPost::where("user_id", Auth::user()->id)->get()->reverse(),
        ]);
    }

    #[On('popup-details')]
    public function showPopupDetails($postId, $cardId) {
        $this->selectedPostId = $postId-1;
        $this->popup = true;
        $this->selectCard($cardId);
        // dd($postId);
    }

    public function selectCard($cardId) {
        // if ($this->selectedCard != $cardId) {
           $this->selectedCard = $cardId;
        // }
    }

    public function popupDetails() {
        return $this->popup;
    }

}
