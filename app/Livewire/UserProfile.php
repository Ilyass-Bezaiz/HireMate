<?php

namespace App\Livewire;

use App\Models\Candidate;
use App\Models\Education;
use App\Models\User;
use App\Models\WorkExperience;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyDemoMail;
use App\Models\CandidateLanguages;
use App\Models\City;
use App\Models\Country;
use App\Models\Employer;
use App\Models\JobOfferPost;
use App\Models\Language;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class UserProfile extends Component
{
    
    public $user;
    public $user_id;
    public $userRole;
    public $userData = [];
    public $subject;
    public $message;
    public $showingModal = false;
    public $responsibilities = null;
    public $showingDetails = false;
    public $employer;

    public function getLanguageName($id){
        $language = Language::findOrFail($id);
        return $language->name;
    }

    public function mount($userId){
       $this->user_id = $userId;
       $this->user = User::findOrFail($userId);
       $this->userRole = $this->user->role;
       if($this->userRole == 'job_seeker'){
           $this->userData = [
                'education' => Education::where('user_id',$userId)->orderBy('start_date','desc')->get(),
                'workExperience' =>  WorkExperience::where('user_id',$userId)->orderBy('start_date','desc')->get(),
                'coverPicture' => Candidate::where('user_id',$userId)->first()->coverPicture,
                'skills' => Candidate::where('user_id',$userId)->first()->skills,
                'about' => Candidate::where('user_id',$userId)->first()->about,
                'headline' => Candidate::where('user_id',$userId)->first()->headline,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
                'resume' => Candidate::where('user_id',$userId)->first()->curriculumVitae,
                'coverLetter' => Candidate::where('user_id',$userId)->first()->coverLetter,
                'languages' => CandidateLanguages::where('user_id',$userId)->orderBy('updated_at','desc')->get()
           ];
        }elseif($this->userRole == 'employer'){
            $this->employer = Employer::where('user_id',$userId)->first();
            $this->userData = [
                'coverPicture' => $this->employer->coverPicture,
                'companyName' => $this->employer->companyName,
                'industry' => $this->employer->industry,
                'about' => $this->employer->bio,
                'posts' => JobOfferPost::where('user_id',$userId)->orderBy('updated_at','desc')->get(),
                'country' => $this->employer->country,
                'city' => $this->employer->city,
                'zip' => $this->employer->zip,
                'employee_count' => $this->employer->employeeCount
            ];
        }

    }

    public function getCountryName($id){
        return Country::findOrFail($id)->name;
    }
    public function getCityName($id){
        return City::findOrFail($id)->name;
    }

    public function sendMail($email)
    {

        $this->validate([
            'subject' => 'required',
            'message' => 'required|max:500',
        ]);

        $mailData = [
            'email' => $email,
            'subject' => $this->subject,
            'from' => auth()->user()->email,
            'message' => $this->message,
        ]; 
        $list_of_subjects = [
            'Feedback and Suggestions',
            'Reporting an Issue',
            'Interested in working with you',
            'General Inquiry',
            'Advertising and Sponsorship'
        ];
        if(in_array($mailData['subject'], $list_of_subjects)){
            // Create an instance of MyDemoMail Mailable
            $myDemoMail = new MyDemoMail($mailData);    
            // Send the email using the Mailable instance
            Mail::to($email)->send($myDemoMail);

            $this->dispatch('email-sent');

        }else{
            $this->dispatch('email-failed');
        }
        
        $this->reset('showingModal');
    
    }

    public function showDetailsModal($id){
        try {

           $decryptedId = Crypt::decrypt($id);

        } catch (DecryptException $e) {
            $this->dispatch('error',message:'Oops ! something went wrong');
            return;
        }
        $workExperience = WorkExperience::findOrFail($decryptedId);
        $this->responsibilities = $workExperience->responsibilities;
        $this->showingDetails = true;        
    }

    public function closeDetailsModal(){
        $this->showingDetails = false;
    }

    public function contactUser(){
        $this->showingModal = true;
    }

    public function render()
    {
        return view('livewire.user-profile',[
            $this->userData['education'] = Education::where('user_id',$this->user_id)->orderBy('start_date','desc')->get(),
            $this->userData['workExperience'] =  WorkExperience::where('user_id',$this->user_id)->orderBy('start_date','desc')->get(),
        ]);
    }
}
