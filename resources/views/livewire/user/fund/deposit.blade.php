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
                <p class="text-red-700">
                    <b>Note:</b> Please Complete the payment first (by below methods) and take screenshot of the successfull payment and attach in the form below.
                </p>
                <div class="grid grid-cols-3 *:border *:rounded-xl *:p-3 gap-3">
                    <div>
                        <p class="text-xl font-semibold border-b mb-2 pb-2">
                            Deposit USDT TRC20
                        </p>
                        <p class="text-wrap break-all">
                            <b>Address:-</b> TKkd8f2X1wrW1zg3aFmG7pejZn6EZqSvmg
                        </p>
                    </div>
                    <div>
                        <p class="text-xl font-semibold border-b mb-2 pb-2">
                            Deposit Via UPI/QR
                        </p>
                        <p class="text-wrap break-all">
                            <img src="/img/qr.png" class="w-full" />
                        </p>
                    </div>
                    <div>
                        <p class="text-xl font-semibold border-b mb-2 pb-2">
                            Deposit to Bank
                        </p>
                        <p class="text-wrap break-all">
                            <b>Bank:-</b><br/>
                            <b>A/C No:-</b><br/>
                            <b>Name:-</b><br/>
                            <b>IFSC:-</b><br/>
                            <b>Branch:-</b>
                        </p>
                    </div>
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
