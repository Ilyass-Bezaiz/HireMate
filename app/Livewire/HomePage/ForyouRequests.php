<?php

namespace App\Livewire\HomePage;

use App\Models\Candidate;
use App\Models\favOfferPost;
use App\Models\JobSeekerPost;
use App\Models\recentEmployerPost;
use App\Models\User;
use Auth;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\Attributes\On; 
use Session;

class ForyouRequests extends Component
{
    public $requests = [];
    public $seekers = [];
    public $users = [];
    public $favPosts = [];
    public $filtredOffers = [];
    public $filter;
    public $authUser;
    public static $postId = 0;
    public static  $selectedPostId;
    public $idJob = 1;
    public $showingFilter = false;
    public $windowWidth = 0;

    protected $listeners=[  
        'filter-requests'=>"applyFilters",
    ];

    #[Renderless]
    public function showModal(){
        // dd($this->idJob);
        $this->dispatch("modal-show",  ['id' => $this->idJob]);
    }

    public function render()
    {
        if($this->filter){
            $this->filtredOffers;
            $offerIds = [];
            
            foreach ($this->filtredOffers as $offer) {
                $offerIds[] = $offer['id'];
            }
            $this->offers = JobSeekerPost::whereIn('id',$offerIds)->get();
            // dd( $this->offers);
        }
        else{
            $this->offers = JobSeekerPost::all()->reverse();
            // dd($this->offers);
            // self::$selectedPostId = Session::get('request-selectedPostId');
        }
        return view('livewire.home-page.foryou-requests', [
            $this->requests = JobSeekerPost::all()->reverse(),
            $this->seekers = Candidate::all()->reverse(),
            $this->users = User::all(),
            $this->authUser = Auth::user(),
            $this->favPosts = favOfferPost::UserFav(),
            // self::$selectedPostId = Session::get('selectedOfferPostId', ''),
        ]);
    }

    public function applyFilters($params){
        $this->filter = true;
        $this->filtredOffers = $params['requests'];
        $this->showingFilter = false;
        // dd($params['offers']);
    }

    public function mount() {
        self::$selectedPostId = JobSeekerPost::all()->keys()->last();
        $this->idJob += JobSeekerPost::all()->keys()->last();
        // $this->js("$wire.$set('windowWidth', window.innerWidth)");
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
        if(!favOfferPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->exists()) {
            favOfferPost::create([
                'user_id' => $this->authUser->id,
                'post_id' => $postId,
            ]);
        } else {
            favOfferPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->delete();
        }

        $this->init($postId-1);
    }

    public function showOfferDetails($postId) {

        self::$selectedPostId = $postId-1;
        $this->idJob = $postId;

        Session::put('request-selectedPostId', self::$selectedPostId);
        // dd($this->windowWidth);

        if($this->windowWidth < 768) {
            $this->showPopUpDetails($postId);
        }

        if(!recentEmployerPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->exists()) {
            recentEmployerPost::create([
                'user_id' => $this->authUser->id,
                'post_id' => $postId,
            ]);
        }else {
            recentEmployerPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->delete();
            recentEmployerPost::create([
                'user_id' => $this->authUser->id,
                'post_id' => $postId,
            ]);
        }
    }

    #[Renderless]
    public function showPopUpDetails($postId) {
        $this->dispatch('popup-seeker-details', postId:$postId-1);
    }

    #[On('check-window')] 
    public function checkWindow() {
        dd('hello');
    }

}
