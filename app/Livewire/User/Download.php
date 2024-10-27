<?php

namespace App\Livewire\User;

use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class Download extends Component
{
    public function render()
    {
        return view('livewire.user.download');
    }
}
