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

    public function save(#[CurrentUser] User $user)
    {
        try {
            $this->validate();

            UserWithdrawl::create([
                'user_id' => $user->id,
                'amount' => $this->amount,
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
