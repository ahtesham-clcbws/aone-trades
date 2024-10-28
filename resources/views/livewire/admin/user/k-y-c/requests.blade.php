<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('KYC Submitions') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination>

            @scope('cell_id', $user)
            {{ $loop->index + 1 }}
            @endscope

            @scope('cell_status', $user)
            <x-mary-badge value="{{ ucfirst($user->status) }}" class="badge-{{ $user->status == 'rejected' ? 'error' : ($user->status == 'approved' ? 'success' : 'warning') }}" />
            @if ($user->status == 'rejected' && $user->reject_notes)
            <span class="text-red-500">{{ $user->reject_notes }}</span>
            @endif
            @endscope

            @scope('cell_created_at', $user)
            {{ date('d-M-Y h:i A', strtotime($user->created_at)) }}
            @endscope

            @scope('cell_actions', $user)
            <div class="flex gap-2">
                <x-mary-button icon="o-eye" class="btn-circle btn-sm bg-blue-400 text-white" title="View" wire:click="openDetails('{{$user->id}}')"/>
                <x-mary-button icon="o-check" class="btn-circle btn-sm btn-success" title="Approve" />
                <x-mary-button icon="o-x-mark" class="btn-circle btn-sm btn-error" title="Reject" />
            </div>
            @endscope

        </x-mary-table>
    </x-mary-card>
    <x-mary-modal wire:model="openImage" class="backdrop-blur">
    </x-mary-modal>
</div>
