<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $bio = '';
    public string $university = '';
    public string $major = '';
    public string $year_of_study = '';
    public string $graduation_year = '';
    public string $location = '';
    public string $interests_text = '';
    public array $social_links = [];
    public string $preferred_contact = 'email';
    public bool $profile_visibility = true;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->bio = $user->bio ?? '';
        $this->university = $user->university ?? '';
        $this->major = $user->major ?? '';
        $this->year_of_study = $user->year_of_study ?? '';
        $this->graduation_year = $user->graduation_year ?? '';
        $this->location = $user->location ?? '';
        $this->interests_text = is_array($user->interests) ? implode(', ', $user->interests) : '';
        $this->social_links = $user->social_links ?? [];
        $this->preferred_contact = $user->preferred_contact ?? 'email';
        $this->profile_visibility = $user->profile_visibility ?? true;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'university' => ['nullable', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:255'],
            'year_of_study' => ['nullable', 'string', 'in:Freshman,Sophomore,Junior,Senior,Graduate'],
            'graduation_year' => ['nullable', 'string', 'min:4', 'max:4'],
            'location' => ['nullable', 'string', 'max:255'],
            'interests_text' => ['nullable', 'string', 'max:500'],
            'social_links' => ['nullable', 'array'],
            'preferred_contact' => ['required', 'string', 'in:email,phone,both'],
            'profile_visibility' => ['boolean'],
        ]);

        // Convert interests text to array
        $interests = !empty($validated['interests_text']) 
            ? array_map('trim', explode(',', $validated['interests_text']))
            : [];
        
        $validated['interests'] = $interests;
        unset($validated['interests_text']);

        $user->fill($validated);
        $user->last_active_at = now();
        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your profile information and academic details')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <!-- Basic Information -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white border-b pb-2">Basic Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <flux:input wire:model="name" :label="__('Full Name')" type="text" required autofocus autocomplete="name" />
                    <flux:input wire:model="phone" :label="__('Phone Number')" type="tel" placeholder="+1 (555) 123-4567" autocomplete="tel" />
                </div>

                <flux:input wire:model="email" :label="__('Email')" type="email" required disabled autocomplete="email" />
                
                <flux:field>
                    <flux:label>Bio</flux:label>
                    <textarea wire:model="bio" placeholder="Tell us about yourself, your interests, and academic goals..." rows="3" class="block w-full rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white"></textarea>
                </flux:field>
            </div>

            <!-- Academic Information -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white border-b pb-2">Academic Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <flux:input wire:model="university" :label="__('University/College')" type="text" placeholder="Harvard University" />
                    <flux:input wire:model="major" :label="__('Major/Field of Study')" type="text" placeholder="Computer Science" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <flux:field>
                            <flux:label>Year of Study</flux:label>
                            <select wire:model="year_of_study" class="block w-full rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white">
                                <option value="">Select your current year</option>
                                <option value="Freshman">Freshman</option>
                                <option value="Sophomore">Sophomore</option>
                                <option value="Junior">Junior</option>
                                <option value="Senior">Senior</option>
                                <option value="Graduate">Graduate</option>
                            </select>
                        </flux:field>
                    </div>
                    <flux:input wire:model="graduation_year" :label="__('Expected Graduation Year')" type="number" min="2024" max="2030" placeholder="2025" />
                </div>

                <flux:input wire:model="location" :label="__('Location')" type="text" placeholder="Boston, MA" />
            </div>

            <!-- Interests & Social Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white border-b pb-2">Interests & Social</h3>
                
                <div>
                    <flux:field>
                        <flux:label>Academic Interests</flux:label>
                        <flux:description>Enter your academic interests separated by commas (e.g., Computer Science, Biology, History)</flux:description>
                        <flux:input wire:model="interests_text" type="text" placeholder="Machine Learning, Biology, History, etc." />
                    </flux:field>
                </div>

                <div>
                    <flux:field>
                        <flux:label>Social Links</flux:label>
                        <flux:description>Add your professional and social media profiles</flux:description>
                        <div class="space-y-2">
                            <flux:input wire:model="social_links.linkedin" type="url" placeholder="LinkedIn profile URL" />
                            <flux:input wire:model="social_links.github" type="url" placeholder="GitHub profile URL" />
                            <flux:input wire:model="social_links.twitter" type="url" placeholder="Twitter profile URL" />
                        </div>
                    </flux:field>
                </div>
            </div>

            <!-- Preferences -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white border-b pb-2">Preferences</h3>
                
                <flux:radio.group wire:model="preferred_contact" :label="__('Preferred Contact Method')">
                    <flux:radio value="email">Email only</flux:radio>
                    <flux:radio value="phone">Phone only</flux:radio>
                    <flux:radio value="both">Both email and phone</flux:radio>
                </flux:radio.group>

                <flux:checkbox wire:model="profile_visibility" :label="__('Make my profile visible to other students')" />
            </div>

            <div class="flex items-center gap-4 pt-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save Profile') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Profile updated successfully!') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
