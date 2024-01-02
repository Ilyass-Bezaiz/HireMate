<?php

namespace App\Livewire;

use App\Models\WorkExperience;
use Livewire\Component;

class UpdateWorkExperience extends Component
{

    public $showingModal = false;
    public $isEditMode = false;
    public $experiencesList = [];

    public $companyName;
    public $position;
    public $start_date;
    public $end_date;
    public $responsibilities;
    public $selectedExperience;
    public $stillWorkHere = false;
    public $disabled;

    public function rules(){
        if($this->stillWorkHere){
            return [
                'companyName' => 'required|max:30',
                'position' => 'required|max:30',
                'responsibilities' => 'nullable|max:500',
                'start_date' => 'required|before_or_equal:today',
                'end_date' => 'nullable'
            ];
        }else{
            return [
                'companyName' => 'required|max:30',
                'position' => 'required|max:30',
                'responsibilities' => 'nullable|max:500',
                'start_date' => 'required|before_or_equal:today',
                'end_date' => 'required|after:start_date|before:today'
            ];
        }
    }

    public function updated($propertyName){
        if($propertyName == 'stillWorkHere'){
            if($this->stillWorkHere){
                $this->disabled = true;
                $this->end_date = null;
            }else{
                $this->disabled = false;
            }
        }
    }

    public function showAddExperienceModal(){
        $this->resetExcept('experiencesList');
        $this->showingModal = true;
    }

    public function showEditExperienceModal($id){
        
        $this->selectedExperience = WorkExperience::findOrFail($id);

        $this->authorize('update',$this->selectedExperience);

        $this->companyName = $this->selectedExperience->company_name;
        $this->position = $this->selectedExperience->position;
        $this->start_date = $this->selectedExperience->start_date;
        $this->end_date = $this->selectedExperience->end_date;
        $this->responsibilities = $this->selectedExperience->responsibilities;
        if($this->end_date == null){
            $this->stillWorkHere = true;
            $this->disabled = true;
        }
        $this->isEditMode = true;
        $this->showingModal = true;


    }

    public function createExperience(){
        $this->validate();
        if(count($this->experiencesList) < 5){
            WorkExperience::create([
                'company_name' => $this->companyName,
                'position' => $this->position,
                'responsibilities' => $this->responsibilities,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'user_id' => auth()->user()->id
            ]);
    
            session()->flash('success', 'Work experience saved !');
            $this->resetExcept('experiencesList');
        }else{
            $this->resetExcept('experiencesList');
            session()->flash('error', 'You have exceeded the maximum number of experiences entries !');
            return;
        }
    }

    public function updateExperience(){
        $this->validate();
        $this->selectedExperience->update([
            'company_name' => $this->companyName,
            'position' => $this->position,
            'responsibilities' => $this->responsibilities,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_id' => auth()->user()->id
        ]);
        session()->flash('success', 'Work experience saved !');
        $this->resetExcept('experiencesList');
    }

    public function deleteExperience(){
        $this->authorize('delete',$this->selectedExperience);
        $this->selectedExperience->delete();
        session()->flash('success', 'Experience deleted successfully !');
        $this->resetExcept('experiencesList');
    }

    public function render()
    {
        return view('livewire.update-work-experience',[
            $this->experiencesList = WorkExperience::where('user_id',auth()->user()->id)->orderBy('end_date','desc')->get()
        ]);
    }
}
