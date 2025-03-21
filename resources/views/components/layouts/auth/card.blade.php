<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased">
        <div class="flex flex-col h-screen w-full items-center justify-center bg-cover bg-center" style="background-image: url(storage/img/auth/bg_login.jpg)">
            <div class="w-full max-w-3xl overflow-hidden rounded-lg bg-enphasis shadow-lg sm:flex flex-col">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium p-4" wire:navigate>
                    <span class="flex h-32 w-32 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-32 fill-current text-black dark:text-white" />
                    </span>

                    <span class="text-base text-5xl">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="w-full p-8 pt-0">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
