<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Current Password" id="current_password" type="password" class="mt-1 block w-full input-sm" wire:model="state.current_password" autocomplete="current-password" required />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="New Password" id="password" type="password" class="mt-1 block w-full input-sm" wire:model="state.password" autocomplete="new-password" required />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-mary-input label="Confirm Password" id="password_confirmation" type="password" class="mt-1 block w-full input-sm" wire:model="state.password_confirmation" autocomplete="new-password" required />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-mary-button type="submit" label="UPDATE" class="btn-primary btn-sm" />
    </x-slot>
</x-form-section>
