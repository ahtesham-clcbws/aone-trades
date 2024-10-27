<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class Commodities extends Component
{
    #[Title('Commodities')]
    public function render()
    {
        return view('livewire.website.pages.commodities');
    }
}
