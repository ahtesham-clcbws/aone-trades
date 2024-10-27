<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Recent Withdrawl Requests') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$withdrawls" with-pagination>
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
</div>
