<x-layouts.app :title="__('Become a Tutor')">
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-500 to-blue-600 rounded-xl p-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Become a Tutor 🎓</h1>
            <p class="text-green-100">Share your knowledge and help fellow students while earning money</p>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
            <form action="{{ route('tutors.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Subject -->
                <div>
                    <flux:field>
                        <flux:label for="subject">Subject *</flux:label>
                        <flux:input 
                            id="subject" 
                            name="subject" 
                            value="{{ old('subject') }}" 
                            placeholder="e.g., Mathematics, Computer Science, Physics"
                            required
                        />
                        <flux:error name="subject" />
                    </flux:field>
                </div>

                <!-- Description -->
                <div>
                    <flux:field>
                        <flux:label for="description">Description *</flux:label>
                        <flux:textarea 
                            id="description" 
                            name="description" 
                            rows="4"
                            placeholder="Tell students about your teaching style, experience, and what makes you a great tutor..."
                            required
                        >{{ old('description') }}</flux:textarea>
                        <flux:error name="description" />
                    </flux:field>
                </div>

                <!-- Hourly Rate -->
                <div>
                    <flux:field>
                        <flux:label for="hourly_rate">Hourly Rate (USD) *</flux:label>
                        <flux:input 
                            id="hourly_rate" 
                            name="hourly_rate" 
                            type="number" 
                            step="0.01" 
                            min="0" 
                            max="1000"
                            value="{{ old('hourly_rate') }}" 
                            placeholder="25.00"
                            required
                        />
                        <flux:error name="hourly_rate" />
                        <flux:description>Set a competitive rate that reflects your expertise and experience</flux:description>
                    </flux:field>
                </div>

                <!-- Location -->
                <div>
                    <flux:field>
                        <flux:label for="location">Location *</flux:label>
                        <flux:select id="location" name="location" required>
                            <option value="">Select location</option>
                            <option value="Online" {{ old('location') === 'Online' ? 'selected' : '' }}>Online</option>
                            <option value="On-campus" {{ old('location') === 'On-campus' ? 'selected' : '' }}>On-campus</option>
                            <option value="Library" {{ old('location') === 'Library' ? 'selected' : '' }}>Library</option>
                            <option value="Student Center" {{ old('location') === 'Student Center' ? 'selected' : '' }}>Student Center</option>
                            <option value="Coffee Shop" {{ old('location') === 'Coffee Shop' ? 'selected' : '' }}>Coffee Shop</option>
                            <option value="Other" {{ old('location') === 'Other' ? 'selected' : '' }}>Other</option>
                        </flux:select>
                        <flux:error name="location" />
                    </flux:field>
                </div>

                <!-- Qualifications -->
                <div>
                    <flux:field>
                        <flux:label for="qualifications">Qualifications & Experience</flux:label>
                        <flux:textarea 
                            id="qualifications" 
                            name="qualifications" 
                            rows="3"
                            placeholder="e.g., Computer Science major, 3+ years tutoring experience, TA for Data Structures course..."
                        >{{ old('qualifications') }}</flux:textarea>
                        <flux:error name="qualifications" />
                        <flux:description>Highlight your academic background, teaching experience, and relevant achievements</flux:description>
                    </flux:field>
                </div>

                <!-- Availability -->
                <div>
                    <flux:field>
                        <flux:label>Availability *</flux:label>
                        <div class="grid gap-3 md:grid-cols-2">
                            @php
                                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                $timeSlots = [
                                    '9:00-12:00' => 'Morning (9:00 AM - 12:00 PM)',
                                    '12:00-15:00' => 'Afternoon (12:00 PM - 3:00 PM)',
                                    '15:00-18:00' => 'Late Afternoon (3:00 PM - 6:00 PM)',
                                    '18:00-21:00' => 'Evening (6:00 PM - 9:00 PM)',
                                ];
                            @endphp
                            
                            @foreach($days as $day)
                                <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-4">
                                    <h4 class="font-medium text-sm mb-3 capitalize">{{ $day }}</h4>
                                    <div class="space-y-2">
                                        @foreach($timeSlots as $value => $label)
                                            <label class="flex items-center">
                                                <flux:checkbox 
                                                    name="availability[{{ $day }}][]" 
                                                    value="{{ $value }}"
                                                    {{ in_array($value, old("availability.{$day}", [])) ? 'checked' : '' }}
                                                />
                                                <span class="ml-2 text-sm">{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <flux:error name="availability" />
                        <flux:description>Select the time slots when you're available for tutoring sessions</flux:description>
                    </flux:field>
                </div>

                <!-- Free Session -->
                <div>
                    <flux:field>
                        <flux:checkbox 
                            name="offers_free_session" 
                            value="1"
                            {{ old('offers_free_session') ? 'checked' : '' }}
                        />
                        <flux:label>Offer a free trial session</flux:label>
                        <flux:description>Attract more students by offering a free 30-minute trial session</flux:description>
                    </flux:field>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                    <flux:button type="submit" variant="primary" class="flex-1">
                        Create Tutor Profile
                    </flux:button>
                    <a href="{{ route('tutors.index') }}" class="flex-1">
                        <flux:button type="button" variant="ghost" class="w-full">
                            Cancel
                        </flux:button>
                    </a>
                </div>
            </form>
        </div>

        <!-- Tips Section -->
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
            <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-3">💡 Tips for Success</h3>
            <ul class="space-y-2 text-sm text-blue-800 dark:text-blue-200">
                <li>• Set a competitive hourly rate based on your experience and subject demand</li>
                <li>• Write a detailed description highlighting your teaching style and expertise</li>
                <li>• Be specific about your availability to avoid scheduling conflicts</li>
                <li>• Consider offering a free trial session to attract new students</li>
                <li>• Keep your profile updated and respond promptly to booking requests</li>
            </ul>
        </div>
    </div>
</x-layouts.app>
