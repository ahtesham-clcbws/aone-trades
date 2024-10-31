<div>
    <div class="mb-5">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Manage Funds') }}
        </h2>
    </div>
    <x-mary-card>
        <div class="flex items-center gap-3 mb-3">
            <x-mary-icon name="o-circle-stack" class="cursor-pointer bg-green-100 text-green-600 h-12 w-12 rounded-full p-2" />
            <div class="flex flex-col gap-3">
                <p class="text-2xl font-bold">Withdraw</p>
            </div>
        </div>
        <x-mary-form wire:submit="save" class="mt-5" no-separator>
            <div class="grid gap-3">
                <x-mary-input label="Amount" placeholder="Enter amount in dollars" type="number" wire:model="amount" prefix="$" required />
                <div class="grid gap-3">
                    <x-mary-radio label="Withdrawal Method" :options="$typeOptions" wire:model.live="type" required />
                    @if ($type)
                    <x-mary-input label="{{ $type == 'Bank' ? 'Account Number' : ($type == 'UPI' ? 'UPI Address' : 'USDT Address') }}" wire:model="address" required />
                    @if ($type == 'Bank')
                    <x-mary-input label="Bank Name" wire:model="bank_name" required />
                    <x-mary-input label="Bank Branch" wire:model="bank_branch" required />
                    <x-mary-input label="IFSC Code" wire:model="ifsc_code" required />
                    @endif
                    @endif
                </div>
            </div>
            <div class="">
                <x-mary-button label="Submit Request" class="btn-primary mt-3" type="submit" spinner="save" />
            </div>
        </x-mary-form>
    </x-mary-card>
</div>
