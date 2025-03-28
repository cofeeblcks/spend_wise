import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import luxonPlugin from '@fullcalendar/luxon';
import esLocale from '@fullcalendar/core/locales/es';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

// Hacer FullCalendar disponible globalmente
window.FullCalendar = {
    Calendar,
    dayGridPlugin,
    interactionPlugin,
    luxonPlugin,
    esLocale,
    bootstrap5Plugin,
};
