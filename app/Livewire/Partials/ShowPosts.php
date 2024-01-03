<?php

namespace App\Livewire\Partials;

use App\Models\User;
use Livewire\Component;
use App\Models\JobOfferPost;
use Livewire\WithPagination;
use App\Models\JobApplication;


class ShowPosts extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $showApplicants = false;
    public $UserApplicants = [];
    public $selectedPostId;
    public $status;

    public function render()
    {
        return view('livewire.partials.show-posts',[
            'posts' => JobOfferPost::where('user_id',auth()->user()->id)->get(),
            $this->UserApplicants,
            $this->status
        ]);
    }

    public function mount(){
        
    }
    
    public function showApplicant($postId){
        $usersInfo=[];
        $userIds=[];
        $applications = JobApplication::where('post_id',$postId)->get();
        // dd($applications);
        //get user info
        foreach ($applications as $application) {
            // Get the user_id from the application
            $userId = $application->user_id;
            
            // Use the user_id to get user information
            $user = User::find($userId);
            
            // Check if the user exists
            if ($user) {
                // Add user information to the $usersInfo array
                $usersInfo[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'path' => $user->profile_photo_path,
                    // Add other user information as needed
                ];
            }
        }
        // add statuss
        $i=0;
        foreach ($applications as $application) {
            $usersInfo[$i]['status'] = $application->status;
            $i++;
        }
        // dd($usersInfo);
        $this->UserApplicants = $usersInfo;
        $this->showApplicants = true;
        $this->selectedPostId = $postId;
        // dd($postId);
    }

    public function AcceptUser($userId){
        $application = JobApplication::where('post_id', $this->selectedPostId)->where('user_id', $userId);
        $appId = $application->get()->value('id');
        // dd($appId);
        $application = JobApplication::find($appId);
        $application->update([
            'status'=>"Accepted",
        ]);
    }

    public function RejectUser($userId){
        $application = JobApplication::where('post_id', $this->selectedPostId)->where('user_id', $userId);
        $appId = $application->get()->value('id');
        // dd($appId);
        $application = JobApplication::find($appId);
        $application->update([
            'status'=>"Rejected",
        ]);
    }
}