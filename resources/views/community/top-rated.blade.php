<x-layouts.app :title="__('Top Rated')">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Top Rated</h1>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                    Highest quality content across all categories
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300 text-sm px-3 py-1 rounded-full font-medium">
                    ⭐ Quality Content
                </span>
            </div>
        </div>

        <div class="grid gap-6">
            <!-- Top Study Materials -->
            @if($topMaterials->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                <flux:icon.academic-cap class="size-5 text-blue-600 dark:text-blue-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Top Rated Study Materials</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach($topMaterials as $material)
                                <div class="group bg-neutral-50 dark:bg-zinc-700 rounded-xl p-4 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                            <flux:icon.document-text class="size-4 text-blue-600 dark:text-blue-400" />
                                        </div>
                                        <div class="flex items-center gap-1 text-yellow-600 dark:text-yellow-400 text-sm font-semibold">
                                            <flux:icon.star class="size-4" />
                                            {{ number_format($material->rating, 1) }}
                                        </div>
                                    </div>
                                    <h3 class="font-semibold text-neutral-900 dark:text-white mb-1 truncate">{{ $material->title }}</h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-2">{{ $material->subject }}</p>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $material->downloads }} downloads</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Top Tutors -->
            @if($topTutors->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-emerald-100 dark:bg-emerald-900 rounded-lg">
                                <flux:icon.user-group class="size-5 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Top Rated Tutors</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($topTutors as $tutor)
                                <div class="group bg-neutral-50 dark:bg-zinc-700 rounded-xl p-4 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="p-2 bg-emerald-100 dark:bg-emerald-900 rounded-lg">
                                            <flux:icon.academic-cap class="size-4 text-emerald-600 dark:text-emerald-400" />
                                        </div>
                                        <div class="flex items-center gap-1 text-yellow-600 dark:text-yellow-400 text-sm font-semibold">
                                            <flux:icon.star class="size-4" />
                                            {{ number_format($tutor->rating, 1) }}
                                        </div>
                                    </div>
                                    <h3 class="font-semibold text-neutral-900 dark:text-white mb-1">{{ $tutor->user->name }}</h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-2">{{ $tutor->subject }}</p>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-400">${{ $tutor->hourly_rate }}/hr • {{ $tutor->total_sessions }} sessions</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Top Forum Posts -->
            @if($topPosts->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                <flux:icon.chat-bubble-left-right class="size-5 text-indigo-600 dark:text-indigo-400" />
                            </div>
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Popular Discussions</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($topPosts as $post)
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
                                    <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $post->views }} views</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Empty State -->
        @if($topMaterials->count() === 0 && $topTutors->count() === 0 && $topPosts->count() === 0)
            <div class="text-center py-16">
                <div class="text-neutral-400 dark:text-neutral-600 text-6xl mb-4">⭐</div>
                <h3 class="text-xl font-semibold text-neutral-900 dark:text-white mb-2">No top rated content yet</h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-6 max-w-md mx-auto">
                    Help build the community by contributing high-quality content and supporting fellow students.
                </p>
                <div class="flex gap-4 justify-center">
                    <flux:button href="{{ route('study-materials.create') }}" variant="primary" icon="plus">
                        Upload Material
                    </flux:button>
                    <flux:button href="{{ route('tutors.create') }}" variant="outline" icon="user-plus">
                        Become Tutor
                    </flux:button>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
