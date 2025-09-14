<?php

namespace App\Livewire;

use App\Models\Tutor;
use Livewire\Component;
use Livewire\WithPagination;

class TutorsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $subject = '';
    public $location = '';
    public $maxRate = '';
    public $sortBy = 'rating';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'subject' => ['except' => ''],
        'location' => ['except' => ''],
        'maxRate' => ['except' => ''],
        'sortBy' => ['except' => 'rating'],
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

    public function updatingLocation()
    {
        $this->resetPage();
    }

    public function updatingMaxRate()
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
        $this->location = '';
        $this->maxRate = '';
        $this->sortBy = 'rating';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    public function render()
    {
        $query = Tutor::with('user')
            ->where('is_available', true);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('subject', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function ($userQuery) {
                      $userQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Apply subject filter
        if ($this->subject) {
            $query->where('subject', $this->subject);
        }

        // Apply location filter
        if ($this->location) {
            $query->where('location', 'like', '%' . $this->location . '%');
        }

        // Apply max rate filter
        if ($this->maxRate) {
            $query->where('hourly_rate', '<=', $this->maxRate);
        }

        // Apply sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        $tutors = $query->paginate(12);

        // Get unique subjects and locations for filters
        $subjects = Tutor::where('is_available', true)
            ->distinct()
            ->pluck('subject')
            ->sort()
            ->values();

        $locations = Tutor::where('is_available', true)
            ->distinct()
            ->pluck('location')
            ->sort()
            ->values();

        return view('livewire.tutors-index', [
            'tutors' => $tutors,
            'subjects' => $subjects,
            'locations' => $locations,
        ]);
    }
}
