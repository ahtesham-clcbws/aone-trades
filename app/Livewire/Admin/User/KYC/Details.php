<?php

namespace App\Livewire\Admin\User\KYC;

use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('admin.layouts.admin')]
class Details extends Component
{
    public function render()
    {
        return view('livewire.admin.user.k-y-c.details');
    }
}
