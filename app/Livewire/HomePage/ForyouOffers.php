<?php

namespace App\Livewire\HomePage;

use App\Models\Employer;
use App\Models\favSeekerPost;
use App\Models\JobOfferPost;
use App\Models\recentSeekerPost;
use App\Models\User;
use Auth;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class ForyouOffers extends Component
{
    public $offers = [];
    public $employers = [];
    public $users = [];
    public $favPosts = [];
    public $authUser;
    public static $postId = 0;
    public static  $selectedPostId;
    public $idJob = 1;
    public $showingFilter = false;

    #[Renderless]
    public function showModal(){
        // dd($this->idJob);
        $this->dispatch("modal-show",  ['id' => $this->idJob]);
    }

    public function render()
    {
        return view('livewire.home-page.foryou-offers', [
            $this->offers = JobOfferPost::all()->reverse(),
            $this->employers = Employer::all()->reverse(),
            $this->users = User::all(),
            $this->authUser = Auth::user(),
            $this->favPosts = favSeekerPost::UserFav(),
        ]);
    }

    public function mount() {
        self::$selectedPostId = JobOfferPost::all()->keys()->last();
        $this->idJob += JobOfferPost::all()->keys()->last();
    }

    public function toggleFilter() {
        $this->mount();
        $this->showingFilter = !$this->showingFilter;
    }
    public function closeFilter() {
        $this->mount();
        $this->showingFilter = false;
    }

    public function init($lastSelectedPostId) {
        self::$selectedPostId = $lastSelectedPostId;
    }
    
    

    public function likedPost($postId): bool {
        $liked = false;
        foreach($this->favPosts as $favPost) {
            $favPost->post_id == $postId ? $liked = true : false;
        }
        return $liked;
    }

    public function addFav($postId) {
        // $this->js("alert('$postId')");
        if(!favSeekerPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->exists()) {
            favSeekerPost::create([
                'user_id' => $this->authUser->id,
                'post_id' => $postId,
            ]);
        } else {
            favSeekerPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->delete();
        }

        $this->init($postId-1);
    }

    public function showOfferDetails($postId) {

        self::$selectedPostId = $postId-1;
        $this->idJob = $postId;

        if(!recentSeekerPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->exists()) {
            recentSeekerPost::create([
                'user_id' => $this->authUser->id,
                'post_id' => $postId,
            ]);
        }else {
            recentSeekerPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->delete();
            recentSeekerPost::create([
                'user_id' => $this->authUser->id,
                'post_id' => $postId,
            ]);
        }
        
        // $this->js("console.log('$test')");
    }

}