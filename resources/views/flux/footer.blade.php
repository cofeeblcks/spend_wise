@php
$classes = Flux::classes('[grid-area:footer]')
    ->add($attributes->has('container') ? '' : 'p-6 md:p-0 border-t border-zinc-200 dark:border-zinc-600')
    ;
@endphp

<div {{ $attributes->class($classes) }} data-flux-footer>
    <flux:with-container :attributes="$attributes->except('class')->class('p-6 md:p-0')">
        {{ $slot }}
    </flux:with-container>
</div>
