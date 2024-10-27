<?php

namespace App\Livewire\User\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class Profile extends Component
{
    public $planRequest = null;

    public function mount()
    {
        $user = Auth::user();
        if ($user->pendingPlanRequests && count($user->pendingPlanRequests)) {
            $this->planRequest = $user->pendingPlanRequests[0];
        }
    }
    public function render()
    {
        return view('livewire.user.account.profile');
    }
}
