<x-layouts.app :title="__('Edit Event')">
    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                    <li><a href="{{ route('events.index') }}" class="hover:text-gray-900 dark:hover:text-white">Events</a></li>
                    <li><flux:icon.chevron-right class="size-4" /></li>
                    <li><a href="{{ route('events.show', $event) }}" class="hover:text-gray-900 dark:hover:text-white">{{ $event->title }}</a></li>
                    <li><flux:icon.chevron-right class="size-4" /></li>
                    <li class="text-gray-900 dark:text-white">Edit</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Event</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Update your event details</p>
            </div>

            <!-- Edit Event Form -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <form action="{{ route('events.update', $event) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Event Title -->
                    <div>
                        <flux:field>
                            <flux:label>Event Title</flux:label>
                            <flux:input name="title" placeholder="Enter event title..." value="{{ old('title', $event->title) }}" required />
                            @error('title')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Event Description -->
                    <div>
                        <flux:field>
                            <flux:label>Description</flux:label>
                            <flux:textarea name="description" rows="4" placeholder="Describe your event..." required>{{ old('description', $event->description) }}</flux:textarea>
                            @error('description')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Date and Time -->
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <flux:field>
                                <flux:label>Start Date & Time</flux:label>
                                <flux:input name="start_time" type="datetime-local" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" required />
                                @error('start_time')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                        </div>

                        <div>
                            <flux:field>
                                <flux:label>End Date & Time</flux:label>
                                <flux:input name="end_time" type="datetime-local" value="{{ old('end_time', $event->end_time->format('Y-m-d\TH:i')) }}" required />
                                @error('end_time')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                        </div>
                    </div>

                    <!-- Location and Organizer -->
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <flux:field>
                                <flux:label>Location</flux:label>
                                <flux:input name="location" placeholder="Where will the event take place?" value="{{ old('location', $event->location) }}" required />
                                @error('location')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                        </div>

                        <div>
                            <flux:field>
                                <flux:label>Organizer</flux:label>
                                <flux:input name="organizer" placeholder="Club, department, or organization" value="{{ old('organizer', $event->organizer) }}" required />
                                @error('organizer')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                        </div>
                    </div>

                    <!-- Category -->
                    <div>
                        <flux:field>
                            <flux:label>Category</flux:label>
                            <flux:select name="category" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}" {{ old('category', $event->category) === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </flux:select>
                            @error('category')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- RSVP Settings -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">RSVP Settings</h3>
                        
                        <div class="flex items-center">
                            <flux:checkbox name="requires_rsvp" :checked="old('requires_rsvp', $event->requires_rsvp)" />
                            <flux:label class="ml-2">Require RSVP for this event</flux:label>
                        </div>

                        <div id="rsvp-details" class="space-y-4" style="display: {{ old('requires_rsvp', $event->requires_rsvp) ? 'block' : 'none' }};">
                            <div>
                                <flux:field>
                                    <flux:label>Maximum Attendees (Optional)</flux:label>
                                    <flux:input name="max_attendees" type="number" min="1" placeholder="Leave empty for unlimited" value="{{ old('max_attendees', $event->max_attendees) }}" />
                                    @error('max_attendees')
                                        <flux:error>{{ $message }}</flux:error>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field>
                                    <flux:label>Contact Email</flux:label>
                                    <flux:input name="contact_email" type="email" placeholder="Contact email for questions" value="{{ old('contact_email', $event->contact_email) }}" />
                                    @error('contact_email')
                                        <flux:error>{{ $message }}</flux:error>
                                    @enderror
                                </flux:field>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Additional Options</h3>
                        
                        <div>
                            <flux:field>
                                <flux:label>Event Image URL (Optional)</flux:label>
                                <flux:input name="image_url" type="url" placeholder="https://example.com/image.jpg" value="{{ old('image_url', $event->image_url) }}" />
                                @error('image_url')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                        </div>

                        <div class="flex items-center">
                            <flux:checkbox name="is_featured" :checked="old('is_featured', $event->is_featured)" />
                            <flux:label class="ml-2">Feature this event (makes it more visible)</flux:label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <flux:button href="{{ route('events.show', $event) }}" variant="outline">
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary">
                            Update Event
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle RSVP details visibility
        document.addEventListener('DOMContentLoaded', function() {
            const requiresRsvpCheckbox = document.querySelector('input[name="requires_rsvp"]');
            const rsvpDetails = document.getElementById('rsvp-details');
            
            function toggleRsvpDetails() {
                if (requiresRsvpCheckbox.checked) {
                    rsvpDetails.style.display = 'block';
                } else {
                    rsvpDetails.style.display = 'none';
                }
            }
            
            requiresRsvpCheckbox.addEventListener('change', toggleRsvpDetails);
            toggleRsvpDetails(); // Initial state
        });
    </script>
</x-layouts.app>
