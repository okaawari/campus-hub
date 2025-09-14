<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use App\Models\Textbook;
use App\Models\CampusEvent;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    /**
     * Show user's documents - their uploaded study materials
     */
    public function myDocuments()
    {
        $studyMaterials = StudyMaterial::where('user_id', Auth::id())
            ->with('user')
            ->latest()
            ->paginate(12);

        return view('library.my-documents', compact('studyMaterials'));
    }

    /**
     * Show saved/bookmarked materials
     */
    public function savedMaterials()
    {
        // For now, we'll show highly rated materials the user might be interested in
        // In a real app, we'd have a bookmarks/saved items table
        $savedMaterials = StudyMaterial::where('rating', '>=', 4.0)
            ->with('user')
            ->latest()
            ->paginate(12);

        return view('library.saved-materials', compact('savedMaterials'));
    }

    /**
     * Show user's bookmarks (events, forum posts, etc.)
     */
    public function bookmarks()
    {
        // For now, show popular content the user might want to bookmark
        $popularEvents = CampusEvent::where('start_time', '>', now())
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $popularPosts = ForumPost::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('library.bookmarks', compact('popularEvents', 'popularPosts'));
    }

    /**
     * Show user's recent activity
     */
    public function recentActivity()
    {
        $recentMaterials = StudyMaterial::where('user_id', Auth::id())
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentTextbooks = Textbook::where('user_id', Auth::id())
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentEvents = CampusEvent::where('user_id', Auth::id())
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentPosts = ForumPost::where('user_id', Auth::id())
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('library.recent-activity', compact(
            'recentMaterials',
            'recentTextbooks', 
            'recentEvents',
            'recentPosts'
        ));
    }
}