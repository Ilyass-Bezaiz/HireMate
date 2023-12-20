<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\Country;

class JobSeekerNewPost extends Component
{
    
    public $showingModal = false;
    public $countries;
    public $cities = [];
    public $selectedCountry = null;
 
    public function showJobSeekerPostModal(){
        $this->showingModal = true;
    }
    
    public function mount(){
        $this->countries = Country::all();
    }

    public function updatedSelectedCountry($country){
        $this->cities = City::where('country_id', $country)->get();
    }

    public function render()
    {  
        return view('livewire.job-seeker-new-post');
    }
}
