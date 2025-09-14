@props(['events' => collect()])

<div class="space-y-4">
    <!-- Calendar Mini Header (now removed since parent handles it) -->

    <!-- Calendar Headers -->
    <div class="grid grid-cols-7 gap-1 mb-3">
        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div class="text-center text-xs font-semibold text-neutral-600 dark:text-neutral-400 py-2 bg-neutral-50 dark:bg-zinc-700 rounded-lg">
                {{ $day }}
            </div>
        @endforeach
    </div>

    <!-- Calendar Grid -->
    <div class="grid grid-cols-7 gap-1">
        @php
            $today = now();
            $startOfMonth = $today->copy()->startOfMonth();
            $endOfMonth = $today->copy()->endOfMonth();
            $startOfWeek = $startOfMonth->copy()->startOfWeek();
            $endOfWeek = $endOfMonth->copy()->endOfWeek();
            
            // Group events by date
            $eventsByDate = $events->groupBy(function($event) {
                return $event->start_time->format('Y-m-d');
            });
        @endphp

        @for($date = $startOfWeek->copy(); $date->lte($endOfWeek); $date->addDay())
            @php
                $dayEvents = $eventsByDate->get($date->format('Y-m-d'), collect());
                $isCurrentMonth = $date->month === $today->month;
                $isToday = $date->isSameDay($today);
            @endphp
            
            <div class="group min-h-[70px] p-2 rounded-lg transition-all duration-200 hover:bg-purple-50 dark:hover:bg-purple-900/20
                {{ $isCurrentMonth ? 'bg-white dark:bg-zinc-700' : 'bg-neutral-50 dark:bg-zinc-800' }}
                {{ $isToday ? 'ring-2 ring-purple-500 bg-purple-50 dark:bg-purple-900/20' : '' }}">
                
                <!-- Date Number -->
                <div class="text-xs font-bold mb-1 text-center
                    {{ $isCurrentMonth ? 'text-neutral-900 dark:text-white' : 'text-neutral-400 dark:text-neutral-600' }}
                    {{ $isToday ? 'text-purple-600 dark:text-purple-400' : '' }}">
                    {{ $date->day }}
                </div>

                <!-- Events -->
                @if($dayEvents->count() > 0)
                    <div class="space-y-1">
                        @foreach($dayEvents->take(1) as $event)
                            <a href="{{ route('events.show', $event) }}" 
                               class="block text-xs p-1 rounded truncate bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/50 dark:to-pink-900/50 text-purple-800 dark:text-purple-200 hover:from-purple-200 hover:to-pink-200 dark:hover:from-purple-800/50 dark:hover:to-pink-800/50 transition-colors font-medium"
                               title="{{ $event->title }}">
                                {{ $event->title }}
                            </a>
                        @endforeach
                        
                        @if($dayEvents->count() > 1)
                            <div class="text-xs text-purple-600 dark:text-purple-400 text-center font-medium">
                                +{{ $dayEvents->count() - 1 }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endfor
    </div>
</div>
