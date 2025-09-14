<x-layouts.app :title="__('Contact Seller')">
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100 mb-2">Contact Seller 📞</h1>
            <p class="text-neutral-600 dark:text-neutral-400">Get in touch about this textbook</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h2 class="text-xl font-semibold mb-4">Send Message</h2>
                    
                    <form action="{{ route('textbooks.contact', $textbook) }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid gap-6 md:grid-cols-2">
                            <!-- Subject -->
                            <div class="md:col-span-2">
                                <flux:field>
                                    <flux:label>Subject *</flux:label>
                                    <flux:input name="subject" value="{{ old('subject', 'Inquiry about ' . $textbook->title) }}" required />
                                    <flux:error name="subject" />
                                </flux:field>
                            </div>

                            <!-- Message -->
                            <div class="md:col-span-2">
                                <flux:field>
                                    <flux:label>Message *</flux:label>
                                    <flux:textarea name="message" rows="6" placeholder="Hi! I'm interested in your textbook..." required>{{ old('message') }}</flux:textarea>
                                    <flux:error name="message" />
                                </flux:field>
                            </div>

                            <!-- Contact Method -->
                            <div class="md:col-span-2">
                                <flux:field>
                                    <flux:label>Preferred Contact Method</flux:label>
                                    <flux:select name="contact_method">
                                        <option value="email" {{ old('contact_method') === 'email' ? 'selected' : '' }}>Email</option>
                                        <option value="phone" {{ old('contact_method') === 'phone' ? 'selected' : '' }}>Phone</option>
                                        <option value="campus_hub" {{ old('contact_method') === 'campus_hub' ? 'selected' : '' }}>Campus Hub Messages</option>
                                    </flux:select>
                                    <flux:error name="contact_method" />
                                </flux:field>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('textbooks.show', $textbook) }}" 
                               class="px-6 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-colors">
                                Cancel
                            </a>
                            <flux:button type="submit" variant="primary" class="px-6 py-2">
                                Send Message
                            </flux:button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Textbook Info -->
            <div class="space-y-6">
                <!-- Textbook Summary -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="text-lg font-semibold mb-4">Textbook Details</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-16 h-20 bg-neutral-100 dark:bg-neutral-700 rounded-lg flex items-center justify-center">
                                <flux:icon.book-open-text class="size-8 text-neutral-400" />
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold line-clamp-2">{{ $textbook->title }}</h4>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $textbook->author }}</p>
                                @if($textbook->listing_type === 'sale' || $textbook->listing_type === 'rent')
                                    <p class="text-sm font-medium text-green-600 dark:text-green-400">${{ number_format($textbook->price, 2) }}</p>
                                @else
                                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Exchange</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="space-y-2 text-sm">
                            @if($textbook->course_code)
                                <div class="flex items-center gap-2">
                                    <flux:icon.academic-cap class="size-4 text-neutral-500" />
                                    <span>{{ $textbook->course_code }}</span>
                                </div>
                            @endif
                            
                            <div class="flex items-center gap-2">
                                <flux:icon.shield-check class="size-4 text-neutral-500" />
                                <span>{{ ucfirst($textbook->condition) }} Condition</span>
                            </div>
                            
                            @if($textbook->location)
                                <div class="flex items-center gap-2">
                                    <flux:icon.map-pin class="size-4 text-neutral-500" />
                                    <span>{{ $textbook->location }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Seller Info -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="text-lg font-semibold mb-4">Seller Information</h3>
                    
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($textbook->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-semibold">{{ $textbook->user->name }}</div>
                            <div class="text-sm text-neutral-600 dark:text-neutral-400">Member since {{ $textbook->user->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('textbooks.show', $textbook) }}" 
                       class="w-full bg-neutral-100 dark:bg-neutral-700 text-neutral-700 dark:text-neutral-300 text-center py-2 px-4 rounded-lg hover:bg-neutral-200 dark:hover:bg-neutral-600 transition-colors text-sm">
                        View Full Listing
                    </a>
                </div>

                <!-- Safety Tips -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800 p-6">
                    <h3 class="text-lg font-semibold mb-4 text-blue-900 dark:text-blue-100">Safety Tips</h3>
                    <ul class="space-y-2 text-sm text-blue-800 dark:text-blue-200">
                        <li class="flex items-start gap-2">
                            <flux:icon.shield-check class="size-4 mt-0.5 flex-shrink-0" />
                            <span>Meet in a public place on campus</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <flux:icon.eye class="size-4 mt-0.5 flex-shrink-0" />
                            <span>Inspect the book thoroughly before purchase</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <flux:icon.chat-bubble-left-right class="size-4 mt-0.5 flex-shrink-0" />
                            <span>Ask questions about condition and usage</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <flux:icon.document-text class="size-4 mt-0.5 flex-shrink-0" />
                            <span>Get a receipt or confirmation</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
