<x-layouts.app :title="__('Book Session with ' . $tutor->user->name)">
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-500 to-blue-600 rounded-xl p-6 text-white">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-xl">
                    {{ substr($tutor->user->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Book Session with {{ $tutor->user->name }}</h1>
                    <p class="text-green-100">{{ $tutor->subject }} • ${{ number_format($tutor->hourly_rate, 2) }}/hour</p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h2 class="text-xl font-semibold mb-6">Schedule Your Session</h2>
                    
                    <form action="{{ route('tutors.store-booking', $tutor) }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Date and Time -->
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <flux:field>
                                    <flux:label for="scheduled_time">Date & Time *</flux:label>
                                    <flux:input 
                                        id="scheduled_time" 
                                        name="scheduled_time" 
                                        type="datetime-local" 
                                        value="{{ old('scheduled_time') }}"
                                        min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                                        required
                                    />
                                    <flux:error name="scheduled_time" />
                                    <flux:description>Select a date and time for your session</flux:description>
                                </flux:field>
                            </div>
                            
                            <div>
                                <flux:field>
                                    <flux:label for="duration_minutes">Duration *</flux:label>
                                    <flux:select id="duration_minutes" name="duration_minutes" required>
                                        <option value="">Select duration</option>
                                        <option value="30" {{ old('duration_minutes') == '30' ? 'selected' : '' }}>30 minutes - ${{ number_format($tutor->hourly_rate * 0.5, 2) }}</option>
                                        <option value="60" {{ old('duration_minutes') == '60' ? 'selected' : '' }}>1 hour - ${{ number_format($tutor->hourly_rate, 2) }}</option>
                                        <option value="90" {{ old('duration_minutes') == '90' ? 'selected' : '' }}>1.5 hours - ${{ number_format($tutor->hourly_rate * 1.5, 2) }}</option>
                                        <option value="120" {{ old('duration_minutes') == '120' ? 'selected' : '' }}>2 hours - ${{ number_format($tutor->hourly_rate * 2, 2) }}</option>
                                    </flux:select>
                                    <flux:error name="duration_minutes" />
                                </flux:field>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <flux:field>
                                <flux:label for="notes">Session Notes (Optional)</flux:label>
                                <flux:textarea 
                                    id="notes" 
                                    name="notes" 
                                    rows="4"
                                    placeholder="Describe what you'd like to focus on during the session, specific topics you need help with, or any questions you have..."
                                >{{ old('notes') }}</flux:textarea>
                                <flux:error name="notes" />
                                <flux:description>Help the tutor prepare for your session by sharing your learning goals</flux:description>
                            </flux:field>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="bg-neutral-50 dark:bg-zinc-700 rounded-lg p-4">
                            <h3 class="font-medium mb-2">Session Terms</h3>
                            <ul class="text-sm text-neutral-600 dark:text-neutral-400 space-y-1">
                                <li>• Sessions are billed at ${{ number_format($tutor->hourly_rate, 2) }} per hour</li>
                                <li>• Payment will be processed after the session is completed</li>
                                <li>• You can cancel up to 24 hours before the session for a full refund</li>
                                <li>• The tutor will confirm your booking within 24 hours</li>
                                @if($tutor->offers_free_session)
                                    <li>• This tutor offers a free trial session for new students</li>
                                @endif
                            </ul>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                            <flux:button type="submit" variant="primary" class="flex-1">
                                Request Booking
                            </flux:button>
                            <a href="{{ route('tutors.show', $tutor) }}" class="flex-1">
                                <flux:button type="button" variant="ghost" class="w-full">
                                    Cancel
                                </flux:button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tutor Info Sidebar -->
            <div class="space-y-6">
                <!-- Tutor Summary -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="font-semibold mb-4">Tutor Information</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr($tutor->user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-medium">{{ $tutor->user->name }}</div>
                                <div class="text-sm text-neutral-600 dark:text-neutral-400">{{ $tutor->subject }}</div>
                            </div>
                        </div>
                        
                        <div class="space-y-2 pt-3 border-t border-neutral-200 dark:border-neutral-700">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-neutral-600 dark:text-neutral-400">Rating</span>
                                <div class="flex items-center gap-1">
                                    <flux:icon.star class="size-4 text-yellow-500" />
                                    <span class="font-medium">{{ number_format($tutor->rating, 1) }}</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-neutral-600 dark:text-neutral-400">Sessions</span>
                                <span class="font-medium">{{ $tutor->total_sessions }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-neutral-600 dark:text-neutral-400">Location</span>
                                <span class="font-medium">{{ $tutor->location }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Availability -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="font-semibold mb-4">Availability</h3>
                    <div class="space-y-2">
                        @php
                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                            $dayNames = [
                                'monday' => 'Mon', 'tuesday' => 'Tue', 'wednesday' => 'Wed', 
                                'thursday' => 'Thu', 'friday' => 'Fri', 'saturday' => 'Sat', 'sunday' => 'Sun'
                            ];
                        @endphp
                        
                        @foreach($days as $day)
                            @if(isset($tutor->availability[$day]) && count($tutor->availability[$day]) > 0)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="font-medium">{{ $dayNames[$day] }}</span>
                                    <div class="flex gap-1">
                                        @foreach($tutor->availability[$day] as $timeSlot)
                                            <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs rounded">
                                                {{ $timeSlot }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Help Section -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                    <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-3">💡 Need Help?</h3>
                    <ul class="space-y-2 text-sm text-blue-800 dark:text-blue-200">
                        <li>• Choose a time that works for both you and the tutor</li>
                        <li>• Be specific about what you want to learn</li>
                        <li>• The tutor will confirm your booking soon</li>
                        <li>• You'll receive meeting details after confirmation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
