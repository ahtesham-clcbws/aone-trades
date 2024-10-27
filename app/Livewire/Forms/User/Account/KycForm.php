<?php

namespace App\Livewire\Forms\User\Account;

use App\Models\User;
use App\Models\UserKyc;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class KycForm extends Form
{
    use Toast;
    use WithFileUploads;

    public ?UserKyc $kyc;

    #[Validate('required|min:5')]
    public $name;

    #[Validate('required|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/')]
    public $pancard;

    #[Validate('image')]
    public $pancard_proof;

    #[Validate('required|min:5')]
    public $bank_name;

    #[Validate('required|confirmed|digits_between:11,16')]
    public $account_number;

    #[Validate('required|digits_between:11,16')]
    public $account_number_confirmation;

    #[Validate('required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/')]
    public $ifsc_code;

    #[Validate('image')]
    public $bank_proof;

    #[Validate('image')]
    public $address_proof;


    public function setData(UserKyc $kyc)
    {
        $this->kyc = $kyc;

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

            $pancard_proof_path = $this->pancard_proof->store('kyc/' . $user->id, 'public');
            $bank_proof_path = $this->bank_proof->store('kyc/' . $user->id, 'public');
            $address_proof_path = $this->address_proof->store('kyc/' . $user->id, 'public');

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
            $this->reset();
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
