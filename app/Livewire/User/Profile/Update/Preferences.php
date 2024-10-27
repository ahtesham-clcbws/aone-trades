<?php

namespace App\Livewire\User\Profile\Update;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Mary\Traits\Toast;

class Preferences extends Component
{
    use Toast;
    public User $user;

    public $timezone;
    public $address;
    public $city;
    public $state;
    public $country;
    public $pincode;

    public function mount()
    {
        $this->user = Auth::user();
        $this->timezone = $this->user->timezone;
        $this->city = $this->user->city;
        $this->address = $this->user->address;
        $this->state = $this->user->state;
        $this->country = $this->user->country;
        $this->pincode = $this->user->pincode;
    }
    public function render()
    {
        return view('livewire.user.profile.update.preferences');
    }

    public function save()
    {
        try {
            $userDetails = [
                'timezone' => $this->timezone,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'pincode' => $this->pincode,
            ];
            Validator::make($userDetails, [
                'timezone' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:13'],
                'state' => ['required', 'string', 'max:13'],
                'country' => ['required', 'string', 'max:13'],
                'pincode' => ['required', 'integer', 'maxlength:6', 'minlength:5']
            ]);
            $this->user->forceFill([
                'timezone' => $userDetails['timezone'],
                'address' => $userDetails['address'],
                'city' => $userDetails['city'],
                'state' => $userDetails['state'],
                'country' => $userDetails['country'],
                'pincode' => $userDetails['pincode']
            ])->save();
            return $this->success('Preferences update successfully.');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
