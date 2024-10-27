<?php

namespace App\Livewire\Admin\Deposit;

use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('admin.layouts.admin')]
class Details extends Component
{
    public function render()
    {
        return view('livewire.admin.deposit.details');
    }
}
