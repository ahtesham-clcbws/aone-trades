<?php

namespace App\Livewire\Website\Pages;
use Livewire\Attributes\Title;
use Livewire\Component;

class IbPartner extends Component
{
    #[Title('IB Partner')]
    public function render()
    {
        return view('livewire.website.pages.ib-partner');
    }
}
