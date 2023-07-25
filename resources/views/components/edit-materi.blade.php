@props([ 'button' => __('Confirm')])

<span x-ref="span" {{ $attributes }}>
    {{ $slot }}
</span>
@once
<x-dialog-modal wire:model="editMateriModal" class="fixed">
    <x-slot name="title">
        {{ $editname }}
    </x-slot>

    <x-slot name="content">
        {{ $editform }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="modalMateri('edit')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ml-3" wire:click="confirmEditMateri" wire:loading.attr="enabled">
            {{ $button }}
        </x-button>
    </x-slot>
</x-dialog-modal>
@endonce