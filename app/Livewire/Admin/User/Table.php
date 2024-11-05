<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserKyc;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

#[Layout('admin.layouts.admin')]
class Table extends Component
{
    use Toast;
    use WithPagination;
    use WithFileUploads;
    public $perPage = 10;

    public bool $showUserDetailsModal = false;
    public User $thisUser;

    public bool $showManualKycModal = false;
    public User $kycUser;

    #[Validate('required|image')]
    public $pancard_proof;
    #[Validate('required|image')]
    public $address_proof;
    #[Validate('required|image')]
    public $address_proof_back;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'package', 'label' => 'Plan'],
            ['key' => 'IsIBPartner', 'label' => 'IB Partner'],
            ['key' => 'created_at', 'label' => 'Registration'],
            ['key' => 'status', 'label' => 'KYC Status'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $users = User::with('ib_partnet_request')->orderBy('id', 'desc')->where('role', 'user')->paginate(10);

        return view('livewire.admin.user.table', [
            'headers' => $headers,
            'users' => $users
        ]);
    }

    public function viewUser($id)
    {
        try {
            $user = User::find($id);
            $this->thisUser = $user;
            $this->showUserDetailsModal = true;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }

    public function openManualKycModal($id)
    {
        try {
            $user = User::find($id);
            $this->kycUser = $user;
            $this->showManualKycModal = true;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }

    public function saveApproveKyc()
    {
        try {
            $this->validate();

            $pancard_file = $this->pancard_proof->store('kyc/' . $this->kycUser->id, 'public');
            $address_proof_file = $this->address_proof->store('kyc/' . $this->kycUser->id, 'public');
            $address_proof_file_back = $this->address_proof_back->store('kyc/' . $this->kycUser->id, 'public');

            $kyc = new UserKyc();
            $kyc->user_id = $this->kycUser->id;

            $kyc->pancard_file = $pancard_file;
            $kyc->address_proof_file = $address_proof_file;
            $kyc->address_proof_file_back = $address_proof_file_back;

            $kyc->status = 'approved';

            $kyc->save();

            $this->success('User KYC approved successfully');
            $this->js('window.location.reload()');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
