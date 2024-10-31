<?php

namespace App\Livewire\User\Account;

use App\Livewire\Forms\User\Account\KycForm;
use App\Models\Help;
use App\Models\User;
use App\Models\UserKyc;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

#[Layout('layouts.app')]
class Kyc extends Component
{
    use Toast;
    use WithFileUploads;

    public $kycSubmitted = false;
    public ?UserKyc $userKyc = null;
    public $kycStatus = 'pending';

    public string $group = 'group1';

    public $kycInformationBlock = [];
    public $documentInformationBlock = [];
    public $generalInformationBlock = [];

    public bool $showKycForm = false;

    #[Validate('required|image')]
    public $pancard_proof;
    #[Validate('required|image')]
    public $address_proof;
    #[Validate('required|image')]
    public $address_proof_back;


    public function mount(#[CurrentUser] User $user)
    {
        $userKyc = UserKyc::where('user_id', $user->id)->first();
        if ($userKyc) {
            $this->kycSubmitted = true;
            $this->userKyc = $userKyc;
        }
        $this->kycStatus = $user->getKycStatus();

        $this->kycInformationBlock = Help::where('help_category_id', 1)->where('in_kyc', true)->get();
        $this->documentInformationBlock = Help::where('help_category_id', 2)->where('in_kyc', true)->get();
        $this->generalInformationBlock = Help::where('help_category_id', 3)->where('in_kyc', true)->get();

        // show kyx form logic
        $showKycForm = false;
        if (!$userKyc) {
            $showKycForm = true;
        }
        if ($userKyc && $userKyc->status == 'rejected') {
            $showKycForm = true;
        }
        $this->showKycForm = $showKycForm;
    }

    public function render()
    {
        return view('livewire.user.account.kyc');
    }

    public function save(#[CurrentUser] User $user)
    {
        if (!$this->userKyc) {
            $this->store($user);
        } else {
            $this->update($user);
        }
    }

    public function store(#[CurrentUser] User $user)
    {
        try {
            $this->validate();

            $pancard_file = $this->pancard_proof->store('kyc/' . $user->id, 'public');
            $address_proof_file = $this->address_proof->store('kyc/' . $user->id, 'public');
            $address_proof_file_back = $this->address_proof_back->store('kyc/' . $user->id, 'public');

            $userKyc = new UserKyc();

            $userKyc->user_id = $user->id;

            $userKyc->pancard_file = $pancard_file;
            $userKyc->address_proof_file = $address_proof_file;
            $userKyc->address_proof_file_back = $address_proof_file_back;

            $userKyc->save();

            $this->success('KYC submitted successfully');
            $this->js('window.location.reload()');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
    public function update(#[CurrentUser] User $user)
    {
        try {
            $this->validate();

            $userKyc = UserKyc::find($this->userKyc->id);

            $pancard_file = $this->pancard_proof->store('kyc/' . $user->id, 'public');
            $address_proof_file = $this->address_proof->store('kyc/' . $user->id, 'public');
            $address_proof_file_back = $this->address_proof_back->store('kyc/' . $user->id, 'public');

            $userKyc->pancard_file = $pancard_file;
            $userKyc->address_proof_file = $address_proof_file;
            $userKyc->address_proof_file_back = $address_proof_file_back;

            $userKyc->save();

            $this->success('KYC re-submitted successfully');
            $this->js('window.location.reload()');
            $this->reset();
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
