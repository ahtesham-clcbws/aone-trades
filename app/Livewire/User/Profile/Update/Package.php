<?php

namespace App\Livewire\User\Profile\Update;

use App\Models\User;
use App\Models\UserPlanRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mary\Traits\Toast;

class Package extends Component
{
    use Toast;
    public User $user;

    public $package;

    public $packages = [
        "Standard",
        "Classic",
        "Expert",
        "Master",
        "Pro"
    ];

    public $planRequest = null;

    public function mount()
    {
        $this->user = Auth::user();
        $this->package = $this->user->package;
        $planRequests = $this->user->pendingPlanRequests;
        if ($planRequests && count($planRequests)) {
            $this->planRequest = $planRequests[0];
        }
    }

    public function render()
    {
        return view('livewire.user.profile.update.package');
    }

    public function save()
    {
        try {
            if ($this->planRequest) {
                if ($this->package !== $this->user->package) {
                    $planRequest = new UserPlanRequest();
                    $planRequest->user_id = $this->user->id;
                    $planRequest->package = $this->package;
                    $planRequest->save();
                    return $this->success('Account upgrade request recieved successfully, please wait for sometime our executive will get in touch with you.');
                }
                return $this->error('Change plan first, to submit the request.');
            }
            return $this->error('You already have another plan change request is in process.');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
