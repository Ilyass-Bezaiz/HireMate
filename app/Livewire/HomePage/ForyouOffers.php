<?php

namespace App\Livewire\HomePage;

use App\Models\Employer;
use App\Models\favSeekerPost;
use App\Models\JobOfferPost;
use App\Models\recentSeekerPost;
use App\Models\User;
use App\Models\JobApplication;
use Auth;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\Attributes\On; 

class ForyouOffers extends Component
{
    public $offers = [];
    public $employers = [];
    public $users = [];
    public $favPosts = [];
    public $filtredOffers=[];
    public $authUser;
    public static $postId = 0;
    public static  $selectedPostId;
    public $idJob = 1;
    public $showingFilter = false;
    public $filter;

    public $windowWidth = 0;

    
    protected $listeners=[  
        'filter'=>"applyFilters",
    ];
    
    public function render()
    {
        if($this->filter){
            $this->filtredOffers;
            $offerIds = [];
            
            foreach ($this->filtredOffers as $offer) {
                $offerIds[] = $offer['id'];
            }
            $this->offers = JobOfferPost::whereIn('id',$offerIds)->get();
            // dd( $this->offers);
        }
        else{
            $this->offers = JobOfferPost::all()->reverse();
            // dd($this->offers);
        }
        return view('livewire.home-page.foryou-offers', [
            $this->offers,
            $this->employers = Employer::all()->reverse(),
            $this->users = User::all(),
            $this->authUser = Auth::user(),
            $this->favPosts = favSeekerPost::UserFav(),
        ]);
    }

    #[Renderless]
    public function showModal(){
        // dd($this->idJob);
        $this->filter = false;
        $this->dispatch("modal-show",  ['id' => $this->idJob]);
    }

    public function applyFilters($params){
        $this->filter = true;
        $this->filtredOffers = $params['offers'];
        // dd($params['offers']);
    }

    public function mount() {
        self::$selectedPostId = JobOfferPost::all()->keys()->last();
        $this->idJob += JobOfferPost::all()->keys()->last();
        // $this->js("$wire.$set('windowWidth', window.innerWidth)");
    }

    public function toggleFilter() {
        $this->mount(self::$selectedPostId);
        $this->showingFilter = !$this->showingFilter;
    }
    public function closeFilter() {
        $this->showingFilter = false;
        $this->mount();
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

        // dd($this->windowWidth);

        if($this->windowWidth < 768) {
            $this->dispatch('popup-joboffer-details', postId:$postId-1);
        }

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
    }

    public function alreadyApplied($postId){
        return JobApplication::where('user_id', auth()->user()->id)->where('post_id', $postId+1)->exists();
    }

}