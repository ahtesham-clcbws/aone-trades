<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Recent Withdrawl Requests') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$withdrawls" with-pagination show-empty-text wire:model="expanded" expandable>
            @scope('cell_amount', $entity)
            $ {{ $entity->amount }}
            @endscope
            @scope('cell_status', $entity)
            <x-mary-badge :value="$entity->status" class="badge-{{ $entity->status == 'rejected' ? 'error' : ($entity->status == 'approved' ? 'success' : 'warning') }}" />
            @if ($entity->status == 'rejected' && $entity->reject_notes)
            <span class="text-red-500">{{ $entity->reject_notes }}</span>
            @endif
            @endscope
            @scope('expansion', $entity)
            <div class="bg-base-200 p-8">
                @if (strtolower($entity->type) == 'bank')
                <table class="customTable w-full">
                    <tr>
                        <td><b>Bank Name:</b></td>
                        <td>{{ $entity->bank_name }}</td>
                    </tr>
                    <tr>
                        <td><b>Account Number:</b></td>
                        <td>{{ $entity->address }}</td>
                    </tr>
                    <tr>
                        <td><b>Bank Branch:</b></td>
                        <td>{{ $entity->bank_branch }}</td>
                    </tr>
                    <tr>
                        <td><b>IFSC Code:</b></td>
                        <td>{{ $entity->ifsc_code }}</td>
                    </tr>
                </table>
                @elseif(strtolower($entity->type) == 'usdt')
                <p><b>USDT address: </b>{{ $entity->address }}</p>
                @else
                <p><b>UPI address: </b>{{ $entity->address }}</p>
                @endif
            </div>
            @endscope
        </x-mary-table>
    </x-mary-card>
</div>
