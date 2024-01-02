<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidate;
use App\Models\Skills;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UpdateJobSeekerProfileData extends Component
{
    use WithFileUploads;

    public $user;
    public $resume, $resumeUrl, $resumePath;
    public $coverPictureUrl, $coverPicturePath, $coverPicture;
    public $coverLetterUrl, $coverLetterPath, $coverLetter;
    public $about,$headline,$skills,$skillsList;

    public function mount()
    {
        $this->user = Candidate::where('user_id', auth()->user()->id)->first();
        $this->resumeUrl = $this->user->curriculumVitae;
        $this->coverPictureUrl = $this->user->coverPicture;
        $this->coverLetterUrl = $this->user->coverLetter;
        $this->skillsList = Skills::all();
        $this->headline = $this->user->headline;
        $this->about = $this->user->about;
        $this->skills = $this->user->skills;
    }

    // function to remove CV
    public function removeCV(){
        Storage::delete($this->resumeUrl);
        $this->user->update([
            'curriculumVitae' => null,
        ]);
        $this->reset(['resume','resumeUrl']);
    }

    // function to remove cover picture
    public function removeCoverPicture(){
        Storage::delete($this->coverPictureUrl);
        $this->user->update([
            'coverPicture' => null
        ]);
        $this->reset(['coverPicture','coverPictureUrl']);
    }

    // function to remove cover letter 
    public function removeCoverLetter(){
        Storage::delete($this->coverLetterUrl);
        $this->user->update([
            'coverLetter' => null
        ]);
        $this->reset(['coverLetter','coverLetterUrl']);
    }
    // function to save data to the DB
    public function save()
    {   
        $validated = $this->validate([
            'resume' => 'nullable|file|mimes:pdf,docx|max:2048',
            'coverPicture' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'coverLetter' => 'nullable|file|mimes:pdf,docx|max:2048',
            'about' => 'nullable|max:500',
            'headline' => 'nullable|max:40'
        ]);
        
        // check if skill doesn't exist on the database before creating it
        if($this->skills && count($this->skills) > 0){
            foreach($this->skills as $skill){
                $checkSkill = Skills::where('title',$skill)->first();
                if($checkSkill == null){
                    // Validate Skill String to check if it has tags or if it is too long before adding it to the skills table
                    if(Str::length($skill) <= 30 && $skill == strip_tags($skill)){
                        $newSkill = Skills::create([
                            'title' => $skill
                        ]);
                    }
                    else{
                        session()->flash('error', 'Something went wrong ! Please provide a skill that doesn\'t exceed 30 caracters.');
                        return;
                    }
                }
            }
        }
        
        

        $this->user->update([
            'skills' => $this->skills,
            'about' => $this->about,
            'headline' => $this->headline
        ]);
        if ($this->resume) {
            // storing file in storage/public/uploads folder
            $this->resumePath = $this->resume->storeAs('public/uploads', 'cv-user'.auth()->user()->id.'.pdf');
            
            $this->user->update([
                'curriculumVitae' => $this->resumePath,
            ]);
            return redirect('/user/profile');
        }

        if($this->coverPicture){
            $this->coverPicturePath = $this->coverPicture->storeAs('public/uploads/cover_pictures','cover-user'.auth()->user()->id.'.jpg');
            
            $this->user->update([
                'coverPicture' => $this->coverPicturePath,
            ]);
            return redirect('/user/profile');
        }

        if($this->coverLetter){
            $this->coverLetterPath = $this->coverLetter->storeAs('public/uploads/cover_letters','coverletter-user'.auth()->user()->id.'.pdf');
            
            $this->user->update([
                'coverLetter' => $this->coverLetterPath,
            ]);
            return redirect('/user/profile');
        }

        session()->flash('success', 'Data saved successfully !');

    }

    public function render()
    {
        return view('livewire.update-job-seeker-profile-data');
    }
}