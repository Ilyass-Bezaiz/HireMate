<?php

namespace App\Livewire;

use App\Models\Candidate;
use Livewire\Component;

class ModifyDemographicInfo extends Component
{   
    public $user;
    public $gender;
    public $age;

    public function mount()
    {
        $this->user = Candidate::where('user_id', auth()->user()->id)->first();
        $this->age = $this->user->age;
        $this->gender = $this->user->gender;
    }

    public function save()
    {   
        $validated = $this->validate([
            'age' => 'numeric|max:50',
        ]);
        
        $this->user->update([
            'age' => $this->age,
            'gender' => $this->gender,
        ]);

        session()->flash('success-demographic', 'Data saved successfully !');

    }

    public function render()
    {
        return view('livewire.modify-demographic-info');
    }
}
