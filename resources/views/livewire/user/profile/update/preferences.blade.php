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
            <x-mary-input label="Time Zone" id="timezone" type="text" class="mt-1 block w-full input-sm" wire:model="timezone" readonly />
        </div>
        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Address" id="address" type="text" class="mt-1 block w-full input-sm" wire:model="address" required />
        </div>
        <!-- City -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="City" id="city" type="text" class="mt-1 block w-full input-sm" wire:model="city" required />
        </div>
        <!-- State/Province -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="State/Province" id="state" type="text" class="mt-1 block w-full input-sm" wire:model="state" required />
        </div>
        <!-- Country -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Country" id="country" type="text" class="mt-1 block w-full input-sm" wire:model="country" required />
        </div>
        <!-- Pincode -->
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Pincode" id="pincode" type="number" class="mt-1 block w-full input-sm" wire:model="pincode" required />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-mary-button type="submit" class="btn-primary btn-sm ms-3" label="Update" />
    </x-slot>
</x-form-section>
