<div>
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold">Study Materials</h1>
                <p class="text-neutral-600 dark:text-neutral-400">Share and discover study resources</p>
            </div>
            <div class="flex justify-center sm:justify-end">
                <flux:button :href="route('study-materials.create')" icon="plus" class="w-full sm:w-auto">
                    <span class="hidden sm:inline">Upload Material</span>
                    <span class="sm:hidden">Upload</span>
                </flux:button>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 md:p-6">
            <!-- Search and Filter Row -->
            <div class="grid gap-3 md:gap-4 grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-2">
                    <flux:input 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Search materials by title, subject, or professor..." 
                        class="w-full" 
                    />
                </div>
                <div>
                    <flux:select wire:model.live="subjectFilter">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject }}">{{ $subject }}</option>
                        @endforeach
                    </flux:select>
                </div>
                <div>
                    <flux:select wire:model.live="typeFilter">
                        <option value="">All Types</option>
                        <option value="notes">Study Notes</option>
                        <option value="exam">Exam Papers</option>
                        <option value="flashcards">Flashcards</option>
                        <option value="cheat_sheet">Cheat Sheets</option>
                        <option value="other">Other</option>
                    </flux:select>
                </div>
                <div class="flex justify-center md:justify-start">
                    <flux:button variant="outline" wire:click="clearFilters" size="sm" class="w-full md:w-auto min-h-[2.5rem] flex items-center justify-center">
                        <flux:icon.x-mark class="size-4 me-1" />
                        {{-- <span class="hidden sm:inline">Clear</span> --}}
                    </flux:button>
                </div>
            </div>
            
            <!-- Sort Options -->
            <div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                <span class="text-sm text-neutral-600 dark:text-neutral-400 font-medium">Sort by:</span>
                <div class="grid grid-cols-2 sm:flex gap-2">
                    <flux:button 
                        wire:click="$set('sortBy', 'latest')" 
                        variant="{{ $sortBy === 'latest' ? 'primary' : 'outline' }}" 
                        size="sm"
                        class="text-xs sm:text-sm"
                    >
                        Latest
                    </flux:button>
                    <flux:button 
                        wire:click="$set('sortBy', 'rating')" 
                        variant="{{ $sortBy === 'rating' ? 'primary' : 'outline' }}" 
                        size="sm"
                        class="text-xs sm:text-sm"
                    >
                        Rating
                    </flux:button>
                    <flux:button 
                        wire:click="$set('sortBy', 'downloads')" 
                        variant="{{ $sortBy === 'downloads' ? 'primary' : 'outline' }}" 
                        size="sm"
                        class="text-xs sm:text-sm"
                    >
                        Downloads
                    </flux:button>
                    <flux:button 
                        wire:click="$set('sortBy', 'title')" 
                        variant="{{ $sortBy === 'title' ? 'primary' : 'outline' }}" 
                        size="sm"
                        class="text-xs sm:text-sm"
                    >
                        Title
                    </flux:button>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="mt-6 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                <div class="grid gap-4 md:grid-cols-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total'] }}</div>
                        <div class="text-sm text-neutral-600 dark:text-neutral-400">Total Materials</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['notes'] }}</div>
                        <div class="text-sm text-neutral-600 dark:text-neutral-400">Study Notes</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['exams'] }}</div>
                        <div class="text-sm text-neutral-600 dark:text-neutral-400">Exam Papers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ number_format($stats['downloads']) }}</div>
                        <div class="text-sm text-neutral-600 dark:text-neutral-400">Total Downloads</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Materials -->
        @if($featuredMaterials->count() > 0)
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-xl p-6">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <flux:icon.star class="size-5 text-yellow-500" />
                    Featured Study Materials
                </h2>
                <div class="grid gap-4 md:grid-cols-3">
                    @foreach($featuredMaterials as $featured)
                        <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-neutral-200 dark:border-neutral-700">
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                    @switch($featured->type)
                                        @case('notes')
                                            <flux:icon.document-text class="size-4 text-blue-600 dark:text-blue-400" />
                                            @break
                                        @case('exam')
                                            <flux:icon.academic-cap class="size-4 text-blue-600 dark:text-blue-400" />
                                            @break
                                        @case('flashcards')
                                            <flux:icon.rectangle-stack class="size-4 text-blue-600 dark:text-blue-400" />
                                            @break
                                        @case('cheat_sheet')
                                            <flux:icon.clipboard-document-list class="size-4 text-blue-600 dark:text-blue-400" />
                                            @break
                                        @default
                                            <flux:icon.document class="size-4 text-blue-600 dark:text-blue-400" />
                                    @endswitch
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-sm line-clamp-2">{{ $featured->title }}</h3>
                                    <p class="text-xs text-neutral-600 dark:text-neutral-400 mt-1">{{ $featured->subject }} • {{ $featured->downloads }} downloads</p>
                                    <div class="flex items-center gap-1 mt-2">
                                        <flux:icon.star class="size-3 text-yellow-500" />
                                        <span class="text-xs font-medium">{{ $featured->rating }}</span>
                                    </div>
                                </div>
                            </div>
                            <flux:button size="sm" variant="outline" class="w-full mt-3" :href="route('study-materials.show', $featured)">
                                View Details
                            </flux:button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Materials Grid -->
        <div class="grid gap-4 sm:gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @forelse($materials as $material)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 sm:p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                @switch($material->type)
                                    @case('notes')
                                        <flux:icon.document-text class="size-5 text-blue-600 dark:text-blue-400" />
                                        @break
                                    @case('exam')
                                        <flux:icon.academic-cap class="size-5 text-blue-600 dark:text-blue-400" />
                                        @break
                                    @case('flashcards')
                                        <flux:icon.rectangle-stack class="size-5 text-blue-600 dark:text-blue-400" />
                                        @break
                                    @case('cheat_sheet')
                                        <flux:icon.clipboard-document-list class="size-5 text-blue-600 dark:text-blue-400" />
                                        @break
                                    @default
                                        <flux:icon.document class="size-5 text-blue-600 dark:text-blue-400" />
                                @endswitch
                            </div>
                            <div>
                                <span class="text-xs bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-2 py-1 rounded-full">
                                    {{ ucfirst(str_replace('_', ' ', $material->type)) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <flux:icon.star class="size-4 text-yellow-500" />
                            <span class="text-sm font-medium">{{ number_format($material->rating, 1) }}</span>
                        </div>
                    </div>

                    <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $material->title }}</h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3">{{ $material->description }}</p>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-sm">
                            <flux:icon.academic-cap class="size-4 text-neutral-500" />
                            <span>{{ $material->subject }}</span>
                        </div>
                        @if($material->course_code)
                            <div class="flex items-center gap-2 text-sm">
                                <flux:icon.book-open class="size-4 text-neutral-500" />
                                <span>{{ $material->course_code }}</span>
                            </div>
                        @endif
                        @if($material->professor)
                            <div class="flex items-center gap-2 text-sm">
                                <flux:icon.user class="size-4 text-neutral-500" />
                                <span>{{ $material->professor }}</span>
                            </div>
                        @endif
                        <div class="flex items-center gap-2 text-sm">
                            <flux:icon.arrow-down-tray class="size-4 text-neutral-500" />
                            <span>{{ $material->downloads }} downloads</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-2">
                        <div class="flex items-center gap-2">
                            <div class="size-8 bg-neutral-200 dark:bg-neutral-700 rounded-full flex items-center justify-center">
                                <span class="text-xs font-medium">{{ substr($material->user->name, 0, 1) }}</span>
                            </div>
                            <span class="text-sm">{{ $material->user->name }}</span>
                        </div>
                        <div class="flex gap-2">
                            <flux:button size="sm" variant="outline" :href="route('study-materials.show', $material)" class="flex-1 sm:flex-none">
                                View
                            </flux:button>
                            <flux:button size="sm" :href="route('study-materials.download', $material)" icon="arrow-down-tray" class="flex-1 sm:flex-none">
                                <span class="hidden sm:inline">Download</span>
                                <span class="sm:hidden">DL</span>
                            </flux:button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <flux:icon.document-text class="size-16 text-neutral-400 mx-auto mb-4" />
                    <h3 class="text-lg font-semibold mb-2">No study materials found</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-6">
                        @if($search || $subjectFilter || $typeFilter)
                            Try adjusting your search criteria or clear the filters.
                        @else
                            Be the first to share study materials with your peers!
                        @endif
                    </p>
                    @if($search || $subjectFilter || $typeFilter)
                        <flux:button wire:click="clearFilters" variant="outline" class="me-4">
                            Clear Filters
                        </flux:button>
                    @endif
                    <flux:button :href="route('study-materials.create')" icon="plus">
                        Upload Material
                    </flux:button>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($materials->hasPages())
            <div class="flex justify-center">
                {{ $materials->links() }}
            </div>
        @endif
    </div>
</div>