<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Livewire\WithPagination;

class Community extends Component
{    
    
    public $categories = [];
    public $posts = [];
    
    public $selectedCategory;
    public $title;
    public $description;

    public $showModal = false;
    public $selectedPost;

    //filters
    public $categoryFilter;
    public $selectedDate;
    public $filtering = false;
    public $filtredPosts = [];

    public $comments = [];
    public $body;
    
    public function mount(){
        $this->categories = Category::all();
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
    
    public function createComment()
    {
        $this->validate([
            'body' => 'required|min:5',
        ]);
        
        if ($this->selectedPost) {
            Comment::create([
                'body' => $this->body,
                'user_id' => auth()->user()->id,
                'post_id' => $this->selectedPost->id,
            ]);
            
            $this->comments = Comment::where('post_id', $this->selectedPost->id)->orderBy('created_at', 'desc')->get();
        }

        // Reset the input fields
        $this->reset(['body']);
    }

    public function showCommentModal($postId)
    {
        $this->selectedPost = Post::find($postId);
        $this->comments = Comment::where('post_id', $postId)->orderBy('created_at', 'desc')->get();
        $this->showModal = true;
    }

    public function closeModal(){
        $this->reset(['body']);
        $this->showModal = false;
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
