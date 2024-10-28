<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('KYC Submitions') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$data" with-pagination>

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
                <x-mary-button icon="o-check" class="btn-circle btn-sm btn-success" title="Approve" />
                <x-mary-button icon="o-x-mark" class="btn-circle btn-sm btn-error" title="Reject" />
            </div>
            @endscope

        </x-mary-table>
    </x-mary-card>
    <x-mary-modal wire:model="showKycModal" class="backdrop-blur">
        <div class="w-full">
            <table class="customTable w-full">
                <tr>
                    <td colspan="2"><b>Name on ID: </b></td>
                    <td colspan="2">{{ $userKyc?->name }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Pancard ID: </b></td>
                    <td colspan="2">{{ $userKyc?->pancard }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Bank Name: </b></td>
                    <td colspan="2">{{ $userKyc?->bank_name }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Account Number: </b></td>
                    <td colspan="2">{{ $userKyc?->account_number }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>IFSC Code: </b></td>
                    <td colspan="2">{{ $userKyc?->ifsc_code }}</td>
                </tr>

                <tr>
                    <td colspan="2"><b>Date of Birth: </b></td>
                    <td colspan="2">{{ $userKyc?->user?->date_of_birth ? date('d M, Y', strtotime($userKyc?->user?->date_of_birth)) : 'N/A' }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Gender: </b></td>
                    <td colspan="2">{{ $userKyc?->user?->gender??'N/A' }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Time Zone: </b></td>
                    <td colspan="2">{{ $userKyc?->user?->timezone??'N/A' }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Address: </b></td>
                    <td colspan="2">{{ $userKyc?->user?->address??'N/A' }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Pincode: </b></td>
                    <td colspan="2">{{ $userKyc?->user?->pincode??'N/A' }}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>City/State/Country: </b></td>
                    <td colspan="2">{{ $userKyc?->user?->city??'-' }} / {{ $userKyc?->user?->state??'-' }} / {{ $userKyc?->user?->country??'-' }} </td>
                </tr>

                <tr>
                    @if ($userKyc?->user?->profile_photo_path)
                    <td><img src="{{ $userKyc->user->profile_photo_url }}" /></td>
                    @endif
                    @if ($userKyc?->pancard_file)
                    <td><img src="/storage/{{ $userKyc->pancard_file }}" /></td>
                    @endif
                    @if ($userKyc?->bank_proof_file)
                    <td><img src="/storage/{{ $userKyc->bank_proof_file }}" /></td>
                    @endif
                    @if ($userKyc?->address_proof_file)
                    <td><img src="/storage/{{ $userKyc->address_proof_file }}" /></td>
                    @endif
                </tr>
            </table>
        </div>
    </x-mary-modal>
</div>
