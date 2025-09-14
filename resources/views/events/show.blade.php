<x-layouts.app :title="$event->title">
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                    <li><a href="{{ route('events.index') }}" class="hover:text-gray-900 dark:hover:text-white">Events</a></li>
                    <li><flux:icon.chevron-right class="size-4" /></li>
                    <li class="text-gray-900 dark:text-white">{{ $event->title }}</li>
                </ol>
            </nav>

            <div class="grid gap-8 lg:grid-cols-3">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Event Header -->
                    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <!-- Event Image -->
                        @if($event->image_url)
                            <div class="aspect-video bg-gray-200 dark:bg-gray-700">
                                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="aspect-video bg-gradient-to-br from-{{ $event->category_color }}-100 to-{{ $event->category_color }}-200 dark:from-{{ $event->category_color }}-900 dark:to-{{ $event->category_color }}-800 flex items-center justify-center">
                                <flux:icon name="{{ $event->category_icon }}" class="size-20 text-{{ $event->category_color }}-600 dark:text-{{ $event->category_color }}-400" />
                            </div>
                        @endif

                        <div class="p-6">
                            <!-- Category and Featured Badge -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $event->category_color }}-100 text-{{ $event->category_color }}-800 dark:bg-{{ $event->category_color }}-900 dark:text-{{ $event->category_color }}-200">
                                    {{ ucfirst($event->category) }}
                                </span>
                                @if($event->is_featured)
                                    <div class="flex items-center text-yellow-600 dark:text-yellow-400">
                                        <flux:icon.star class="size-5 mr-1" />
                                        <span class="text-sm font-medium">Featured</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Event Title -->
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $event->title }}</h1>

                            <!-- Event Description -->
                            <div class="prose prose-gray dark:prose-invert max-w-none mb-6">
                                {!! nl2br(e($event->description)) !!}
                            </div>

                            <!-- Event Details -->
                            <div class="grid gap-4 md:grid-cols-2 mb-6">
                                <div class="flex items-start space-x-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                        <flux:icon.calendar-days class="size-5 text-gray-600 dark:text-gray-400" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Date</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->start_time->format('l, F j, Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                        <flux:icon.clock class="size-5 text-gray-600 dark:text-gray-400" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Time</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                        <flux:icon.map-pin class="size-5 text-gray-600 dark:text-gray-400" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Location</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->location }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                        <flux:icon.user-group class="size-5 text-gray-600 dark:text-gray-400" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Organizer</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $event->organizer }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Event Status -->
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    @if($event->isUpcoming())
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            <flux:icon.clock class="size-4 mr-1" />
                                            Upcoming
                                        </span>
                                    @elseif($event->isOngoing())
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            <flux:icon.play class="size-4 mr-1" />
                                            Happening Now
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            <flux:icon.check class="size-4 mr-1" />
                                            Past Event
                                        </span>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    @can('update', $event)
                                        <flux:button href="{{ route('events.edit', $event) }}" variant="outline" size="sm">
                                            <flux:icon.pencil class="size-4 mr-1" />
                                            Edit
                                        </flux:button>
                                    @endcan
                                    
                                    @can('delete', $event)
                                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <flux:button type="submit" variant="outline" size="sm" 
                                                       onclick="return confirm('Are you sure you want to delete this event?')">
                                                <flux:icon.trash class="size-4 mr-1" />
                                                Delete
                                            </flux:button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendees Section -->
                    @if($event->requires_rsvp && $event->rsvps()->count() > 0)
                        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Attendees</h3>
                            
                            <div class="space-y-4">
                                <!-- Attending -->
                                @if($event->attendingRsvps()->count() > 0)
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                                Attending ({{ $attendingCount }})
                                            </h4>
                                        </div>
                                        <div class="grid gap-2 sm:grid-cols-2">
                                            @foreach($event->attendingRsvps()->with('user')->get() as $rsvp)
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                                        <span class="text-xs font-medium text-green-800 dark:text-green-200">
                                                            {{ substr($rsvp->user->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <span class="text-sm text-gray-900 dark:text-white">{{ $rsvp->user->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Maybe -->
                                @if($event->maybeRsvps()->count() > 0)
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                                Maybe ({{ $maybeCount }})
                                            </h4>
                                        </div>
                                        <div class="grid gap-2 sm:grid-cols-2">
                                            @foreach($event->maybeRsvps()->with('user')->get() as $rsvp)
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                                        <span class="text-xs font-medium text-yellow-800 dark:text-yellow-200">
                                                            {{ substr($rsvp->user->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                    <span class="text-sm text-gray-900 dark:text-white">{{ $rsvp->user->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- RSVP Section -->
                    @if($event->requires_rsvp && $event->isUpcoming())
                        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">RSVP</h3>
                            
                            @auth
                                @if($userRsvp)
                                    <!-- Current RSVP Status -->
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Your RSVP Status:</p>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            @if($userRsvp->status === 'attending') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @elseif($userRsvp->status === 'maybe') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $userRsvp->status)) }}
                                        </span>
                                    </div>

                                    @if($userRsvp->notes)
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Your Notes:</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $userRsvp->notes }}</p>
                                        </div>
                                    @endif
                                @endif

                                <!-- RSVP Form -->
                                <form action="{{ route('events.rsvp', $event) }}" method="POST" class="space-y-4">
                                    @csrf
                                    
                                    <div>
                                        <flux:field>
                                            <flux:label>RSVP Status</flux:label>
                                            <flux:select name="status" required>
                                                <option value="attending" {{ $userRsvp?->status === 'attending' ? 'selected' : '' }}>Attending</option>
                                                <option value="maybe" {{ $userRsvp?->status === 'maybe' ? 'selected' : '' }}>Maybe</option>
                                                <option value="not_attending" {{ $userRsvp?->status === 'not_attending' ? 'selected' : '' }}>Not Attending</option>
                                            </flux:select>
                                        </flux:field>
                                    </div>

                                    <div>
                                        <flux:field>
                                            <flux:label>Notes (Optional)</flux:label>
                                            <flux:textarea name="notes" rows="3" placeholder="Any additional notes...">{{ $userRsvp?->notes }}</flux:textarea>
                                        </flux:field>
                                    </div>

                                    <div class="flex space-x-2">
                                        <flux:button type="submit" variant="primary" class="flex-1">
                                            Update RSVP
                                        </flux:button>
                                        
                                        @if($userRsvp)
                                            <form action="{{ route('events.cancel-rsvp', $event) }}" method="POST" class="inline">
                                                @csrf
                                                <flux:button type="submit" variant="outline">
                                                    Cancel
                                                </flux:button>
                                            </form>
                                        @endif
                                    </div>
                                </form>
                            @else
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    Please <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500">login</a> to RSVP for this event.
                                </p>
                            @endauth
                        </div>
                    @endif

                    <!-- Event Stats -->
                    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Event Stats</h3>
                        
                        <div class="space-y-4">
                            @if($event->requires_rsvp)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Attending</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $attendingCount }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Maybe</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $maybeCount }}</span>
                                </div>
                                
                                @if($event->max_attendees)
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Capacity</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $event->max_attendees }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Spots Left</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                                            @if($event->spots_remaining === -1)
                                                Unlimited
                                            @else
                                                {{ $event->spots_remaining }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Created</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $event->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    @if($event->contact_email)
                        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Contact</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Have questions about this event?</p>
                            <a href="mailto:{{ $event->contact_email }}" class="text-blue-600 hover:text-blue-500 text-sm">
                                {{ $event->contact_email }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
