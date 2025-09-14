<x-layouts.app :title="__('Top Uploads')">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">Top Uploads</h1>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                    Most downloaded study materials from the community
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 text-sm px-3 py-1 rounded-full font-medium">
                    🔥 Hot
                </span>
            </div>
        </div>

        @if($topMaterials->count() > 0)
            <!-- Top Downloads Summary -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-6 border border-green-200 dark:border-green-800">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                            {{ $topMaterials->sum('downloads') }}
                        </div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Total Downloads</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                            {{ $topMaterials->count() }}
                        </div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Top Materials</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                            {{ number_format($topMaterials->avg('rating'), 1) }}
                        </div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">Average Rating</p>
                    </div>
                </div>
            </div>

            <!-- Top Materials Grid -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($topMaterials as $index => $material)
                    <div class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-green-300 dark:hover:border-green-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 relative">
                        <!-- Ranking Badge -->
                        @if($index < 3)
                            <div class="absolute -top-2 -left-2 z-10">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm
                                    {{ $index === 0 ? 'bg-yellow-500' : ($index === 1 ? 'bg-gray-400' : 'bg-orange-500') }}">
                                    {{ $index + 1 }}
                                </div>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <flux:icon.arrow-up class="size-6 text-white" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2 truncate">
                                        {{ $material->title }}
                                    </h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3 line-clamp-2">
                                        {{ $material->description }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm mb-3">
                                        <span class="bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 px-2 py-1 rounded-full">
                                            {{ $material->subject }}
                                        </span>
                                        <span class="text-neutral-500 dark:text-neutral-400">
                                            by {{ $material->user->name }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="flex items-center gap-1 text-green-600 dark:text-green-400 font-semibold">
                                                <flux:icon.arrow-down-tray class="size-4" />
                                                {{ $material->downloads }}
                                            </span>
                                            <span class="flex items-center gap-1 text-yellow-600 dark:text-yellow-400">
                                                <flux:icon.star class="size-4" />
                                                {{ number_format($material->rating, 1) }}
                                            </span>
                                        </div>
                                        @if($material->downloads > 50)
                                            <span class="bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 text-xs px-2 py-1 rounded-full">
                                                🔥 Popular
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex gap-2">
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
                {{ $topMaterials->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="text-neutral-400 dark:text-neutral-600 text-6xl mb-4">📈</div>
                <h3 class="text-xl font-semibold text-neutral-900 dark:text-white mb-2">No top uploads yet</h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-6 max-w-md mx-auto">
                    Be the first to contribute! Upload study materials and help your fellow students succeed.
                </p>
                <flux:button href="{{ route('study-materials.create') }}" variant="primary" icon="plus">
                    Upload Study Material
                </flux:button>
            </div>
        @endif
    </div>
</x-layouts.app>
