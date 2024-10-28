<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Plan change Requests') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination>
            @scope('cell_status', $deposit)
            <x-mary-badge value="{{ ucfirst($deposit->status) }}" class="badge-{{ $deposit->status == 'rejected' ? 'error' : ($deposit->status == 'approved' ? 'success' : 'warning') }}" />
            @if ($deposit->status == 'rejected' && $deposit->reject_notes)
            <span class="text-red-500">{{ $deposit->reject_notes }}</span>
            @endif
            @endscope

            @scope('cell_id', $deposit)
            {{ $loop->index + 1 }}
            @endscope

            @scope('cell_created_at', $deposit)
            {{ date('d-M-Y h:i A', strtotime($deposit->created_at)) }}
            @endscope

            @scope('cell_actions', $entity)
            <div class="flex gap-2">
                <x-mary-button icon="o-check" class="btn-circle btn-sm btn-success" title="Approve" />
                <x-mary-button icon="o-x-mark" class="btn-circle btn-sm btn-error" title="Reject" />
            </div>
            @endscope
        </x-mary-table>
    </x-mary-card>
</div>
