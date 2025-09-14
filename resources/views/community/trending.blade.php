<x-layouts.app :title="__('Trending')">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Trending</h1>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                    What's hot in the campus community right now
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 text-sm px-3 py-1 rounded-full font-medium">
                    🔥 Trending Now
                </span>
            </div>
        </div>

        <div class="grid gap-6">
            <!-- Trending Study Materials -->
            @if($trendingMaterials->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                <flux:icon.arrow-trending-up class="size-5 text-blue-600 dark:text-blue-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Trending Study Materials</h2>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">(Last 7 days)</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-2">
                            @foreach($trendingMaterials as $material)
                                <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800 hover:shadow-lg transition-all">
                                    <div class="flex items-start gap-4">
                                        <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                                            <flux:icon.arrow-trending-up class="size-6 text-white" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2 truncate">
                                                {{ $material->title }}
                                            </h3>
                                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3 line-clamp-2">
                                                {{ $material->description }}
                                            </p>
                                            
                                            <div class="flex items-center justify-between text-sm mb-3">
                                                <span class="bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 px-2 py-1 rounded-full">
                                                    {{ $material->subject }}
                                                </span>
                                                <span class="text-neutral-500 dark:text-neutral-400">
                                                    by {{ $material->user->name }}
                                                </span>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-4 text-sm">
                                                    <span class="flex items-center gap-1 text-blue-600 dark:text-blue-400 font-semibold">
                                                        <flux:icon.arrow-down-tray class="size-4" />
                                                        {{ $material->downloads }}
                                                    </span>
                                                    <span class="flex items-center gap-1 text-yellow-600 dark:text-yellow-400">
                                                        <flux:icon.star class="size-4" />
                                                        {{ number_format($material->rating, 1) }}
                                                    </span>
                                                </div>
                                                <span class="bg-orange-100 text-orange-700 dark:bg-orange-900 dark:text-orange-300 text-xs px-2 py-1 rounded-full">
                                                    🔥 Hot
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Trending Events -->
            @if($trendingEvents->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                                <flux:icon.calendar-days class="size-5 text-orange-600 dark:text-orange-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Trending Events</h2>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">(Recently added)</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach($trendingEvents as $event)
                                <div class="group bg-neutral-50 dark:bg-zinc-700 rounded-xl p-4 hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                                            <flux:icon.calendar class="size-4 text-orange-600 dark:text-orange-400" />
                                        </div>
                                        <span class="bg-orange-100 text-orange-700 dark:bg-orange-900 dark:text-orange-300 text-xs px-2 py-1 rounded-full">
                                            New
                                        </span>
                                    </div>
                                    <h3 class="font-semibold text-neutral-900 dark:text-white mb-1 line-clamp-2">{{ $event->title }}</h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-2">{{ $event->start_time->format('M j, Y') }}</p>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $event->location }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recent Forum Activity -->
            @if($trendingPosts->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                <flux:icon.chat-bubble-left-right class="size-5 text-indigo-600 dark:text-indigo-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Recent Discussions</h2>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">(Last 3 days)</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($trendingPosts as $post)
                                <div class="group bg-neutral-50 dark:bg-zinc-700 rounded-xl p-4 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                            <flux:icon.chat-bubble-left-right class="size-4 text-indigo-600 dark:text-indigo-400" />
                                        </div>
                                        <span class="bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300 text-xs px-2 py-1 rounded-full">
                                            {{ $post->category }}
                                        </span>
                                    </div>
                                    <h3 class="font-semibold text-neutral-900 dark:text-white mb-1 line-clamp-2">{{ $post->title }}</h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-2">by {{ $post->user->name }}</p>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Empty State -->
        @if($trendingMaterials->count() === 0 && $trendingEvents->count() === 0 && $trendingPosts->count() === 0)
            <div class="text-center py-16">
                <div class="text-neutral-400 dark:text-neutral-600 text-6xl mb-4">📈</div>
                <h3 class="text-xl font-semibold text-neutral-900 dark:text-white mb-2">Nothing trending yet</h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-6 max-w-md mx-auto">
                    Be the first to create trending content! Share something amazing with the community.
                </p>
                <div class="flex gap-4 justify-center">
                    <flux:button href="{{ route('study-materials.create') }}" variant="primary" icon="plus">
                        Upload Material
                    </flux:button>
                    <flux:button href="{{ route('events.create') }}" variant="outline" icon="calendar-days">
                        Create Event
                    </flux:button>
                    <flux:button href="{{ route('forum.create') }}" variant="outline" icon="chat-bubble-left-right">
                        Start Discussion
                    </flux:button>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
