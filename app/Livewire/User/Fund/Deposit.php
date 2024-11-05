<?php

namespace App\Livewire\User\Fund;

use App\Models\UserDeposit;
use Livewire\Component;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

#[Layout('layouts.app')]
class Deposit extends Component
{
    use Toast;
    use WithFileUploads;

    public $showSection = null;
    public function setShowSection($section)
    {
        if ($this->showSection == $section) {
            $this->showSection = null;
        } else {
            $this->showSection = $section;
        }
    }

    #[Validate('image')]
    public $file;

    #[Validate('required')]
    public $amount;

    public function save(#[CurrentUser] User $user)
    {
        try {
            $this->validate();

            $filepath = $this->file->store('deposit-files', 'public');

            UserDeposit::create([
                'user_id' => $user->id,
                'amount' => $this->amount,
                'deposit_receipt' => $filepath,
            ]);

            redirect()->to('/user/history/deposit');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            throw $th;
        }
    }

    public function render()
    {
        return view('livewire.user.fund.deposit');
    }
}
