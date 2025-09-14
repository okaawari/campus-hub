<div class="flex h-full w-full flex-1 flex-col gap-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Campus Forum 💬</h1>
                <p class="text-purple-100">Connect with your peers, ask questions, and share knowledge across all subjects.</p>
            </div>
            <div class="hidden md:block">
                <flux:icon.chat-bubble-left-right class="size-16 text-purple-200" />
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid gap-4 md:grid-cols-4">
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-neutral-200 dark:border-neutral-700">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                    <flux:icon.chat-bubble-left-right class="size-5 text-blue-600 dark:text-blue-400" />
                </div>
                <div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Total Posts</p>
                    <p class="text-lg font-semibold">{{ \App\Models\ForumPost::whereNull('parent_id')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-neutral-200 dark:border-neutral-700">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                    <flux:icon.check-circle class="size-5 text-green-600 dark:text-green-400" />
                </div>
                <div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Solved Questions</p>
                    <p class="text-lg font-semibold">{{ \App\Models\ForumPost::where('is_solved', true)->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-neutral-200 dark:border-neutral-700">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                    <flux:icon.eye class="size-5 text-yellow-600 dark:text-yellow-400" />
                </div>
                <div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Total Views</p>
                    <p class="text-lg font-semibold">{{ \App\Models\ForumPost::sum('views') }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-4 border border-neutral-200 dark:border-neutral-700">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                    <flux:icon.heart class="size-5 text-purple-600 dark:text-purple-400" />
                </div>
                <div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Total Upvotes</p>
                    <p class="text-lg font-semibold">{{ \App\Models\ForumPost::sum('upvotes') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-neutral-200 dark:border-neutral-700 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <!-- Search -->
            <div>
                <flux:field>
                    <flux:label>Search Posts</flux:label>
                    <flux:input 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Search titles and content..."
                        icon="magnifying-glass"
                    />
                </flux:field>
            </div>

            <!-- Category Filter -->
            <div>
                <flux:field>
                    <flux:label>Category</flux:label>
                    <flux:select wire:model.live="category">
                        <option value="">All Categories</option>
                        @foreach($categories as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </flux:select>
                </flux:field>
            </div>

            <!-- Subject Filter -->
            <div>
                <flux:field>
                    <flux:label>Subject</flux:label>
                    <flux:select wire:model.live="subject">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject }}">{{ $subject }}</option>
                        @endforeach
                    </flux:select>
                </flux:field>
            </div>

            <!-- Sort By -->
            <div>
                <flux:field>
                    <flux:label>Sort By</flux:label>
                    <flux:select wire:model.live="sortBy">
                        @foreach($sortOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </flux:select>
                </flux:field>
            </div>
        </div>

        <!-- Active Filters and Actions -->
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
            <div class="flex flex-wrap gap-2">
                @if($search || $category || $subject)
                    <flux:badge variant="outline" class="cursor-pointer" wire:click="clearFilters">
                        <flux:icon.x-mark class="size-3" />
                        Clear Filters
                    </flux:badge>
                @endif
                
                @if($search)
                    <flux:badge variant="info">
                        Search: "{{ $search }}"
                    </flux:badge>
                @endif
                
                @if($category)
                    <flux:badge variant="success">
                        Category: {{ ucfirst($category) }}
                    </flux:badge>
                @endif
                
                @if($subject)
                    <flux:badge variant="warning">
                        Subject: {{ $subject }}
                    </flux:badge>
                @endif
            </div>
            
            <flux:button href="{{ route('forum.create') }}" variant="primary" class="w-full sm:w-auto">
                <flux:icon.plus class="size-4" />
                New Post
            </flux:button>
        </div>
    </div>

    <!-- Forum Posts -->
    <div class="space-y-4">
        @forelse($posts as $post)
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-neutral-200 dark:border-neutral-700 hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                @if($post->is_pinned)
                                    <flux:icon.star class="size-4 text-yellow-500" />
                                @endif
                                @if($post->is_solved)
                                    <flux:icon.check-circle class="size-4 text-green-500" />
                                @endif
                                <flux:badge 
                                    variant="{{ $post->category === 'question' ? 'success' : ($post->category === 'announcement' ? 'warning' : 'outline') }}"
                                    class="text-xs"
                                >
                                    {{ ucfirst($post->category) }}
                                </flux:badge>
                                @if($post->subject)
                                    <flux:badge variant="outline" class="text-xs">
                                        {{ $post->subject }}
                                    </flux:badge>
                                @endif
                                @if($post->course_code)
                                    <flux:badge variant="outline" class="text-xs">
                                        {{ $post->course_code }}
                                    </flux:badge>
                                @endif
                            </div>
                            
                            <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-2">
                                <a href="{{ route('forum.show', $post) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2">
                                {{ Str::limit($post->content, 150) }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between text-sm text-neutral-500 dark:text-neutral-400">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">
                                <flux:icon.user class="size-4" />
                                <span>{{ $post->user->name }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:icon.clock class="size-4" />
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:icon.eye class="size-4" />
                                <span>{{ $post->views }} views</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:icon.chat-bubble-left-right class="size-4" />
                                <span>{{ $post->replies->count() }} replies</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-1 text-green-600 dark:text-green-400">
                                <flux:icon.heart class="size-4" />
                                <span>{{ $post->upvotes }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <flux:icon.chat-bubble-left-right class="size-16 text-neutral-400 mx-auto mb-4" />
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-2">
                    @if($search || $category || $subject)
                        No posts found matching your criteria
                    @else
                        No posts yet
                    @endif
                </h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-6">
                    @if($search || $category || $subject)
                        Try adjusting your search terms or filters.
                    @else
                        Be the first to start a discussion in the campus forum!
                    @endif
                </p>
                <flux:button href="{{ route('forum.create') }}" variant="primary">
                    <flux:icon.plus class="size-4" />
                    Create First Post
                </flux:button>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
