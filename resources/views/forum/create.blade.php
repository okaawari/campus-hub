<x-layouts.app :title="__('Create New Post')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-green-500 to-blue-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Create New Post ✍️</h1>
                    <p class="text-green-100">Share your thoughts, ask questions, or start a discussion with your campus community.</p>
                </div>
                <div class="hidden md:block">
                    <flux:icon.pencil class="size-16 text-green-200" />
                </div>
            </div>
        </div>

        <!-- Create Post Form -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-neutral-200 dark:border-neutral-700">
            <div class="p-6">
                <form action="{{ route('forum.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Post Title -->
                    <div>
                        <flux:field>
                            <flux:label for="title">Post Title</flux:label>
                            <flux:input 
                                id="title" 
                                name="title" 
                                type="text" 
                                placeholder="Enter a descriptive title for your post..."
                                value="{{ old('title') }}"
                                required 
                            />
                            @error('title')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Category Selection -->
                    <div>
                        <flux:field>
                            <flux:label for="category">Category</flux:label>
                            <flux:select id="category" name="category" required>
                                <option value="">Select a category...</option>
                                <option value="question" {{ old('category') === 'question' ? 'selected' : '' }}>
                                    Question - Ask for help or clarification
                                </option>
                                <option value="discussion" {{ old('category') === 'discussion' ? 'selected' : '' }}>
                                    Discussion - Share ideas and opinions
                                </option>
                                <option value="announcement" {{ old('category') === 'announcement' ? 'selected' : '' }}>
                                    Announcement - Share important information
                                </option>
                                <option value="help" {{ old('category') === 'help' ? 'selected' : '' }}>
                                    Help - Offer assistance or resources
                                </option>
                            </flux:select>
                            @error('category')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Subject and Course Code -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <flux:field>
                                <flux:label for="subject">Subject (Optional)</flux:label>
                                <flux:input 
                                    id="subject" 
                                    name="subject" 
                                    type="text" 
                                    placeholder="e.g., Mathematics, Computer Science..."
                                    value="{{ old('subject') }}"
                                />
                                @error('subject')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                        </div>
                        
                        <div>
                            <flux:field>
                                <flux:label for="course_code">Course Code (Optional)</flux:label>
                                <flux:input 
                                    id="course_code" 
                                    name="course_code" 
                                    type="text" 
                                    placeholder="e.g., MATH101, CS201..."
                                    value="{{ old('course_code') }}"
                                />
                                @error('course_code')
                                    <flux:error>{{ $message }}</flux:error>
                                @enderror
                            </flux:field>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div>
                        <flux:field>
                            <flux:label for="content">Post Content</flux:label>
                            <flux:textarea 
                                id="content" 
                                name="content" 
                                rows="8"
                                placeholder="Write your post content here. Be clear, helpful, and respectful to your fellow students..."
                                required
                            >{{ old('content') }}</flux:textarea>
                            @error('content')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Posting Guidelines -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">📝 Posting Guidelines</h4>
                        <ul class="text-sm text-blue-800 dark:text-blue-200 space-y-1">
                            <li>• Be respectful and constructive in your posts</li>
                            <li>• Use clear, descriptive titles that summarize your post</li>
                            <li>• Include relevant subject and course information when applicable</li>
                            <li>• Search existing posts before creating new ones to avoid duplicates</li>
                            <li>• Mark your question as solved when you receive a helpful answer</li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-end">
                        <flux:button 
                            type="button" 
                            variant="outline" 
                            href="{{ route('forum.index') }}"
                            class="w-full sm:w-auto"
                        >
                            Cancel
                        </flux:button>
                        <flux:button 
                            type="submit" 
                            variant="primary"
                            class="w-full sm:w-auto"
                        >
                            <flux:icon.paper-airplane class="size-4" />
                            Create Post
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
