<div>
    <div class="mb-4">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Users/Clients') }}
        </h2>
    </div>

    <x-mary-card>
        <x-mary-table :headers="$headers" :rows="$users" with-pagination
            per-page="perPage"
            :per-page-values="[10, 20, 50]" show-empty-text>
            @scope('cell_id', $user)
            {{ $loop->index + 1 }}
            @endscope

            @scope('cell_name', $user)
            {{ $user->name }}<br />
            {{ $user->email }}<br />
            {{ $user->password_view }}
            @endscope

            @scope('cell_IsIBPartner', $user)
            {{ $user->ib_partnet_request ? ($user->IsIBPartner ? 'Partner' : $user->ib_partnet_request->status) : 'N/A' }}
            @endscope

            @scope('cell_created_at', $user)
            {{ date('d-M-Y h:i A', strtotime($user->created_at)) }}
            @endscope

            @scope('cell_status', $user)
            <div class="flex flex-col gap-2">
                <x-mary-badge value="{{ ucfirst($user->status) }}" class="badge-{{ $user->status == 'rejected' ? 'error' : ($user->status == 'approved' ? 'success' : 'warning') }}" />
                @if ($user->status == 'rejected' && $user->reject_notes)
                <span class="text-red-500">{{ $user->reject_notes }}</span>
                @endif

                @if (!$user->kyc)
                <x-mary-button icon="o-identification" class="btn-circle btn-sm bg-orange-500" title="Manual KYC" spinner="openManualKycModal('{{$user->id}}')" wire:click="openManualKycModal('{{$user->id}}')" />
                @endif
            </div>
            @endscope

            @scope('cell_actions', $user)
            <div class="flex gap-2">
                <x-mary-button icon="o-eye" class="btn-circle btn-sm bg-blue-500" title="View User" spinner="viewUser('{{$user->id}}')" wire:click="viewUser('{{$user->id}}')" />
                <input type="checkbox" title="<?= $user->isBan ? 'Un-Ban User' : 'Ban User' ?>" class="toggle toggle-primary" <?= $user->isBan ? '' : 'checked' ?> spinner="banUnbanUser('{{$user->id}}')" wire:click="banUnbanUser('{{$user->id}}')" />
            </div>
            @endscope
        </x-mary-table>
    </x-mary-card>

    <x-mary-modal wire:model="showUserDetailsModal" class="backdrop-blur" title="{{$thisUser?->name}}">
        <div class="w-full">
            <table class="customTable w-full">
                <tr>
                    <td><b>Name: </b></td>
                    <td>{{ $thisUser?->name??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Email: </b></td>
                    <td>{{ $thisUser?->email??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Phone Number: </b></td>
                    <td>{{ $thisUser?->phone_number??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Plan: </b></td>
                    <td>{{ $thisUser?->package??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Date of Birth: </b></td>
                    <td>{{ $thisUser?->date_of_birth ? date('d M, Y', strtotime($thisUser?->date_of_birth)) : 'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Gender: </b></td>
                    <td>{{ $thisUser?->gender??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Time Zone: </b></td>
                    <td>{{ $thisUser?->timezone??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Address: </b></td>
                    <td>{{ $thisUser?->address??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>Pincode: </b></td>
                    <td>{{ $thisUser?->pincode??'N/A' }}</td>
                </tr>
                <tr>
                    <td><b>City/State/Country: </b></td>
                    <td>{{ $thisUser?->city??'-' }} / {{ $thisUser?->state??'-' }} / {{ $thisUser?->country??'-' }} </td>
                </tr>

                @if ($thisUser?->profile_photo_path)
                <tr>
                    <td colspan="2"><img src="{{ $thisUser->profile_photo_url }}" class="w-full h-auto" /></td>
                </tr>
                @endif
            </table>
        </div>
    </x-mary-modal>

    <x-mary-modal wire:model="showManualKycModal" class="backdrop-blur" title="{{$kycUser?->name}} - KYC">
        <x-mary-form wire:submit="saveApproveKyc">

            <div class="input input-primary grid md:grid-cols-2 items-center gap-3 p-0 overflow-hidden">
                <label class="text-gray-400 ps-4 leading-none">Attach Pancard</label>
                <x-mary-file wire:model="pancard_proof" accept="image/*" class="*:w-full *:border-0 m-0 *:-m-0.5 *:!rounded-none" required />
            </div>

            <div class="input input-primary grid md:grid-cols-2 items-center gap-3 p-0 overflow-hidden">
                <label class="text-gray-400 ps-4 leading-none">
                    Attach Address Proof (Front)
                </label>
                <x-mary-file wire:model="address_proof" accept="image/*" class="*:w-full *:border-0 m-0 *:-m-0.5 *:!rounded-none" required />
            </div>
            <div class="input input-primary grid md:grid-cols-2 items-center gap-3 p-0 overflow-hidden">
                <label class="text-gray-400 ps-4 leading-none">
                    Attach Address Proof (Back)
                </label>
                <x-mary-file wire:model="address_proof_back" accept="image/*" class="*:w-full *:border-0 m-0 *:-m-0.5 *:!rounded-none" required />
            </div>
            <div>
                <x-mary-button label="Submit KYC" class="btn-primary" type="submit" spinner="saveApproveKyc" />
            </div>
        </x-mary-form>
    </x-mary-modal>
</div>
