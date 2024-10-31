<?php

namespace App\Livewire\User\Account;

use App\Models\User;
use App\Models\UserTransferDetail;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;
use Livewire\Attributes\Rule;

#[Layout('layouts.app')]
class BankInfo extends Component
{
    use Toast;

    public $editDetails = null;
    public $openAddDetailsForm = false;
    public $planRequest = null;

    public $transferDetails = [];
    public $transferTypeAlreadyAdded = []; // Bank, UPI, USDT
    public $typeOptions = [
        [
            'id' => 'Bank',
            'name' => 'Bank'
        ],
        [
            'id' => 'UPI',
            'name' => 'UPI'
        ],
        [
            'id' => 'USDT',
            'name' => 'USDT'
        ]
    ];


    #[Validate(['required', 'string'])]
    public $type;

    #[Rule]
    public $address = null;

    #[Validate(['required_if:type,Bank'])]
    public $bank_name = null;
    #[Validate(['required_if:type,Bank'])]
    public $bank_branch = null;
    #[Rule]
    public $ifsc_code = null;

    public function rules()
    {
        return [
            'type' => ['required', 'string'],
            'address' => $this->getAddressRule(),
            'bank_name' => ['required_if:type,Bank'],
            'bank_branch' => ['required_if:type,Bank'],
            'ifsc_code' => $this->getIfscCodeRule(),
        ];
    }

    protected function getAddressRule()
    {
        return match ($this->type) {
            'Bank' => ['required', 'numeric'], // Account number validation
            'UPI' => ['required', 'regex:/^[a-z0-9]*@[a-z]*$/'], // UPI validation
            'USDT' => ['required', 'regex:/^T[A-Za-z1-9]{33}$/'], // USDT validation
            default => ['required'],
        };
    }

    protected function getIfscCodeRule()
    {
        return $this->type === 'Bank'
            ? ['required', 'regex:/^[A-Z]{4}0[A-Z0-9]{6}$/']
            : [];
    }

    public function messages()
    {
        return [
            'address.required' => 'The address field is required.',
            'address.numeric' => 'The account number should contain only numbers.',
            'address.regex' => $this->getAddressErrorMessage(),

            'ifsc_code.required' => 'The IFSC code is required for bank transfers.',
            'ifsc_code.regex' => 'The IFSC code format is invalid. It should match the format: ABCD0EFGHIJ.',
        ];
    }

    protected function getAddressErrorMessage()
    {
        return match ($this->type) {
            'UPI' => 'The UPI address format is invalid. Example: upinumber@bankname',
            'USDT' => 'The USDT address format is invalid. It should start with "T" followed by 33 alphanumeric characters.',
            default => 'The address format is invalid.',
        };
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(#[CurrentUser] User $user)
    {
        $this->getInitialData($user);
    }
    public function getInitialData($user)
    {
        if ($user->pendingPlanRequests && count($user->pendingPlanRequests)) {
            $this->planRequest = $user->pendingPlanRequests[0];
        }
        $this->transferDetails = $user->transfer_details;
        if (count($user->transfer_details)) {
            foreach ($user->transfer_details as $transfer_detail) {
                $this->transferTypeAlreadyAdded[] = $transfer_detail->type;
            }
            foreach ($this->typeOptions as $key => $typeOption) {
                if (in_array($typeOption['name'], $this->transferTypeAlreadyAdded)) {
                    $this->typeOptions[$key] = [
                        'id' => $typeOption['id'],
                        'name' => $typeOption['name'],
                        'disabled' => true
                    ];
                } else {
                    $this->typeOptions[$key] = [
                        'id' => $typeOption['id'],
                        'name' => $typeOption['name'],
                        'disabled' => false
                    ];
                }
            }
        }
    }
    public function resetForm()
    {
        $this->editDetails = null;
        $this->type = null;
        $this->address = null;
        $this->bank_name = null;
        $this->bank_branch = null;
        $this->ifsc_code = null;
    }

    public function addDetails($id = null)
    {
        $this->resetForm();
        $this->openAddDetailsForm = true;
    }
    public function closeModal()
    {
        $this->resetForm();
        $this->openAddDetailsForm = false;
    }

    public function save(#[CurrentUser] User $user)
    {
        $this->validate();
        if ($this->editDetails) {
            return $this->update($user);
        }
        return $this->store($user);
    }
    public function store(#[CurrentUser] User $user)
    {
        try {
            $newDetails = new UserTransferDetail();
            $newDetails->user_id = $user->id;
            $newDetails->type = $this->type;
            $newDetails->address = $this->address;
            $newDetails->bank_name = $this->bank_name;
            $newDetails->bank_branch = $this->bank_branch;
            $newDetails->ifsc_code = $this->ifsc_code;
            $newDetails->save();
            $this->resetForm();
            $this->openAddDetailsForm = false;
            $this->success('Details successfully added.');
            $this->getInitialData($user);
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }
    public function update($user)
    {
        try {
            $this->editDetails->type = $this->type;
            $this->editDetails->address = $this->address;
            $this->editDetails->bank_name = $this->bank_name;
            $this->editDetails->bank_branch = $this->bank_branch;
            $this->editDetails->ifsc_code = $this->ifsc_code;
            $this->editDetails->isActive = true;
            $this->editDetails->save();
            $this->resetForm();
            $this->openAddDetailsForm = false;
            $this->success('Details updated successfully.');
            $this->getInitialData($user);
        } catch (\Throwable $th) {
            report($th->getMessage());
            $this->error($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.user.account.bank-info');
    }
}
