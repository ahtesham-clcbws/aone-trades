<?php

namespace App\Livewire\User\Fund;

use Livewire\Component;
use App\Models\User;
use App\Models\UserWithdrawl;
use Illuminate\Container\Attributes\CurrentUser;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Mary\Traits\Toast;

#[Layout('layouts.app')]
class Withdraw extends Component
{
    use Toast;

    #[Validate('required|current_password:web')]
    public $password;
    #[Validate('required')]
    public $amount;
    #[Validate('nullable|string')]
    public $comments;
    #[Validate('required')]
    public $type;

    public $transferDetails = [];
    public $transferTypeAlreadyAdded = [];
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

    public function mount(#[CurrentUser] User $user)
    {
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
                        'disabled' => false
                    ];
                } else {
                    $this->typeOptions[$key] = [
                        'id' => $typeOption['id'],
                        'name' => $typeOption['name'],
                        'disabled' => true
                    ];
                }
            }
        }
    }

    public function save(#[CurrentUser] User $user)
    {
        if(!count($this->transferTypeAlreadyAdded)){
            return $this->error('You don\'t have any mode selected.' );
        }
        try {
            $this->validate();

            UserWithdrawl::create([
                'user_id' => $user->id,
                'amount' => $this->amount,
                'type' => $this->type,
                'user_comments' => $this->comments,
            ]);

            return redirect()->to('/user/history/withdraw');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.user.fund.withdraw');
    }
}
