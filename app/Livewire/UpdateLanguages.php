<?php

namespace App\Livewire;

use App\Models\Candidate;
use App\Models\CandidateLanguages;
use App\Models\Language;
use App\Models\User;
use Livewire\Component;

class UpdateLanguages extends Component
{
    public $languages = [];
    public $languagesList = [];
    public $showingModal = false;
    public $isEditMode = false;
    public $proficiency;
    public $selectedLanguage;
    public $languageToUpdate;
    public $getLanguageName;

    public function mount(){
        $this->languages = CandidateLanguages::where('user_id',auth()->user()->id)->get();
        $this->languagesList = Language::all();
    }

    public function showAddLanguageModal(){
        $this->resetExcept('languages','languagesList');
        $this->showingModal = true;
    }

    public function getLanguageName($id){
        $language = Language::findOrFail($id);
        return $language->name;
    }

    public function addLanguage(){
        $this->validate([
            'proficiency' => 'required',
            'selectedLanguage' => 'required'
        ]);
        $languageExists = CandidateLanguages::where('language_id',$this->selectedLanguage)->where('user_id',auth()->user()->id)->get();
        $prevLanguages = CandidateLanguages::where('user_id',auth()->user()->id)->get();
        if(count($languageExists) == 0 && count($prevLanguages)<5){
            CandidateLanguages::create([
                'user_id' => auth()->user()->id,
                'language_id' => $this->selectedLanguage,
                'proficiency' => $this->proficiency
            ]);
            $this->dispatch('success',message:"Languages saved successfully !");
        }elseif(count($prevLanguages) == 5){
            $this->dispatch('error',message:"Maximum number of languages exceeded ! ");
        }
        else{
            $this->dispatch('error',message:"You already added this language to the list !");
        }

        $this->languages = CandidateLanguages::where('user_id',auth()->user()->id)->get();
        $this->resetExcept('languages','languagesList');
    }

    public function updateLanguage(){
        $this->validate([
            'proficiency' => 'required',
            'selectedLanguage' => 'required'
        ]);
        $languageExists = CandidateLanguages::where('language_id',$this->selectedLanguage)->where('user_id',auth()->user()->id)->get();
        if(count($languageExists) == 0){
            $this->languageToUpdate->update([
                'language_id' => $this->selectedLanguage,
                'proficiency' => $this->proficiency,
                'user_id' => auth()->user()->id
            ]);
            $this->dispatch('success',message:"Languages updated successfully !");
        }else{
            $this->dispatch('error',message:"You already added this language to the list !");
        }
        
        $this->languages = CandidateLanguages::where('user_id',auth()->user()->id)->get();
        $this->resetExcept('languagesList','languages');
    }

    public function deleteLanguage(){
        $this->authorize('delete',$this->languageToUpdate);
        $this->languageToUpdate->delete();
        $this->dispatch('success',message:"Language deleted successfully !");
        $this->languages = CandidateLanguages::where('user_id',auth()->user()->id)->get();
        $this->resetExcept('languagesList','languages');
    }

    public function showEditLanguageModal($id){

        $this->languageToUpdate = CandidateLanguages::findOrFail($id);

        $this->authorize('update',$this->languageToUpdate);

        $this->proficiency = $this->languageToUpdate->proficiency;
        $this->selectedLanguage = $this->languageToUpdate->language_id;

        $this->showingModal = true;
        $this->isEditMode = true;

    }


    public function render()
    {
        return view('livewire.update-languages',[
            'languages' => CandidateLanguages::where('user_id',auth()->user()->id)->get(),
        ]);
    }
}
