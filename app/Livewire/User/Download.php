<?php

namespace App\Livewire\User;

use App\Models\Download as ModelsDownload;
use Livewire\Component;

use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Download extends Component
{
    public $downloads;
    public function mount()
    {
        $this->downloads = ModelsDownload::all();
    }
    public function render()
    {
        return view('livewire.user.download');
    }
}
