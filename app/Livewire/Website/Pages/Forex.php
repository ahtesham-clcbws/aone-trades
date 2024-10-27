<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class Forex extends Component
{
    #[Title('Forex')]
    public function render()
    {
        return view('livewire.website.pages.forex');
    }
}
