<?php

namespace App\Http\Controllers;

use App\Models\CampusEvent;
use App\Models\EventRsvp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CampusEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // The index view now uses Livewire component
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = [
            'academic' => 'Academic',
            'club' => 'Club',
            'sports' => 'Sports',
            'job_fair' => 'Job Fair',
            'seminar' => 'Seminar',
            'social' => 'Social',
            'other' => 'Other'
        ];

        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
            'category' => ['required', Rule::in(['academic', 'club', 'sports', 'job_fair', 'seminar', 'social', 'other'])],
            'organizer' => 'required|string|max:255',
            'max_attendees' => 'nullable|integer|min:1',
            'requires_rsvp' => 'boolean',
            'contact_email' => 'nullable|email',
            'image_url' => 'nullable|url',
            'is_featured' => 'boolean',
        ]);

        $event = CampusEvent::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'category' => $request->category,
            'organizer' => $request->organizer,
            'max_attendees' => $request->max_attendees,
            'requires_rsvp' => $request->boolean('requires_rsvp'),
            'contact_email' => $request->contact_email,
            'image_url' => $request->image_url,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CampusEvent $event)
    {
        $event->load(['user', 'rsvps.user']);
        
        $userRsvp = null;
        if (Auth::check()) {
            $userRsvp = $event->rsvps()->where('user_id', Auth::id())->first();
        }

        $attendingCount = $event->attendingRsvps()->count();
        $maybeCount = $event->maybeRsvps()->count();

        return view('events.show', compact('event', 'userRsvp', 'attendingCount', 'maybeCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampusEvent $event)
    {
        $this->authorize('update', $event);

        $categories = [
            'academic' => 'Academic',
            'club' => 'Club',
            'sports' => 'Sports',
            'job_fair' => 'Job Fair',
            'seminar' => 'Seminar',
            'social' => 'Social',
            'other' => 'Other'
        ];

        return view('events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampusEvent $event)
    {
        $this->authorize('update', $event);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
            'category' => ['required', Rule::in(['academic', 'club', 'sports', 'job_fair', 'seminar', 'social', 'other'])],
            'organizer' => 'required|string|max:255',
            'max_attendees' => 'nullable|integer|min:1',
            'requires_rsvp' => 'boolean',
            'contact_email' => 'nullable|email',
            'image_url' => 'nullable|url',
            'is_featured' => 'boolean',
        ]);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'category' => $request->category,
            'organizer' => $request->organizer,
            'max_attendees' => $request->max_attendees,
            'requires_rsvp' => $request->boolean('requires_rsvp'),
            'contact_email' => $request->contact_email,
            'image_url' => $request->image_url,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampusEvent $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }

    /**
     * Handle RSVP for an event
     */
    public function rsvp(Request $request, CampusEvent $event)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'status' => ['required', Rule::in(['attending', 'maybe', 'not_attending'])],
            'notes' => 'nullable|string|max:500',
        ]);

        // Check if event is at capacity
        if ($request->status === 'attending' && $event->isAtCapacity()) {
            return back()->with('error', 'Sorry, this event is at capacity.');
        }

        $rsvp = EventRsvp::updateOrCreate(
            [
                'campus_event_id' => $event->id,
                'user_id' => Auth::id(),
            ],
            [
                'status' => $request->status,
                'notes' => $request->notes,
            ]
        );

        $statusMessage = match($request->status) {
            'attending' => 'You are now attending this event!',
            'maybe' => 'You marked yourself as maybe attending.',
            'not_attending' => 'You marked yourself as not attending.',
        };

        return back()->with('success', $statusMessage);
    }

    /**
     * Cancel RSVP for an event
     */
    public function cancelRsvp(CampusEvent $event)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $event->rsvps()->where('user_id', Auth::id())->delete();

        return back()->with('success', 'Your RSVP has been cancelled.');
    }
}
