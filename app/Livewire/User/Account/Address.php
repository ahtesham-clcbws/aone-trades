<?php

namespace App\Livewire\User\Account;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

#[Layout('layouts.app')]
class Address extends Component
{
    use Toast;

    public $showEditForm = false;


    public $timezone;
    public $address;
    public $city;
    public $state;
    public $country;
    public $pincode;


    public function mount(#[CurrentUser] User $user)
    {
        $this->timezone = $user->timezone;
        $this->city = $user->city;
        $this->address = $user->address;
        $this->state = $user->state;
        $this->country = $user->country;
        $this->pincode = $user->pincode;
    }
    public function render()
    {
        return view('livewire.user.account.address');
    }

    public function showForm()
    {
        $this->showEditForm = true;
    }
    public function closeForm()
    {
        $this->showEditForm = false;
    }

    public function save(#[CurrentUser] User $user)
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
            $user->forceFill([
                'timezone' => $userDetails['timezone'],
                'address' => $userDetails['address'],
                'city' => $userDetails['city'],
                'state' => $userDetails['state'],
                'country' => $userDetails['country'],
                'pincode' => $userDetails['pincode']
            ])->save();
            $this->success('Preferences update successfully.');
            $this->closeForm();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
