<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Campus Events</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Discover and join exciting events happening on campus</p>
                </div>
                @auth
                    <flux:button href="{{ route('events.create') }}" icon="plus" variant="primary">
                        Create Event
                    </flux:button>
                @endauth
            </div>
        </div>

                <!-- Filters -->
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 mb-8">
                    <div class="grid gap-4 md:grid-cols-4 lg:grid-cols-6">
                        <!-- Search -->
                        <div class="md:col-span-2">
                            <flux:field>
                                <flux:label>Search Events</flux:label>
                                <flux:input wire:model.live.debounce.300ms="search" placeholder="Search by title, organizer, or location..." />
                            </flux:field>
                        </div>
                        
                        <!-- Category Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Category</flux:label>
                                <flux:select wire:model.live="category" placeholder="All Categories">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </flux:select>
                            </flux:field>
                        </div>
                        
                        <!-- Status Filter -->
                        <div>
                            <flux:field>
                                <flux:label>Status</flux:label>
                                <flux:select wire:model.live="status" placeholder="All Events">
                                    @foreach($statusOptions as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </flux:select>
                            </flux:field>
                        </div>

                        <!-- Sort Options -->
                        <div>
                            <flux:field>
                                <flux:label>Sort By</flux:label>
                                <flux:select wire:model.live="sortBy">
                                    <option value="start_time">Date</option>
                                    <option value="title">Title</option>
                                    <option value="category">Category</option>
                                    <option value="created_at">Created</option>
                                </flux:select>
                            </flux:field>
                        </div>
                        
                        <!-- Sort Direction -->
                        <div>
                            <flux:field>
                                <flux:label>Direction</flux:label>
                                <flux:select wire:model.live="sortDirection">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </flux:select>
                            </flux:field>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    @if($search || $category || $status !== 'upcoming' || $sortBy !== 'start_time' || $sortDirection !== 'asc')
                        <div class="mt-4 flex justify-end">
                            <flux:button wire:click="clearFilters" variant="outline" size="sm">
                                Clear Filters
                            </flux:button>
                        </div>
                    @endif
                </div>

                <!-- Results Summary -->
                <div class="mb-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Showing {{ $events->count() }} of {{ $events->total() }} events
                        @if($search)
                            matching "{{ $search }}"
                        @endif
                        @if($category)
                            in {{ $categories[$category] }}
                        @endif
                    </p>
                </div>

                <!-- Events Grid -->
                @if($events->count() > 0)
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($events as $event)
                            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                                <!-- Event Image -->
                                @if($event->image_url)
                                    <div class="aspect-video bg-gray-200 dark:bg-gray-700">
                                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="aspect-video bg-gradient-to-br from-{{ $event->category_color }}-100 to-{{ $event->category_color }}-200 dark:from-{{ $event->category_color }}-900 dark:to-{{ $event->category_color }}-800 flex items-center justify-center">
                                        <flux:icon name="{{ $event->category_icon }}" class="size-12 text-{{ $event->category_color }}-600 dark:text-{{ $event->category_color }}-400" />
                                    </div>
                                @endif

                                <!-- Event Content -->
                                <div class="p-6">
                                    <!-- Category Badge -->
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $event->category_color }}-100 text-{{ $event->category_color }}-800 dark:bg-{{ $event->category_color }}-900 dark:text-{{ $event->category_color }}-200">
                                            {{ $categories[$event->category] }}
                                        </span>
                                        @if($event->is_featured)
                                            <flux:icon.star class="size-4 text-yellow-500" />
                                        @endif
                                    </div>

                                    <!-- Event Title -->
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                        <a href="{{ route('events.show', $event) }}" class="hover:text-{{ $event->category_color }}-600 dark:hover:text-{{ $event->category_color }}-400">
                                            {{ $event->title }}
                                        </a>
                                    </h3>

                                    <!-- Event Description -->
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                                        {{ $event->description }}
                                    </p>

                                    <!-- Event Details -->
                                    <div class="space-y-2 mb-4">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <flux:icon.calendar-days class="size-4 mr-2" />
                                            <span>{{ $event->start_time->format('M j, Y') }}</span>
                                        </div>
                                        
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <flux:icon.clock class="size-4 mr-2" />
                                            <span>{{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}</span>
                                        </div>
                                        
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <flux:icon.map-pin class="size-4 mr-2" />
                                            <span>{{ $event->location }}</span>
                                        </div>
                                        
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <flux:icon.user-group class="size-4 mr-2" />
                                            <span>{{ $event->organizer }}</span>
                                        </div>
                                    </div>

                                    <!-- Event Status -->
                                    <div class="flex items-center justify-between mb-4">
                                        @if($event->isUpcoming())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                <flux:icon.clock class="size-3 mr-1" />
                                                Upcoming
                                            </span>
                                        @elseif($event->isOngoing())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                <flux:icon.play class="size-3 mr-1" />
                                                Now
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                <flux:icon.check class="size-3 mr-1" />
                                                Past
                                            </span>
                                        @endif

                                        @if($event->requires_rsvp)
                                            @if($event->isAtCapacity())
                                                <span class="text-xs text-red-600 dark:text-red-400 font-medium">Full</span>
                                            @elseif($event->spots_remaining > 0 && $event->spots_remaining <= 5)
                                                <span class="text-xs text-orange-600 dark:text-orange-400 font-medium">{{ $event->spots_remaining }} left</span>
                                            @else
                                                <span class="text-xs text-gray-600 dark:text-gray-400">{{ $event->attendingRsvps()->count() }} attending</span>
                                            @endif
                                        @endif
                                    </div>

                                    <!-- Action Button -->
                                    <flux:button href="{{ route('events.show', $event) }}" variant="outline" class="w-full">
                                        View Details
                                    </flux:button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $events->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <flux:icon.calendar-days class="size-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" />
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No events found</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            @if($search || $category || $status !== 'upcoming')
                                Try adjusting your filters or search terms.
                            @else
                                Be the first to create an event for your campus community!
                            @endif
                        </p>
                        @auth
                            <flux:button href="{{ route('events.create') }}" variant="primary">
                                Create Your First Event
                            </flux:button>
                        @endauth
                    </div>
                @endif
    </div>
</div>
