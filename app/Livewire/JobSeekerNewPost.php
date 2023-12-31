<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\Country;
use App\Models\JobSeekerPost;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;


class JobSeekerNewPost extends Component
{
    
    protected $paginationTheme = 'bootstrap';
    public $showingModal = false;
    public $countries = [];
    public $cities = [];
    public $selectedCountry = null;
    public $isEditMode = false;
    public $oldCityValue = null;
    public $oldCityId = null;
    // job seeker post data

    public $post;
    public $title;
    public $expectedSalary;
    public $cityId;
    public $description;
    public $contractType;
    public $flexibility;
    
    public function showJobSeekerPostModal(){
        // resetting properties
        $this->resetExcept('countries','cities');

        $this->showingModal = true;
    }
    
    public function mount(){
        $this->countries = Country::all();
    }

    public function updatedSelectedCountry($country){
        $this->cities = City::where('country_id', $country)->get();   
    }

    public function storeJobSeekerPost(){
        $this->validate([
            'title' =>'required|max:50',
            'description' => 'required|max:200',
            'expectedSalary'=>'required|numeric',
            'flexibility' => 'required',
            'contractType' => 'required',
            'selectedCountry' => 'required',
            'cityId' => 'required'
        ]);

        JobSeekerPost::create([
            'title' => $this->title,
            'description' => $this->description,
            'expected_salary' => $this->expectedSalary,
            'flexibility' => $this->flexibility,
            'requestedContract' => $this->contractType,
            'country_id' => $this->selectedCountry,
            'city_id' => $this->cityId,
            'user_id' => auth()->user()->id
        ]);
        
        $this->resetExcept('countries','cities');

    }
    public function updateJobSeekerPost(){
        $this->validate([
            'title' =>'required|max:50',
            'description' => 'required|max:500',
            'expectedSalary'=>'required|numeric',
            'flexibility' => 'required',
            'contractType' => 'required',
            'selectedCountry' => 'required',
            'cityId' => 'required'
        ]);
        $this->post->update([
            'title' => $this->title,
            'description' => $this->description,
            'expected_salary' => $this->expectedSalary,
            'flexibility' => $this->flexibility,
            'requestedContract' => $this->contractType,
            'country_id' => $this->selectedCountry,
            'city_id' => $this->cityId,
            'user_id' => auth()->user()->id
        ]);
        $this->resetExcept('countries','cities');
    }

    public function deletePost($id){

        $post = JobSeekerPost::findOrFail($id);
        
        /* secure delete action
        / ### prevent any user from deleting any post he wants .
        */

        $this->authorize('delete', $post);

        $post->delete();
        // resetting properties
        $this->resetExcept('countries','cities');
        
    }

    public function showEditPostModal($id){
        $this->post = JobSeekerPost::findOrFail($id);
        
        $this->authorize('update',$this->post);

        $this->title = $this->post->title;
        $this->expectedSalary = $this->post->expected_salary;
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

    public function render()
    {  
        return view('livewire.job-seeker-new-post',[
            'posts' => JobSeekerPost::where('user_id',auth()->user()->id)->paginate(5),
        ]);
    }
}