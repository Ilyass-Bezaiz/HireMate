<?php

namespace App\Livewire;

use App\Models\Education;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateEdcuationInfo extends Component
{
    public $showingModal = false;
    public $isEditMode = false;
    public $educationList = [];

    public $education_status;    
    public $education_level;
    public $education_field;
    public $start_date;
    public $end_date;
    public $selectedEducation;
    public $disabled = false;

    // conditional validation rules based on the Education status field
    public function rules(){
        if($this->education_status == 'Currently enrolled'){
            return [
                'education_status' => 'required',
                'education_level' => 'required',
                'education_field' => 'required|max:30',
                'start_date' => 'required|before:today',
                'end_date' => 'nullable'
            ];
        }else{
            return [
                'education_status' => 'required',
                'education_level' => 'required',
                'education_field' => 'required|max:30',
                'start_date' => 'required|before_or_equal:today',
                'end_date' => 'required|after:start_date|before:today'
            ];
        }
    }

    public function showAddEducationModal(){
        $this->resetExcept('educationList');
        $this->showingModal = true;
    }
    
    public function showEditEducationModal($id){
        
        $this->selectedEducation = Education::findOrFail($id);

        $this->authorize('update',$this->selectedEducation);

        $this->isEditMode = true;
        $this->showingModal = true;


        $this->education_level = $this->selectedEducation->education_level;
        $this->education_status = $this->selectedEducation->education_status;
        $this->education_field = $this->selectedEducation->education_field;
        $this->start_date = $this->selectedEducation->start_date;
        $this->end_date = $this->selectedEducation->end_date;

    }

    // change the value of the "disabled" property if the user has chosen "Currently enrolled" as education status
    public function updated($propertyName){
        if($propertyName == 'education_status'){
            if($this->education_status == 'Currently enrolled'){
                $this->disabled = true;
                $this->end_date = null;
            }else{
                $this->disabled = false;
            }
        }
    }

    public function updateEducation(){
        $this->validate();
        $this->selectedEducation->update([
            'education_level' => $this->education_level,
            'education_status' => $this->education_status,
            'education_field' => $this->education_field,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_id' => auth()->user()->id
        ]);
        session()->flash('success', 'Education information saved successfully !');
        $this->resetExcept('educationList');
    }

    public function deleteEducation(){
        $this->authorize('delete',$this->selectedEducation);
        $this->selectedEducation->delete();
        session()->flash('success', 'Education information saved successfully !');
        $this->resetExcept('educationList');
    }

    public function create(){

        $this->validate();
        if(count($this->educationList) < 5){
            Education::create([
                'education_level' => $this->education_level,
                'education_status' => $this->education_status,
                'education_field' => $this->education_field,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'user_id' => auth()->user()->id
            ]);
    
            session()->flash('success', 'Education information saved successfully !');
            $this->resetExcept('educationList');
        }else{
            $this->resetExcept('educationList');
            session()->flash('error', 'You have exceeded the maximum number of education entries !');
            return;
        }
        


    }

    public function render()
    {
        return view('livewire.update-edcuation-info',[
            $this->educationList = Education::where('user_id',auth()->user()->id)->orderBy('end_date','desc')->get()
        ]);
    }
}
