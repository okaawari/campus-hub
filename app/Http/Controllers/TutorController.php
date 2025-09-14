<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\TutorBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tutors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tutors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'hourly_rate' => 'required|numeric|min:0|max:1000',
            'location' => 'required|string|max:255',
            'qualifications' => 'nullable|string|max:1000',
            'offers_free_session' => 'boolean',
            'availability' => 'required|array',
            'availability.*' => 'required|string',
        ]);

        // Check if user already has a tutor profile
        if (Tutor::where('user_id', Auth::id())->exists()) {
            return back()->withErrors(['error' => 'You already have a tutor profile. You can only have one tutor profile per account.']);
        }

        Tutor::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'hourly_rate' => $request->hourly_rate,
            'location' => $request->location,
            'qualifications' => $request->qualifications,
            'offers_free_session' => $request->has('offers_free_session'),
            'availability' => $request->availability,
            'is_available' => true,
        ]);

        return redirect()->route('tutors.index')
            ->with('success', 'Your tutor profile has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tutor $tutor)
    {
        $tutor->load('user', 'bookings.student');
        return view('tutors.show', compact('tutor'));
    }

    /**
     * Show the booking form for a tutor.
     */
    public function book(Tutor $tutor)
    {
        $tutor->load('user');
        return view('tutors.book', compact('tutor'));
    }

    /**
     * Store a booking for a tutor.
     */
    public function storeBooking(Request $request, Tutor $tutor)
    {
        $request->validate([
            'scheduled_time' => 'required|date|after:now',
            'duration_minutes' => 'required|integer|min:30|max:240',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Check if user is trying to book themselves
        if ($tutor->user_id === Auth::id()) {
            return back()->withErrors(['error' => 'You cannot book a session with yourself.']);
        }

        // Check if tutor is available
        if (!$tutor->is_available) {
            return back()->withErrors(['error' => 'This tutor is currently not available for bookings.']);
        }

        $duration = $request->duration_minutes;
        $totalCost = ($tutor->hourly_rate / 60) * $duration;

        TutorBooking::create([
            'tutor_id' => $tutor->id,
            'student_id' => Auth::id(),
            'scheduled_time' => $request->scheduled_time,
            'duration_minutes' => $duration,
            'total_cost' => $totalCost,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('tutors.show', $tutor)
            ->with('success', 'Your booking request has been submitted! The tutor will review and confirm your session.');
    }
}
