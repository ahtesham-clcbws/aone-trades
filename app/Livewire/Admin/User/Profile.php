<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('admin.layouts.admin')]
class Profile extends Component
{
    public function render()
    {
        return view('livewire.admin.user.profile');
    }
}
