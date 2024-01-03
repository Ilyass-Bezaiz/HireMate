<?php

namespace App\Livewire\HomePage;

use App\Models\Employer;
use App\Models\Candidate;
use App\Models\favSeekerPost;
use App\Models\JobOfferPost;
use App\Models\JobSeekerPost;
use App\Models\User;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class PopUpOfferDetails extends Component
{
    public $postId = 1;
    public $users = [];
    public $offers = [];
    public $requests = [];
    public $employers = [];
    public $seekers = [];
    public $showingModal = false;
    protected $listeners = ['popup-joboffer-details' => 'show', 'popup-seeker-details' => 'show'];

    public function render()
    {
        return view('livewire.home-page.pop-up-offer-details',[
            $this->users = User::all(),
            $this->offers = JobOfferPost::all(),
            $this->requests = JobSeekerPost::all(),
            $this->employers = Employer::all(),
            $this->seekers = Candidate::all(),
        ]);
    }

    
    // #[On('popup-details')]
    public function show($postId) {
        // dd($postId);
        $this->postId = $postId;
        $this->showingModal = true;
        // $this->$postId = $postId;
        // dd($postId);
    }
    
    public function closeModal() {
        $this->showingModal = false;
    }
    

    public function likedPost($postId): bool {
        $liked = false;
        favSeekerPost::where('post_id', $postId)->exists() ? $liked = true : false;
        return $liked;
    }

    public function addFav($postId) {
        // $this->js("alert('$postId')");
        if(!favSeekerPost::where('user_id','=',Auth::user()->id)->where('post_id','=', $postId)->exists()) {
            favSeekerPost::create([
                'user_id' => Auth::user()->id,
                'post_id' => $postId,
            ]);
        } else {
            favSeekerPost::where('user_id','=',Auth::user()->id)->where('post_id','=', $postId)->delete();
        }
        // $this->mount(favSeekerPost::where("user_id", Auth::user()->id)->get()->reverse());
    }
}

