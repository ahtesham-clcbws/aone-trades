<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Users/Clients') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$users" with-pagination
            per-page="perPage"
            :per-page-values="[10, 20, 50]">

            @scope('cell_amount', $user)
            $ {{ $user->amount }}
            @endscope

            @scope('cell_id', $user)
            {{ $loop->index + 1 }}
            @endscope

            @scope('cell_created_at', $user)
            {{ date('d-M-Y h:i A', strtotime($user->created_at)) }}
            @endscope

            @scope('cell_status', $user)
            <x-mary-badge value="{{ ucfirst($user->status) }}" class="badge-{{ $user->status == 'rejected' ? 'error' : ($user->status == 'approved' ? 'success' : 'warning') }}" />
            @if ($user->status == 'rejected' && $user->reject_notes)
            <span class="text-red-500">{{ $user->reject_notes }}</span>
            @endif
            @endscope

            @scope('cell_actions', $user)
            <div class="flex gap-2">
                <x-mary-button class="btn-circle btn-sm bg-orange-500" title="Ban User"><x-mary-icon name="bi.ban" /></x-mary-button>
                <x-mary-button icon="o-trash" class="btn-circle btn-sm btn-error" title="Delete" />
            </div>
            @endscope
        </x-mary-table>
    </x-mary-card>
</div>
