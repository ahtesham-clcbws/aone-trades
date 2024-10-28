<div>
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight flex-inline">
            {{ __('Manage Account') }}
        </h2>
        <x-mary-button label="Edit Profile!" class="btn-sm" link="{{ route('profile.show') }}" />
    </div>
    <div class="grid md:grid-cols-2 gap-4 mt-4">
        <x-mary-card>
            <div class="flex items-center gap-3 mb-3">
                <img src="{{ auth()->user()->profile_photo_url }}" class="h-12 w-12 object-fill rounded-full" alt="{{ auth()->user()->name }}" />
                <div class="flex flex-col gap-3">
                    <p class="text-2xl font-bold">{{ auth()->user()->name }}</p>
                </div>
            </div>
            <div class="grid gap-3 divide-y mt-2 *:pt-3">
                <div class="flex flex-col md:flex-row md:justify-between">
                    <b>Email</b>
                    <p>{!! auth()->user()->email ?? '<span class="text-red-500">Pending!</span>' !!}</p>
                </div>
                <div class="flex flex-col md:flex-row md:justify-between">
                    <b>Mobile Number</b>
                    <p>{!! auth()->user()->phone_number ?? '<span class="text-red-500">Pending!</span>' !!}</p>
                </div>
                <div class="flex flex-col md:flex-row md:justify-between">
                    <b>Date of Birth</b>
                    <p>{!! auth()->user()->date_of_birth ? date('F d Y',strtotime(auth()->user()->date_of_birth)) : '<span class="text-red-500">Pending!</span>' !!}</p>
                </div>
                <div class="flex flex-col md:flex-row md:justify-between">
                    <b>Gender</b>
                    <p>{!! auth()->user()->gender ?? '<span class="text-red-500">Pending!</span>' !!}</p>
                </div>
                <div class="grid gap-2">
                    <div class="w-full flex flex-col md:flex-row md:justify-between md:items-center">
                        <b>Active Plan</b>
                        <x-mary-button label="{{ auth()->user()->package }}" class="btn-primary btn-sm" link="{{ route('profile.show') }}/#change-plan" />
                    </div>
                    @if ($planRequest)
                    <p class="text-info">
                        Account upgrade request for <b>{{ $planRequest->package }}</b> plan already sent on <b>{{ date('d-M-Y h:i A', strtotime($planRequest->created_at)) }}</b> please wait for sometime our executive will get in touch with you.
                    </p>
                    @endif
                </div>

            </div>
        </x-mary-card>
        <x-mary-card>
            <div class="flex items-center gap-3 mb-3">
                <x-mary-icon name="o-adjustments-vertical" class="cursor-pointer bg-green-100 text-green-600 h-12 w-12 rounded-full p-2" />
                <div class="flex flex-col gap-3">
                    <p class="text-2xl font-bold">Preferences</p>
                </div>
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
        <x-mary-card>
            <div class="flex justify-between items-center gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <x-mary-icon name="o-building-office-2" class="cursor-pointer bg-green-100 text-green-600 h-12 w-12 rounded-full p-2" />
                    <div class="flex flex-col gap-3">
                        <p class="text-2xl font-bold">Transfer Details</p>
                    </div>
                </div>
                @if (count($transferDetails) < 3)
                    <x-mary-button icon="o-plus" class="btn-circle btn-primary btn-sm" wire:click="addDetails()" />
                @endif
            </div>
            <div class="grid gap-3 divide-y mt-2 *:pt-3 mb-3">
                @if (count($transferDetails))
                @foreach ($transferDetails as $transferDetail)
                <div>
                    @if (strtolower($transferDetail->type) == 'bank')
                    <table class="customTable w-full">
                        <tr>
                            <td><b>Bank Name:</b></td>
                            <td>{{ $transferDetail->bank_name }}</td>
                        </tr>
                        <tr>
                            <td><b>Account Number:</b></td>
                            <td>{{ $transferDetail->address }}</td>
                        </tr>
                        <tr>
                            <td><b>Bank Branch:</b></td>
                            <td>{{ $transferDetail->bank_branch }}</td>
                        </tr>
                        <tr>
                            <td><b>IFSC Code:</b></td>
                            <td>{{ $transferDetail->ifsc_code }}</td>
                        </tr>
                    </table>
                    @else
                    <b>{{ $transferDetail->type }}: </b><span>{{ $transferDetail->address }}</span>
                    @endif
                </div>
                @endforeach
                @else
                <div>
                    No transfer details found<br />
                    Plase add</br />
                    <x-mary-button label="Add Details" class="btn-primary btn-sm mt-3" wire:click="addDetails()" />
                </div>
                @endif
            </div>
        </x-mary-card>
    </div>
    <x-mary-modal wire:model="openAddDetailsForm" class="backdrop-blur" persistent>
        <x-mary-form wire:submit="save" no-separator>
            <x-mary-select
                label="Detail Type"
                placeholder="Select type"
                placeholder-value="0"
                icon="o-squares-plus"
                :options="$typeOptions"
                wire:model.live="type"
                inline required />

            @if ($type)
            <x-mary-input label="{{ $type == 'Bank' ? 'Account Number' : ($type == 'UPI' ? 'UPI Address' : 'USDT Address') }}" wire:model="address" inline required />
            @if ($type == 'Bank')
            <x-mary-input label="Bank Name" wire:model="bank_name" inline required />
            <x-mary-input label="Bank Branch" wire:model="bank_branch" inline required />
            <x-mary-input label="IFSC Code" wire:model="ifsc_code" inline required />
            @endif
            @endif
            @if ($editDetails)
            <x-mary-select
                label="Is Active?"
                placeholder="Select state"
                placeholder-value="0"
                :options="$activeOptions"
                wire:model.live="isActive"
                inline required />
            @endif

            <x-slot:actions>
                <x-mary-button label="Save" class="btn-primary" type="submit" spinner="save" />
                <x-mary-button label="Cancel" class="btn-error" wire:click="closeModal()" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
    <style>
        .customTable,
        .customTable th,
        .customTable td {
            border: 1px solid lightgray;
            border-collapse: collapse;
        }
        .customTable td {
            padding: 2px 8px;
        }
    </style>
</div>
