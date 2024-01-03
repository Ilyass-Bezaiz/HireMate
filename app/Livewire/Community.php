<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Candidate;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Livewire\WithPagination;

class Community extends Component
{    
    
    public $categories = [];
    public $posts = [];
    
    public $title;
    public $selectedCategory;
    public $description;

    public $showModal = false;
    public $selectedPost;

    public $categoryId = null;
    public $selectedDate = null;
    public $filtredPosts = [];
    public $post;

    public $comments = [];
    public $body;

    public $showEditModal = false;
    public $editTitle, $editCategory, $editDescription;
    public $selectedComment;
    public $editComment = false;
    public $commentId;

    
    public function mount()
    {
        $this->categories = Category::all();
    }

    public function loadPosts()
    {
        $this->posts = Post::with('user')->get()->reverse();
    }

    public function getHeadline($userId){
        $candidate = Candidate::where('user_id',$userId)->first();
        if($candidate->headline){
            return $candidate->headline;
        }
        return "Not explicitly specified";
    }

    public function toggleLikePost($postId)
    {
        $user = auth()->user();
        $this->post = Post::find($postId);

        if($user->hasLiked($this->post))
        {
            $user->likes()->detach($this->post);
            return;
        }
        $user->likes()->attach($this->post);
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

    public function updatePost()
    {
        $this->validate([
            'editTitle' => 'required|min:3',
            'editCategory' => 'required',
            'editDescription' => 'required|min:10',
        ]);

        $this->selectedPost->update([
            'title' => $this->editTitle,
            'category_id' => $this->editCategory,
            'description' => $this->editDescription
        ]);
        $this->showEditModal = false;
    }

    public function showUpdateModal($postId)
    {
        $this->showEditModal = true;

        $post = Post::find($postId);
        $this->selectedPost = $post;

        $this->editTitle = $post->title;
        $this->editCategory = $post->category_id;
        $this->editDescription = $post->description;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
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

    public function editCommentFunction($commentId)
    {
        $this->editComment = true;
        $this->commentId = $commentId;
        $this->comment = Comment::find($commentId);
        $this->body = $this->comment->body;
    }

    public function updateComment()
    {
        $comment = Comment::find($this->commentId);
        $this->validate([
            'body' => 'required|min:5',
        ]);
        $comment->update([
            'body' => $this->body,
        ]);

        $this->reset(['body']);
        $this->comments = Comment::where('post_id', $this->selectedPost->id)->get()->reverse();
        $this->editComment = false;
    }

    public function showCommentModal($postId)
    {
        $this->selectedPost = Post::find($postId);
        $this->comments = Comment::where('post_id', $postId)->orderBy('created_at', 'desc')->get();
        $this->showModal = true;
    }

    public function closeModal()
    {
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

    $posts = $query->get()->reverse();
        
        return view('livewire.community',[
            $this->posts = $posts,
        ]);
    }
}