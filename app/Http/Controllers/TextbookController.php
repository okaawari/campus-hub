<?php

namespace App\Http\Controllers;

use App\Models\Textbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TextbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('textbooks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('textbooks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'edition' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'condition' => ['required', Rule::in(['new', 'like_new', 'good', 'fair', 'poor'])],
            'listing_type' => ['required', Rule::in(['sale', 'exchange', 'rent'])],
            'price' => 'nullable|numeric|min:0|max:999.99',
            'course_code' => 'nullable|string|max:20',
            'subject' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle price validation based on listing type
        if (in_array($validated['listing_type'], ['sale', 'rent']) && !$validated['price']) {
            return back()->withErrors(['price' => 'Price is required for sale and rent listings.'])->withInput();
        }

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('textbooks', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create textbook
        $textbook = Textbook::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'author' => $validated['author'],
            'isbn' => $validated['isbn'],
            'edition' => $validated['edition'],
            'description' => $validated['description'],
            'condition' => $validated['condition'],
            'listing_type' => $validated['listing_type'],
            'price' => $validated['price'] ?? 0,
            'course_code' => $validated['course_code'],
            'subject' => $validated['subject'],
            'location' => $validated['location'],
            'images' => $imagePaths,
            'is_available' => true,
        ]);

        return redirect()->route('textbooks.show', $textbook)
            ->with('success', 'Textbook listed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Textbook $textbook)
    {
        $textbook->load('user');
        return view('textbooks.show', compact('textbook'));
    }

    /**
     * Show the contact form for the textbook.
     */
    public function contact(Textbook $textbook)
    {
        $textbook->load('user');
        return view('textbooks.contact', compact('textbook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Textbook $textbook)
    {
        $this->authorize('update', $textbook);
        return view('textbooks.edit', compact('textbook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Textbook $textbook)
    {
        $this->authorize('update', $textbook);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'edition' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'condition' => ['required', Rule::in(['new', 'like_new', 'good', 'fair', 'poor'])],
            'listing_type' => ['required', Rule::in(['sale', 'exchange', 'rent'])],
            'price' => 'nullable|numeric|min:0|max:999.99',
            'course_code' => 'nullable|string|max:20',
            'subject' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle price validation based on listing type
        if (in_array($validated['listing_type'], ['sale', 'rent']) && !$validated['price']) {
            return back()->withErrors(['price' => 'Price is required for sale and rent listings.'])->withInput();
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('textbooks', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
        }

        $textbook->update($validated);

        return redirect()->route('textbooks.show', $textbook)
            ->with('success', 'Textbook updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Textbook $textbook)
    {
        $this->authorize('delete', $textbook);

        // Delete associated images
        if ($textbook->images) {
            foreach ($textbook->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $textbook->delete();

        return redirect()->route('textbooks.index')
            ->with('success', 'Textbook removed successfully!');
    }
}
