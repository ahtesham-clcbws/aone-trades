<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Plan change Requests') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination show-empty-text>

            @scope('cell_id', $request)
            {{ $loop->index + 1 }}
            @endscope

            @scope('cell_user.name', $withdrawal)
            {{ $withdrawal->user->name }}<br />
            {{ $withdrawal->user->email }}
            @endscope

            @scope('cell_status', $request)
            <x-mary-badge value="{{ ucfirst($request->status) }}" class="badge-{{ $request->status == 'rejected' ? 'error' : ($request->status == 'approved' ? 'success' : 'warning') }}" />
            @if ($request->status == 'rejected' && $request->reject_notes)
            <br /><span class="text-red-500">{{ $request->reject_notes }}</span>
            @endif
            @endscope

            @scope('cell_created_at', $request)
            {{ date('d-M-Y h:i A', strtotime($request->created_at)) }}
            @endscope

            @scope('cell_actions', $request)
            <div class="flex gap-2">
                @if ($request->status != 'approved')
                <x-mary-button icon="o-check" type="button" class="btn-circle btn-sm btn-success" title="Approve" spinner="approve({{$request->id}})" wire:click="approve({{$request->id}})" />
                @endif
                @if ($request->status != 'rejected')
                <x-mary-button icon="o-x-mark" type="button" class="btn-circle btn-sm btn-error" title="Reject" wire:click="openRejectPanel({{$request->id}})" />
                @endif
                <x-mary-button icon="o-trash" type="button" class="btn-circle btn-sm btn-secondary" title="Delete" spinner="delete({{$request->id}})" wire:click="delete({{$request->id}})" />
            </div>
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
