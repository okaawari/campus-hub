<x-layouts.app :title="$post->title">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Back Button -->
        <div class="flex items-center gap-4">
            <flux:button 
                href="{{ route('forum.index') }}" 
                variant="outline" 
                size="sm"
            >
                <flux:icon.arrow-left class="size-4" />
                Back to Forum
            </flux:button>
            
            <div class="flex items-center gap-2">
                @if($post->is_pinned)
                    <flux:badge variant="warning" class="text-xs">
                        <flux:icon.star class="size-3" />
                        Pinned
                    </flux:badge>
                @endif
                @if($post->is_solved)
                    <flux:badge variant="success" class="text-xs">
                        <flux:icon.check-circle class="size-3" />
                        Solved
                    </flux:badge>
                @endif
            </div>
        </div>

        <!-- Main Post -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-neutral-200 dark:border-neutral-700">
            <div class="p-6">
                <!-- Post Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-3">
                            <flux:badge 
                                variant="{{ $post->category === 'question' ? 'success' : ($post->category === 'announcement' ? 'warning' : 'outline') }}"
                                class="text-sm"
                            >
                                {{ ucfirst($post->category) }}
                            </flux:badge>
                            @if($post->subject)
                                <flux:badge variant="outline" class="text-sm">
                                    {{ $post->subject }}
                                </flux:badge>
                            @endif
                            @if($post->course_code)
                                <flux:badge variant="outline" class="text-sm">
                                    {{ $post->course_code }}
                                </flux:badge>
                            @endif
                        </div>
                        
                        <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 mb-4">
                            {{ $post->title }}
                        </h1>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="prose dark:prose-invert max-w-none mb-6">
                    <div class="whitespace-pre-wrap text-neutral-700 dark:text-neutral-300">
                        {{ $post->content }}
                    </div>
                </div>

                <!-- Post Meta and Actions -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-4 border-t border-neutral-200 dark:border-neutral-700">
                    <div class="flex items-center gap-4 text-sm text-neutral-500 dark:text-neutral-400">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                {{ $post->user->initials() }}
                            </div>
                            <div>
                                <div class="font-medium text-neutral-900 dark:text-neutral-100">{{ $post->user->name }}</div>
                                <div class="text-xs">{{ $post->created_at->format('M j, Y \a\t g:i A') }}</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">
                                <flux:icon.eye class="size-4" />
                                <span>{{ $post->views }} views</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <flux:icon.chat-bubble-left-right class="size-4" />
                                <span>{{ $post->replies->count() }} replies</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Voting Section -->
                    <div class="flex items-center gap-2">
                        <form action="{{ route('forum.vote', $post) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="type" value="upvote">
                            <flux:button 
                                type="submit" 
                                variant="outline" 
                                size="sm"
                                class="flex items-center gap-1"
                            >
                                <flux:icon.heart class="size-4" />
                                {{ $post->upvotes }}
                            </flux:button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Replies Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-neutral-900 dark:text-neutral-100">
                    Replies ({{ $post->replies->count() }})
                </h2>
            </div>

            @forelse($post->replies as $reply)
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-neutral-200 dark:border-neutral-700">
                    <div class="p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold flex-shrink-0">
                                {{ $reply->user->initials() }}
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="font-medium text-neutral-900 dark:text-neutral-100">{{ $reply->user->name }}</span>
                                    <span class="text-sm text-neutral-500 dark:text-neutral-400">{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <div class="prose dark:prose-invert max-w-none">
                                    <div class="whitespace-pre-wrap text-neutral-700 dark:text-neutral-300">
                                        {{ $reply->content }}
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-2 mt-3">
                                    <form action="{{ route('forum.vote', $reply) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="type" value="upvote">
                                        <flux:button 
                                            type="submit" 
                                            variant="outline" 
                                            size="sm"
                                            class="flex items-center gap-1"
                                        >
                                            <flux:icon.heart class="size-4" />
                                            {{ $reply->upvotes }}
                                        </flux:button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <flux:icon.chat-bubble-left-right class="size-12 text-neutral-400 mx-auto mb-3" />
                    <p class="text-neutral-600 dark:text-neutral-400">No replies yet. Be the first to respond!</p>
                </div>
            @endforelse
        </div>

        <!-- Reply Form -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-neutral-200 dark:border-neutral-700">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100 mb-4">
                    Post a Reply
                </h3>
                
                <form action="{{ route('forum.reply', $post) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <flux:field>
                        <flux:label for="reply_content">Your Reply</flux:label>
                        <flux:textarea 
                            id="reply_content" 
                            name="content" 
                            rows="4"
                            placeholder="Share your thoughts, provide an answer, or ask a follow-up question..."
                            required
                        ></flux:textarea>
                        @error('content')
                            <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </flux:field>
                    
                    <div class="flex justify-end">
                        <flux:button 
                            type="submit" 
                            variant="primary"
                        >
                            <flux:icon.paper-airplane class="size-4" />
                            Post Reply
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
