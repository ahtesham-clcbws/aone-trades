<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Withdrawl Requests') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$withdrawls" with-pagination
            per-page="perPage"
            :per-page-values="[10, 20, 50]"
            wire:model="expanded" expandable>
            @scope('cell_id', $withdrawal)
            {{ $loop->index + 1 }}
            @endscope

            @scope('cell_user.name', $withdrawal)
            {{ $withdrawal->user->name }}<br />
            {{ $withdrawal->user->email }}
            @endscope
            @scope('cell_amount', $withdrawal)
            $ {{ $withdrawal->amount }}
            @endscope

            @scope('cell_status', $withdrawal)
            <x-mary-badge value="{{ ucfirst($withdrawal->status) }}" class="badge-{{ $withdrawal->status == 'rejected' ? 'error' : ($withdrawal->status == 'approved' ? 'success' : 'warning') }}" />
            @endscope

            @scope('cell_created_at', $withdrawal)
            {{ date('d-M-Y h:i A', strtotime($withdrawal->created_at)) }}
            @endscope

            @scope('cell_actions', $withdrawal)
            <div class="flex gap-2">
                @if ($withdrawal->status == 'pending')
                <x-mary-button icon="o-check" type="button" class="btn-circle btn-sm btn-success" title="Approve" spinner="approve({{$withdrawal->id}})" wire:click="approve({{$withdrawal->id}})" />
                <x-mary-button icon="o-x-mark" type="button" class="btn-circle btn-sm btn-error" title="Reject" wire:click="openRejectPanel({{$withdrawal->id}})" />
                @endif
                <x-mary-button icon="o-trash" type="button" class="btn-circle btn-sm btn-secondary" title="Delete" spinner="delete({{$withdrawal->id}})" wire:click="delete({{$withdrawal->id}})" />
            </div>
            @endscope

            @scope('expansion', $withdrawal)
            <div class="bg-base-200 p-3">
                @if ($withdrawal->transfer)
                @if (strtolower($withdrawal->transfer->type) == 'bank')
                <table class="customTable w-full">
                    <tr>
                        <td><b>Bank Name:</b></td>
                        <td>{{ $withdrawal->transfer->bank_name }}</td>
                    </tr>
                    <tr>
                        <td><b>Account Number:</b></td>
                        <td>{{ $withdrawal->transfer->address }}</td>
                    </tr>
                    <tr>
                        <td><b>Bank Branch:</b></td>
                        <td>{{ $withdrawal->transfer->bank_branch }}</td>
                    </tr>
                    <tr>
                        <td><b>IFSC Code:</b></td>
                        <td>{{ $withdrawal->transfer->ifsc_code }}</td>
                    </tr>
                </table><br />
                @else
                <p><b>{{ $withdrawal->transfer->type }}: </b><span>{{ $withdrawal->transfer->address }}</span></p><br />
                @endif
                @endif
                @if ($withdrawal->status == 'rejected' && $withdrawal->reject_notes)
                <p class="text-error mb-3"><b>Reject Notes: </b> {{ $withdrawal->reject_notes }}</p><br />
                @endif
                <p><b>User Comments: </b> {{ $withdrawal->user_comments ? $withdrawal->user_comments : 'N/A' }}</p>
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
