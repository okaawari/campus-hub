<?php

namespace App\Livewire;

use App\Models\CampusEvent;
use Livewire\Component;
use Livewire\WithPagination;

class EventsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $status = 'upcoming';
    public $sortBy = 'start_time';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'status' => ['except' => 'upcoming'],
        'sortBy' => ['except' => 'start_time'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedStatus()
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
        $this->category = '';
        $this->status = 'upcoming';
        $this->sortBy = 'start_time';
        $this->sortDirection = 'asc';
        $this->resetPage();
    }

    public function render()
    {
        $query = CampusEvent::with(['user', 'rsvps'])
            ->orderBy($this->sortBy, $this->sortDirection);

        // Apply filters
        if ($this->category) {
            $query->byCategory($this->category);
        }

        if ($this->search) {
            $query->search($this->search);
        }

        switch ($this->status) {
            case 'upcoming':
                $query->upcoming();
                break;
            case 'past':
                $query->past();
                break;
            case 'featured':
                $query->featured();
                break;
            case 'all':
                // No additional filter
                break;
        }

        $events = $query->paginate(12);

        $categories = [
            'academic' => 'Academic',
            'club' => 'Club',
            'sports' => 'Sports',
            'job_fair' => 'Job Fair',
            'seminar' => 'Seminar',
            'social' => 'Social',
            'other' => 'Other'
        ];

        $statusOptions = [
            'upcoming' => 'Upcoming',
            'past' => 'Past',
            'featured' => 'Featured',
            'all' => 'All Events'
        ];

        return view('livewire.events-index', [
            'events' => $events,
            'categories' => $categories,
            'statusOptions' => $statusOptions,
        ]);
    }
}
