<?php

namespace App\Livewire;

use App\Models\StudyMaterial;
use Livewire\Component;
use Livewire\WithPagination;

class StudyMaterialsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $subjectFilter = '';
    public $typeFilter = '';
    public $sortBy = 'latest'; // latest, rating, downloads, title

    protected $queryString = [
        'search' => ['except' => ''],
        'subjectFilter' => ['except' => ''],
        'typeFilter' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSubjectFilter()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
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
        $this->subjectFilter = '';
        $this->typeFilter = '';
        $this->sortBy = 'latest';
        $this->resetPage();
    }

    public function render()
    {
        $query = StudyMaterial::with('user')
            ->where('is_approved', true);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('subject', 'like', '%' . $this->search . '%')
                  ->orWhere('professor', 'like', '%' . $this->search . '%')
                  ->orWhere('course_code', 'like', '%' . $this->search . '%');
            });
        }

        // Apply subject filter
        if ($this->subjectFilter) {
            $query->where('subject', $this->subjectFilter);
        }

        // Apply type filter
        if ($this->typeFilter) {
            $query->where('type', $this->typeFilter);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'downloads':
                $query->orderBy('downloads', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $materials = $query->paginate(12);

        // Get featured materials (high-rated and popular)
        $featuredMaterials = StudyMaterial::where('rating', '>=', 4.7)
            ->orderBy('downloads', 'desc')
            ->limit(3)
            ->get();

        // Get statistics
        $stats = [
            'total' => StudyMaterial::where('is_approved', true)->count(),
            'notes' => StudyMaterial::where('is_approved', true)->where('type', 'notes')->count(),
            'exams' => StudyMaterial::where('is_approved', true)->where('type', 'exam')->count(),
            'downloads' => StudyMaterial::where('is_approved', true)->sum('downloads'),
        ];

        // Get unique subjects for filter
        $subjects = StudyMaterial::where('is_approved', true)
            ->distinct()
            ->pluck('subject')
            ->sort()
            ->values();

        return view('livewire.study-materials-index', [
            'materials' => $materials,
            'featuredMaterials' => $featuredMaterials,
            'stats' => $stats,
            'subjects' => $subjects,
        ]);
    }
}