<?php

namespace App\Livewire\User\History;

use App\Models\User;
use App\Models\UserWithdrawl;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Withdraw extends Component
{
    use WithPagination;
    public array $expanded = [];

    public function render(#[CurrentUser] User $user)
    {
        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'hidden'],
            ['key' => 'amount', 'label' => 'Amount'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'type', 'label' => 'Transfer On'],
            ['key' => 'created_at', 'label' => 'Date'],
        ];

        $withdrawls = UserWithdrawl::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.user.history.withdraw', [
            'headers' => $headers,
            'withdrawls' => $withdrawls
        ]);
    }
}
