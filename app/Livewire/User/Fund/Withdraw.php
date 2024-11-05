<?php

namespace App\Livewire\User\Fund;

use Livewire\Component;
use App\Models\User;
use App\Models\UserWithdrawl;
use Illuminate\Container\Attributes\CurrentUser;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Mary\Traits\Toast;
use Livewire\Attributes\Rule;

#[Layout('layouts.app')]
class Withdraw extends Component
{
    use Toast;

    #[Validate(['required', 'numeric'])]
    public $amount;

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
            'amount' => ['required', 'numeric'],
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

    public function mount(#[CurrentUser] User $user) {}

    public function save(#[CurrentUser] User $user)
    {
        try {
            $this->validate();

            $newRequest = new UserWithdrawl();

            $newRequest->user_id = $user->id;
            $newRequest->amount = $this->amount;
            $newRequest->type = $this->type;

            $newRequest->address = $this->address;

            if ($this->type == 'Bank') {
                $newRequest->bank_name = $this->bank_name;
                $newRequest->bank_branch = $this->bank_branch;
                $newRequest->ifsc_code = $this->ifsc_code;
            }

            $newRequest->save();

            redirect()->to('/user/history/withdraw');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            throw $th;
        }
    }
    public function render()
    {
        return view('livewire.user.fund.withdraw');
    }
}
