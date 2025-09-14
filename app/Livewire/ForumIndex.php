<?php

namespace App\Livewire;

use App\Models\ForumPost;
use Livewire\Component;
use Livewire\WithPagination;

class ForumIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $subject = '';
    public $sortBy = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'subject' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingSubject()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->subject = '';
        $this->sortBy = 'latest';
        $this->resetPage();
    }

    public function render()
    {
        $query = ForumPost::with(['user', 'replies'])
            ->whereNull('parent_id');

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if ($this->category) {
            $query->where('category', $this->category);
        }

        // Apply subject filter
        if ($this->subject) {
            $query->where('subject', $this->subject);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'popular':
                $query->orderBy('upvotes', 'desc');
                break;
            case 'most_viewed':
                $query->orderBy('views', 'desc');
                break;
            case 'most_replies':
                $query->withCount('replies')->orderBy('replies_count', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'latest':
            default:
                $query->orderBy('is_pinned', 'desc')
                      ->orderBy('created_at', 'desc');
                break;
        }

        $posts = $query->paginate(15);

        // Get filter options
        $categories = ForumPost::whereNull('parent_id')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->mapWithKeys(function ($category) {
                return [$category => ucfirst($category)];
            });

        $subjects = ForumPost::whereNull('parent_id')
            ->whereNotNull('subject')
            ->distinct()
            ->pluck('subject')
            ->filter()
            ->sort();

        $sortOptions = [
            'latest' => 'Latest Posts',
            'popular' => 'Most Popular',
            'most_viewed' => 'Most Viewed',
            'most_replies' => 'Most Replies',
            'oldest' => 'Oldest Posts',
        ];

        return view('livewire.forum-index', [
            'posts' => $posts,
            'categories' => $categories,
            'subjects' => $subjects,
            'sortOptions' => $sortOptions,
        ]);
    }
}
