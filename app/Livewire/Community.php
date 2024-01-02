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
    public $categoryId = null;
    public $selectedDate = null;
    public $filtredPosts = [];

    public $comments = [];
    public $body;
    
    public function mount()
    {
        $this->categories = Category::all();
    }

    public function loadPosts()
    {
        $this->posts = Post::with('user')->orderBy('created_at', 'desc')->get();
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

        $this->loadPosts();
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

    public function applyFilters()
    {
        $this->render();
    
    }

    public function render()
    {

        $query = Post::query();

    if ($this->categoryId) {
        $query->where('category_id', $this->categoryId);
    }

    if ($this->selectedDate) {
        if ($this->selectedDate === '24h') {
            $query->whereBetween('created_at', [now()->subDay(), now()]);
        } elseif ($this->selectedDate === 'week') {
            $query->whereBetween('created_at', [now()->subWeek(), now()]);
        } elseif ($this->selectedDate === 'month') {
            $query->whereBetween('created_at', [now()->subMonth(), now()]);
        } elseif ($this->selectedDate === '3months') {
            $query->whereBetween('created_at', [now()->subMonths(3), now()]);
        }
    }

    $posts = $query->get();
        
        return view('livewire.community',[
            $this->posts = $posts,
        ]);
    }


}
