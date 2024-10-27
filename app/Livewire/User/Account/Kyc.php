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
    public $userKyc = null;
    public $kycStatus = 'pending';

    public string $group = 'group1';

    public $kycInformationBlock = [];
    public $documentInformationBlock = [];
    public $generalInformationBlock = [];

    public bool $showKycForm = false;


    use Toast;
    use WithFileUploads;

    public ?UserKyc $kyc;

    #[Validate('required|min:5')]
    public $name;

    #[Validate('required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/')]
    public $pancard;

    #[Validate('nullable|image')]
    public $pancard_proof;

    #[Validate('required|min:5')]
    public $bank_name;

    #[Validate('required|confirmed|digits_between:11,16')]
    public $account_number;

    #[Validate('required|digits_between:11,16')]
    public $account_number_confirmation;

    #[Validate('required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/')]
    public $ifsc_code;

    #[Validate('nullable|image')]
    public $bank_proof;

    #[Validate('nullable|image')]
    public $address_proof;


    public function mount(#[CurrentUser] User $user)
    {
        $userKyc = UserKyc::where('user_id', $user->id)->first();
        if ($userKyc) {
            $this->kycSubmitted = true;
            $this->userKyc = $userKyc;
            $this->setData($userKyc);
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

    public function setData(UserKyc $kyc)
    {
        $this->name = $kyc->name;

        $this->pancard = $kyc->pancard;

        $this->bank_name = $kyc->bank_name;

        $this->account_number = $kyc->account_number;
        $this->account_number_confirmation = $kyc->account_number;

        $this->ifsc_code = $kyc->ifsc_code;
    }

    public function store(#[CurrentUser] User $user)
    {
        try {
            $this->validate();

            $pancard_proof_path = null;
            $bank_proof_path = null;
            $address_proof_path = null;
            if ($this->pancard_proof) {
                $pancard_proof_path = $this->pancard_proof->store('kyc/' . $user->id, 'public');
            }
            if ($this->bank_proof) {
                $bank_proof_path = $this->bank_proof->store('kyc/' . $user->id, 'public');
            }
            if ($this->address_proof) {
                $address_proof_path = $this->address_proof->store('kyc/' . $user->id, 'public');
            }

            $userKyc = new UserKyc();

            $userKyc->user_id = $user->id;

            $userKyc->name = $this->name;
            $userKyc->pancard = $this->pancard;
            $userKyc->bank_name = $this->bank_name;
            $userKyc->account_number = $this->account_number;
            $userKyc->ifsc_code = $this->ifsc_code;

            $userKyc->pancard_file = $pancard_proof_path;
            $userKyc->bank_proof_file = $bank_proof_path;
            $userKyc->address_proof_file = $address_proof_path;

            $userKyc->save();

            $this->success('KYC submitted successfully');
            // refresh the page after submit
            $this->reset();
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
    public function update(#[CurrentUser] User $user)
    {
        try {
            // $this->validate();


            $userKyc = UserKyc::find($this->kyc->id);

            $userKyc->name = $this->name;
            $userKyc->pancard = $this->pancard;
            $userKyc->bank_name = $this->bank_name;
            $userKyc->account_number = $this->account_number;
            $userKyc->ifsc_code = $this->ifsc_code;

            if ($this->pancard_proof) {
                $pancard_proof_path = $this->pancard_proof->store('kyc/' . $user->id, 'public');
                $userKyc->pancard_file = $pancard_proof_path;
            }
            if ($this->bank_proof) {
                $bank_proof_path = $this->bank_proof->store('kyc/' . $user->id, 'public');
                $userKyc->bank_proof_file = $bank_proof_path;
            }
            if ($this->address_proof) {
                $address_proof_path = $this->address_proof->store('kyc/' . $user->id, 'public');
                $userKyc->address_proof_file = $address_proof_path;
            }

            $userKyc->save();

            $this->success('KYC re-submitted successfully');
            // refresh the page after submit
            $this->reset();
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
