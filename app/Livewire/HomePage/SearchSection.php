<?php

namespace App\Livewire\HomePage;

use App\Models\Employer;
use App\Models\JobOfferPost;
use Livewire\Component;
use Session;

class SearchSection extends Component
{
    public $inp1 = '';
    public $inp2 = '';
    public $searchedPosts = [];
    public function render()
    {
        return view('livewire.home-page.search-section');
    }
    public function search() {
        // $this->searchedPosts = array_unique();
        // SearchedOffers::searching($this->inp1, $this->inp2);
        if($this->inp1 != "" || $this->inp2 != ""){
            Session::put('last_search_title', $this->inp1);
            Session::put('last_search_location', $this->inp2);
            $this->dispatch('change-main-nav', 2);
            if (auth()->user()->role == 'job_seeker') {
                $this->dispatch('searching', [$this->inp1, $this->inp2]);
            } else {
                $this->dispatch('searching-for-seeker', [$this->inp1, $this->inp2]);
            }
            $this->inp1 = '';
            $this->inp2 = '';
            $this->js("window.scrollTo(0, 500)");
        }
    }
}
