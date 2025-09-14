<x-layouts.app :title="__($tutor->user->name . ' - ' . $tutor->subject . ' Tutor')">
    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Tutor Header -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-blue-600 p-6 text-white">
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                            {{ substr($tutor->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold">{{ $tutor->user->name }}</h1>
                            <p class="text-green-100 text-lg">{{ $tutor->subject }} Tutor</p>
                            <div class="flex items-center gap-4 mt-2">
                                <div class="flex items-center gap-1">
                                    <flux:icon.star class="size-5 text-yellow-300" />
                                    <span class="font-semibold">{{ number_format($tutor->rating, 1) }}</span>
                                    <span class="text-green-100">({{ $tutor->total_sessions }} sessions)</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <flux:icon.map-pin class="size-4" />
                                    <span>{{ $tutor->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold">${{ number_format($tutor->hourly_rate, 2) }}</div>
                        <div class="text-green-100">per hour</div>
                        @if($tutor->offers_free_session)
                            <div class="mt-2 px-3 py-1 bg-green-400 text-green-900 rounded-full text-sm font-medium">
                                Free Trial Available
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="flex gap-4">
                    @if($tutor->user_id !== auth()->id())
                        <a href="{{ route('tutors.book', $tutor) }}" 
                           class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium">
                            Book a Session
                        </a>
                    @endif
                    <a href="{{ route('tutors.index') }}" 
                       class="border border-neutral-300 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 px-6 py-3 rounded-lg hover:bg-neutral-50 dark:hover:bg-zinc-700 transition-colors font-medium">
                        Back to Tutors
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- About Section -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h2 class="text-xl font-semibold mb-4">About {{ $tutor->user->name }}</h2>
                    <div class="prose dark:prose-invert max-w-none">
                        <p class="text-neutral-700 dark:text-neutral-300 leading-relaxed">
                            {{ $tutor->description }}
                        </p>
                    </div>
                </div>

                <!-- Qualifications -->
                @if($tutor->qualifications)
                    <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
                            <flux:icon.academic-cap class="size-5 text-blue-600" />
                            Qualifications & Experience
                        </h2>
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-neutral-700 dark:text-neutral-300 leading-relaxed">
                                {{ $tutor->qualifications }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Availability -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
                        <flux:icon.clock class="size-5 text-green-600" />
                        Availability
                    </h2>
                    <div class="grid gap-3 md:grid-cols-2">
                        @php
                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                            $dayNames = [
                                'monday' => 'Monday',
                                'tuesday' => 'Tuesday', 
                                'wednesday' => 'Wednesday',
                                'thursday' => 'Thursday',
                                'friday' => 'Friday',
                                'saturday' => 'Saturday',
                                'sunday' => 'Sunday'
                            ];
                        @endphp
                        
                        @foreach($days as $day)
                            @if(isset($tutor->availability[$day]) && count($tutor->availability[$day]) > 0)
                                <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-3">
                                    <h4 class="font-medium text-sm mb-2">{{ $dayNames[$day] }}</h4>
                                    <div class="space-y-1">
                                        @foreach($tutor->availability[$day] as $timeSlot)
                                            <span class="inline-block bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded">
                                                {{ $timeSlot }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Info -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="font-semibold mb-4">Quick Info</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">Hourly Rate</span>
                            <span class="font-semibold text-green-600">${{ number_format($tutor->hourly_rate, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">Rating</span>
                            <div class="flex items-center gap-1">
                                <flux:icon.star class="size-4 text-yellow-500" />
                                <span class="font-semibold">{{ number_format($tutor->rating, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">Sessions Completed</span>
                            <span class="font-semibold">{{ $tutor->total_sessions }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">Location</span>
                            <span class="font-semibold">{{ $tutor->location }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">Status</span>
                            <span class="px-2 py-1 text-xs rounded-full {{ $tutor->is_available ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                {{ $tutor->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                @if($tutor->bookings->count() > 0)
                    <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                        <h3 class="font-semibold mb-4">Recent Sessions</h3>
                        <div class="space-y-3">
                            @foreach($tutor->bookings->take(3) as $booking)
                                <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-3">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium">{{ $booking->student->name }}</span>
                                        <span class="text-xs px-2 py-1 rounded-full 
                                            {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                               ($booking->status === 'confirmed' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 
                                               'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-neutral-600 dark:text-neutral-400">
                                        {{ $booking->scheduled_time->format('M j, Y g:i A') }} • {{ $booking->duration_minutes }}min
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Contact Info -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                    <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-3">📞 Ready to Learn?</h3>
                    <p class="text-sm text-blue-800 dark:text-blue-200 mb-4">
                        Book a session with {{ $tutor->user->name }} to get personalized help in {{ $tutor->subject }}.
                    </p>
                    @if($tutor->user_id !== auth()->id())
                        <a href="{{ route('tutors.book', $tutor) }}" 
                           class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            Book Now
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
