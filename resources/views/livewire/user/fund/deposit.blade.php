<div>
    <div class="mb-5">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Manage Funds') }}
        </h2>
    </div>
    <x-mary-card>
        <div class="flex gap-3">
            <x-mary-icon name="o-circle-stack" class="cursor-pointer bg-green-100 text-green-600 h-12 w-12 rounded-full p-2" />
            <div class="flex flex-col gap-3">
                <p class="text-2xl font-bold">Deposit</p>
                <p class="test-gray-700">
                    <b>Note:</b> Please Complete the payment first and take screenshot of the successfull payment and attach in the form below.
                </p>
                <div>
                    <x-mary-button label="Click to Deposit" class="btn-primary btn-sm text-white" />
                </div>
            </div>
        </div>
        <x-mary-form wire:submit="save" class="mt-5" no-separator>
            <x-mary-input label="Amount" placeholder="Enter amount in dollars" wire:model="amount" type="number" prefix="$" required />
            <x-mary-file wire:model="file" label="Receipt" accept="image/*" class="*:w-full" required />
            <div class="mt-4">
                <x-mary-button label="Deposit" class="btn-primary" type="submit" spinner="save" />
            </div>
        </x-mary-form>
    </x-mary-card>
</div>
