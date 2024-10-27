<?php

namespace App\Livewire\Admin\Withdrawal;

use App\Models\UserWithdrawl;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('admin.layouts.admin')]
class Requests extends Component
{
    use WithPagination;
    public $perPage = 10;
    public array $expanded = [];
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'user.name', 'label' => 'Name'],
            ['key' => 'user.email', 'label' => 'Email'],
            ['key' => 'amount', 'label' => 'Amount'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Date'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];

        $withdrawls = UserWithdrawl::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.withdrawal.requests', [
            'headers' => $headers,
            'withdrawls' => $withdrawls
        ]);
    }
}
