<x-layouts.email.base>
    <x-slot name="body">
        <h1 class="email-title">¡Bienvenido a {{ $appName }}, {{ $user->full_name }}!</h1>

        <p>Gracias por registrarte en nuestra plataforma. Estamos encantados de tenerte con nosotros.</p>

        <div class="email-panel">
            <strong>Datos de tu cuenta:</strong><br>
            Email: {{ $user->email }}<br>
            Fecha de registro: {{ now()->format('d/m/Y H:i') }}
        </div>

        <div class="email-section">
            <h3 style="color: #203A75;">Comienza a explorar</h3>
            <a class="email-button" href="{{ config('app.url') }}">Iniciar sesión</a>
        </div>
    </x-slot>
</x-layouts.email.base>
