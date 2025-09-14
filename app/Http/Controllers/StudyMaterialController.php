<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // The index view now uses Livewire component
        return view('study-materials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('study-materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'course_code' => 'nullable|string|max:20',
            'professor' => 'nullable|string|max:255',
            'type' => 'required|in:notes,exam,flashcards,cheat_sheet,other',
            'file' => 'required|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('study-materials', $fileName, 'public');

        StudyMaterial::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'subject' => $request->subject,
            'course_code' => $request->course_code,
            'professor' => $request->professor,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'type' => $request->type,
        ]);

        return redirect()->route('study-materials.index')
            ->with('success', 'Study material uploaded successfully! It will be reviewed before being made public.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyMaterial $studyMaterial)
    {
        $studyMaterial->load('user', 'ratings.user');
        return view('study-materials.show', compact('studyMaterial'));
    }

    /**
     * Download the study material file.
     */
    public function download(StudyMaterial $studyMaterial)
    {
        $studyMaterial->increment('downloads');
        
        return Storage::disk('public')->download($studyMaterial->file_path, $studyMaterial->file_name);
    }

    /**
     * Rate a study material.
     */
    public function rate(Request $request, StudyMaterial $studyMaterial)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $studyMaterial->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        // Update average rating
        $averageRating = $studyMaterial->ratings()->avg('rating');
        $studyMaterial->update(['rating' => round($averageRating, 2)]);

        return back()->with('success', 'Thank you for your rating!');
    }
}
