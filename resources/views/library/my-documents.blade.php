<x-layouts.app :title="__('My Documents')">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white">My Documents</h1>
                <p class="text-neutral-600 dark:text-neutral-400 mt-2">
                    Study materials you've uploaded to the community
                </p>
            </div>
            <flux:button href="{{ route('study-materials.create') }}" variant="primary" icon="plus">
                Upload New Material
            </flux:button>
        </div>

        @if($studyMaterials->count() > 0)
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-neutral-200 dark:border-neutral-700">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-xl">
                            <flux:icon.document-text class="size-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">Total Documents</p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $studyMaterials->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-neutral-200 dark:border-neutral-700">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-xl">
                            <flux:icon.arrow-down-tray class="size-6 text-green-600 dark:text-green-400" />
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">Total Downloads</p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $studyMaterials->sum('downloads') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 border border-neutral-200 dark:border-neutral-700">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-xl">
                            <flux:icon.star class="size-6 text-yellow-600 dark:text-yellow-400" />
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">Average Rating</p>
                            <p class="text-2xl font-bold text-neutral-900 dark:text-white">
                                {{ number_format($studyMaterials->avg('rating'), 1) }}/5.0
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Grid -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($studyMaterials as $material)
                    <div class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <flux:icon.document-text class="size-6 text-white" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2 truncate">
                                        {{ $material->title }}
                                    </h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3 line-clamp-2">
                                        {{ $material->description }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 px-2 py-1 rounded-full">
                                            {{ $material->subject }}
                                        </span>
                                        <span class="text-neutral-500 dark:text-neutral-400">
                                            {{ $material->type }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between mt-4 pt-3 border-t border-neutral-200 dark:border-neutral-700">
                                        <div class="flex items-center gap-4 text-sm text-neutral-600 dark:text-neutral-400">
                                            <span class="flex items-center gap-1">
                                                <flux:icon.arrow-down-tray class="size-4" />
                                                {{ $material->downloads }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <flux:icon.star class="size-4" />
                                                {{ number_format($material->rating, 1) }}
                                            </span>
                                        </div>
                                        <span class="text-xs text-neutral-500 dark:text-neutral-400">
                                            {{ $material->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <div class="mt-4">
                                        <flux:button href="{{ route('study-materials.show', $material) }}" variant="outline" size="sm" class="w-full">
                                            View Details
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
                {{ $studyMaterials->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="text-neutral-400 dark:text-neutral-600 text-6xl mb-4">📄</div>
                <h3 class="text-xl font-semibold text-neutral-900 dark:text-white mb-2">No documents yet</h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-6 max-w-md mx-auto">
                    You haven't uploaded any study materials yet. Share your knowledge with the community!
                </p>
                <flux:button href="{{ route('study-materials.create') }}" variant="primary" icon="plus">
                    Upload Your First Document
                </flux:button>
            </div>
        @endif
    </div>
</x-layouts.app>
