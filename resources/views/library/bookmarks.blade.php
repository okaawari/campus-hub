<x-layouts.app :title="__('Bookmarks')">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Bookmarks</h1>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                    Your saved events and forum discussions
                </p>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            <!-- Bookmarked Events -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                        <flux:icon.calendar-days class="size-5 text-orange-600 dark:text-orange-400" />
                    </div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Popular Events</h2>
                </div>

                @if($popularEvents->count() > 0)
                    <div class="space-y-4">
                        @foreach($popularEvents as $event)
                            <div class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-orange-300 dark:hover:border-orange-600 transition-all duration-300 hover:shadow-lg">
                                <div class="p-6">
                                    <div class="flex items-start gap-4">
                                        <div class="p-3 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <flux:icon.calendar class="size-6 text-white" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2 truncate">
                                                {{ $event->title }}
                                            </h3>
                                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3 line-clamp-2">
                                                {{ $event->description }}
                                            </p>
                                            
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-orange-600 dark:text-orange-400 font-medium">
                                                    {{ $event->start_time->format('M j, Y g:i A') }}
                                                </span>
                                                <span class="text-neutral-500 dark:text-neutral-400">
                                                    {{ $event->location }}
                                                </span>
                                            </div>

                                            <div class="mt-4">
                                                <flux:button href="{{ route('events.show', $event) }}" variant="outline" size="sm" class="w-full">
                                                    View Event
                                                </flux:button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <div class="text-neutral-400 dark:text-neutral-600 text-4xl mb-2">📅</div>
                        <p class="text-neutral-600 dark:text-neutral-400">No events to bookmark yet</p>
                    </div>
                @endif
            </div>

            <!-- Bookmarked Forum Posts -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                        <flux:icon.chat-bubble-left-right class="size-5 text-indigo-600 dark:text-indigo-400" />
                    </div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Popular Discussions</h2>
                </div>

                @if($popularPosts->count() > 0)
                    <div class="space-y-4">
                        @foreach($popularPosts as $post)
                            <div class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-indigo-300 dark:hover:border-indigo-600 transition-all duration-300 hover:shadow-lg">
                                <div class="p-6">
                                    <div class="flex items-start gap-4">
                                        <div class="p-3 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <flux:icon.chat-bubble-left-right class="size-6 text-white" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2 truncate">
                                                {{ $post->title }}
                                            </h3>
                                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3 line-clamp-2">
                                                {{ $post->content }}
                                            </p>
                                            
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300 px-2 py-1 rounded-full">
                                                    {{ $post->category }}
                                                </span>
                                                <span class="text-neutral-500 dark:text-neutral-400">
                                                    by {{ $post->user->name }}
                                                </span>
                                            </div>

                                            <div class="mt-4">
                                                <flux:button href="{{ route('forum.show', $post) }}" variant="outline" size="sm" class="w-full">
                                                    View Discussion
                                                </flux:button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <div class="text-neutral-400 dark:text-neutral-600 text-4xl mb-2">💬</div>
                        <p class="text-neutral-600 dark:text-neutral-400">No discussions to bookmark yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 justify-center pt-8">
            <flux:button href="{{ route('events.index') }}" variant="outline" icon="calendar-days">
                Explore Events
            </flux:button>
            <flux:button href="{{ route('forum.index') }}" variant="outline" icon="chat-bubble-left-right">
                Browse Forum
            </flux:button>
        </div>
    </div>
</x-layouts.app>
