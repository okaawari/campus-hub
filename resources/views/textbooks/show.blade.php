<x-layouts.app :title="$textbook->title">
    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-neutral-600 dark:text-neutral-400">
            <a href="{{ route('textbooks.index') }}" class="hover:text-blue-600 dark:hover:text-blue-400">Textbooks</a>
            <flux:icon.chevron-right class="size-4" />
            <span class="text-neutral-900 dark:text-neutral-100">{{ $textbook->title }}</span>
        </nav>

        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Textbook Header -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100 mb-2">{{ $textbook->title }}</h1>
                            <p class="text-xl text-neutral-600 dark:text-neutral-400 mb-2">{{ $textbook->author }}</p>
                            @if($textbook->edition)
                                <p class="text-sm text-neutral-500 dark:text-neutral-500">{{ $textbook->edition }}</p>
                            @endif
                        </div>
                        <div class="flex flex-col gap-2">
                            @if($textbook->listing_type === 'sale')
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full dark:bg-green-900 dark:text-green-300">
                                    For Sale
                                </span>
                            @elseif($textbook->listing_type === 'exchange')
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    Exchange
                                </span>
                            @elseif($textbook->listing_type === 'rent')
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full dark:bg-purple-900 dark:text-purple-300">
                                    For Rent
                                </span>
                            @endif
                            <span class="px-3 py-1 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-full dark:bg-neutral-700 dark:text-neutral-300">
                                {{ ucfirst($textbook->condition) }}
                            </span>
                        </div>
                    </div>

                    <!-- Price Section -->
                    <div class="bg-gradient-to-r from-green-50 to-blue-50 dark:from-green-900/20 dark:to-blue-900/20 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                @if($textbook->listing_type === 'sale' || $textbook->listing_type === 'rent')
                                    <div class="text-3xl font-bold text-green-600 dark:text-green-400">${{ number_format($textbook->price, 2) }}</div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">
                                        {{ $textbook->listing_type === 'sale' ? 'One-time purchase' : 'Per semester' }}
                                    </div>
                                @else
                                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">Exchange</div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">Looking for similar textbooks</div>
                                @endif
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-neutral-600 dark:text-neutral-400">Listed</div>
                                <div class="font-medium">{{ $textbook->created_at->format('M j, Y') }}</div>
                            </div>
                        </div>
                    </div>

                    @if($textbook->description)
                        <div class="prose dark:prose-invert max-w-none">
                            <h3 class="text-lg font-semibold mb-3">Description</h3>
                            <p class="text-neutral-700 dark:text-neutral-300 leading-relaxed">{{ $textbook->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Textbook Details -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="text-lg font-semibold mb-4">Book Details</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        @if($textbook->isbn)
                            <div class="flex items-center gap-3">
                                <flux:icon.identification class="size-5 text-neutral-500" />
                                <div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">ISBN</div>
                                    <div class="font-mono text-sm">{{ $textbook->isbn }}</div>
                                </div>
                            </div>
                        @endif

                        @if($textbook->course_code)
                            <div class="flex items-center gap-3">
                                <flux:icon.academic-cap class="size-5 text-neutral-500" />
                                <div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">Course Code</div>
                                    <div class="font-medium">{{ $textbook->course_code }}</div>
                                </div>
                            </div>
                        @endif

                        @if($textbook->subject)
                            <div class="flex items-center gap-3">
                                <flux:icon.book-open-text class="size-5 text-neutral-500" />
                                <div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">Subject</div>
                                    <div class="font-medium">{{ $textbook->subject }}</div>
                                </div>
                            </div>
                        @endif

                        @if($textbook->edition)
                            <div class="flex items-center gap-3">
                                <flux:icon.document-text class="size-5 text-neutral-500" />
                                <div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">Edition</div>
                                    <div class="font-medium">{{ $textbook->edition }}</div>
                                </div>
                            </div>
                        @endif

                        @if($textbook->condition)
                            <div class="flex items-center gap-3">
                                <flux:icon.shield-check class="size-5 text-neutral-500" />
                                <div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">Condition</div>
                                    <div class="font-medium">{{ ucfirst($textbook->condition) }}</div>
                                </div>
                            </div>
                        @endif

                        @if($textbook->location)
                            <div class="flex items-center gap-3">
                                <flux:icon.map-pin class="size-5 text-neutral-500" />
                                <div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">Location</div>
                                    <div class="font-medium">{{ $textbook->location }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if($textbook->images && count($textbook->images) > 0)
                    <!-- Images Section -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                        <h3 class="text-lg font-semibold mb-4">Images</h3>
                        <div class="grid gap-4 md:grid-cols-2">
                            @foreach($textbook->images as $image)
                                <div class="aspect-[3/4] bg-neutral-100 dark:bg-neutral-700 rounded-lg overflow-hidden">
                                    <img src="{{ $image }}" alt="{{ $textbook->title }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
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
                    
                    <div class="space-y-3">
                        <a href="{{ route('textbooks.contact', $textbook) }}" 
                           class="w-full bg-green-600 text-white text-center py-3 px-4 rounded-lg hover:bg-green-700 transition-colors font-medium">
                            Contact Seller
                        </a>
                        
                        @if($textbook->listing_type === 'sale' || $textbook->listing_type === 'rent')
                            <a href="{{ route('textbooks.contact', $textbook) }}?action=purchase" 
                               class="w-full bg-blue-600 text-white text-center py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                Make Offer
                            </a>
                        @endif
                    </div>
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
