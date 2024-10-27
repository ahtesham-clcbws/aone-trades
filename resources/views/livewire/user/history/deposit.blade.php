<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Recent Deposits') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$deposits" with-pagination>
            @scope('cell_deposit_receipt', $deposit)
            <x-mary-avatar :image="'/storage/'.$deposit->deposit_receipt" wire:click="openDepositImage('{{$deposit->deposit_receipt}}')" class="cursor-pointer" />
            @endscope
            @scope('cell_amount', $deposit)
            $ {{ $deposit->amount }}
            @endscope
            @scope('cell_status', $deposit)
            <x-mary-badge :value="$deposit->status" class="badge-{{ $deposit->status == 'rejected' ? 'danger' : ($deposit->status == 'approved' ? 'success' : 'warning') }}" />
            @if ($deposit->status == 'rejected' && $deposit->reject_notes)
            <span class="text-red-500">{{ $deposit->reject_notes }}</span>
            @endif
            @endscope
        </x-mary-table>
    </x-mary-card>
    <x-mary-modal wire:model="openImage" class="backdrop-blur">
        <img src="/storage/{{$imagePath}}" class="w-full h-auto" />
    </x-mary-modal>
</div>
