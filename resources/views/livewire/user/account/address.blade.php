<div class="grid md:grid-cols-2 gap-4">

    @if ($showEditForm == true)
    <x-mary-card>
        <div class="flex items-center justify-between gap-3 mb-3">
            <div class="flex items-center gap-3">
                <x-mary-icon name="o-map-pin" class="cursor-pointer bg-primary/40 text-primary h-12 w-12 rounded-full p-2" />
                <div class="flex flex-col gap-3">
                    <p class="text-2xl font-bold">Update Preferences</p>
                </div>
            </div>
        </div>
        <x-mary-form wire:submit="save">
            <div class="grid gap-1 mt-2 *:pt-3">
                <!-- Time Zone -->
                <x-mary-input label="Time Zone" id="timezone" type="text" class="mt-1 block w-full input-sm" inline wire:model="timezone" required />

                <!-- Address -->
                <x-mary-input label="Address" id="address" type="text" class="mt-1 block w-full input-sm" inline wire:model="address" required />

                <!-- City -->
                <x-mary-input label="City" id="city" type="text" class="mt-1 block w-full input-sm" inline wire:model="city" required />

                <!-- State/Province -->
                <x-mary-input label="State/Province" id="state" type="text" class="mt-1 block w-full input-sm" inline wire:model="state" required />

                <!-- Country -->
                <x-mary-input label="Country" id="country" type="text" class="mt-1 block w-full input-sm" inline wire:model="country" required />

                <!-- Pincode -->
                <x-mary-input label="Pincode" id="pincode" type="number" class="mt-1 block w-full input-sm" inline wire:model="pincode" required />

            </div>
            <div class="mt-3 flex justify-between gap-3">
                <x-mary-button label="Cancel" wire:click="closeForm()" spinner="closeForm" />
                <x-mary-button type="submit" label="Update" class="btn-primary" spinner="save" />
            </div>
        </x-mary-form>
    </x-mary-card>
    @else
    <x-mary-card>
        <div class="flex items-center justify-between gap-3 mb-3">
            <div class="flex items-center gap-3">
                <x-mary-icon name="o-map-pin" class="cursor-pointer bg-primary/40 text-primary h-12 w-12 rounded-full p-2" />
                <div class="flex flex-col gap-3">
                    <p class="text-2xl font-bold">Preferences</p>
                </div>
            </div>
            <x-mary-button label="Edit Details" class="btn-sm btn-outline btn-primary" wire:click="showForm()" spinner="showForm" />
        </div>
        <div class="grid gap-3 divide-y mt-2 *:pt-3">
            <div class="flex flex-col md:flex-row md:justify-between">
                <b>Time Zone</b>
                <p>{{ auth()->user()->timezone }}</p>
            </div>
            <div class="flex flex-col {{ auth()->user()->address ? '' : 'md:flex-row md:justify-between' }}">
                <b>Address:</b>
                <p>{!! auth()->user()->address ?? '<span class="text-red-500">Pending!</span>' !!}</p>
            </div>
            <div class="flex flex-col md:flex-row md:justify-between">
                <b>City</b>
                <p>{!! auth()->user()->city ?? '<span class="text-red-500">Pending!</span>' !!}</p>
            </div>
            <div class="flex flex-col md:flex-row md:justify-between">
                <b>State/Provision</b>
                <p>{!! auth()->user()->state ?? '<span class="text-red-500">Pending!</span>' !!}</p>
            </div>
            <div class="flex flex-col md:flex-row md:justify-between">
                <b>Country</b>
                <p>{!! auth()->user()->country ?? '<span class="text-red-500">Pending!</span>' !!}</p>
            </div>
            <div class="flex flex-col md:flex-row md:justify-between">
                <b>Pincode</b>
                <p>{!! auth()->user()->pincode ?? '<span class="text-red-500">Pending!</span>' !!}</p>
            </div>

            <div class="flex flex-col md:flex-row md:justify-between">
                <b>Registered On</b>
                <p>{!! auth()->user()->created_at ? date('d M Y',strtotime(auth()->user()->created_at)) : '' !!}</p>
            </div>
        </div>
    </x-mary-card>
    @endif
</div>
