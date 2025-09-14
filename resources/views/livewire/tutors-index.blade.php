<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-500 to-blue-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Find Your Perfect Tutor 🎓</h1>
                <p class="text-green-100">Connect with experienced tutors to accelerate your learning journey</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold">{{ $tutors->total() }}</div>
                <div class="text-green-100">Available Tutors</div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Filter Tutors</h2>
            <button wire:click="clearFilters" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                Clear All Filters
            </button>
        </div>
        
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Search</label>
                <flux:input 
                    wire:model.live.debounce.300ms="search" 
                    placeholder="Search tutors, subjects..." 
                    class="w-full"
                />
            </div>

            <!-- Subject Filter -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Subject</label>
                <flux:select wire:model.live="subject" placeholder="All Subjects" class="w-full">
                    <option value="">All Subjects</option>
                    @foreach($subjects as $subjectOption)
                        <option value="{{ $subjectOption }}">{{ $subjectOption }}</option>
                    @endforeach
                </flux:select>
            </div>

            <!-- Location Filter -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Location</label>
                <flux:select wire:model.live="location" placeholder="All Locations" class="w-full">
                    <option value="">All Locations</option>
                    @foreach($locations as $locationOption)
                        <option value="{{ $locationOption }}">{{ $locationOption }}</option>
                    @endforeach
                </flux:select>
            </div>

            <!-- Max Rate Filter -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Max Rate ($/hr)</label>
                <flux:input 
                    wire:model.live.debounce.300ms="maxRate" 
                    type="number" 
                    placeholder="No limit" 
                    class="w-full"
                />
            </div>
        </div>
    </div>

    <!-- Sort Options -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="text-sm text-neutral-600 dark:text-neutral-400">Sort by:</span>
            <div class="flex gap-2">
                <button 
                    wire:click="sortBy('rating')" 
                    class="px-3 py-1 text-sm rounded-lg border transition-colors {{ $sortBy === 'rating' ? 'bg-blue-100 text-blue-700 border-blue-300 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700' : 'bg-white text-neutral-700 border-neutral-300 hover:bg-neutral-50 dark:bg-zinc-800 dark:text-neutral-300 dark:border-neutral-600 dark:hover:bg-zinc-700' }}"
                >
                    Rating
                    @if($sortBy === 'rating')
                        <flux:icon.chevron-up class="size-3 inline ml-1 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" />
                    @endif
                </button>
                <button 
                    wire:click="sortBy('hourly_rate')" 
                    class="px-3 py-1 text-sm rounded-lg border transition-colors {{ $sortBy === 'hourly_rate' ? 'bg-blue-100 text-blue-700 border-blue-300 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700' : 'bg-white text-neutral-700 border-neutral-300 hover:bg-neutral-50 dark:bg-zinc-800 dark:text-neutral-300 dark:border-neutral-600 dark:hover:bg-zinc-700' }}"
                >
                    Price
                    @if($sortBy === 'hourly_rate')
                        <flux:icon.chevron-up class="size-3 inline ml-1 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" />
                    @endif
                </button>
                <button 
                    wire:click="sortBy('total_sessions')" 
                    class="px-3 py-1 text-sm rounded-lg border transition-colors {{ $sortBy === 'total_sessions' ? 'bg-blue-100 text-blue-700 border-blue-300 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700' : 'bg-white text-neutral-700 border-neutral-300 hover:bg-neutral-50 dark:bg-zinc-800 dark:text-neutral-300 dark:border-neutral-600 dark:hover:bg-zinc-700' }}"
                >
                    Experience
                    @if($sortBy === 'total_sessions')
                        <flux:icon.chevron-up class="size-3 inline ml-1 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" />
                    @endif
                </button>
            </div>
        </div>
        
        <div class="text-sm text-neutral-600 dark:text-neutral-400">
            Showing {{ $tutors->firstItem() ?? 0 }}-{{ $tutors->lastItem() ?? 0 }} of {{ $tutors->total() }} tutors
        </div>
    </div>

    <!-- Tutors Grid -->
    @if($tutors->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($tutors as $tutor)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Tutor Header -->
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ substr($tutor->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $tutor->user->name }}</h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $tutor->subject }}</p>
                                </div>
                            </div>
                            @if($tutor->offers_free_session)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full dark:bg-green-900 dark:text-green-300">
                                    Free Session
                                </span>
                            @endif
                        </div>
                        
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-3">
                            {{ $tutor->description }}
                        </p>
                        
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-1">
                                <flux:icon.star class="size-4 text-yellow-500" />
                                <span class="font-medium">{{ number_format($tutor->rating, 1) }}</span>
                                <span class="text-neutral-500">({{ $tutor->total_sessions }} sessions)</span>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold text-green-600 dark:text-green-400">${{ number_format($tutor->hourly_rate, 2) }}/hr</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tutor Details -->
                    <div class="p-6">
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center gap-2 text-sm">
                                <flux:icon.map-pin class="size-4 text-neutral-500" />
                                <span>{{ $tutor->location }}</span>
                            </div>
                            @if($tutor->qualifications)
                                <div class="flex items-start gap-2 text-sm">
                                    <flux:icon.academic-cap class="size-4 text-neutral-500 mt-0.5" />
                                    <span class="line-clamp-2">{{ $tutor->qualifications }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('tutors.show', $tutor) }}" 
                               class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                View Profile
                            </a>
                            <a href="{{ route('tutors.book', $tutor) }}" 
                               class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                                Book Session
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $tutors->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-neutral-100 dark:bg-zinc-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <flux:icon.user-group class="size-12 text-neutral-400" />
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-2">No tutors found</h3>
            <p class="text-neutral-600 dark:text-neutral-400 mb-6">
                @if($search || $subject || $location || $maxRate)
                    Try adjusting your search criteria or clear the filters to see all available tutors.
                @else
                    No tutors are currently available. Check back later or consider becoming a tutor yourself!
                @endif
            </p>
            @if($search || $subject || $location || $maxRate)
                <button wire:click="clearFilters" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Clear Filters
                </button>
            @else
                <a href="{{ route('tutors.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors inline-block">
                    Become a Tutor
                </a>
            @endif
        </div>
    @endif
</div>
