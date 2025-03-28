<div
    x-data="{
        calendar: null,
        initCalendar() {
            const calendarEl = this.$refs.calendar;

            this.calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [
                    FullCalendar.dayGridPlugin,
                    FullCalendar.luxonPlugin,
                ],
                locale: FullCalendar.esLocale,
                themeSystem: FullCalendar.bootstrap5Plugin,
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                editable: false,
                selectable: true,
                events: @js($events),
                eventClick: (info) => {
                    console.log(info.event);
                },
                {{--
                datesSet: (info) => { },
                dateClick: (info) => { },
                eventDrop: (info) => { },
                eventResize: (info) => { },
                select: (info) => { }
                --}}
            });

            this.calendar.render();
        }
    }"
    x-init="initCalendar()"
    @refresh-calendar.window="calendar.refetchEvents()"
    wire:ignore
>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-8">
            <div x-ref="calendar" id="calendar"></div>
        </div>
    </div>
</div>
