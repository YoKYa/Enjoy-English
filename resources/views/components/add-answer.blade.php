<span x-ref="span" {{ $attributes }}>
    {{ $slot }}
</span>
@once
<x-dialog-modal wire:model="modalAnswer" maxWidth="4xl">
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="content">
        {{ $form }}
    </x-slot>

    <x-slot name="footer">
        <x-button class="ml-3" wire:click="$emit('modalA')" wire:loading.attr="enabled">
            {{ __('Done') }}
        </x-button>
    </x-slot>
</x-dialog-modal>
@endonce