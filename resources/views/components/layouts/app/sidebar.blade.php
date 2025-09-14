<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Campus Hub')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    <flux:navlist.item icon="academic-cap" :href="route('study-materials.index')" :current="request()->routeIs('study-materials.*')" wire:navigate>{{ __('Study Materials') }}</flux:navlist.item>
                    <flux:navlist.item icon="user-group" :href="route('tutors.index')" :current="request()->routeIs('tutors.*')" wire:navigate>{{ __('Tutoring') }}</flux:navlist.item>
                    <flux:navlist.item icon="book-open" :href="route('textbooks.index')" :current="request()->routeIs('textbooks.*')" wire:navigate>{{ __('Textbooks') }}</flux:navlist.item>
                    <flux:navlist.item icon="calendar-days" :href="route('events.index')" :current="request()->routeIs('events.*')" wire:navigate>{{ __('Events') }}</flux:navlist.item>
                    <flux:navlist.item icon="chat-bubble-left-right" :href="route('forum.index')" :current="request()->routeIs('forum.*')" wire:navigate>{{ __('Forum') }}</flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.group :heading="__('Library')" class="grid">
                    <flux:navlist.item icon="document-text" :href="route('library.my-documents')" wire:navigate>{{ __('My Documents') }}</flux:navlist.item>
                    <flux:navlist.item icon="folder" :href="route('library.saved-materials')" wire:navigate>{{ __('Saved Materials') }}</flux:navlist.item>
                    <flux:navlist.item icon="bookmark" :href="route('library.bookmarks')" wire:navigate>{{ __('Bookmarks') }}</flux:navlist.item>
                    <flux:navlist.item icon="clock" :href="route('library.recent-activity')" wire:navigate>{{ __('Recent Activity') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Community')" class="grid">
                    <flux:navlist.item icon="arrow-up" :href="route('community.top-uploads')" wire:navigate>
                        <div class="flex items-center justify-between w-full">
                            {{ __('Top Uploads') }}
                            <span class="bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 text-xs px-2 py-0.5 rounded-full">Hot</span>
                        </div>
                    </flux:navlist.item>
                    <flux:navlist.item icon="heart" :href="route('community.most-liked')" wire:navigate>
                        <div class="flex items-center justify-between w-full">
                            {{ __('Most Liked') }}
                            <span class="bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300 text-xs px-2 py-0.5 rounded-full">❤️</span>
                        </div>
                    </flux:navlist.item>
                    <flux:navlist.item icon="star" :href="route('community.top-rated')" wire:navigate>
                        <div class="flex items-center justify-between w-full">
                            {{ __('Top Rated') }}
                            <span class="bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300 text-xs px-2 py-0.5 rounded-full">⭐</span>
                        </div>
                    </flux:navlist.item>
                    <flux:navlist.item icon="arrow-trending-up" :href="route('community.trending')" wire:navigate>
                        <div class="flex items-center justify-between w-full">
                            {{ __('Trending') }}
                            <span class="bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 text-xs px-2 py-0.5 rounded-full">🔥</span>
                        </div>
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :avatar="auth()->user()->avatar ?: null"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-sm">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        @if (auth()->user()->avatar)
                                            <img src="{{ auth()->user()->avatar }}" />
                                        @else
                                            {{ auth()->user()->initials() }}
                                        @endif
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :avatar="auth()->user()->avatar ?: null"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-sm">
                                    @if (auth()->user()->avatar)
                                        <img src="{{ auth()->user()->avatar }}" />
                                    @else
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-sm bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                        >
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    @endif
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
