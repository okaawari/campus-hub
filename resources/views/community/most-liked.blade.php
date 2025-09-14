<x-layouts.app :title="__('Most Liked')">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Most Liked</h1>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                    Highest rated content loved by the community
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300 text-sm px-3 py-1 rounded-full font-medium">
                    ❤️ Community Favorites
                </span>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            <!-- Top Rated Study Materials -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                        <flux:icon.academic-cap class="size-5 text-blue-600 dark:text-blue-400" />
                    </div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Top Study Materials</h2>
                </div>

                @if($topMaterials->count() > 0)
                    <div class="space-y-4">
                        @foreach($topMaterials as $material)
                            <div class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-red-300 dark:hover:border-red-600 transition-all duration-300 hover:shadow-lg">
                                <div class="p-6">
                                    <div class="flex items-start gap-4">
                                        <div class="p-3 bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <flux:icon.heart class="size-6 text-white" />
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
                                                    <span class="flex items-center gap-1 text-yellow-600 dark:text-yellow-400 font-semibold">
                                                        <flux:icon.star class="size-4" />
                                                        {{ number_format($material->rating, 1) }}
                                                    </span>
                                                    <span class="flex items-center gap-1 text-neutral-600 dark:text-neutral-400">
                                                        <flux:icon.arrow-down-tray class="size-4" />
                                                        {{ $material->downloads }}
                                                    </span>
                                                </div>
                                                <span class="bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300 text-xs px-2 py-1 rounded-full">
                                                    💕 Loved
                                                </span>
                                            </div>

                                            <div class="mt-4">
                                                <flux:button href="{{ route('study-materials.show', $material) }}" variant="outline" size="sm" class="w-full">
                                                    View Material
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
                        <div class="text-neutral-400 dark:text-neutral-600 text-4xl mb-2">📚</div>
                        <p class="text-neutral-600 dark:text-neutral-400">No highly rated materials yet</p>
                    </div>
                @endif
            </div>

            <!-- Top Rated Tutors -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-emerald-100 dark:bg-emerald-900 rounded-lg">
                        <flux:icon.user-group class="size-5 text-emerald-600 dark:text-emerald-400" />
                    </div>
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Top Tutors</h2>
                </div>

                @if($topTutors->count() > 0)
                    <div class="space-y-4">
                        @foreach($topTutors as $tutor)
                            <div class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-300 hover:shadow-lg">
                                <div class="p-6">
                                    <div class="flex items-start gap-4">
                                        <div class="p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <flux:icon.academic-cap class="size-6 text-white" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2">
                                                {{ $tutor->user->name }}
                                            </h3>
                                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3 line-clamp-2">
                                                {{ $tutor->description }}
                                            </p>
                                            
                                            <div class="flex items-center justify-between text-sm mb-3">
                                                <span class="bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300 px-2 py-1 rounded-full">
                                                    {{ $tutor->subject }}
                                                </span>
                                                <span class="text-neutral-500 dark:text-neutral-400">
                                                    ${{ $tutor->hourly_rate }}/hr
                                                </span>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-4 text-sm">
                                                    <span class="flex items-center gap-1 text-yellow-600 dark:text-yellow-400 font-semibold">
                                                        <flux:icon.star class="size-4" />
                                                        {{ number_format($tutor->rating, 1) }}
                                                    </span>
                                                    <span class="flex items-center gap-1 text-neutral-600 dark:text-neutral-400">
                                                        <flux:icon.user-group class="size-4" />
                                                        {{ $tutor->total_sessions }} sessions
                                                    </span>
                                                </div>
                                                @if($tutor->rating >= 4.8)
                                                    <span class="bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300 text-xs px-2 py-1 rounded-full">
                                                        ⭐ Top Rated
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="mt-4">
                                                <flux:button href="{{ route('tutors.show', $tutor) }}" variant="outline" size="sm" class="w-full">
                                                    View Profile
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
                        <div class="text-neutral-400 dark:text-neutral-600 text-4xl mb-2">👨‍🏫</div>
                        <p class="text-neutral-600 dark:text-neutral-400">No highly rated tutors yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 justify-center pt-8">
            <flux:button href="{{ route('study-materials.index') }}" variant="outline" icon="academic-cap">
                Explore Materials
            </flux:button>
            <flux:button href="{{ route('tutors.index') }}" variant="outline" icon="user-group">
                Find Tutors
            </flux:button>
        </div>
    </div>
</x-layouts.app>
