<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Employer;
use App\Models\Candidate;
use Livewire\Attributes\On;
use App\Models\JobOfferPost;
use Livewire\WithFileUploads;
use App\Models\JobApplication;
use App\Livewire\HomePage\JobseekerOffers;

class ApplyingProcess extends Component
{
    use WithFileUploads;

    public $user = [];
    public $applyingForJob = 1;
    public $companyApplied;
    public $stepper = 1;
    public $showingModal = false;
    public $showingSuccessMessage = false;
    protected $listeners = ['modal-show' => 'applyForJob'];

    //models
    public $email = "";
    public $phone = "";
    #[Validate('max:2048')]
    public $resume;
    public $resumeUrl = false;
    public $path;

    // #[On("modal-show")]
    public function applyForJob($params){
        $id = $params['id'];
        // dd($id);
        $this->showingSuccessMessage = false;
        $this->applyingForJob = $id+1;
        $userId = JobOfferPost::where('id', $this->applyingForJob)->value('user_id');
        $this->companyApplied = Employer::where('user_id', $userId)->value('companyName');
        $this->showingModal = true;
    }

    public function nextStep(){
        if($this->stepper < 3)  $this->check($this->stepper)? $this->stepper++ : $this->stepper;
    }

    public function stepBack(){
        $this->stepper--;
    }

    public function check($step){
        if ($step == 1) {
            $validated = $this->validate([
                'email' => 'required|max:100',
                'phone'=>'required|numeric',
            ]);
            $user = User::find(auth()->id());
            $user->update(['email' => $this->email, 'phone' => $this->phone]);
            return isset($validated);
        }
        if ($step == 2) {
            if($this->resumeUrl == false){
                $validated = $this->validate([
                    'resume' => 'file|mimes:pdf,docx|max:2048',
                ]);
                $this->path = $this->resume->storeAs('public/uploads', 'cv-'.auth()->user()->name.'.pdf');
                $this->user->update([
                    'curriculumVitae' => $this->path
                ]);
                $this->resumeUrl = $this->path;
                return isset($validated);
            }
            else return true;
        }
        if($step == 3){
            $this->submitApplication();
        }
    }

    public function removeCV(){
        $this->user->update([
            'curriculumVitae' => null,
        ]);
        $this->resumeUrl = null;
        $this->resume =  null;
        $this->path =  null;
    }

    public function edit($step){
        $this->stepper = $step;
    }

    
    public function cancelApplying(){
        $this->showingModal = false;
        $this->stepper = 1;
        // $this->resumeUrl = null;
        // $this->path =  null;
        // $this->resume =  null;
    }
    
    public function submitApplication(){
        // Get the currently authenticated user's ID
        $userId = auth()->id();
        // Create the application record
        JobApplication::create([
            'user_id' => $userId,
            'post_id' => $this->applyingForJob,
        ]);
        $this->cancelApplying();
        session()->flash('message', 'Your application has been submitted!');
        $this->showingSuccessMessage = true;
    }
    
    public function mount(){
        $user = User::find(auth()->id());
        $this->user = Candidate::where('user_id', auth()->user()->id)->first();
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->resumeUrl = $this->user->curriculumVitae;
        $this->resume = $this->user->curriculumVitae;
    }
    public function render()
    {
        return view('livewire.applying-process');
    }
}