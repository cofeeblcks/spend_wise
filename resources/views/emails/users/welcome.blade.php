<x-layouts.email.base>
    <x-slot name="body">
        <h1 class="email-title">¡Bienvenido a {{ $appName }}, {{ $user->full_name }}!</h1>

        <p>Gracias por registrarte en nuestra plataforma. Estamos encantados de tenerte con nosotros.</p>

        <div class="email-panel">
            <strong>Datos de tu cuenta:</strong><br>
            Email: {{ $user->email }}<br>
            Fecha de registro: {{ now()->format('d/m/Y H:i') }}
        </div>
    </x-slot>
</x-layouts.email.base>
