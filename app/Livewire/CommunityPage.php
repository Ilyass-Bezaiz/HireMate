<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CommunityPage extends Component
{
    public $categories = [];

    public function mount(){
        $this->categories = Category::all();
    }

    

    public function render()
    {
        return view('livewire.community-page');
    }
}
