<?php

namespace App\Livewire\HomePage;

use Livewire\Component;
use App\Models\Employer;
use Livewire\Attributes\On;
use App\Models\JobOfferPost;
use App\Models\JobSeekerPost;
use App\Livewire\HomePage\ForyouOffers;
use Session;

class FilterOffers extends Component
{
    public $salaryRange = 0;
    public $fullTimeBox;
    public $partTimeBox;
    public $experienceRange = 0;
    public $anyExperienceBox;
    public $techBox;
    public $consultingBox;
    public $advertisingBox;
    public function render()
    {
        return view('livewire.home-page.filter-offers');
    }

    public function filter() {
        // dd($this->salaryRange);
        $query = JobOfferPost::query();
            if ($this->salaryRange) {
                $query->where('salary', '>=', $this->salaryRange);
            }
            if ($this->fullTimeBox || $this->partTimeBox) {
                $query->where(function ($query) {
                    if ($this->fullTimeBox) {
                        $query->orWhere('requestedContract', 'full-time');
                    }
            
                    if ($this->partTimeBox) {
                        $query->orWhere('requestedContract', 'part-time');
                    }
                });
            }
            if ($this->experienceRange) {
                $query->where('required_experience', '>=', $this->experienceRange);
            }
            if ($this->techBox || $this->consultingBox || $this->advertisingBox) {
                $query->where(function ($query) {
                    if ($this->techBox) {
                        $query->orWhere('industry', $this->techBox);
                    }
                    if ($this->consultingBox) {
                        $query->orWhere('industry', $this->consultingBox);
                    }
                    if ($this->advertisingBox) {
                        $query->orWhere('industry', $this->advertisingBox);
                    }
                });
            }
            $offers = $query->get()->reverse();
            if($offers->count() == 0) {
                $this->js("alert('Offers not found')");
            } else {
                $this->dispatch('filter', ['offers'=>$offers]);
            }
        
    }

    public function incSalaryRange() {
        return $this->salaryRange;
    }
    public function incExpRange() {
        return $this->experienceRange;
    }
}