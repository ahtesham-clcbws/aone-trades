<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Component;

class KycInformation extends Component
{
    public $showKycModal = false;

    public User $user;

    public function mount(#[CurrentUser] User $user)
    {
        $this->user = $user;
        // if ($user->getKyCStatus() == 'pending') {
        //     $this->showKycModal = true;
        // } else {
        //     $this->showKycModal = false;
        // }
    }

    public function render(#[CurrentUser] User $user)
    {
        $this->user = $user;
        // if ($user->getKyCStatus() == 'pending') {
        //     $this->showKycModal = true;
        // } else {
        //     $this->showKycModal = false;
        // }
        return view('livewire.user.kyc-information');
    }
}
