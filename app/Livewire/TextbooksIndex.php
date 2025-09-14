<?php

namespace App\Livewire;

use App\Models\Textbook;
use Livewire\Component;
use Livewire\WithPagination;

class TextbooksIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $subject = '';
    public $courseCode = '';
    public $listingType = '';
    public $maxPrice = '';
    public $condition = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'subject' => ['except' => ''],
        'courseCode' => ['except' => ''],
        'listingType' => ['except' => ''],
        'maxPrice' => ['except' => ''],
        'condition' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSubject()
    {
        $this->resetPage();
    }

    public function updatingCourseCode()
    {
        $this->resetPage();
    }

    public function updatingListingType()
    {
        $this->resetPage();
    }

    public function updatingMaxPrice()
    {
        $this->resetPage();
    }

    public function updatingCondition()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->subject = '';
        $this->courseCode = '';
        $this->listingType = '';
        $this->maxPrice = '';
        $this->condition = '';
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    public function render()
    {
        $query = Textbook::with('user')
            ->where('is_available', true);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('author', 'like', '%' . $this->search . '%')
                  ->orWhere('isbn', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('course_code', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function ($userQuery) {
                      $userQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Apply subject filter
        if ($this->subject) {
            $query->where('subject', $this->subject);
        }

        // Apply course code filter
        if ($this->courseCode) {
            $query->where('course_code', 'like', '%' . $this->courseCode . '%');
        }

        // Apply listing type filter
        if ($this->listingType) {
            $query->where('listing_type', $this->listingType);
        }

        // Apply max price filter
        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }

        // Apply condition filter
        if ($this->condition) {
            $query->where('condition', $this->condition);
        }

        // Apply sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        $textbooks = $query->paginate(12);

        // Get unique values for filters
        $subjects = Textbook::where('is_available', true)
            ->distinct()
            ->pluck('subject')
            ->filter()
            ->sort()
            ->values();

        $courseCodes = Textbook::where('is_available', true)
            ->distinct()
            ->pluck('course_code')
            ->filter()
            ->sort()
            ->values();

        $listingTypes = Textbook::where('is_available', true)
            ->distinct()
            ->pluck('listing_type')
            ->filter()
            ->sort()
            ->values();

        $conditions = Textbook::where('is_available', true)
            ->distinct()
            ->pluck('condition')
            ->filter()
            ->sort()
            ->values();

        return view('livewire.textbooks-index', [
            'textbooks' => $textbooks,
            'subjects' => $subjects,
            'courseCodes' => $courseCodes,
            'listingTypes' => $listingTypes,
            'conditions' => $conditions,
        ]);
    }
}
