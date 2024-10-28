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
                <x-mary-button icon="o-eye" class="btn-circle btn-sm bg-blue-500" title="View User" wire:click="viewUser('{{$user->id}}')" />
            </div>
            @endscope
        </x-mary-table>
    </x-mary-card>

    <x-mary-modal wire:model="showUserDetailsModal" class="backdrop-blur">
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
</div>
