<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Livewire\WithPagination;

class Community extends Component
{
    public $categories = [];
    public $posts = array();
    public $postOwner = [];
    
    public $selectedCategory;
    public $title;
    public $description;

    
    public function mount(){
        $this->categories = Category::all();
        // $this->posts = Post::all();
    }
    
    public function createPost()
    {
        $this->validate([
            'title' => 'required|min:3',
            'selectedCategory' => 'required',
            'description' => 'required|min:10',
        ]);

        Post::create([
            'title' => $this->title,
            'category_id' => $this->selectedCategory,
            'user_id' => auth()->user()->id,
            'description' => $this->description
        ]);

        // Reset the input fields
        $this->reset(['title', 'selectedCategory', 'description']);
    }   

    public function render()
    {
        // Ensure $this->posts is a collection
        $postsCollection = collect($this->posts);

        // Fetch the user information for each post
        $postsCollection->each(function ($post) {
            $post->user = User::find($post->user_id);
        });
        return view('livewire.community', [
            $this->posts = Post::orderBy('created_at', 'desc')->get(),
        ]);
    }
     
}
