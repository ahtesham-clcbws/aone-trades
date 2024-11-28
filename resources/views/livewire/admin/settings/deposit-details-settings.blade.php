<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            Deposit Details
        </h2>
    </div>

    <x-mary-card>
        <div class="flex justify-end">
            <x-mary-button label="Add Download" class="btn-primary btn-sm" icon="o-plus-circle" title="Add Download" wire:click="openAddForm()" />
        </div>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination
            per-page="perPage"
            :per-page-values="[10, 20, 50]"
            wire:model="expanded"
            expandable show-empty-text>
            <x-slot:empty>
                <x-mary-icon name="o-cube" label="It is empty." />
            </x-slot:empty>
            @scope('cell_id', $depositDetail)
            {{ $loop->index+1 }}
            @endscope

            @scope('cell_type', $depositDetail)
            {{ ucfirst($depositDetail->type) }}
            @endscope

            @scope('expansion', $depositDetail)
            <div class="bg-base-200 p-4">
                @if ($depositDetail->type == 'bank')
                <table class="customTable w-full">
                    <tr>
                        <td><b>Account Number:</b></td>
                        <td>{{ $depositDetail->address }}</td>
                    </tr>
                    <tr>
                        <td><b>Account Name:</b></td>
                        <td>{{ $depositDetail->account_name }}</td>
                    </tr>
                    <tr>
                        <td><b>Bank Name:</b></td>
                        <td>{{ $depositDetail->bank_name }}</td>
                    </tr>
                    <tr>
                        <td><b>IFSC Code:</b></td>
                        <td>{{ $depositDetail->ifsc_code }}</td>
                    </tr>
                    @if ($depositDetail->micr_code)
                    <tr>
                        <td><b>MICR:</b></td>
                        <td>{{ $depositDetail->micr_code }}</td>
                    </tr>
                    @endif
                    @if ($depositDetail->branch_address)
                    <tr>
                        <td><b>Bank Branch:</b></td>
                        <td>{{ $depositDetail->branch_address }}</td>
                    </tr>
                    @endif
                </table>
                @else
                <img src="{{ '/storage/'.$depositDetail->qr_code }}" class="max-h-52 h-full w-auto" />
                @endif
            </div>
            @endscope

            @scope('cell_actions', $entity)
            <div class="flex gap-2">
                <x-mary-button icon="o-trash" class="btn-circle btn-sm btn-error" title="Delete" wire:click="delete({{$entity->id}})"
                    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE" />
            </div>
            @endscope

        </x-mary-table>
    </x-mary-card>

    <x-mary-modal wire:model="addDepositDetails" class="backdrop-blur" persistent>
        <x-mary-form wire:submit="save" no-separator>
            <x-mary-select label="Type" :options="$detailTypes" wire:model.live="type" inline
                placeholder="Select details type"
                placeholder-value="0" />
            @if ($type)
            <x-mary-input label="{{ $type == 'bank' ? 'Bank Account Number' : ($type == 'upi' ? 'UPI address' : 'Tether address') }}" wire:model="address" inline />
            @endif

            @if ($type == 'upi' || $type == 'tether')
            <x-mary-file wire:model.live="qr_code" accept="image/png, image/jpeg" class="*:w-full" />
            @endif

            @if ($type == 'bank')
            <x-mary-input label="Name on Account" wire:model="account_name" inline />
            <x-mary-input label="Bank Name" wire:model="bank_name" inline />
            <x-mary-input label="IFSC Code" wire:model="ifsc_code" inline />
            <x-mary-input label="MICR (optional)" wire:model="micr_code" inline />
            <x-mary-input label="Branch address (optional)" wire:model="branch_address" inline />
            @endif

            <x-slot:actions>
                <x-mary-button label="Save" type="submit" class="btn-primary" spinner="save" />
                <x-mary-button type="button" label="Cancel" wire:click="closeAddForm" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
