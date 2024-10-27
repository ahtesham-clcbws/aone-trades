<?php

namespace App\Livewire\User;

use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $showAlert = true;
    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
