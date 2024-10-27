<?php

namespace App\Livewire\User\History;

use App\Models\User;
use App\Models\UserDeposit;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Component;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Deposit extends Component
{
    use WithPagination;

    public bool $openImage = false;
    public string $imagePath = '';

    public function render(#[CurrentUser] User $user)
    {

        $headers = [
            ['key' => 'deposit_receipt', 'label' => '#'],
            ['key' => 'amount', 'label' => 'Amount'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'created_at', 'label' => 'Date'],
        ];

        $deposits = UserDeposit::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.user.history.deposit', [
            'headers' => $headers,
            'deposits' => $deposits
        ]);
    }

    public function openDepositImage($imagePath)
    {
        $this->imagePath = $imagePath;
        $this->openImage = true;
    }
}
