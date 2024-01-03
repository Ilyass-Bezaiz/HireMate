<?php

namespace App\Livewire\HomePage;

use App\Models\City;
use App\Models\Country;
use App\Models\Candidate;
use App\Models\favOfferPost;
use App\Models\JobSeekerPost;
use App\Models\recentOfferPost;
use App\Models\User;
use Auth;
use Illuminate\Support\Collection;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\Attributes\On;
use Session; 

class SearchedRequests extends Component
{
    public $requests = [];
    public $seekers = [];
    public $users = [];
    public $favPosts = [];
    public $authUser;
    public static $postId = 0;
    public static  $selectedPostId = 0;
    public $showingFilter = false;
    public $searchedTitle;
    public $searchedLocation;
    public $idJob = 1;

    #[Renderless]
    public function showModal(){
        // dd($key);
        $this->dispatch("modal-show",  ['id' => $this->idJob]);
    }

    public function render()
    {
        return view('livewire.home-page.searched-requests', [
            $this->seekers = Candidate::all(),
            $this->users = User::all(),
            $this->authUser = Auth::user(),
            $this->favPosts = favOfferPost::UserFav(),
        ]);
    }

    public function mount() {
        $this->searchedTitle = Session::get('last_search_title', '');
        $this->searchedLocation = Session::get('last_search_location', '');
        $this->requests = $this->searching([$this->searchedTitle, $this->searchedLocation]);
    }

    #[On('searching-for-seeker')]
    public function searching($data) {
        $this->searchedTitle = $data[0];
        $this->searchedLocation = $data[1];
        if ($this->searchedTitle != "" || $this->searchedLocation != "") {
            if($this->searchedTitle != "" && $this->searchedLocation != "") {
                $jobTitle = JobSeekerPost::where("title", "like", "%".$this->searchedTitle."%")->get();
                $countryIds = Country::getCountryId($this->searchedLocation);
                $cityIds = City::getCityId($this->searchedLocation);
                $country = JobSeekerPost::where("country_id", "like", "")->get();
                foreach($countryIds as $countryId){
                    JobSeekerPost::where("country_id", "like", $countryId->id)->exists() ? $country = JobSeekerPost::where("country_id", "like", $countryId->id)->get() : null;
                }
                $city = JobSeekerPost::where("city_id", "like", "")->get();
                foreach($cityIds as $cityId){
                    JobSeekerPost::where("city_id", "like", $cityId->id)->exists() ? $city = JobSeekerPost::where("city_id", "like", $cityId->id)->get() : null;
                }
                $this->requests = $jobTitle->intersect($country->merge($city));
            }elseif($this->searchedTitle != "") {
                $jobTitle = JobSeekerPost::where("title", "like", "%".$this->searchedTitle."%")->get();
                $this->requests = $jobTitle;
            }elseif($this->searchedLocation != "") {
                $countryIds = Country::getCountryId($this->searchedLocation);
                $cityIds = City::getCityId($this->searchedLocation);
                $country = JobSeekerPost::where("country_id", "like", "")->get();
                foreach($countryIds as $countryId){
                    JobSeekerPost::where("country_id", "like", $countryId->id)->exists() ? $country = JobSeekerPost::where("country_id", "like", $countryId->id)->get() : null;
                }
                $city = JobSeekerPost::where("city_id", "like", "")->get();
                foreach($cityIds as $cityId){
                    JobSeekerPost::where("city_id", "like", $cityId->id)->exists() ? $city = JobSeekerPost::where("city_id", "like", $cityId->id)->get() : null;
                }
                // dd($city);
                $this->requests = $country->merge($city);
            }
            // JobseekerOffers::selectNavSection(2);
            return $this->requests;
        } else {
            return null;
        }
    }

    public function likedPost($postId): bool {
        $liked = false;
        foreach($this->favPosts as $favPost) {
            $favPost->post_id == ($postId+1) ? $liked = true : null;
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

        // $this->init($postId-1);
    }

    public function init($lastSelectedPostId) {
        self::$selectedPostId = $lastSelectedPostId;
    }

    public function showOfferDetails($postId, $id) {
        // dd($postId ,$id);
        self::$selectedPostId = $postId-1;
        $this->idJob = $id;
        
        if(!recentOfferPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->exists()) {
            recentOfferPost::create([
                'user_id' => $this->authUser->id,
                'post_id' => $postId,
            ]);
        }else {
            recentOfferPost::where('user_id','=',$this->authUser->id)->where('post_id','=', $postId)->delete();
            recentOfferPost::create([
                'user_id' => $this->authUser->id,
                'post_id' => $postId,
            ]);
        }
    }

}
