@props([ 'button' => __('Delete')])

<span x-ref="span" {{ $attributes }}>
    {{ $slot }}
</span>
@once
<x-dialog-modal wire:model="deleteUserModal">
    <x-slot name="title">
        {{ $name }}
    </x-slot>

    <x-slot name="content">
        {{ $form }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="modalDelete" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ml-3 bg-red-600 hover:bg-red-800" wire:click="confirmDeleteUser" wire:loading.attr="enabled">
            {{ $button }}
        </x-button>
    </x-slot>
</x-dialog-modal>
@endonce