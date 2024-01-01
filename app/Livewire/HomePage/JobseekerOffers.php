<?php

namespace App\Livewire\HomePage;

use Livewire\Attributes\On;
use Livewire\Component;

class JobseekerOffers extends Component
{
    public $selectedNavSection = 1;

    public function render()
    {
        return view('livewire.home-page.jobseeker-offers');
    }

    #[On('change-main-nav')]
    public function selectNav($section) {
        $this->selectedNavSection = $section;
        // $this->js("location.reload()");
        // $this->dipsatch('refreshComponent');
        return $this->selectedNavSection;
    }

    public static function getPostPublishDay($post) {
        if (($post->updated_at)->diff(date('Y-m-d H:i:s'))->d > 10) {
            return $post->updated_at->format('Y-m-d');
        }elseif (($post->updated_at)->diff(date('Y-m-d H:i:s'))->d >= 1) {
            return ($post->updated_at)->diff(date('Y-m-d H:i:s'))->d." days ago";
        }elseif (($post->updated_at)->diff(date('Y-m-d H:i:s'))->h <= 24 && ($post->updated_at)->diff(date('Y-m-d H:i:s'))->h >= 1) {
            return ($post->updated_at)->diff(date('Y-m-d H:i:s'))->h." hours ago";
        }elseif (($post->updated_at)->diff(date('Y-m-d H:i:s'))->m <= 60 && ($post->updated_at)->diff(date('Y-m-d H:i:s'))->m >= 1) {
            return ($post->updated_at)->diff(date('Y-m-d H:i:s'))->m." minutes ago";
        }elseif (($post->updated_at)->diff(date('Y-m-d H:i:s'))->s <= 60) {
            return ($post->updated_at)->diff(date('Y-m-d H:i:s'))->m." seconds ago";
        }    
    }

}
