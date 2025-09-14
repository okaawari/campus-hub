<x-layouts.app :title="$studyMaterial->title">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $studyMaterial->title }}</h1>
                <p class="text-neutral-600 dark:text-neutral-400">{{ $studyMaterial->subject }} • {{ $studyMaterial->downloads }} downloads</p>
            </div>
            <div class="flex gap-2">
                <flux:button variant="outline" :href="route('study-materials.index')" icon="arrow-left">
                    Back to Materials
                </flux:button>
                <flux:button :href="route('study-materials.download', $studyMaterial)" icon="arrow-down-tray">
                    Download
                </flux:button>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Material Details -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h2 class="text-lg font-semibold mb-4">Material Details</h2>
                    
                    @if($studyMaterial->description)
                        <div class="mb-4">
                            <h3 class="font-medium mb-2">Description</h3>
                            <p class="text-neutral-600 dark:text-neutral-400">{{ $studyMaterial->description }}</p>
                        </div>
                    @endif

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <h3 class="font-medium mb-2">Course Information</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center gap-2">
                                    <flux:icon.academic-cap class="size-4 text-neutral-500" />
                                    <span>{{ $studyMaterial->subject }}</span>
                                </div>
                                @if($studyMaterial->course_code)
                                    <div class="flex items-center gap-2">
                                        <flux:icon.book-open class="size-4 text-neutral-500" />
                                        <span>{{ $studyMaterial->course_code }}</span>
                                    </div>
                                @endif
                                @if($studyMaterial->professor)
                                    <div class="flex items-center gap-2">
                                        <flux:icon.user class="size-4 text-neutral-500" />
                                        <span>{{ $studyMaterial->professor }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="font-medium mb-2">File Information</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center gap-2">
                                    <flux:icon.document class="size-4 text-neutral-500" />
                                    <span>{{ $studyMaterial->file_name }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <flux:icon.arrow-down-tray class="size-4 text-neutral-500" />
                                    <span>{{ $studyMaterial->downloads }} downloads</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <flux:icon.calendar-days class="size-4 text-neutral-500" />
                                    <span>{{ $studyMaterial->created_at->format('M j, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ratings and Reviews -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h2 class="text-lg font-semibold mb-4">Ratings & Reviews</h2>
                    
                    @if($studyMaterial->ratings->count() > 0)
                        <div class="space-y-4">
                            @foreach($studyMaterial->ratings as $rating)
                                <div class="border-b border-neutral-200 dark:border-neutral-700 pb-4 last:border-b-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-2">
                                            <div class="size-8 bg-neutral-200 dark:bg-neutral-700 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-medium">{{ substr($rating->user->name, 0, 1) }}</span>
                                            </div>
                                            <span class="font-medium">{{ $rating->user->name }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <flux:icon.star class="size-4 {{ $i <= $rating->rating ? 'text-yellow-500' : 'text-neutral-300' }}" />
                                            @endfor
                                        </div>
                                    </div>
                                    @if($rating->comment)
                                        <p class="text-neutral-600 dark:text-neutral-400 text-sm">{{ $rating->comment }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-neutral-600 dark:text-neutral-400">No ratings yet. Be the first to rate this material!</p>
                    @endif

                    <!-- Rating Form -->
                    <div class="mt-6 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                        <h3 class="font-medium mb-3">Rate this material</h3>
                        <form method="POST" action="{{ route('study-materials.rate', $studyMaterial) }}" class="space-y-4">
                            @csrf
                            <div>
                                <flux:label>Rating</flux:label>
                                <flux:radio.group name="rating" class="flex gap-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <flux:radio value="{{ $i }}" />
                                    @endfor
                                </flux:radio.group>
                                @error('rating')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </div>
                            <flux:field>
                                <flux:label>Comment (optional)</flux:label>
                                <flux:textarea name="comment" placeholder="Share your thoughts about this material..." rows="3"></flux:textarea>
                                @error('comment')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                            <flux:button type="submit" size="sm">Submit Rating</flux:button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Uploader Info -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="font-semibold mb-4">Uploaded by</h3>
                    <div class="flex items-center gap-3">
                        <div class="size-12 bg-neutral-200 dark:bg-neutral-700 rounded-full flex items-center justify-center">
                            <span class="text-lg font-medium">{{ substr($studyMaterial->user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-medium">{{ $studyMaterial->user->name }}</p>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">Member since {{ $studyMaterial->user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="font-semibold mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <flux:button :href="route('study-materials.download', $studyMaterial)" icon="arrow-down-tray" class="w-full">
                            Download File
                        </flux:button>
                        <flux:button variant="outline" icon="heart" class="w-full">
                            Add to Favorites
                        </flux:button>
                        <flux:button variant="outline" icon="share" class="w-full">
                            Share
                        </flux:button>
                    </div>
                </div>

                <!-- Material Stats -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="font-semibold mb-4">Statistics</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">Downloads</span>
                            <span class="font-medium">{{ $studyMaterial->downloads }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">Rating</span>
                            <div class="flex items-center gap-1">
                                <flux:icon.star class="size-4 text-yellow-500" />
                                <span class="font-medium">{{ number_format($studyMaterial->rating, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">Reviews</span>
                            <span class="font-medium">{{ $studyMaterial->ratings->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
