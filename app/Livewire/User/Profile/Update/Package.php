<?php

namespace App\Livewire\User\Profile\Update;

use App\Models\User;
use App\Models\UserPlanRequest;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mary\Traits\Toast;

class Package extends Component
{
    use Toast;
    public User $user;

    public $package = null;

    public $planRequest = null;

    public $ourPackages = [];

    public function mount(#[CurrentUser] User $user)
    {
        $packages = [];
        $this->user = $user;

        foreach (getPlans() as $package) {
            $newPackage = [
                'id' => $package->name,
                'name' => $package->name
            ];
            if ($package == $user->package) {
                $newPackage['disabled'] = true;
            }
            $packages[] = $newPackage;
        }
        $this->ourPackages = $packages;

        $this->package = $user->package;
        $planRequests = $user->pendingPlanRequests;
        if ($planRequests && count($planRequests)) {
            $this->planRequest = $planRequests[0];
        }
    }

    public function render()
    {
        return view('livewire.user.profile.update.package');
    }

    public function save(#[CurrentUser] User $user)
    {
        try {
            if (!$this->planRequest) {
                if ($this->package !== $user->package) {
                    $planRequest = new UserPlanRequest();
                    $planRequest->user_id = $user->id;
                    $planRequest->current_package = $user->package;
                    $planRequest->package = $this->package;
                    $planRequest->save();
                    $this->success('Account upgrade request recieved successfully, please wait for sometime our executive will get in touch with you.');
                    return $this->js('window.location.reload()');
                }
                return $this->error('Change plan first, to submit the request.');
            }
            return $this->error('You already have another plan change request is in process.');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
