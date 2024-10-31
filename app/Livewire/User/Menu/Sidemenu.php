<?php

namespace App\Livewire\User\Menu;

use Livewire\Component;

class Sidemenu extends Component
{
    public $openConfirmModal = false;
    public function render()
    {
        return view('livewire.user.menu.sidemenu');
    }

}
