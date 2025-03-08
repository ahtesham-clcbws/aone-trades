<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserKyc;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
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

        $users = User::with('ib_partnet_request')->orderBy('id', 'desc')->where('role', 'user')->paginate($this->perPage);

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

    public function banUnbanUser($id)
    {
        try {
            $user = User::find($id);
            $banStatus = $user->isBan;
            $user->isBan = !$banStatus;
            $message = $banStatus ? 'Ban' : 'Un-Ban';
            $user->save();
            $this->success('User ' . $message . ' successfully');
            // $this->js('window.location.reload()');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }

    public function loginAsUser($userId)
    {
        try {
            // Find the user
            $user = User::findOrFail($userId);

            // Log out the current user (admin)
            // Auth::guard('web')->logout();

            // Log in the new user (without a password)
            Auth::guard('web')->login($user, true);
            // $guard = new StatefulGuard();
            // $guard->login($user, true);

            // Generate a Sanctum token for the user
            // $token = $user->createToken('impersonation-token')->plainTextToken;

            // Store the token in the session
            // Session::put('auth_token', $token);

            // Regenerate the session ID for security
            Session::regenerate();

            // Redirect to the user's dashboard
            return redirect()->intended('user/dashboard');
        } catch (\Throwable $th) {
            // Log the error
            logger('Impersonate error: ', [
                'throw message' => $th->getMessage(),
                'throw response' => $th
            ]);

            // Show an error message
            $this->error($th->getMessage());
        }
    }
}
