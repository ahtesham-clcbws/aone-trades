<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('admin.layouts.admin')]
class Table extends Component
{
    use WithPagination;
    public $perPage = 10;
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'package', 'label' => 'Plan'],
            ['key' => 'created_at', 'label' => 'Registration'],
            ['key' => 'status', 'label' => 'KYC Status'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $users = User::orderBy('id', 'desc')->where('role', 'user')->paginate(10);

        return view('livewire.admin.user.table', [
            'headers' => $headers,
            'users' => $users
        ]);
    }
}
