<x-layouts.app :title="__('Campus Hub Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-8 animate-fade-in">
        <!-- Welcome Section -->
        <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl p-8 text-white shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent animate-pulse"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold mb-3 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                            Welcome to Campus Hub! 🎓
                        </h1>
                        <p class="text-lg text-white/90 max-w-2xl">
                            Your comprehensive platform for academic success - discover study materials, connect with tutors, trade textbooks, and engage with your campus community.
                        </p>
                    </div>
                    <div class="hidden lg:block">
                        <div class="text-6xl opacity-20 animate-bounce-slow">📚</div>
                    </div>
                </div>
                <div class="mt-6 flex gap-4">
                    <flux:button href="{{ route('study-materials.index') }}" variant="outline" class="bg-white/20 border-white/30 text-white hover:bg-white/30 backdrop-blur-sm">
                        Explore Materials
                    </flux:button>
                    <flux:button href="{{ route('events.index') }}" variant="ghost" class="text-white hover:bg-white/20">
                        View Events
                    </flux:button>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
            <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-blue-400/20 rounded-full blur-2xl"></div>
        </div>

        <!-- Quick Stats -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="group bg-white dark:bg-zinc-800 rounded-xl p-6 border border-neutral-200 dark:border-neutral-700 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <flux:icon.academic-cap class="size-6 text-white" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400 mb-1">Study Materials</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ \App\Models\StudyMaterial::count() }}</p>
                        <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">+12% this week</p>
                    </div>
                </div>
            </div>
            
            <div class="group bg-white dark:bg-zinc-800 rounded-xl p-6 border border-neutral-200 dark:border-neutral-700 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <flux:icon.user-group class="size-6 text-white" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400 mb-1">Available Tutors</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ \App\Models\Tutor::where('is_available', true)->count() }}</p>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">Online now</p>
                    </div>
                </div>
            </div>
            
            <div class="group bg-white dark:bg-zinc-800 rounded-xl p-6 border border-neutral-200 dark:border-neutral-700 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <flux:icon.book-open class="size-6 text-white" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400 mb-1">Textbooks</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ \App\Models\Textbook::where('is_available', true)->count() }}</p>
                        <p class="text-xs text-purple-600 dark:text-purple-400 font-medium">For sale/rent</p>
                    </div>
                </div>
            </div>
            
            <div class="group bg-white dark:bg-zinc-800 rounded-xl p-6 border border-neutral-200 dark:border-neutral-700 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <flux:icon.calendar-days class="size-6 text-white" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400 mb-1">Upcoming Events</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ \App\Models\CampusEvent::where('start_time', '>', now())->count() }}</p>
                        <p class="text-xs text-orange-600 dark:text-orange-400 font-medium">This month</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Quick Actions</h2>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Get started with these popular features</p>
            </div>
            
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Primary Actions (Featured) -->
                <a href="{{ route('study-materials.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-2xl border-2 border-blue-200 dark:border-blue-700 hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <flux:icon.arrow-up-tray class="size-6 text-white" />
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2">Upload Study Materials</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">Share your notes, exams, and study guides with the community</p>
                                <div class="mt-3 flex items-center text-blue-600 dark:text-blue-400 text-sm font-medium">
                                    Get started <flux:icon.arrow-right class="size-4 ml-1 group-hover:translate-x-1 transition-transform" />
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('tutors.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 rounded-2xl border-2 border-emerald-200 dark:border-emerald-700 hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <flux:icon.user-plus class="size-6 text-white" />
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2">Become a Tutor</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">Help fellow students succeed and earn money teaching</p>
                                <div class="mt-3 flex items-center text-emerald-600 dark:text-emerald-400 text-sm font-medium">
                                    Start tutoring <flux:icon.arrow-right class="size-4 ml-1 group-hover:translate-x-1 transition-transform" />
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('textbooks.create') }}" class="group relative overflow-hidden bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-2xl border-2 border-purple-200 dark:border-purple-700 hover:border-purple-300 dark:hover:border-purple-600 transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <flux:icon.book-open class="size-6 text-white" />
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-neutral-900 dark:text-white mb-2">List Textbook</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">Sell or exchange your textbooks with other students</p>
                                <div class="mt-3 flex items-center text-purple-600 dark:text-purple-400 text-sm font-medium">
                                    List now <flux:icon.arrow-right class="size-4 ml-1 group-hover:translate-x-1 transition-transform" />
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                <!-- Secondary Actions -->
                <a href="{{ route('events.create') }}" class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-orange-300 dark:hover:border-orange-600 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.calendar-days class="size-6 text-white" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-neutral-900 dark:text-white">Create Event</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">Organize campus events and meetings</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('forum.create') }}" class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-indigo-300 dark:hover:border-indigo-600 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.chat-bubble-left-right class="size-6 text-white" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-neutral-900 dark:text-white">Ask Question</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">Get help from the community</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('study-materials.index') }}" class="group bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-pink-300 dark:hover:border-pink-600 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <flux:icon.magnifying-glass class="size-6 text-white" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-neutral-900 dark:text-white">Browse Resources</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">Explore study materials and more</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity & Calendar -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Recent Activity</h2>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Stay updated with the latest</p>
            </div>
            
            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Recent Study Materials -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                <flux:icon.document-text class="size-5 text-blue-600 dark:text-blue-400" />
                            </div>
                            <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Recent Study Materials</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse(\App\Models\StudyMaterial::latest()->limit(3)->get() as $material)
                                <div class="group flex items-center gap-4 p-3 bg-neutral-50 dark:bg-zinc-700 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors duration-200">
                                    <div class="p-2 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-sm">
                                        <flux:icon.academic-cap class="size-4 text-white" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-neutral-900 dark:text-white truncate">{{ $material->title }}</p>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                            {{ $material->subject }} • 
                                            <span class="text-blue-600 dark:text-blue-400 font-medium">{{ $material->downloads }} downloads</span>
                                        </p>
                                    </div>
                                    <flux:icon.chevron-right class="size-4 text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" />
                                </div>
                            @empty
                                <div class="text-center py-6">
                                    <div class="text-neutral-400 dark:text-neutral-600 text-4xl mb-3">📚</div>
                                    <p class="text-neutral-600 dark:text-neutral-400 mb-2">No study materials yet</p>
                                    <flux:button href="{{ route('study-materials.create') }}" size="sm" variant="outline">
                                        Upload First Material
                                    </flux:button>
                                </div>
                            @endforelse
                        </div>
                        @if(\App\Models\StudyMaterial::count() > 0)
                            <div class="mt-4">
                                <flux:button href="{{ route('study-materials.index') }}" variant="outline" size="sm" class="w-full">
                                    View All Materials
                                </flux:button>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Upcoming Events -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700 bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                                <flux:icon.calendar-days class="size-5 text-orange-600 dark:text-orange-400" />
                            </div>
                            <h3 class="font-bold text-lg text-neutral-900 dark:text-white">Upcoming Events</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse(\App\Models\CampusEvent::where('start_time', '>', now())->orderBy('start_time')->limit(3)->get() as $event)
                                <div class="group flex items-center gap-4 p-3 bg-neutral-50 dark:bg-zinc-700 rounded-xl hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors duration-200">
                                    <div class="p-2 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-sm">
                                        <flux:icon.calendar class="size-4 text-white" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-neutral-900 dark:text-white truncate">{{ $event->title }}</p>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                                            <span class="text-orange-600 dark:text-orange-400 font-medium">{{ $event->start_time->format('M j, Y') }}</span> • {{ $event->location }}
                                        </p>
                                    </div>
                                    <flux:icon.chevron-right class="size-4 text-neutral-400 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors" />
                                </div>
                            @empty
                                <div class="text-center py-6">
                                    <div class="text-neutral-400 dark:text-neutral-600 text-4xl mb-3">📅</div>
                                    <p class="text-neutral-600 dark:text-neutral-400 mb-2">No upcoming events</p>
                                    <flux:button href="{{ route('events.create') }}" size="sm" variant="outline">
                                        Create Event
                                    </flux:button>
                                </div>
                            @endforelse
                        </div>
                        @if(\App\Models\CampusEvent::where('start_time', '>', now())->count() > 0)
                            <div class="mt-4">
                                <flux:button href="{{ route('events.index') }}" variant="outline" size="sm" class="w-full">
                                    View All Events
                                </flux:button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Enhanced Event Calendar -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-neutral-200 dark:border-neutral-700 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                    <flux:icon.calendar-days class="size-5 text-purple-600 dark:text-purple-400" />
                                </div>
                                <h3 class="font-bold text-lg text-neutral-900 dark:text-white">{{ now()->format('F Y') }}</h3>
                            </div>
                            <flux:button href="{{ route('events.index') }}" variant="ghost" size="xs" class="text-purple-600 dark:text-purple-400 hover:bg-purple-100 dark:hover:bg-purple-900">
                                View All
                            </flux:button>
                        </div>
                    </div>
                    <div class="p-4">
                        <x-event-calendar :events="\App\Models\CampusEvent::where('start_time', '>=', now()->startOfMonth())->where('start_time', '<=', now()->endOfMonth())->get()" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
