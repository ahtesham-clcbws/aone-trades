<x-form-section submit="save">
    <x-slot name="title">
        {{ __('Preferences') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s preferences and address information.') }}
    </x-slot>

    <x-slot name="form">

        <!-- Time Zone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="timezone" value="{{ __('Time Zone') }}" />
            <x-input id="timezone" type="text" class="mt-1 block w-full" wire:model="timezone" required />
            <x-input-error for="timezone" class="mt-2" />
        </div>
        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Address') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model="address" required />
            <x-input-error for="address" class="mt-2" />
        </div>
        <!-- City -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="city" value="{{ __('City') }}" />
            <x-input id="city" type="text" class="mt-1 block w-full" wire:model="city" required />
            <x-input-error for="city" class="mt-2" />
        </div>
        <!-- State/Province -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="state" value="{{ __('State/Province') }}" />
            <x-input id="state" type="text" class="mt-1 block w-full" wire:model="state" required />
            <x-input-error for="state" class="mt-2" />
        </div>
        <!-- Country -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="country" value="{{ __('Country') }}" />
            <x-input id="country" type="text" class="mt-1 block w-full" wire:model="country" required />
            <x-input-error for="country" class="mt-2" />
        </div>
        <!-- Pincode -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="pincode" value="{{ __('Pincode') }}" />
            <x-input id="pincode" type="text" class="mt-1 block w-full" wire:model="pincode" required />
            <x-input-error for="pincode" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button type="submit">
            <span class="loading loading-bars loading-xs me-2" wire:loading></span> {{ __('Update') }}
        </x-button>
    </x-slot>
</x-form-section>
