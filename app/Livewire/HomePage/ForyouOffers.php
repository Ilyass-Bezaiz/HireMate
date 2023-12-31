<?php

namespace App\Livewire\HomePage;

use App\Models\Employer;
use App\Models\favSeekerPost;
use App\Models\JobOfferPost;
use App\Models\recentSeekerPost;
use App\Models\User;
use Auth;
use Livewire\Component;

class ForyouOffers extends Component
{
    public $offers = [];
    public $employers = [];
    public $users = [];
    public $favPosts = [];
    public $authUser;
    public static $postId = 0;
    public static  $selectedPostId = 0;
    public $showingFilter = false;

    public function render()
    {
        return view('livewire.home-page.foryou-offers', [
            $this->offers = JobOfferPost::all(),
            $this->employers = Employer::all(),
            $this->users = User::all(),
            $this->authUser = Auth::user(),
            $this->favPosts = favSeekerPost::UserFav(),
            
        ]);
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

    public function init($lastSelectedPostId) {
        self::$selectedPostId = $lastSelectedPostId;
        
    }

    public function showOfferDetails($postId) {

        self::$selectedPostId = $postId-1;

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
