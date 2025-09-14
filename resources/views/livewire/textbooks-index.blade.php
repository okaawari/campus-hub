<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Find Your Textbooks 📚</h1>
                <p class="text-purple-100">Buy, sell, or exchange textbooks with fellow students</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold">{{ $textbooks->total() }}</div>
                <div class="text-purple-100">Available Textbooks</div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Filter Textbooks</h2>
            <button wire:click="clearFilters" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                Clear All Filters
            </button>
        </div>
        
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Search</label>
                <flux:input 
                    wire:model.live.debounce.300ms="search" 
                    placeholder="Search title, author, ISBN..." 
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

            <!-- Course Code Filter -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Course Code</label>
                <flux:input 
                    wire:model.live.debounce.300ms="courseCode" 
                    placeholder="e.g., CS101, MATH200" 
                    class="w-full"
                />
            </div>

            <!-- Listing Type Filter -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Type</label>
                <flux:select wire:model.live="listingType" placeholder="All Types" class="w-full">
                    <option value="">All Types</option>
                    @foreach($listingTypes as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </flux:select>
            </div>

            <!-- Max Price Filter -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Max Price ($)</label>
                <flux:input 
                    wire:model.live.debounce.300ms="maxPrice" 
                    type="number" 
                    placeholder="No limit" 
                    class="w-full"
                />
            </div>

            <!-- Condition Filter -->
            <div>
                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Condition</label>
                <flux:select wire:model.live="condition" placeholder="All Conditions" class="w-full">
                    <option value="">All Conditions</option>
                    @foreach($conditions as $conditionOption)
                        <option value="{{ $conditionOption }}">{{ ucfirst($conditionOption) }}</option>
                    @endforeach
                </flux:select>
            </div>
        </div>
    </div>

    <!-- Sort Options -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="text-sm text-neutral-600 dark:text-neutral-400">Sort by:</span>
            <div class="flex gap-2">
                <button 
                    wire:click="sortBy('price')" 
                    class="px-3 py-1 text-sm rounded-lg border transition-colors {{ $sortBy === 'price' ? 'bg-blue-100 text-blue-700 border-blue-300 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700' : 'bg-white text-neutral-700 border-neutral-300 hover:bg-neutral-50 dark:bg-zinc-800 dark:text-neutral-300 dark:border-neutral-600 dark:hover:bg-zinc-700' }}"
                >
                    Price
                    @if($sortBy === 'price')
                        <flux:icon.chevron-up class="size-3 inline ml-1 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" />
                    @endif
                </button>
                <button 
                    wire:click="sortBy('created_at')" 
                    class="px-3 py-1 text-sm rounded-lg border transition-colors {{ $sortBy === 'created_at' ? 'bg-blue-100 text-blue-700 border-blue-300 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700' : 'bg-white text-neutral-700 border-neutral-300 hover:bg-neutral-50 dark:bg-zinc-800 dark:text-neutral-300 dark:border-neutral-600 dark:hover:bg-zinc-700' }}"
                >
                    Latest
                    @if($sortBy === 'created_at')
                        <flux:icon.chevron-up class="size-3 inline ml-1 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" />
                    @endif
                </button>
                <button 
                    wire:click="sortBy('title')" 
                    class="px-3 py-1 text-sm rounded-lg border transition-colors {{ $sortBy === 'title' ? 'bg-blue-100 text-blue-700 border-blue-300 dark:bg-blue-900 dark:text-blue-300 dark:border-blue-700' : 'bg-white text-neutral-700 border-neutral-300 hover:bg-neutral-50 dark:bg-zinc-800 dark:text-neutral-300 dark:border-neutral-600 dark:hover:bg-zinc-700' }}"
                >
                    Title
                    @if($sortBy === 'title')
                        <flux:icon.chevron-up class="size-3 inline ml-1 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" />
                    @endif
                </button>
            </div>
        </div>
        
        <div class="text-sm text-neutral-600 dark:text-neutral-400">
            Showing {{ $textbooks->firstItem() ?? 0 }}-{{ $textbooks->lastItem() ?? 0 }} of {{ $textbooks->total() }} textbooks
        </div>
    </div>

    <!-- Textbooks Grid -->
    @if($textbooks->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($textbooks as $textbook)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Textbook Header -->
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg line-clamp-2 mb-1">{{ $textbook->title }}</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $textbook->author }}</p>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                @if($textbook->listing_type === 'sale')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full dark:bg-green-900 dark:text-green-300">
                                        For Sale
                                    </span>
                                @elseif($textbook->listing_type === 'exchange')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full dark:bg-blue-900 dark:text-blue-300">
                                        Exchange
                                    </span>
                                @elseif($textbook->listing_type === 'rent')
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full dark:bg-purple-900 dark:text-purple-300">
                                        For Rent
                                    </span>
                                @endif
                                <span class="px-2 py-1 bg-neutral-100 text-neutral-700 text-xs font-medium rounded-full dark:bg-neutral-700 dark:text-neutral-300">
                                    {{ ucfirst($textbook->condition) }}
                                </span>
                            </div>
                        </div>
                        
                        @if($textbook->description)
                            <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-3">
                                {{ $textbook->description }}
                            </p>
                        @endif
                        
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-4">
                                @if($textbook->course_code)
                                    <div class="flex items-center gap-1">
                                        <flux:icon.academic-cap class="size-4 text-neutral-500" />
                                        <span class="font-medium">{{ $textbook->course_code }}</span>
                                    </div>
                                @endif
                                @if($textbook->edition)
                                    <div class="flex items-center gap-1">
                                        <flux:icon.book-open-text class="size-4 text-neutral-500" />
                                        <span>{{ $textbook->edition }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="text-right">
                                @if($textbook->listing_type === 'sale' || $textbook->listing_type === 'rent')
                                    <div class="font-semibold text-green-600 dark:text-green-400">${{ number_format($textbook->price, 2) }}</div>
                                @else
                                    <div class="font-semibold text-blue-600 dark:text-blue-400">Exchange</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Textbook Details -->
                    <div class="p-6">
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center gap-2 text-sm">
                                <flux:icon.user class="size-4 text-neutral-500" />
                                <span>{{ $textbook->user->name }}</span>
                            </div>
                            @if($textbook->location)
                                <div class="flex items-center gap-2 text-sm">
                                    <flux:icon.map-pin class="size-4 text-neutral-500" />
                                    <span>{{ $textbook->location }}</span>
                                </div>
                            @endif
                            @if($textbook->isbn)
                                <div class="flex items-center gap-2 text-sm">
                                    <flux:icon.identification class="size-4 text-neutral-500" />
                                    <span class="font-mono text-xs">{{ $textbook->isbn }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('textbooks.show', $textbook) }}" 
                               class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                View Details
                            </a>
                            <a href="{{ route('textbooks.contact', $textbook) }}" 
                               class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                                Contact Seller
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $textbooks->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-neutral-100 dark:bg-zinc-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <flux:icon.book-open-text class="size-12 text-neutral-400" />
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-2">No textbooks found</h3>
            <p class="text-neutral-600 dark:text-neutral-400 mb-6">
                @if($search || $subject || $courseCode || $listingType || $maxPrice || $condition)
                    Try adjusting your search criteria or clear the filters to see all available textbooks.
                @else
                    No textbooks are currently available. Check back later or consider listing your own textbooks!
                @endif
            </p>
            @if($search || $subject || $courseCode || $listingType || $maxPrice || $condition)
                <button wire:click="clearFilters" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Clear Filters
                </button>
            @else
                <a href="{{ route('textbooks.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors inline-block">
                    List Your Textbook
                </a>
            @endif
        </div>
    @endif
</div>
