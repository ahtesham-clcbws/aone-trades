<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class Info extends Component
{
    #[Title('Info')]
    public function render()
    {
        return view('livewire.website.pages.info');
    }
}
