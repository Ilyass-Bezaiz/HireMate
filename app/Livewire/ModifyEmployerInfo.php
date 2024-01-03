<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Employer;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModifyEmployerInfo extends Component
{

    use WithFileUploads;

    public $countries = [];
    public $selectedCountry = null;
    public $city;
    public $industry;
    public $employee_count;
    public $company_name;
    public $about;
    public $zip;
    public $coverPictureUrl, $coverPicturePath, $coverPicture;

    public $employer = null;

    public function mount(){
        $this->countries = Country::all();
        $this->employer = Employer::where('user_id',auth()->user()->id)->first();
        $this->selectedCountry = $this->employer->country;
        $this->city = $this->employer->city;
        $this->industry = $this->employer->industry;
        $this->employee_count = $this->employer->employeeCount;
        $this->company_name = $this->employer->companyName;
        $this->about = $this->employer->bio;
        $this->zip = $this->employer->zip;
        $this->coverPictureUrl = $this->employer->coverPicture;
    }

    // function to remove cover picture
    public function removeCoverPicture(){
        Storage::delete($this->coverPictureUrl);
        $this->employer->update([
            'coverPicture' => null
        ]);
        $this->reset(['coverPicture','coverPictureUrl']);
    }

    // function to save data to the DB
    public function save()
    {   
        $validated = $this->validate([
            'coverPicture' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'about' => 'nullable|max:1000',
            'industry' => 'nullable|max:40',
            'employee_count' => 'required|max:10000',
            'city' => 'nullable|string|max:40',
            'zip' => 'nullable|numeric|max:999999',
            'company_name' => 'nullable|string|max:40',
        ]);
        

        $this->employer->update([
            'bio' => $this->about,
            'industry' => $this->industry,
            'companyName' => $this->company_name,
            'country' => $this->selectedCountry,
            'city' => $this->city,
            'zip' => $this->zip,
            'employeeCount' => $this->employee_count,
        ]);

        if($this->coverPicture){
            $this->coverPicturePath = $this->coverPicture->storeAs('public/uploads/cover_pictures','cover-employer'.auth()->user()->id.'.jpg');
            
            $this->employer->update([
                'coverPicture' => $this->coverPicturePath,
            ]);
            $this->dispatch('success',message:"Data saved successfully !");
            return redirect('/user/profile');
        }
        $this->dispatch('success',message:"Data saved successfully !");


    }

    public function render()
    {
        return view('livewire.modify-employer-info');
    }
}
