<x-layouts.app :title="__('Saved Materials')">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Saved Materials</h1>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                    High-quality study materials you might find useful
                </p>
            </div>
            <flux:button href="{{ route('study-materials.index') }}" variant="outline" icon="magnifying-glass">
                Browse All Materials
            </flux:button>
        </div>

        @if($savedMaterials->count() > 0)
            <!-- Materials Grid -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($savedMaterials as $material)
                    <div class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <flux:icon.bookmark class="size-6 text-white" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2 truncate">
                                        {{ $material->title }}
                                    </h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3 line-clamp-2">
                                        {{ $material->description }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm mb-3">
                                        <span class="bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300 px-2 py-1 rounded-full">
                                            {{ $material->subject }}
                                        </span>
                                        <span class="text-neutral-500 dark:text-neutral-400">
                                            by {{ $material->user->name }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4 text-sm text-neutral-600 dark:text-neutral-400">
                                            <span class="flex items-center gap-1">
                                                <flux:icon.arrow-down-tray class="size-4" />
                                                {{ $material->downloads }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <flux:icon.star class="size-4 text-yellow-500" />
                                                {{ number_format($material->rating, 1) }}
                                            </span>
                                        </div>
                                        @if($material->rating >= 4.5)
                                            <span class="bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300 text-xs px-2 py-1 rounded-full">
                                                ⭐ Highly Rated
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-4 flex gap-2">
                                        <flux:button href="{{ route('study-materials.show', $material) }}" variant="outline" size="sm" class="flex-1">
                                            View
                                        </flux:button>
                                        <flux:button href="{{ route('study-materials.download', $material) }}" variant="primary" size="sm" class="flex-1">
                                            Download
                                        </flux:button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $savedMaterials->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="text-neutral-400 dark:text-neutral-600 text-6xl mb-4">🔖</div>
                <h3 class="text-xl font-semibold text-neutral-900 dark:text-white mb-2">No saved materials yet</h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-6 max-w-md mx-auto">
                    Start exploring study materials and save the ones you find useful for quick access later.
                </p>
                <flux:button href="{{ route('study-materials.index') }}" variant="primary" icon="magnifying-glass">
                    Explore Study Materials
                </flux:button>
            </div>
        @endif
    </div>
</x-layouts.app>
