<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use App\Models\Textbook;
use App\Models\CampusEvent;
use App\Models\ForumPost;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    /**
     * Show top uploads - most downloaded study materials
     */
    public function topUploads()
    {
        $topMaterials = StudyMaterial::with('user')
            ->orderBy('downloads', 'desc')
            ->paginate(15);

        return view('community.top-uploads', compact('topMaterials'));
    }

    /**
     * Show most liked content - highest rated materials and tutors
     */
    public function mostLiked()
    {
        $topMaterials = StudyMaterial::with('user')
            ->where('rating', '>=', 4.0)
            ->orderBy('rating', 'desc')
            ->orderBy('downloads', 'desc')
            ->limit(10)
            ->get();

        $topTutors = Tutor::with('user')
            ->where('rating', '>=', 4.0)
            ->orderBy('rating', 'desc')
            ->orderBy('total_sessions', 'desc')
            ->limit(10)
            ->get();

        return view('community.most-liked', compact('topMaterials', 'topTutors'));
    }

    /**
     * Show top rated content across all categories
     */
    public function topRated()
    {
        $topMaterials = StudyMaterial::with('user')
            ->orderBy('rating', 'desc')
            ->limit(8)
            ->get();

        $topTutors = Tutor::with('user')
            ->orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        // Top forum posts (most recent as we don't have ratings yet)
        $topPosts = ForumPost::with('user')
            ->latest()
            ->limit(6)
            ->get();

        return view('community.top-rated', compact('topMaterials', 'topTutors', 'topPosts'));
    }

    /**
     * Show trending content - recent popular uploads
     */
    public function trending()
    {
        // Materials uploaded in the last 7 days with good ratings
        $trendingMaterials = StudyMaterial::with('user')
            ->where('created_at', '>=', now()->subDays(7))
            ->where('downloads', '>', 0)
            ->orderBy('downloads', 'desc')
            ->orderBy('rating', 'desc')
            ->limit(10)
            ->get();

        // Recent events with participants
        $trendingEvents = CampusEvent::with('user')
            ->where('start_time', '>', now())
            ->where('created_at', '>=', now()->subDays(7))
            ->latest()
            ->limit(8)
            ->get();

        // Recent forum activity
        $trendingPosts = ForumPost::with('user')
            ->where('created_at', '>=', now()->subDays(3))
            ->latest()
            ->limit(6)
            ->get();

        return view('community.trending', compact(
            'trendingMaterials',
            'trendingEvents', 
            'trendingPosts'
        ));
    }
}