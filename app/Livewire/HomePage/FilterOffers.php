<?php

namespace App\Livewire\HomePage;

use Livewire\Attributes\On;
use Livewire\Component;

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
        dd($this->salaryRange);
    }

    public function incSalaryRange() {
        return $this->salaryRange;
    }
    public function incExpRange() {
        return $this->experienceRange;
    }
}
