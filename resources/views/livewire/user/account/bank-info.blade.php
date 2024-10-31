<div class="grid md:grid-cols-2 gap-4">

    <x-mary-card>
        <div class="flex items-center justify-between gap-3 mb-3">
            <div class="flex items-center gap-3">
                <x-mary-icon name="o-building-office-2" class="cursor-pointer bg-primary/40 text-primary h-12 w-12 rounded-full p-2" />
                <div class="flex flex-col gap-3">
                    <p class="text-2xl font-bold">Transfer Details</p>
                </div>
            </div>
            @if (count($transferDetails)
            < 3)
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
            <x-slot:actions>
                <x-mary-button label="Save" class="btn-primary" type="submit" spinner="save" />
                <x-mary-button label="Cancel" class="btn-error" wire:click="closeModal()" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

</div>
