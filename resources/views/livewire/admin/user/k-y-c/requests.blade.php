<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('KYC Submitions') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination show-empty-text>

            @scope('cell_id', $kyc)
            {{ $loop->index + 1 }}
            @endscope

            @scope('cell_status', $kyc)
            <x-mary-badge value="{{ ucfirst($kyc->status) }}" class="badge-{{ $kyc->status == 'rejected' ? 'error' : ($kyc->status == 'approved' ? 'success' : 'warning') }}" />
            @if ($kyc->status == 'rejected' && $kyc->reject_notes)
            <span class="text-red-500">{{ $kyc->reject_notes }}</span>
            @endif
            @endscope

            @scope('cell_created_at', $kyc)
            {{ date('d-M-Y h:i A', strtotime($kyc->created_at)) }}
            @endscope

            @scope('cell_actions', $kyc)
            <div class="flex gap-2">
                <x-mary-button icon="o-eye" class="btn-circle btn-sm bg-blue-400 text-white" title="View" wire:click="viewRequest('{{$kyc->id}}')" />
                @if ($kyc->status == 'pending')
                <x-mary-button icon="o-check" type="button" class="btn-circle btn-sm btn-success" title="Approve" spinner="approve({{$kyc->id}})" wire:click="approve({{$kyc->id}})" />
                <x-mary-button icon="o-x-mark" type="button" class="btn-circle btn-sm btn-error" title="Reject" wire:click="openRejectPanel({{$kyc->id}})" />
                @endif
                <x-mary-button icon="o-trash" type="button" class="btn-circle btn-sm btn-secondary" title="Delete" spinner="delete({{$kyc->id}})" wire:click="delete({{$kyc->id}})" />
            </div>
            @endscope

        </x-mary-table>
    </x-mary-card>
    <x-mary-modal wire:model="showKycModal" class="backdrop-blur">
        <div class="w-full">
            <table class="customTable w-full">
                <tr>
                    <td><b>Name: </b></td>
                    <td>{{ $userKyc?->user?->name }}</td>
                </tr>

                <tr>
                    <td><b>Date of Birth: </b></td>
                    <td>{{ $userKyc?->user?->date_of_birth ? date('d M, Y', strtotime($userKyc?->user?->date_of_birth)) : 'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Gender: </b></td>
                    <td>{{ $userKyc?->user?->gender??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Time Zone: </b></td>
                    <td>{{ $userKyc?->user?->timezone??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Address: </b></td>
                    <td>{{ $userKyc?->user?->address??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Pincode: </b></td>
                    <td>{{ $userKyc?->user?->pincode??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>City/State/Country: </b></td>
                    <td>{{ $userKyc?->user?->city??'-' }} / {{ $userKyc?->user?->state??'-' }} / {{ $userKyc?->user?->country??'-' }} </td>
                </tr>

                <tr>
                    @if ($userKyc?->user?->profile_photo_path)
                    <td><img src="{{ $userKyc->user->profile_photo_url }}" /></td>
                    @endif
                    @if ($userKyc?->pancard_file)
                    <td><img src="/storage/{{ $userKyc->pancard_file }}" /></td>
                    @endif
                </tr>
                <tr>
                    @if ($userKyc?->address_proof_file)
                    <td><img src="/storage/{{ $userKyc->address_proof_file }}" /></td>
                    @endif
                    @if ($userKyc?->address_proof_file_back)
                    <td><img src="/storage/{{ $userKyc->address_proof_file_back }}" /></td>
                    @endif
                </tr>
            </table>
        </div>
    </x-mary-modal>
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
