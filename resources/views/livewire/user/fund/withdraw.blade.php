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
            <div class="grid md:grid-cols-2 gap-3">
                <x-mary-input placeholder="Enter amount in dollars" type="number" wire:model="amount" prefix="$" required />
                <x-mary-password placeholder="Password" wire:model="password" clearable required />
            </div>
            <x-mary-textarea wire:model="comments" placeholder="Comments" rows="3" inline class="leading-snug"/>
            <div>
                @if (count($transferTypeAlreadyAdded))
                <x-mary-radio label="Select mode" :options="$typeOptions" wire:model.live="type" required />
                @else
                Not transfer details found, please add Bank account, UPI or USDT to profile to proceed with withdrawals.<br />
                <x-mary-button class="btn-secondary btn-sm" link="{{ route('user.account.profile') }}" label="Go to Profile" icon="o-user" />
                @endif
            </div>
            <div class="">
                <x-mary-button label="Submit Request" class="btn-primary mt-3" type="submit" spinner="save" />
            </div>
        </x-mary-form>
    </x-mary-card>
</div>
