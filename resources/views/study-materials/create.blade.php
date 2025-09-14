<x-layouts.app :title="__('Upload Study Material')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Upload Study Material</h1>
                <p class="text-neutral-600 dark:text-neutral-400">Share your notes, exams, and study resources</p>
            </div>
            <flux:button variant="outline" :href="route('study-materials.index')" icon="arrow-left">
                Back to Materials
            </flux:button>
        </div>

        <!-- Upload Form -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
            <form method="POST" action="{{ route('study-materials.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold">Basic Information</h3>
                        
                        <flux:field>
                            <flux:label>Title *</flux:label>
                            <flux:input name="title" placeholder="e.g., Calculus 101 Final Exam Solutions" required />
                            @error('title')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>

                        <flux:field>
                            <flux:label>Description</flux:label>
                            <flux:textarea name="description" placeholder="Brief description of the material..." rows="3"></flux:textarea>
                            @error('description')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>

                        <flux:field>
                            <flux:label>Subject *</flux:label>
                            <flux:input name="subject" placeholder="e.g., Mathematics, Computer Science" required />
                            @error('subject')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Course Details -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold">Course Details</h3>
                        
                        <flux:field>
                            <flux:label>Course Code</flux:label>
                            <flux:input name="course_code" placeholder="e.g., MATH101, CS201" />
                            @error('course_code')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>

                        <flux:field>
                            <flux:label>Professor</flux:label>
                            <flux:input name="professor" placeholder="Professor's name" />
                            @error('professor')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>

                        <flux:field>
                            <flux:label>Material Type *</flux:label>
                            <flux:select name="type" required>
                                <option value="notes">Study Notes</option>
                                <option value="exam">Exam Papers</option>
                                <option value="flashcards">Flashcards</option>
                                <option value="cheat_sheet">Cheat Sheet</option>
                                <option value="other">Other</option>
                            </flux:select>
                            @error('type')
                                <flux:error>{{ $message }}</flux:error>
                            @enderror
                        </flux:field>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">File Upload</h3>
                    
                    <flux:field>
                        <flux:label>File *</flux:label>
                        <flux:input type="file" name="file" accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png" required />
                        <flux:description>
                            Supported formats: PDF, DOC, DOCX, TXT, JPG, JPEG, PNG (Max: 10MB)
                        </flux:description>
                        @error('file')
                            <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </flux:field>
                </div>

                <!-- Guidelines -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Upload Guidelines</h4>
                    <ul class="text-sm text-blue-800 dark:text-blue-200 space-y-1">
                        <li>• Ensure your material is original or properly cited</li>
                        <li>• Use clear, descriptive titles</li>
                        <li>• Include relevant course information</li>
                        <li>• Materials will be reviewed before being made public</li>
                        <li>• Respect copyright and academic integrity policies</li>
                    </ul>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-4">
                    <flux:button type="submit" icon="arrow-up-tray" class="flex-1">
                        Upload Material
                    </flux:button>
                    <flux:button type="button" variant="outline" :href="route('study-materials.index')">
                        Cancel
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
