<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Mary\Traits\Toast;

#[Layout('admin.layouts.admin')]
class Table extends Component
{
    use Toast;
    use WithPagination;
    public $perPage = 10;

    public bool $showUserDetailsModal = false;
    public User $thisUser;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'package', 'label' => 'Plan'],
            ['key' => 'created_at', 'label' => 'Registration'],
            ['key' => 'password_view', 'label' => 'PWD'],
            ['key' => 'status', 'label' => 'KYC Status'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $users = User::orderBy('id', 'desc')->where('role', 'user')->paginate(10);

        return view('livewire.admin.user.table', [
            'headers' => $headers,
            'users' => $users
        ]);
    }

    public function viewUser($id){
        try {
            $user = User::find($id);
            $this->thisUser = $user;
            $this->showUserDetailsModal = true;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }

}
