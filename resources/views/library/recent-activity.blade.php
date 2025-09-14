<x-layouts.app :title="__('Recent Activity')">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Recent Activity</h1>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                    Your latest contributions to the campus community
                </p>
            </div>
        </div>

        <div class="grid gap-6">
            <!-- Recent Study Materials -->
            @if($recentMaterials->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                <flux:icon.document-text class="size-5 text-blue-600 dark:text-blue-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Recent Study Materials</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentMaterials as $material)
                                <div class="flex items-center gap-4 p-4 bg-neutral-50 dark:bg-zinc-700 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                        <flux:icon.academic-cap class="size-4 text-blue-600 dark:text-blue-400" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold text-neutral-900 dark:text-white truncate">{{ $material->title }}</h3>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                            {{ $material->subject }} • {{ $material->downloads }} downloads
                                        </p>
                                    </div>
                                    <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                        {{ $material->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recent Textbooks -->
            @if($recentTextbooks->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                <flux:icon.book-open class="size-5 text-purple-600 dark:text-purple-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Recent Textbook Listings</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentTextbooks as $textbook)
                                <div class="flex items-center gap-4 p-4 bg-neutral-50 dark:bg-zinc-700 rounded-xl hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">
                                    <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                        <flux:icon.book-open class="size-4 text-purple-600 dark:text-purple-400" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold text-neutral-900 dark:text-white truncate">{{ $textbook->title }}</h3>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                            ${{ $textbook->price }} • {{ ucfirst($textbook->listing_type) }} • {{ $textbook->condition }}
                                        </p>
                                    </div>
                                    <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                        {{ $textbook->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recent Events -->
            @if($recentEvents->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                                <flux:icon.calendar-days class="size-5 text-orange-600 dark:text-orange-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Recent Events Created</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentEvents as $event)
                                <div class="flex items-center gap-4 p-4 bg-neutral-50 dark:bg-zinc-700 rounded-xl hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors">
                                    <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                                        <flux:icon.calendar class="size-4 text-orange-600 dark:text-orange-400" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold text-neutral-900 dark:text-white truncate">{{ $event->title }}</h3>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                            {{ $event->start_time->format('M j, Y') }} • {{ $event->location }}
                                        </p>
                                    </div>
                                    <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                        {{ $event->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recent Forum Posts -->
            @if($recentPosts->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                <flux:icon.chat-bubble-left-right class="size-5 text-indigo-600 dark:text-indigo-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Recent Forum Posts</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentPosts as $post)
                                <div class="flex items-center gap-4 p-4 bg-neutral-50 dark:bg-zinc-700 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                        <flux:icon.chat-bubble-left-right class="size-4 text-indigo-600 dark:text-indigo-400" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold text-neutral-900 dark:text-white truncate">{{ $post->title }}</h3>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                            {{ $post->category }}
                                        </p>
                                    </div>
                                    <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                        {{ $post->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Empty State -->
            @if($recentMaterials->count() === 0 && $recentTextbooks->count() === 0 && $recentEvents->count() === 0 && $recentPosts->count() === 0)
                <div class="text-center py-16">
                    <div class="text-neutral-400 dark:text-neutral-600 text-6xl mb-4">⏰</div>
                    <h3 class="text-xl font-semibold text-neutral-900 dark:text-white mb-2">No recent activity</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-6 max-w-md mx-auto">
                        Start contributing to the campus community! Upload study materials, list textbooks, create events, or join discussions.
                    </p>
                    <div class="flex gap-4 justify-center">
                        <flux:button href="{{ route('study-materials.create') }}" variant="primary" icon="plus">
                            Upload Material
                        </flux:button>
                        <flux:button href="{{ route('events.create') }}" variant="outline" icon="calendar-days">
                            Create Event
                        </flux:button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
