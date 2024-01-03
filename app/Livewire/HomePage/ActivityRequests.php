<?php

namespace App\Livewire\HomePage;

use App\Models\favOfferPost;
use App\Models\JobApplication;
use App\Models\JobOfferPost;
use App\Models\recentEmployerPost;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class ActivityRequests extends Component
{
    public $selectedCard = 2;
    public $favOffers = [];
    public $appOffers = [];
    public $recentOffers = [];
    public $allOffers = [];
    public $selectedPostId;
    public $popup = false;

    public function render()
    {
        return view('livewire.home-page.activity-requests', [
            // $this->appOffers = JobApplication::where("user_id", Auth::user()->id)->get()->reverse(),
            $this->favOffers = favOfferPost::where("user_id", Auth::user()->id)->get()->reverse(),
            $this->recentOffers = recentEmployerPost::where("user_id", Auth::user()->id)->get()->reverse(),
        ]);
    }

    #[On('popup-seeker-details')]
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
