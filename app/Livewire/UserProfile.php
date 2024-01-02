<?php

namespace App\Livewire;

use App\Models\Candidate;
use App\Models\Education;
use App\Models\User;
use App\Models\WorkExperience;
use Livewire\Component;

class UserProfile extends Component
{
    public $user;
    public $userData;
    public $education;
    public $workExperience;
    public $candidateData;
    public $headline;
    public $about;
    public function mount($userId){
       $this->user = User::findOrFail($userId);
       $this->education = Education::where('user_id',$userId)->get();
       $this->workExperience = WorkExperience::where('user_id',$userId)->get();
       $this->about = Candidate::where('user_id',$userId)->first()->about;
       $this->headline = Candidate::where('user_id',$userId)->first()->headline;
    //    $this->candidateData = Candidate::findOrFail($userId);
    //    $this->about = $this->candidateData->about;
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
