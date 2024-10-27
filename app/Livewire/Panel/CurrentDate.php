<?php

namespace App\Livewire\Panel;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Livewire\Component;

class CurrentDate extends Component
{
    public $timezone;
    public function mount(#[CurrentUser] User $user)
    {
        $this->timezone = $user->timezone ?? 'Asia/Kolkata';
    }
    public function render()
    {
        return view('livewire.panel.current-date');
    }
}
