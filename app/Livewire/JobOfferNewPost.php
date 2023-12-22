<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use App\Models\JobOfferPost;

class JobOfferNewPost extends Component
{
    public $showingModal = false;
    public $countries = [];
    public $cities = [];
    public $selectedCountry = null;
    public $isEditMode = false;
    public $oldCityValue = null;
    public $oldCityId = null;
    // job offer post data

    public $post;
    public $title;
    public $salary;
    public $cityId;
    public $description;
    public $contractType;
    public $flexibility;

    public function showJobOfferPostModal(){
        // resetting properties
        $this->resetExcept('countries','cities');
        $this->showingModal = true;
    }
    
    public function updatedSelectedCountry($country){
        $this->cities = City::where('country_id', $country)->get();
    }

    public function mount(){
        $this->countries = Country::all();
    }

    public function storeJobOfferPost(){
        $this->validate([
            'title' =>'required|max:50',
            'description' => 'required|max:100',
            'salary'=>'required|numeric',
            'flexibility' => 'required',
            'contractType' => 'required',
            'selectedCountry' => 'required',
            'cityId' => 'required'
        ]);

        JobOfferPost::create([
            'title' => $this->title,
            'description' => $this->description,
            'salary' => $this->salary,
            'flexibility' => $this->flexibility,
            'requestedContract' => $this->contractType,
            'country_id' => $this->selectedCountry,
            'city_id' => $this->cityId,
            'user_id' => auth()->user()->id
        ]);
        $this->resetExcept('countries','cities');
    }

    public function showEditPostModal($id){
        $this->post = JobOfferPost::findOrFail($id);
        // dd($post);
        $this->title = $this->post->title;
        $this->salary = $this->post->salary;
        $this->flexibility = $this->post->flexibility;
        $this->contractType = $this->post->requestedContract;
        $this->description = $this->post->description;
        $this->selectedCountry = $this->post->country_id;
        $this->cityId = $this->post->city_id;
        $this->isEditMode = true;
        $this->showingModal = true;

        $this->cities = City::where('country_id', $this->selectedCountry)->get();
        $this->oldCityValue = City::find($this->cityId);
        $this->oldCityId = $this->oldCityValue->id;
    }

    public function updateJobOfferPost(){
        $this->validate([
            'title' =>'required|max:50',
            'description' => 'required|max:100',
            'salary'=>'required|numeric',
            'flexibility' => 'required',
            'contractType' => 'required',
            'selectedCountry' => 'required',
            'cityId' => 'required'
        ]);
        $this->post->update([
            'title' => $this->title,
            'description' => $this->description,
            'salary' => $this->salary,
            'flexibility' => $this->flexibility,
            'requestedContract' => $this->contractType,
            'country_id' => $this->selectedCountry,
            'city_id' => $this->cityId,
            'user_id' => auth()->user()->id
        ]);
        $this->resetExcept('countries','cities');
    }

    public function deletePost($id){
        JobOfferPost::findOrFail($id)->delete();
        // resetting properties
        $this->resetExcept('countries','cities');
    }
    
    public function render()
    {
        return view('livewire.job-offer-new-post',[
            'posts' => JobOfferPost::where('user_id',auth()->user()->id)->paginate(2),
        ]);
    }
}