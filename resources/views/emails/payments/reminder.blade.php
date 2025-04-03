<x-layouts.email.base>
    <x-slot name="body">
        <h1 class="email-title">{{ $greeting }}</h1>
        @foreach ($data as $value)
            @if( $value == 'break' )
                <br>
            @else
                <p>{{ $value }}</p>
            @endif
        @endforeach
    </x-slot>
</x-layouts.email.base>
