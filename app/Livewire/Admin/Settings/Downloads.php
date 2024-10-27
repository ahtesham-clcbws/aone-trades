<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('admin.layouts.admin')]
class Downloads extends Component
{
    public function render()
    {
        return view('livewire.admin.settings.downloads');
    }
}
