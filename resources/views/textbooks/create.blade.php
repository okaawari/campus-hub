<x-layouts.app :title="__('List Your Textbook')">
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100 mb-2">List Your Textbook 📚</h1>
            <p class="text-neutral-600 dark:text-neutral-400">Share your textbooks with fellow students and earn some money</p>
        </div>

        <form action="{{ route('textbooks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
                
                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <flux:field>
                            <flux:label>Book Title *</flux:label>
                            <flux:input name="title" value="{{ old('title') }}" placeholder="e.g., Introduction to Computer Science" required />
                            <flux:error name="title" />
                        </flux:field>
                    </div>

                    <!-- Author -->
                    <div>
                        <flux:field>
                            <flux:label>Author *</flux:label>
                            <flux:input name="author" value="{{ old('author') }}" placeholder="e.g., John Smith" required />
                            <flux:error name="author" />
                        </flux:field>
                    </div>

                    <!-- ISBN -->
                    <div>
                        <flux:field>
                            <flux:label>ISBN</flux:label>
                            <flux:input name="isbn" value="{{ old('isbn') }}" placeholder="e.g., 978-0123456789" />
                            <flux:error name="isbn" />
                        </flux:field>
                    </div>

                    <!-- Edition -->
                    <div>
                        <flux:field>
                            <flux:label>Edition</flux:label>
                            <flux:input name="edition" value="{{ old('edition') }}" placeholder="e.g., 5th Edition" />
                            <flux:error name="edition" />
                        </flux:field>
                    </div>

                    <!-- Subject -->
                    <div>
                        <flux:field>
                            <flux:label>Subject *</flux:label>
                            <flux:input name="subject" value="{{ old('subject') }}" placeholder="e.g., Computer Science" required />
                            <flux:error name="subject" />
                        </flux:field>
                    </div>

                    <!-- Course Code -->
                    <div>
                        <flux:field>
                            <flux:label>Course Code</flux:label>
                            <flux:input name="course_code" value="{{ old('course_code') }}" placeholder="e.g., CS101" />
                            <flux:error name="course_code" />
                        </flux:field>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <flux:field>
                            <flux:label>Description</flux:label>
                            <flux:textarea name="description" rows="4" placeholder="Describe the book's condition, any highlights, notes, etc.">{{ old('description') }}</flux:textarea>
                            <flux:error name="description" />
                        </flux:field>
                    </div>
                </div>
            </div>

            <!-- Listing Details -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-xl font-semibold mb-4">Listing Details</h2>
                
                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Listing Type -->
                    <div>
                        <flux:field>
                            <flux:label>Listing Type *</flux:label>
                            <flux:select name="listing_type" required>
                                <option value="">Select type</option>
                                <option value="sale" {{ old('listing_type') === 'sale' ? 'selected' : '' }}>For Sale</option>
                                <option value="exchange" {{ old('listing_type') === 'exchange' ? 'selected' : '' }}>Exchange</option>
                                <option value="rent" {{ old('listing_type') === 'rent' ? 'selected' : '' }}>For Rent</option>
                            </flux:select>
                            <flux:error name="listing_type" />
                        </flux:field>
                    </div>

                    <!-- Condition -->
                    <div>
                        <flux:field>
                            <flux:label>Condition *</flux:label>
                            <flux:select name="condition" required>
                                <option value="">Select condition</option>
                                <option value="new" {{ old('condition') === 'new' ? 'selected' : '' }}>New</option>
                                <option value="like_new" {{ old('condition') === 'like_new' ? 'selected' : '' }}>Like New</option>
                                <option value="good" {{ old('condition') === 'good' ? 'selected' : '' }}>Good</option>
                                <option value="fair" {{ old('condition') === 'fair' ? 'selected' : '' }}>Fair</option>
                                <option value="poor" {{ old('condition') === 'poor' ? 'selected' : '' }}>Poor</option>
                            </flux:select>
                            <flux:error name="condition" />
                        </flux:field>
                    </div>

                    <!-- Price -->
                    <div id="price-field" style="display: none;">
                        <flux:field>
                            <flux:label>Price ($) *</flux:label>
                            <flux:input name="price" type="number" step="0.01" min="0" value="{{ old('price') }}" placeholder="0.00" />
                            <flux:error name="price" />
                        </flux:field>
                    </div>

                    <!-- Location -->
                    <div>
                        <flux:field>
                            <flux:label>Location</flux:label>
                            <flux:input name="location" value="{{ old('location') }}" placeholder="e.g., Main Campus, Library" />
                            <flux:error name="location" />
                        </flux:field>
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-xl font-semibold mb-4">Images</h2>
                
                <flux:field>
                    <flux:label>Upload Images</flux:label>
                    <flux:input type="file" name="images[]" multiple accept="image/*" />
                    <flux:error name="images" />
                    <flux:description>Upload up to 5 images of your textbook. Show the cover, spine, and any damage or highlights.</flux:description>
                </flux:field>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('textbooks.index') }}" 
                   class="px-6 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-700 transition-colors">
                    Cancel
                </a>
                <flux:button type="submit" variant="primary" class="px-6 py-2">
                    List Textbook
                </flux:button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const listingTypeSelect = document.querySelector('select[name="listing_type"]');
            const priceField = document.getElementById('price-field');
            const priceInput = document.querySelector('input[name="price"]');

            function togglePriceField() {
                const selectedType = listingTypeSelect.value;
                if (selectedType === 'sale' || selectedType === 'rent') {
                    priceField.style.display = 'block';
                    priceInput.required = true;
                } else {
                    priceField.style.display = 'none';
                    priceInput.required = false;
                    priceInput.value = '';
                }
            }

            listingTypeSelect.addEventListener('change', togglePriceField);
            
            // Initialize on page load
            togglePriceField();
        });
    </script>
</x-layouts.app>
