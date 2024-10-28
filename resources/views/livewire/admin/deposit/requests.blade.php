<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Deposit Requests') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$deposits" with-pagination
            per-page="perPage"
            :per-page-values="[10, 20, 50]"
            wire:model="expanded" expandable>
            @scope('cell_amount', $deposit)
            ${{ $deposit->amount }}
            @endscope
            @scope('cell_status', $deposit)
            <x-mary-badge value="{{ ucfirst($deposit->status) }}" class="badge-{{ $deposit->status == 'rejected' ? 'error' : ($deposit->status == 'approved' ? 'success' : 'warning') }}" />
            @endscope

            @scope('cell_id', $deposit)
            {{ $loop->index + 1 }}
            @endscope

            @scope('cell_created_at', $deposit)
            {{ date('d-M-Y h:i A', strtotime($deposit->created_at)) }}
            @endscope

            @scope('cell_actions', $deposit)
            <div class="flex gap-2">
                @if ($deposit->status == 'pending')
                <x-mary-button icon="o-check" type="button" class="btn-circle btn-sm btn-success" title="Approve" spinner="approve({{$deposit->id}})" wire:click="approve({{$deposit->id}})" />
                <x-mary-button icon="o-x-mark" type="button" class="btn-circle btn-sm btn-error" title="Reject" wire:click="openRejectPanel({{$deposit->id}})" />
                @endif
                <x-mary-button icon="o-trash" type="button" class="btn-circle btn-sm btn-secondary" title="Delete" spinner="delete({{$deposit->id}})" wire:click="delete({{$deposit->id}})" />
            </div>
            @endscope

            @scope('expansion', $deposit)
            @if ($deposit->status == 'rejected' && $deposit->reject_notes)
            <p class="text-red-500 mb-2">{{ $deposit->reject_notes }}</p>
            @endif
            <img src="{{ '/storage/'.$deposit->deposit_receipt }}" alt="" class="w-full h-auto object-contain" />
            @endscope

        </x-mary-table>
    </x-mary-card>
    <x-mary-modal wire:model="showRejectPanel" class="backdrop-blur" persistent>
        <x-mary-form wire:submit="reject" no-separator>
            <x-mary-textarea
                label="Reject Notes/Comments"
                wire:model="rejectMessage"
                rows="3"
                inline
                class="leading-snug" />

            <x-slot:actions>
                <x-mary-button label="Reject" class="btn-error" type="submit" spinner="reject" />
                <x-mary-button label="Close" wire:click="closeRejectPanel()" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
