<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Candidate;
use Livewire\WithFileUploads;

class UpdateJobSeekerProfileData extends Component
{
    use WithFileUploads;

    public $user;
    public $age;
    public $gender;
    #[Validate('max:2048')]
    public $resume;
    public $resumeUrl;
    public $changedResumeFile = false;
    public $path;

    // update validation rules based on the changedResumeFile boolean ; if the value of this varibale is true meaning the user changed the file it adds a validation rule for the file.
    protected function rules() {
        if ($this->resumeUrl == null && $this->changedResumeFile)
            return [
                'age' => 'numeric',
                'resume' => 'file|mimes:pdf,docx|max:2048',
            ];
        else if($this->changedResumeFile)
            return [
                'age' => 'numeric',
                'resume' => 'file|mimes:pdf,docx|max:2048',
            ];
        else
            return [
                'age' => 'numeric',
            ];
    }
    // track the state of the changedResumeFile variable
    public function updatedResume(){
            if($this->changedResumeFile == false) $this->changedResumeFile = true;
    }

    public function mount()
    {
        $this->user = Candidate::where('user_id', auth()->user()->id)->first();
        $this->age = $this->user->age;
        $this->gender = $this->user->gender;
        $this->resume = $this->user->curriculumVitae;
        $this->resumeUrl = $this->user->curriculumVitae;
    }

    public function removeCV(){
        $this->user->update([
            'curriculumVitae' => null,
        ]);

        // Redirect to the profile page
        return redirect('/user/profile');
    }

    public function save()
    {
        $validated = $this->validate($this->rules());
        if ($this->resume && $this->changedResumeFile) {
            $this->path = $this->resume->storeAs('public/uploads', 'cv-'.auth()->user()->name.'.pdf');
            if($this->changedResumeFile){
                $this->user->update([
                    'age' => $this->age,
                    'curriculumVitae' => $this->path,
                    'gender' => $this->gender,
                ]);
            }
        }
        else{
            $this->user->update([
                'age' => $this->age,
                'gender' => $this->gender,
            ]);
        }

        session()->flash('success', 'Data saved successfully !');
        $this->reset();
        // Redirect to the profile page
        return redirect('/user/profile');
    }

    public function render()
    {
        return view('livewire.update-job-seeker-profile-data');
    }
}