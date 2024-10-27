<?php

namespace App\Livewire\Admin\Deposit;

use App\Models\UserDeposit;
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
        $deposits = UserDeposit::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.deposit.requests', [
            'headers' => $headers,
            'deposits' => $deposits
        ]);
    }
}
