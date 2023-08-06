@props([ 'button' => __('Confirm')])

<span x-ref="span" {{ $attributes }}>
    {{ $slot }}
</span>
@once
<x-dialog-modal wire:model="publishMateriModal">
    <x-slot name="title">
        {{ $name }}
    </x-slot>

    <x-slot name="content">
        {{ $form }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="modalMateri('publish')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ml-3" wire:click="confirmPublishMateri" wire:loading.attr="enabled">
            {{ $button }}
        </x-button>
    </x-slot>
</x-dialog-modal>
@endonce